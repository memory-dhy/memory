<?php
	#非登录踢出
	include_once('Common/check.php');
	include_once('../Library/pdo.class.php');
	include_once('../Library/page.class.php');
	$page  = isset($_GET['page']) ? $_GET['page'] : 1;
	$count = 10;
	$begin = ($page-1)*$count;
	$sql = "select * from ipaddress order by time desc limit ".$begin.",".$count;
	$ipaddress = $pdo->getData($sql,true);
	$sql    = "select count(-1) c from ipaddress";
	$total  = $pdo->getData($sql,false);
?>
<!doctype html>
<html class="no-js fixed-layout">
<head>
	<?php include_once('Common/head.php');  ?>
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->

<header class="am-topbar am-topbar-inverse admin-header">
	<?php include_once('Common/top.php');  ?>
</header>

<div class="am-cf admin-main">
  <!-- sidebar start -->
  <?php include_once('Common/left.php');  ?>
  <!-- sidebar end -->

  <!-- content start -->
  <div class="admin-content">
        <div class="admin-content-body">
      <div class="am-cf am-padding am-padding-bottom-0">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">首页</strong></div>
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
          <form class="am-form" action="Inc/address.php" method="post" id="listForm">
           <input type="hidden" value="batch" name="method" />
            <table class="am-table am-table-striped am-table-hover table-main">
              <thead>
              <tr>
                <th class="table-check">
        				  <input type="checkbox" id="parent" />
        				</th>
        				<th class="table-id">ID</th>
						<th class="table-title">访问IP</th>
						<th class="table-title">所在位置</th>
						<th class="table-title">经度</th>
						<th class="table-title">纬度</th>
        				<th class="table-date am-hide-sm-only">访问时间</th>
        				<th class="table-set" style="text-align:left;padding-left:60px;">操作</th>
              </tr>
              </thead>
              <tbody>
			        <?php foreach($ipaddress as $key=>$value){ ?>
              <tr id="tr_<?php echo $value['id']; ?>">
                <td><input type="checkbox" name="id[]" value="<?php echo $value['id']; ?>" class="listbox" /></td>
                <td><?php echo $key+1; ?></td>
                <td><?php echo $value['ips']; ?></td>
				<td><?php echo $value['address']; ?></td>
				<td><?php echo $value['log']; ?></td>
				<td><?php echo $value['lat']; ?></td>
                <td><?php echo $value['time']; ?></td>
                <td>
                  <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                      <button type="button" class="detailed am-btn am-btn-default am-btn-xs am-text-secondary detail" name="<?php echo $value['address']; ?>" id="<?php echo $value['id']; ?>"><span class="am-icon-pencil-square-o"></span> 详情位置</button>
                      <button type="button" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only delete" id="<?php echo $value['id']; ?>"><span class="am-icon-trash-o"></span> 删除</button>
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
      <?php include_once('Common/footer.php'); ?>
    </footer>
  </div>
  <!-- content end -->
</div>
<?php include_once('Common/bottom.php'); ?>
</body>
<script type="text/javascript">
	$(function(){
		$(".delete").click(function(){
			var thisId = this.id;
			layer.confirm('确定删除访问信息吗？', {
			  btn: ['确定','取消']
			}, function(){
				$.ajax({
					type:'post',
					url :'Inc/address.php',
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
    $('.detail').click(function(){
        var thisId = this.id;
        var address = this.name;
        var Url = 'map.php?id='+thisId;
        layer.open({
          type: 2,
          title:"详细位置--"+address,
          closeBtn: 2,
          shadeClose: false,
          shade: .5,
          area: ['1000px', '90%'],
          content: Url
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
</html>
