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

	if($_FILES['imgs']['error'][0] == 0){
		$up = new fileupload;
		$up -> set("path", "../../uploads/".date('ymd'));
		$up -> set("maxsize", 2000000);
		$up -> set("allowtype", array("gif", "png", "jpg","jpeg"));
		$up -> set("israndname", true);
		$image = array();
		if($up -> upload("imgs")) {
			foreach($up->getFileName() as $list){
				$image[] = date('ymd').'/'.$list;
			}
		} else {
			echo '<pre>';
			var_dump($up->getErrorMsg());
			echo '</pre>';
			die;
		}

		$sql = 'select * from images where id='.$id;
		$result = $pdo->getData($sql,false);
		$filename1 = '../../uploads/'.json_decode($result['index_img']);
		$filename2 = '../../uploads/'.json_decode($result['article_img']);
		$filename3 = '../../uploads/'.json_decode($result['about_img']);
		$filename4 = '../../uploads/'.json_decode($result['message_img']);
		if($result){
			if(file_exists($filename1)){
				unlink($filename1);
			}
			if(file_exists($filename2)){
				unlink($filename2);
			}
			if(file_exists($filename3)){
				unlink($filename3);
			}
			if(file_exists($filename4)){
				unlink($filename4);
			}
		}else{
			jumpUrl('原文件不存在，跳过删除！');
		}
		$sql = "update images set index_img='".json_encode($image['0'])."',article_img='".json_encode($image['1'])."',about_img='".json_encode($image['2'])."',message_img='".json_encode($image['3'])."' where id='".$id."'";
	}else{
		jumpUrl('未做任何修改');
		die;
	}
	$result = $pdo->toExec($sql);
	if(is_int($result)){
		jumpUrl('修改成功！','../picture/update.php');
	}else{
		jumpUrl('修改失败，请稍后再试！');
	}
}
?>