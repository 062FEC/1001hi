<?php
  include('../includes/php_conn.php');
  set_cookie('atype_info');
  include('../includes/check.php');
  include('../includes/refresh.php');
  include('setup.php');
  

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $admin_site_title;?></title>
<link href="../css/qbt.css" rel="stylesheet" type="text/css">

</head>

<body style="background:#eee; padding:20px 20px 20px 9px;">
<div class="qbt_nidelikai">
<div class="qbt_shujuguanli">
  <span>数据管理</span>
</div>
<div class="qbt_omnissguai">
  
  <form name="list_form" id="list_form" method="post" action="delete.php" target="<?php echo $tempFrame;?>" onSubmit="return del();">
    <table width="100%" border="0" cellpadding="9" cellspacing="0" bgcolor="#ffffff" class="qbt_heniwodsk">
    <tr class="qbt_biaoshiwocunzai">
		<td align="center"><strong>信息名称</strong></td>
		<td align="center"><strong>视频缩略图</strong></td>
		<td align="center"><strong>所属类别</strong></td>
		<td align="center"><strong>操     作</strong></td>
    </tr>
	<?php 
		//遍历酒店视频 
		$sql = 'SELECT * FROM `videos` ';
		$query = mysql_query($sql,$conn);
		while($rs = mysql_fetch_assoc($query)){
	?>
    <tr>
		<td align="center">
			<?php echo $rs['name'];?></a>
		</td>
        <td align="center" >
			<?php if(!empty($rs['img'])){?>
			<img src="../../uploadfiles/<?php echo $rs['img'];?>" width="50">
			<?php }else{echo '暂无缩略图';}?>
		</td>
		<td align="center" >
			<?php if($rs['type']==1){echo '首页视频';}else{echo '子页视频';}?>
		</td>
		<td align="center" >
			<a href="video_save.php?id=<?php echo $rs['id'];?>" title="更改">更改</a>
		</td>
    </tr>
	<?php }?>
</table>
  </form>
</div>
</div>

</body>
</html>