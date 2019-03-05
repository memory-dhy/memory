<?php
//留言管理
header('content-type:text/html;charset=utf-8');
include_once('../../Library/pdo.class.php');
include_once('../../Library/function.php');
$method = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
if($method == ''){
	die('非法请求');
}
#留言
if($method=='add'){
	$name      = isset($_POST['name'])      ? $_POST['name']    : '';
	$email     = isset($_POST['email'])     ? $_POST['email']   : '';
	$message   = isset($_POST['message'])   ? $_POST['message']   : '';
	$sql = "insert into message(mname,memail,mcontent) values('".$name."','".$email."','".$message."')";
	if($name != ''&& $email != '' && $message != ''){
		$result = $pdo->toExec($sql);
		if(!$result){
			echo '删除留言失败，请您稍后再试！';
		}else{
			echo true;
		}
	}else{
		echo '请输入相应信息！';
	}
}
#留言删除
if($method == 'delete'){

	$id = isset($_POST['id']) ? $_POST['id'] : '';
	$sqls    = "delete from message where mid = ".$id;
	$results = $pdo->toExec($sqls);
	if($results){
		echo true;
	}else{
		echo '删除留言失败，请您稍后再试！';
	}
}
#批量删除
if($method == 'batch'){
	$message = '';
	$id      = isset($_POST['mid']) ? $_POST['mid'] : '';
	#删除留言信息

	$sql = "delete from message where mid in (".implode(',',$id).")";
	$result = $pdo->toExec($sql);
	$message .= '已选留言删除成功！';

	if($result){
		jumpUrl($message,'../message/list.php');
	}else{
		jumpUrl('删除失败，请您稍后再试！');
	}
}
?>