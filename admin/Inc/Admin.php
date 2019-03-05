<?php
header('content-type:text/html;charset=utf-8');
include_once('../../Library/pdo.class.php');
include_once('../../Library/function.php');
session_start();
$method = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
if($method==''){
	die('非法请求');
}
#管理员登录数据接收处理
if($method=='login'){
	$username = isset($_POST['username']) ? $_POST['username'] : '';
	$userpwd  = isset($_POST['userpwd'])  ? $_POST['userpwd']  : '';
	$code     = isset($_POST['code'])     ? $_POST['code']     : '';
	$islogin  = isset($_POST['islogin'])  ? $_POST['islogin']  : '';
	$sql 	  = 'select * from administrator where admin_name="'.$username.'" and admin_password="'.md5($userpwd).'"';
	$result   = $pdo->getData($sql,false);
	if(!$result){
		jumpUrl('登录失败,请确认账号和密码是否正确');
	}
	if(strtolower($code) != strtolower($_SESSION['code'])){
		jumpUrl('验证码有误！请重新填写！');
		die;
	}
	$_SESSION['admin'] = $result;
	if($islogin){
		setcookie('PHPSESSID',session_id(),time()+60*60*24*7,'/');
	}
	jumpUrl('登陆成功','../index.php');
}
#退出
if($method=='loginout'){
	unset($_SESSION['admin']);
	jumpUrl('退出成功','../login.html');
}
#密码修改
if($method=='change'){
	$oldpwd  = isset($_POST['oldpwd'])  ? $_POST['oldpwd']  : '';
	$newpwd  = isset($_POST['newpwd'])  ? $_POST['newpwd']  : '';
	$confirm = isset($_POST['confirm']) ? $_POST['confirm'] : '';
	if(md5(trim($oldpwd)) != $_SESSION['admin']['admin_password']){
		jumpUrl('原密码错误，请重新输入！');
	}
	if(trim($newpwd) == ''){
		jumpUrl('新密码不能为空！');
	}
	if(trim($newpwd) != trim($confirm)){
		jumpUrl('新密码与确认密码不相同，请重新修改');
	}
	$sql = 'update administrator set admin_password = "'.md5(trim($newpwd)).'" where admin_id = '.$_SESSION['admin']['admin_id'].'';
	$result = $pdo->toExec($sql);
	if(is_int($result)){
		unset($_SESSION['admin']);
		jumpUrl('密码修改成功！','../login.html');
	}else{
		jumpUrl('修改失败，请稍后再试！');
	}
}
?>