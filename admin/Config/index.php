<?php
include_once('../Common/check.php');
header('content-type:text/html;charset=utf-8');
include_once('../../Library/pdo.class.php');
$sql      = "select * from config where id = 1";
$config = $pdo->getData($sql,false);
?>
<!doctype html>
<html class="no-js">
<head>
	<?php include_once('../Common/head.php'); ?>
  <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
  <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
  <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
  <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
  <script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
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
      <div class="am-fl am-cf">
        <strong class="am-text-primary am-text-lg">系统配置</strong> 
      </div>
    </div>
    <hr>
	<form method="post" action="../Inc/config.php" id="form1" class="am-form am-form-inline" enctype="multipart/form-data">
	<input type="hidden" name="method" value="update" />
  <input type="hidden" name="id" value="<?php echo $config['id']; ?>" />
    <div class="am-tabs am-margin">
      <ul class="am-tabs-nav am-nav am-nav-tabs">
        <li class="am-active"><a href="#tab1">基本信息</a></li>
      </ul>
      <div class="am-tabs-bd">
        <div class="am-tab-panel am-fade am-in am-active" id="tab1">
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
              网站标题
            </div>
            <div class="am-u-sm-8 am-u-md-10">
                <div class="am-form-group am-form-icon">
                  <input type="text" class="am-input-sm" name="sitename" value="<?php echo $config['sitename']; ?>" style="width:500px;" />
                </div>
            </div>
          </div>
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
              SEO关键字
            </div>
            <div class="am-u-sm-8 am-u-md-10">
                <div class="am-form-group am-form-icon">
                  <input type="text" class="am-input-sm" name="seotitle" value="<?php echo $config['seotitle']; ?>" style="width:500px;" />
                </div>
            </div>
          </div>
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
              SEO内容
            </div>
            <div class="am-u-sm-8 am-u-md-10">
                <div class="am-form-group am-form-icon">
                  <input type="text" class="am-input-sm" name="seocontent" value="<?php echo $config['seocontent']; ?>" style="width:500px;" />
                </div>
            </div>
          </div>
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
              版权信息
            </div>
            <div class="am-u-sm-8 am-u-md-10">
                <div class="am-form-group am-form-icon">
                  <input type="text" class="am-input-sm" name="copyright" value="<?php echo $config['copyright']; ?>" style="width:500px;" />
                </div>
            </div>
          </div>
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
              公安部备案信息
            </div>
            <div class="am-u-sm-8 am-u-md-10">
                <div class="am-form-group am-form-icon">
                  <input type="text" class="am-input-sm" name="policeright" value="<?php echo $config['policeright']; ?>" style="width:500px;" />
                </div>
            </div>
          </div>
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
              当前ICON图
            </div>
            <div class="am-u-sm-8 am-u-md-10">
                <div class="am-form-group am-form-icon" style="display: flex;overflow: auto;">
                  <img src="<?php $image=json_decode($config['siteicon']); echo '/uploads/'.$image[0];?>"/>
                </div>
            </div>
          </div>
       <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
              icon图
            </div>
              <div class="am-u-sm-8 am-u-md-10">
                <div class="am-form-group am-form-file">
                    <button type="button" class="am-btn am-btn-danger am-btn-sm">
                      <i class="am-icon-cloud-upload"></i> 选择要上传的文件</button>
                    <input id="doc-form-file" type="file" name="siteicon[]" multiple accept="image/*">
                  </div>
                  <div id="file-list"></div>
                  <script>
                    $(function() {
                      $('#doc-form-file').on('change', function() {
                        var fileNames = '';
                        $.each(this.files, function() {
                          fileNames += '<span class="am-badge">' + this.name + '</span> ';
                        });
                        $('#file-list').html(fileNames);
                      });
                    });
                  </script>
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
