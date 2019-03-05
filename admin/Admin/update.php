<?php
include_once('../Common/check.php');
?>
<!doctype html>
<html class="no-js">
<head>
	<?php include_once('../Common/head.php'); ?>
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->

<header class="am-topbar am-topbar-inverse admin-header">
    <?php include_once('../Common/top.php'); ?>
</header>

<div class="am-cf admin-main">
  <!-- sidebar start -->
  <?php include_once('../Common/left.php'); ?>
  <!-- sidebar end -->

<!-- content start -->
<div class="admin-content">
  <div class="admin-content-body">
    <div class="am-cf am-padding am-padding-bottom-0">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">登录密码修改</strong></div>
    </div>

    <hr>

	<form method="post" action="../Inc/Admin.php" id="form1" class="am-form am-form-inline">
	<input type="hidden" name="method" value="change" />
    <div class="am-tabs am-margin">
      <ul class="am-tabs-nav am-nav am-nav-tabs">
        <li class="am-active"><a href="#tab1">基本信息</a></li>
      </ul>
      <div class="am-tabs-bd">
        <div class="am-tab-panel am-fade am-in am-active" id="tab1">

          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
              原登录密码
            </div>
            <div class="am-u-sm-8 am-u-md-10">
                <div class="am-form-group am-form-icon">
                  <input type="password" name="oldpwd" class="am-input-sm" style="width:220px" />
                </div>
            </div>
          </div>

          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                新密码
            </div>
            <div class="am-u-sm-8 am-u-md-10">
                <div class="am-form-group am-form-icon">
                  <input type="password" name="newpwd" class="am-input-sm" style="width:220px" />
                </div>
            </div>
          </div>

          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
              确认密码
            </div>
            <div class="am-u-sm-8 am-u-md-10">
                <div class="am-form-group am-form-icon">
                  <input type="password" name="confirm" class="am-input-sm" style="width:220px" />
                </div>
            </div>
          </div>

        </div>
      </div>
   </div>

    <div class="am-margin">
      <button type="reset" class="am-btn am-btn-primary am-btn-xs">放弃保存</button>
      <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
    </div>
   </form>
  </div>

  <footer class="admin-content-footer">
    <?php include_once('../Common/footer.php'); ?>
  </footer>
</div>
<!-- content end -->

</div>
  <?php include_once('../Common/bottom.php'); ?>
</body>
</html>
