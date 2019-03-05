<?php 
header('content-type:text/html;charset=utf-8');
include_once('Library/pdo.class.php');
include_once('Library/page.class.php');
#各页面图片
$sql = 'select * from images';
$image = $pdo->getData($sql,false);
#文章
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$count = 4;
$begin = ($page-1)*$count;
$sql 	  = "select * from article order by aid desc limit ".$begin.",".$count;
$article  = $pdo->getData($sql,true);
$sql    = "select count(-1) c from article";
$total  = $pdo->getData($sql,false);
?>
<!DOCTYPE HTML>
<html>
	<?php include_once('common/head.php'); ?>
	<body class="is-loading-0 is-loading-1">

		<!-- Wrapper -->
			<div id="wrapper">
					<!-- articles -->
					<article id="articles" class="panel secondary" style="opacity: 1;">
						<div class="image">
							<img src="uploads/<?php echo json_decode($image['article_img']); ?>" alt="" data-position="center center" />
						</div>
						<div class="content">
							<ul class="actions spinX">
								<li><a href="/" class="button small back">返回首页</a></li>
							</ul>
							<div class="inner">
								<header>
									<h2>文章列表</h2>
								</header>
								<div class="articles">
									<ul>
									<?php
									foreach($article as $key=>$value){ 
									?>
										<li id="img_font">
											<a href="<?php echo $page; ?>-<?php echo $value['aid']; ?>.html" title="" class="aimg">
											
												<img src="uploads/<?php echo implode(json_decode($value['aimg'])); ?>" alt="">
											
											</a>
											<a href="<?php echo $page; ?>-<?php echo $value['aid']; ?>.html" title="" class="afont">
												<span><?php echo mb_substr($value['atitle'],0,10,'utf-8')."......"; ?></span>
											</a>
										</li>
									<?php } ?>
									</ul>
									<div class="page">
										<?php
					    					$link    = "?page=";
					    					$subPage = new SubPages($count,$total['c'],$page,10,$link,2);
					    				?>
									</div>
								</div>
								
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
			<script src="assets/js/skel.min.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
</html>