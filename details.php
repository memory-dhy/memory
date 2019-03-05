<?php 
header('content-type:text/html;charset=utf-8');
include_once('Library/pdo.class.php');
include_once('Library/page.class.php');
#各页面图片
$sql = 'select * from images';
$image = $pdo->getData($sql,false);
#文章
$id = isset($_GET['id']) ? $_GET['id'] : '';
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$sql = 'select * from article where aid='.$id;
$article = $pdo->getData($sql,false);
?>
<!DOCTYPE HTML>
<html>
	<?php include_once('common/head.php'); ?>
	<body class="is-loading-0 is-loading-1">
		<!-- Wrapper -->
			<div id="wrapper">
					<!-- articles content -->
					<article id="acontent" class="panel secondary" style="opacity: 1;">
						<div class="image">
							<img src="uploads/<?php echo implode(json_decode($article['aimg'])); ?>" alt="" data-position="center center" />
						</div>
						<div class="content">
							<ul class="actions spinX">
								<li><a href="article.html?page=<?php echo $page; ?>" class="button small back">返回上层</a></li>
							</ul>
							<div class="inner">
								<header>
									<h2><?php echo $article['atitle']; ?></h2>
									<p>|作者：<?php echo $article['athor']; ?><br>|发表时间：<?php echo $article['atime']; ?></p>
								</header>
								<div class="texts"><?php echo $article['acontent']; ?></div>
							</div>
						</div>
					</article>
				<!-- Footer -->
					<?php include_once('common/footer.php'); ?>
			</div>
		
	</body>
	<?php include_once('baidu_js_push.php'); ?>
	<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/main.js"></script>
			<script type="text/javascript" src="layer/layer.js"></script>
</html>