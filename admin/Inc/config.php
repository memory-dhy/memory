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
	$id 		 = $_POST['id'];
	$sitename    = $_POST['sitename'];
	$seotitle    = $_POST['seotitle'];
	$seocontent  = $_POST['seocontent'];
	$copyright 	 = $_POST['copyright'];
	$policeright = $_POST['policeright'];

	if($_FILES['siteicon']['error'][0] == 0){
		$up = new fileupload;
		$up -> set("path", "../../uploads/".date('ymd'));
		$up -> set("maxsize", 2000000);
		$up -> set("allowtype", array("gif", "png", "jpg","jpeg","ico"));
		$up -> set("israndname", true);
		$image = array();
		if($up -> upload("siteicon")) {
			foreach($up->getFileName() as $list){
				$image[] = date('ymd').'/'.$list;
			}
		} else {
			echo '<pre>';
			var_dump($up->getErrorMsg());
			echo '</pre>';
			die;
		}
		$sql = 'select * from config where id='.$id;
		$result = $pdo->getData($sql,false);
		$filename = '../../uploads/'.implode(json_decode($result['siteicon']));
		if(file_exists($filename)){
			unlink($filename);
		}else {
			echo '原文件删除失败！';
		}
		$sql = "update config set sitename='".$sitename."',seotitle='".$seotitle."',seocontent='".$seocontent."',copyright='".$copyright."',policeright='".$policeright."',siteicon='".json_encode($image)."' where id='".$id."'";
	}else{
		$sql = "update config set sitename='".$sitename."',seotitle='".$seotitle."',seocontent='".$seocontent."',copyright='".$copyright."',policeright='".$policeright."' where id='".$id."'";
	}
	$result = $pdo->toExec($sql);
	if(is_int($result)){
		jumpUrl('修改成功！','../Config/index.php');
	}else{
		jumpUrl('修改失败，请稍后再试！');
	}
}
?>