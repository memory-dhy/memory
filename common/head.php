<?php
$sql = 'select * from config';
$config = $pdo->getData($sql,false);
 ?>
<head>
		<title><?php echo $config['sitename']; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="description" content="<?php echo $config['seocontent']; ?>">
		<meta name="keywords" content="<?php echo $config['seotitle']; ?>">
		<meta name="robots" content="index">
		<meta http-equiv="content-Type" content="text/html;charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=10; IE=11; IE=12; IE=EDGE">
		<meta name="baidu-site-verification" content="Qt0P4GfyWE" />
		<meta baidu-gxt-verify-token="8d8a3049be038e6044aa209ac1c87897">		
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="icon" type="image/x-icon" href="/uploads/<?php echo implode(json_decode($config['siteicon'])); ?>">
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
<!-- cfdhy.top Baidu tongji analytics -->

</head>