<?php
if (!isset($_COOKIE['a_user_id']))
//if ($_COOKIE["a_user_id"]=="")
	{
		echo '<script language="javascript">';
		echo 'self.location=\'../login.htm\';';
		echo '</script>';
		die();
	}
else
	{
	setcookie('a_user_id',$_COOKIE['a_user_id'],time()+7200,'/');
	}
?>
<?php
if ($show_js != 'n')
{
	if (!$_SESSION['superadmin']){
?>
<SCRIPT LANGUAGE="JavaScript">
<!-- Hide
function killErrors() {
  return true;
}
   window.onerror = killErrors;
// -->
</SCRIPT>
<?php } ?>
<SCRIPT src="../../js/function.js" type=text/javascript></SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php } ?>