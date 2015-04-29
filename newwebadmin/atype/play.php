<?php 	include('../includes/php_conn.php');	$id = $_REQUEST['id'];	$sql = 'SELECT * FROM `videos` WHERE `id` = '.$id;	$query = mysql_query($sql,$conn);	$res = mysql_fetch_assoc($query);		?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title><?php echo $res['name'];?></title>	<style type="text/css">		.content{margin:0 auto;width:90%;}	</style>
</head>
<body>
	<div class="content">		<video id="sampleMovie" src="../../videos/<?php echo $res['path'];?>" controls="controls"  autoplay="autoplay" width="100%" >	您的浏览器不支持此种视频格式。	</video>	</div>
</body>
</html>