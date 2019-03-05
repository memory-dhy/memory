<?php
include_once('../Common/check.php');
header('content-type:text/html;charset=utf-8');

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
        <strong class="am-text-primary am-text-lg">文章发表</strong> /
        <small>文章管理</small>
      </div>
    </div>
    <hr>
	<form method="post" action="../Inc/article.php" id="form1" class="am-form am-form-inline" enctype="multipart/form-data">
	<input type="hidden" name="method" value="add" />
    <div class="am-tabs am-margin">
      <ul class="am-tabs-nav am-nav am-nav-tabs">
        <li class="am-active"><a href="#tab1">内容填写</a></li>
      </ul>
      <div class="am-tabs-bd">
        <div class="am-tab-panel am-fade am-in am-active" id="tab1">
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
              文章标题
            </div>
            <div class="am-u-sm-8 am-u-md-10">
                <div class="am-form-group am-form-icon">
                  <input type="text" class="am-input-sm" name="atitle" style="width:220px" />
                </div>
            </div>
          </div>
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
              作者昵称
            </div>
            <div class="am-u-sm-8 am-u-md-10">
                <div class="am-form-group am-form-icon">
                  <input type="text" class="am-input-sm" name="athor" style="width:220px" />
                </div>
            </div>
          </div>

         <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
              文章封面
            </div>
            <div class="am-u-sm-8 am-u-md-10">
                <div class="am-form-group am-form-file">
                    <button type="button" class="am-btn am-btn-danger am-btn-sm">
                      <i class="am-icon-cloud-upload"></i> 选择要上传的文件</button>
                    <input id="doc-form-file" type="file" name="aimg[]" multiple accept="image/*">
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
		     <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
              文章摘要
            </div>
            <div class="am-u-sm-8 am-u-md-10">
                <div class="am-form-group am-form-icon">
                  <input type="text" class="am-input-sm" name="aabstract" style="width:220px" />
                </div>
            </div>
          </div>
          <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
              文章内容
            </div>
            <div class="am-u-sm-8 am-u-md-10">
                <div class="am-form-group am-form-icon">
                  <script id="acontent" name="acontent" type="text/plain" style="height: 300px;"></script>
                </div>
            </div>
          </div>
        </div>
      </div>
   </div>
    <div class="am-margin">
      <button type="reset" class="am-btn am-btn-primary am-btn-xs">放弃保存</button>
      <button type="submit" id="send" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
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
  <script type="text/javascript">
    var ue = UE.getEditor('acontent');
  </script>
  <script>
    var send=document.getElementById("send");
    send.onclick=function(){
    var file=document.getElementById("doc-form-file").value;
    if(file.length<1){
      layer.msg('请选择文件', {icon: 2});
      return false;
      }
    }
</script>
</body>
</html>
