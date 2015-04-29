<?php
$action = $_REQUEST['action'];
if ($action == 'bak') $show_js = 'n';
?>
<?php include("../includes/php_conn.php"); ?>
<?php include("../includes/check.php"); ?>
<?php  

if ($action == 'bak')
{   
	$host  =  $mysql_host; //主机名       
	$user  =  $mysql_user; //MYSQL用户名       
	$password  =  $mysql_pwd; //密码       
	$dbname  =  $mysql_db; //备份的数据库       
		 
	
	
	if (!mysql_connect($host,$user,$password))
    {
    	show_msg('连接数据库主机时出现错误，操作中止！',3,'');
    }
	
	mysql_connect($host,$user,$password);
	
	if (!mysql_select_db($dbname))
    {
    	show_msg('没有找到相对应的数据库，操作中止！',3,'');
    }
	mysql_select_db($dbname);       
		 
	$q1 = mysql_query("show tables");       
	while($t = mysql_fetch_array($q1)){       
	$table = $t[0];       
	$q2 = mysql_query("show create table `$table`");       
	$sql = mysql_fetch_array($q2);       
	$mysql .= "DROP TABLE IF EXISTS `$table`;\r\n".str_replace('CREATE TABLE','CREATE TABLE IF NOT EXISTS',$sql['Create Table']).";\r\n\r\n";#DDL       
		 
	$q3 = mysql_query("select * from `$table`");       
	while($data = mysql_fetch_assoc($q3))       
	{       
		$keys = array_keys($data);       
		$keys = array_map('addslashes',$keys);       
		$keys = join('`,`',$keys);       
		$keys = "`".$keys."`";       
		$vals = array_values($data);       
		$vals = array_map('addslashes',$vals);       
		$vals = join("','",$vals);       
		$vals = "'".$vals."'";       
			 
		$mysql .= 'INSERT INTO `'.$table.'` ('.$keys.') VALUES '.chr(13).chr(10).' ('.str_replace(chr(13).chr(10),'\r\n',$vals).');'.chr(13).chr(10);
	}       
	$mysql .= "\r\n";       
		 
	}
	$mysql = "SET SQL_MODE=\"NO_AUTO_VALUE_ON_ZERO\";\r\n\r\n-- 生成日期: ".date('Y')." 年 ".date('m')." 月 ".date('d')." 日 ".date('H').":".date('i').":".date('s')."\r\n\r\n".$mysql;
	
	header("Content-type: text/html; charset=utf-8"); 
	header("Content-Type: application/force-download");
	header("Content-Disposition: attachment; filename=".basename(date('Y-m-d').'-data.sql')); 
	echo $mysql;
	exit();    
}
?> 
<html>
<head>
<title>admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/qbt.css" rel="stylesheet" type="text/css">
<script language="javascript">
function check(){
	if (confirm("即将备份数据库到本地，是否确认？建议您最少一天备份一次数据库！"))
	return true;
	else
	return false;
	}
</script>
</head>

<body style="background:#eee; padding:20px 20px 20px 9px;">

<div class="qbt_nidelikai">
<div class="qbt_shujuguanli">
  <span>备份数据</span>
</div>
<div class="qbt_omnissguai">
  
  <form name="form1" method="post" action="index.php?action=bak" target="<?php echo $tempFrame; ?>">
    <table width="100%" border="0" cellpadding="9" cellspacing="0" bgcolor="#ffffff" class="qbt_heniwodsk">
      <tr><td height="20">
        <button class="button button_white" onClick="return check();" type="submit">备份数据库到本地</button>
      </td></tr>
    </table>
  </form>
  
</div>
</div>

</body>
</html>
