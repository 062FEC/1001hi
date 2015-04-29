<?php
define('IS_ENG', false);
header("Content-type: text/html; charset=utf-8");

require dirname(__FILE__)."/newwebadmin/includes/dbpath.php";
$conn=&$db_path;
if (!$conn) die('错误提示: ' . mysql_error());
mysql_select_db($table_db,$conn);

require dirname(__FILE__)."/newwebadmin/includes/function.php";

//全站配置
$_global_site_config = mysql_fetch_assoc(mysql_query("SELECT * FROM `atype_info` WHERE `id`=10"));
