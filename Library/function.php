 <?php
//网页提示跳转功能
function jumpUrl($message,$url=null){
	if($url == null){
		echo '<script type="text/javascript">alert("'.$message.'");history.go(-1);</script>';
	}else{
		echo '<script type="text/javascript">alert("'.$message.'");location.href="'.$url.'";</script>';
	}
	die;
}
?>