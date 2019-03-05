<?php
header('content-type:text/html;charset=utf-8');
include_once('../../Library/pdo.class.php');
include_once('../../Library/fileupload.class.php');
include_once('../../Library/function.php');
$method = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
if($method == ''){
	die('非法请求');
}

if($method == 'update'){
	$id      = $_POST['id'];
	$abstract   = $_POST['abstract'];
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
		$sql = 'select * from about where id='.$id;
		$result = $pdo->getData($sql,false);
		$filename = '';
		if($result){
			for($i=0;$i<count(json_decode($result['aimg']));$i++){
				$filename = '../../uploads/'.json_decode($result['aimg'])[$i];
				if(file_exists($filename)){
					unlink($filename);
				}
			}
		}else{
			jumpUrl('原文件不存在，跳过删除！');
		}
		$sql = "update about set abstract='".$abstract."',aimg='".json_encode($image)."' where id='".$id."'";
	}else{
		$sql = "update about set abstract='".$abstract."' where id='".$id."'";
	}
	$result = $pdo->toExec($sql);
	if(is_int($result)){
		jumpUrl('修改成功！','../About/update.php');
	}else{
		jumpUrl('修改失败，请稍后再试！');
	}
}
?>