<?php
header('content-type:text/html;charset=utf-8');
include_once('../Common/check.php');
include_once('../../Library/pdo.class.php');
include_once('../../Library/page.class.php');
$page  = isset($_GET['page']) ? $_GET['page'] : 1;
$count = 15;
$begin = ($page-1)*$count;
$sql 	  = "select * from message order by mid desc limit ".$begin.",".$count;
$message  = $pdo->getData($sql,true);
$sql    = "select count(-1) c from message";
$total  = $pdo->getData($sql,false);
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
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">留言列表</strong>/<small>留言管理</small></div>
      </div>

      <hr>

      <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
          <div class="am-btn-toolbar">
            <div class="am-btn-group am-btn-group-xs">
              <button type="button" class="am-btn am-btn-default batch"><span class="am-icon-trash-o"></span> 删除</button>
            </div>
          </div>
        </div>
      </div>

      <div class="am-g">
        <div class="am-u-sm-12">
          <form class="am-form" action="../Inc/message.php" method="post" id="listForm">
           <input type="hidden" value="batch" name="method" />
            <table class="am-table am-table-striped am-table-hover table-main">
              <thead>
              <tr>
                <th class="table-check">
        				  <input type="checkbox" id="parent" />
        				</th>
        				<th class="table-id">ID</th>
                <th class="table-title">留言者姓名</th>
                <th class="table-title">留言者邮箱</th>
                <th class="table-title">内容概要</th>
        				<th class="table-date am-hide-sm-only">留言时间</th>
        				<th class="table-set">操作</th>
              </tr>
              </thead>
              <tbody>
			        <?php foreach($message as $key=>$value){ ?>
              <tr id="tr_<?php echo $value['mid']; ?>">
                <td><input type="checkbox" name="mid[]" value="<?php echo $value['mid']; ?>" class="listbox" /></td>
                <td><?php echo $key+1; ?></td>
                <td><a href="#"><?php echo $value['mname'] ?></a></td>
                <td><?php echo $value['memail'] ?></td>
                <td><?php echo substr($value['mcontent'],0,30) ?></td>
                <td><?php echo $value['time'] ?></td>
                <td>
                  <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                      <button type="button" class="detailed am-btn am-btn-default am-btn-xs am-text-secondary" name="<?php echo $value['mid']; ?>"><span class="am-icon-pencil-square-o"></span> 查看详细</button>
                      <button type="button" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only delete" id="<?php echo $value['mid']; ?>"><span class="am-icon-trash-o"></span> 删除</button>
                    </div>
                  </div>
                </td>
              </tr>
			        <?php } ?>
              </tbody>
            </table>
            <div class="am-cf">
    				<?php
    					$link    = "?page=";
    					$subPage = new SubPages($count,$total['c'],$page,10,$link,1);
    				?>
            </div>
            <hr />
          </form>
        </div>

      </div>
    </div>

    <footer class="admin-content-footer">
      <?php include_once('../Common/footer.php'); ?>
    </footer>

  </div>
  <!-- content end -->
</div>

<a href="#" class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

<?php include_once('../Common/bottom.php'); ?>

<script type="text/javascript">
	$(function(){
		$(".delete").click(function(){
			var thisId = this.id;
			layer.confirm('确定删除留言信息吗？', {
			  btn: ['确定','取消']
			}, function(){
				$.ajax({
					type:'post',
					url :'../Inc/message.php',
					data:{id:thisId,method:'delete'},
					success:function(data){
						if(data == true || data == 'true'){
							layer.msg('删除成功', {icon: 1});
							$("#tr_"+thisId).hide(1500);
						}else{
							layer.msg(data,{icon:2});
						}
					},
					error:function(){
						layer.msg('删除失败', {icon: 2});
					}
				})
			});
		})
	})
</script>


<script type="text/javascript">
    $(function(){
        $("#parent").change(function(){
            if(this.checked){
                $(".listbox").prop('checked',true);
            }else{
                $(".listbox").prop('checked',false);
            }
        })
        $(".batch").click(function(){
            var length = $(".listbox:checked").length;
            if(length == 0){
                layer.msg('请您选择要删除的内容！',{icon:6});
            }else{
                layer.confirm('确定要删除当前选中的信息吗？',
                  {bth:['确定','取消']},
                  function(){
                    $("#listForm").submit();
                })
            }
        })
    })
</script>
<script type="text/javascript">
$(function(){
  $(".detailed").click(function(){
    var id= this.name;
    var Url = 'detailed.php?id='+id;
    layer.open({
    type: 2,
    title: '留言详细',
    shadeClose: true,
    shade: 0.8,
    area: ['600px', '90%'],
    content: Url
    }); 
  })
})
</script>

</body>
</html>
