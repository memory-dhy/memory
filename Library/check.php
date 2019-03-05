<?php
session_start();
$admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : '';
if(!$admin){	
	echo '<script type="text/javascript">location.href="/admin/login.html"</script>';
}
?>