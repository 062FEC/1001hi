<?php
require "php_conn.php";
$admin_user=rp($_REQUEST['user']);
$admin_password=$_REQUEST['password'];
$sql='select * from web_admin where admin_user=\''.$admin_user.'\'';
$result=mysql_query($sql,$conn);
$rs=mysql_fetch_array($result);

if ($rs['admin_pwd']!=md5($admin_password)){
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
	?>
	<script type="text/javascript">
	alert("登录提示：\n\n用户名或密码错误，请检查后重新输入！");
	var a = parent.document.getElementById("user");
	var b = parent.document.getElementById("password");
	a.value = "";
	b.value = "";
	a.focus();
	window.close();
	</script>
	<?php
	die();
}else{
	if(isset($_POST['remember'])){
		setcookie('a_username',$admin_user,time()+86400*365,'/');
	}else{
		setcookie('a_username',$admin_user,null,'/');
	}
	setcookie('a_user_id',$rs['id'],time()+7200,'/');
	echo '<script language="javascript">
	top.window.self.location = "index.php";
	</script>';
}