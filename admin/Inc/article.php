<?php
//资讯管理
header('content-type:text/html;charset=utf-8');
include_once('../../Library/pdo.class.php');
include_once('../../Library/fileupload.class.php');
include_once('../../Library/function.php');
$method = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
if($method == ''){
	die('非法请求');
}
#文章
if($method=='add'){
	$atitle    = isset($_POST['atitle'])    ? $_POST['atitle']    : '';
	$athor   = isset($_POST['athor'])   ? $_POST['athor']   : '';
	$aabstract   = isset($_POST['aabstract'])   ? $_POST['aabstract']   : '';
	$acontent   = isset($_POST['acontent'])   ? $_POST['acontent']   : '';
	$up = new fileupload;
	$up -> set("path", "../../uploads/".date('ymd'));
	$up -> set("maxsize", 2000000);
	$up -> set("allowtype", array("gif", "png", "jpg","jpeg"));
	$up -> set("israndname", true);
	$image = array();
	//判断pic文件框是否已经选择文件
	if(!empty($_FILES['aimg']['tmp_name'])){
		echo'已选择文件';
	}else{
		echo'请选择文件';
	}
	if($up -> upload("aimg")) {
		foreach($up->getFileName() as $list){
			$image[] = date('ymd').'/'.$list;
		}
	}else{
		echo '<pre>';
		var_dump($up->getErrorMsg());
		echo '</pre>';
		die;
	}
	$sql = "insert into article(athor,atitle,acontent,aimg,aabstract) values('".$athor."','".$atitle."','".$acontent."','".json_encode($image)."','".$aabstract."')";
	$result = $pdo->toExec($sql);
	if(!$result){
		jumpUrl('添加资讯失败，请稍后再试！');
	}else{
		jumpUrl('添加资讯成功','../article/list.php');
	}
}
#资讯删除
if($method == 'delete'){

	$id = isset($_POST['id']) ? $_POST['id'] : '';
	$sql = 'select * from article where aid='.$id;
	$result = $pdo->getData($sql,false);
	$filename = '../../uploads/'.implode(json_decode($result['aimg']));
	if(file_exists($filename)){
		unlink($filename);
	} else {
		echo '文件不存在，删除失败';
	}
	$sqls    = "delete from article where aid = ".$id;
	$results = $pdo->toExec($sqls);
	if($results){
		echo true;
	}else{
		echo '删除文章失败，请您稍后再试！';
	}
}
#批量删除
if($method == 'batch'){
	$message = '';
	$id      = isset($_POST['aid']) ? $_POST['aid'] : '';
	$sql = 'select * from article where aid in ('.implode(",",$id).')';
	$result = $pdo->getData($sql,true);
	foreach($result as $val){
		$filename = '../../uploads/'.implode(json_decode($val['aimg']));
		if(file_exists($filename)){
			echo $filename;
			unlink($filename);
		} else {
			echo '文件不存在，删除失败';
		}
	}
	#删除资讯信息

	$sql = "delete from article where aid in (".implode(',',$id).")";
	$result = $pdo->toExec($sql);
	$message .= '已选文章删除成功！';

	if($result){
		jumpUrl($message,'../article/list.php');
	}else{
		jumpUrl('删除失败，请您稍后再试！');
	}
}
#资讯修改
if($method == 'update'){
	$aid      = $_POST['aid'];
	$atitle    = $_POST['atitle'];
	$athor   = $_POST['athor'];
	$acontent   = $_POST['acontent'];
	$aabstract   = $_POST['aabstract'];


	if($_FILES['aimg']['error'][0] == 0){
		$up = new fileupload;
		$up -> set("path", "../../uploads/".date('ymd'));
		$up -> set("maxsize", 2000000);
		$up -> set("allowtype", array("gif", "png", "jpg","jpeg"));
		$up -> set("israndname", true);
		$image = array();
		if($up -> upload("aimg")) {
			foreach($up->getFileName() as $list){
				$image[] = date('ymd').'/'.$list;
			}
		} else {
			echo '<pre>';
			var_dump($up->getErrorMsg());
			echo '</pre>';
			die;
		}
		$sql = 'select * from article where aid='.$aid;
		$result = $pdo->getData($sql,false);
		$filename = '../../uploads/'.implode(json_decode($result['aimg']));
		if(file_exists($filename)){
			unlink($filename);
		}else {
			echo '原文件删除失败！';
		}
		$sql = "update article set atitle='".$atitle."',athor='".$athor."',acontent='".$acontent."',aimg='".json_encode($image)."',aabstract='".$aabstract."' where aid='".$aid."'";
	}else{
		$sql = "update article set atitle='".$atitle."',athor='".$athor."',acontent='".$acontent."',aabstract='".$aabstract."' where aid='".$aid."'";
	}
	$result = $pdo->toExec($sql);
	if(is_int($result)){
		jumpUrl('修改成功！','../article/list.php');
	}else{
		jumpUrl('修改失败，请稍后再试！');
	}
}
?>