<?php
	header('content-type:text/html;charset=utf-8');
	include_once('../Library/pdo.class.php');
	$id=$_GET['id'];
	$sql 	  = "select * from ipaddress where id=".$id;
	$detail  = $pdo->getData($sql,false);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script src="/layer/layer.js"></script>
	<style type="text/css">
		html,body{
			width: 100%;
			height: 100%;
			margin: 0;
			padding: 0;
		}
		#allmap{
			width: 100%;
			height: 100%;
		}
	</style>
</head>
<body>
	<div id="allmap"></div>
	<script type="text/javascript">
		$(function(){
			//加载层-风格3
			layer.msg('访问者详细位置加载中......', {
			  icon: 16,
			  shade: 0.1,
			  time:1000
			});
			
		})
		
	</script>
	<script type="text/javascript">
		//百度地图API功能
		function loadJScript() {
			var script = document.createElement("script");
			script.type = "text/javascript";
			script.src = "http://api.map.baidu.com/api?v=2.0&ak=VETsUW54nkBZWesyIQlrMuHgqtCVeQF8&callback=init";
			document.body.appendChild(script);
		}
		function init() {
			var map = new BMap.Map("allmap");            // 创建Map实例
			var point = new BMap.Point(<?php echo $detail['log']; ?>, <?php echo $detail['lat']; ?>); 
			// 创建点坐标
			map.centerAndZoom(point,20);                //地图展示级别
			map.enableScrollWheelZoom(false);           //启用滚轮放大缩小
			var marker = new BMap.Marker(point);        // 创建标注    
			map.addOverlay(marker);                     // 将标注添加到地图中 
			marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画

			/*定义信息窗口*/
			var opts = {
			  width : 200,     // 信息窗口宽度
			  height: 100,     // 信息窗口高度
			  title : "<?php echo $detail['address']; ?>" , // 信息窗口标题
			  enableMessage:true,//设置允许信息窗发送短息
			}
			var infoWindow; // 创建信息窗口对象 
			

			/*单击显示信息窗*/
			var geoc = new BMap.Geocoder();
			marker.addEventListener("click", function(e){        
				var pt = e.point;
				geoc.getLocation(pt, function(rs){
					var addComp = rs.addressComponents;
					infoWindow = new BMap.InfoWindow(addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber,opts);
				});
				map.openInfoWindow(infoWindow,point); //开启信息窗口        
			});
		}  
		window.onload = loadJScript;  //异步加载地图
	</script>
</body>
</html>