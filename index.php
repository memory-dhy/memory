<?php
header('content-type:text/html;charset=utf-8');
include_once('Library/pdo.class.php');
include_once('Library/page.class.php');
include_once('Library/getIP.php');
#各页面图片
$sql = 'select * from images';
$image = $pdo->getData($sql,false);
#关于我
$sql = 'select * from about';
$result = $pdo->getData($sql,false);
$img = json_decode($result['aimg']);
?>
<!DOCTYPE HTML>
<html>
	<?php include_once('common/head.php'); ?>
	<body class="is-loading-0 is-loading-1">

		<!-- Wrapper -->
			<div id="wrapper">
				<!-- Home -->
					<article id="home" class="panel special">
						<div class="image">
							<img src="uploads/<?php echo json_decode($image['index_img']); ?>" alt="" data-position="center center" />
						</div>
						<div class="content">
							<div class="inner">
								<header>
									<h1>memory</h1>
									<p>拥有回忆，人生才得以丰润，岁月才满溢诗情。<br/>耽于回忆，青春却难免苍白，木人石心亦伤怀。</p>
								</header>
								<nav id="nav">
									<ul class="actions vertical special spinY">
										<li><a href="article.html" class="button">文章</a></li>
										<li><a href="picture.html" class="button">美图</a></li>
										<li><a href="#work" class="button">关于</a></li>
										<li><a href="#contact" class="button">留言</a></li>
									</ul>
								</nav>

							</div>
						</div>
					</article>

				<!-- Work -->
					<article id="work" class="panel secondary">
						<div class="image">
							<img src="uploads/<?php echo json_decode($image['about_img']); ?>" alt="" data-position="center center" />
						</div>
						<div class="content">
							<ul class="actions spinX">
								<li><a href="#home" class="button small back">返回上层</a></li>
							</ul>
							<div class="inner">
								<header>
									<h2>关于我</h2>
									<p><?php echo $result['abstract']; ?></p>
								</header>
								<div class="photo">
								 	<ul>
										<li><img class="about_img" src="uploads/<?php echo $img[0]?>" alt=""><span>微信</span></li>
										<li><img class="about_img" src="uploads/<?php echo $img[1]?>" alt=""><span>公众号</span></li>
								 	</ul>
								</div>
							</div>
						</div>
					</article>
				<!-- Contact -->
					<article id="contact" class="panel secondary">
						<div class="image">
							<img src="uploads/<?php echo json_decode($image['message_img']); ?>" alt="" data-position="bottom center" />
						</div>
						<div class="content">
							<ul class="actions spinX">
								<li><a href="#home" class="button small back">返回上层</a></li>
							</ul>
							<div class="inner">
								<header>
									<h2>给我留言</h2>
								</header>
								<form method="post" action="admin/Inc/message.php">
									<div class="field half first">
										<label for="name">姓名</label>
										<input type="text" name="name" id="name" />
									</div>
									<div class="field half">
										<label for="email">邮箱</label>
										<input type="text" name="email" id="email" />
									</div>
									<div class="field">
										<label for="message">留言</label>
										<textarea name="message" id="message" rows="5"></textarea>
									</div>
									<ul class="actions">
										<li><a href="javascript:;" class="button submit" id="submit">提交</a></li>
									</ul>
								</form>
							</div>
						</div>
					</article>
					<!-- articles -->
				<!-- Footer -->
					<?php include_once('common/footer.php'); ?>
			</div>


	</body>
	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
			<script type="text/javascript" src="layer/layer.js"></script>
			<script>
			var _hmt = _hmt || [];
			(function() {
			var hm = document.createElement("script");
			hm.src = "https://hm.baidu.com/hm.js?1d0d213c65d2c2ae0dc375c2c6429a5d";
			var s = document.getElementsByTagName("script")[0];
			s.parentNode.insertBefore(hm, s);
			})();
			</script>
			<script type="text/javascript">
				$(function(){
					$('#submit').click(function(){
						var name = $('#name').val();
						var email = $('#email').val();
						var message = $('#message').val();
						layer.confirm('确定发表留言吗？', {
						  btn: ['确定','取消']
						}, function(){
							$.ajax({
								type:'post',
								url :'admin/Inc/message.php',
								data:{name:name,email:email,message:message,method:'add'},
								success:function(data){
									if(data == true || data == 'true'){
										layer.msg('发表成功', {icon: 1});
									}else{
										layer.msg(data,{icon:2});
									}
								},
								error:function(){
									layer.msg('发表失败', {icon: 2});
								}
							})
						});
					})
				})
			</script>
	<?php include_once('baidu_js_push.php'); ?>
</html>