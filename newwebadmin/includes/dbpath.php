<?php
$mysql_host='localhost';		//host name
$mysql_user='root';		//login name
$mysql_pwd='';		//password
$mysql_db='hotel_1001';		//name of database
/*
$mysql_host='IP地址';		//host name
$mysql_user='用户名';		//login name
$mysql_pwd='密码';		//password
$mysql_db='数据库名称';		//name of database
*/

$db_path=mysql_connect ($mysql_host,$mysql_user,$mysql_pwd);
$table_db=$mysql_db;

mysql_query("SET NAMES utf8");//编码
?>