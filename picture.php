<?php 
header('content-type:text/html;charset=utf-8');
include_once('Library/pdo.class.php');
#精美图片
$sql = 'select * from photograph';
$result = $pdo->getData($sql,false);
$img = json_decode($result['photos']);
#版权信息
$sql = 'select * from config';
$config = $pdo->getData($sql,false);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo $config['sitename']; ?>--精美图片</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="description" content="<?php echo $config['seocontent']; ?>">
		<meta name="keywords" content="<?php echo $config['seotitle']; ?>">
		<meta name="robots" content="index">
		<meta http-equiv="content-Type" content="text/html;charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=10; IE=11; IE=12; IE=EDGE">
		<!--[if lte IE 8]><script src="light/assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="light/assets/css/main.css" />
		<link rel="icon" type="image/x-icon" href="/uploads/<?php echo implode(json_decode($config['siteicon'])); ?>">
		<!--[if lte IE 8]><link rel="stylesheet" href="light/assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="light/assets/css/ie9.css" /><![endif]-->
		<noscript><link rel="stylesheet" href="light/assets/css/noscript.css" /></noscript>
	<!-- cfdhy.top Baidu tongji analytics -->

</head>
	<body class="is-loading-0 is-loading-1 is-loading-2">

		<!-- Main -->
			<div id="main">

				<!-- Header -->
					<header id="header">
						<h1>精美图片</h1>
						<p><a href="/" title="">返回首页</a></p>
					</header>

				<!-- Thumbnail -->
					<section id="thumbnails">
					<!-- data-position="top center" -->
					<?php for($i=0;$i<count($img);$i++){?>
						<article>
							<a class="thumbnail" href="uploads/<?php echo $img[$i]; ?>" ><img src="uploads/<?php echo $img[$i]; ?>" alt="" width="160px" height="100px" /></a>
							
						</article>
					<?php } ?>
					</section>

				<!-- Footer -->
					<?php include_once('common/footer.php'); ?>

			</div>

		

	</body>
	<?php include_once('baidu_js_push.php'); ?>
<!-- Scripts -->
			<script src="light/assets/js/jquery.min.js"></script>
			<script src="light/assets/js/skel.min.js"></script>
			<!--[if lte IE 8]><script src="light/assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="light/assets/js/main.js"></script>
			<script>
				var _hmt = _hmt || [];
				(function() {
				var hm = document.createElement("script");
				hm.src = "https://hm.baidu.com/hm.js?1d0d213c65d2c2ae0dc375c2c6429a5d";
				var s = document.getElementsByTagName("script")[0];
				s.parentNode.insertBefore(hm, s);
				})();
			</script>
</html>