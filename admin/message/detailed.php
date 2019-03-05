<?php
include_once('../../Library/pdo.class.php');
$id=$_GET['id'];
$sql 	  = "select * from message where mid=".$id;
$message  = $pdo->getData($sql,false);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style type="text/css">
		.content{
			overflow: hidden;
			padding: 20px;
		}
		.content .message{
			width: 100%;
		}
		.content ul{
			list-style-type: none;
			padding: 0;
			/* margin: 25% auto; */
		}
		.detailed{
			margin: 0;
			padding: 0;
			width: 50%;
			float: right;
			margin-top: 20px;
		}
		.detailed ul li{
			float: right;
			width: 100%;
			height: 100%;
			text-align: center;
		}
		.detailed ul li a{
			text-decoration: none;
			color: #4b5cc4;
		}
	</style>	
</head>
<body>
	<div class="content">
		<div class="message">
			<?php echo $message['mcontent'];  ?>
		</div>
		<div class="detailed">
			<ul>
			<li><?php echo $message['mname'];  ?></li>
			<li><a href="mailto:<?php echo $message['memail'];  ?>" ><?php echo $message['memail'];  ?></a></li>
			<li><?php echo $message['time'];  ?></li>
		</ul>
		</div>
		
	</div>
</body>
</html>