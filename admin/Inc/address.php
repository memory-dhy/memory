<?php
header('content-type:text/html;charset=utf-8');
include_once('../../Library/pdo.class.php');
include_once('../../Library/fileupload.class.php');
include_once('../../Library/function.php');
$method = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
if($method == ''){
	die('非法请求');
}
#删除
if($method == 'delete'){
	$id = isset($_POST['id']) ? $_POST['id'] : '';
	$sql    = "delete from ipaddress where id = ".$id;
	$results = $pdo->toExec($sql);
	if($results){
		echo true;
	}else{
		echo '删除访问信息失败，请您稍后再试！';
	}
}
#批量删除
if($method == 'batch'){
	$message = '';
	$id      = isset($_POST['id']) ? $_POST['id'] : '';
	$sql = "delete from ipaddress where id in (".implode(',',$id).")";
	$result = $pdo->toExec($sql);
	$message .= '已选信息删除成功！';
	if($result){
		jumpUrl($message,'../index.php');
	}else{
		jumpUrl('删除失败，请您稍后再试！');
	}
}
?>