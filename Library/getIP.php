<?php 
error_reporting(E_ALL ^ E_NOTICE); 
header('content-type:text/html;charset=utf-8');
/*
 * 获取客户端IP地址
 */
function getIP()
{
global $ip;
if (getenv("HTTP_CLIENT_IP"))
$ip = getenv("HTTP_CLIENT_IP");
else if(getenv("HTTP_X_FORWARDED_FOR"))
$ip = getenv("HTTP_X_FORWARDED_FOR");
else if(getenv("REMOTE_ADDR"))
$ip = getenv("REMOTE_ADDR");
else $ip = "Unknow";
return $ip;
}
/*
 * 通过IP地址获取访问位置
 */
$content = file_get_contents("http://api.map.baidu.com/location/ip?ak=VETsUW54nkBZWesyIQlrMuHgqtCVeQF8&ip=".explode(',',getIp())[0]."&coor=bd09ll");
$json = json_decode($content);
/*
 * 插入数据库
 */
$sql = 'insert into ipaddress(ips,log,lat,address) values("'.explode(",",getIp())[0].'","'.$json->{'content'}->{'point'}->{'x'}.'","'.$json->{'content'}->{'point'}->{'y'}.'","'.$json->{'content'}->{'address'}.'")';
$result = $pdo->toExec($sql);
/*
 * 插入新数据时删除最老的一条数据
 */
	$sql = 'select count(-1) from ipaddress'; #统计数据库IP条数
	$result = $pdo->getData($sql);
	foreach($result as $val){
		if($val['count(-1)']>50){ #如果条数大于50，执行删除最老的一条
			$sql1 = 'delete from ipaddress where id=(select min(id) from(select * from ipaddress group by id) as a)';
			$results = $pdo->toExec($sql1);
		}
	}
?>