<?php
if (!isset($_COOKIE['a_user_id'])){
	echo '<script language="javascript">';
	echo 'self.location=\'login.htm\';';
	echo '</script>';
	die();
}else{
	setcookie('a_user_id',$_COOKIE['a_user_id'],time()+7200,'/');
}
