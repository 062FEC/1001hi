<?php
  include("../includes/php_conn.php");
  include("../includes/check.php");
?>
<html>
<head>
<title>admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/qbt.css" rel="stylesheet" type="text/css">
<?php

if($_GET['id']){
  $admininfo = mysql_fetch_assoc(mysql_query("SELECT * FROM `web_admin` WHERE `id`='{$_GET['id']}'"));
}else{
  $admininfo = mysql_fetch_assoc(mysql_query("SELECT * FROM `web_admin` WHERE `id`='{$_COOKIE['a_user_id']}'"));
}

if ($action == 'save')
{
  $_POST['user'] = trim($_POST['user']);
  if($_POST['id']){
    $admininfo = mysql_fetch_assoc(mysql_query("SELECT * FROM `web_admin` WHERE `id`='{$_POST['id']}'"));
    $admin_pwd = "'{$admininfo['admin_pwd']}'";
    if($_POST['pwd']){
      $admin_pwd = "md5('{$_POST['pwd']}')";
    }
    $sql="UPDATE `web_admin` SET 
      `admin_user`='{$_POST['user']}',
      `admin_pwd`={$admin_pwd},
      `role_id`='{$_POST['role_id']}'
      WHERE `id`='{$_POST['id']}'";
  }else{
    $sql="INSERT INTO `web_admin` SET 
      `admin_user`='{$_POST['user']}',
      `admin_pwd`=md5('{$_POST['pwd']}'),
      `role_id`='{$_POST['role_id']}',
      `admin_id`='{$a_user_id}'";
  }

  mysql_query($sql,$conn);
  is_err();

  if($_POST['id']){
?>
<script language="javascript">
alert("资料更改成功，按确定返回！");
window.self.location='index.php';
</script>
<?php
  }else{
?>
<script language="javascript">
alert("添加管理员成功");
window.self.location='index.php';
</script>
<?php
  }
  exit;
}

if($_GET['id']){
  $sql='select * from web_admin where id='.$_GET['id'];
  $result=mysql_query($sql,$conn);
  $rs=mysql_fetch_array($result);
}
?>
<script type="text/javascript" charset="utf-8" src="../js/jquery.js"></script>
<script language="javascript">
function check()
{

if (document.form1.user.value=="")
{alert("用户名不能为空！");
document.form1.user.focus();
return false;
}
<?php if(!$_GET['id']){ ?>
if (document.form1.pwd.value=="")
{alert("用户密码不能为空！");
document.form1.pwd.focus();
return false;
}
<?php } ?>
if (document.form1.pwd.value!=document.form1.pwd1.value)
{alert("两次输入的用户密码不一致,请重新输入！");
document.form1.pwd1.focus();
return false;
}
is_form_submited = true;
return true;
}
var is_form_submited=false;
function is_form_changed() { 
    if(is_form_submited) return false;
    var is_changed = false; 
    $("input, textarea, select").each(function() { 
        var _v = $(this).attr('_value'); 
        if(typeof(_v) == 'undefined') _v = ''; 
        if(_v != $(this).val()) is_changed = true; 
    }); 
    return is_changed; 
} 
$(document).ready(function(){ 
    $("input, textarea, select").each(function() { 
        $(this).attr('_value', $(this).val()); 
    }); 
}); 
window.onbeforeunload = function() { 
    if(is_form_changed()) { 
        return "当前页面内容还没有保存，您确定离开吗？"; 
    } 
}
</script>
</head>

<body style="background:#eee; padding:20px 20px 20px 9px;">

<div class="qbt_nidelikai">
<div class="qbt_shujuguanli">
  <span><?php if($_GET['id']){ ?>管理员资料更改<?php }else{ ?>添加管理员<?php } ?></span>
</div>
<div class="qbt_omnissguai">
  
  <form name="form1" method="post" action="" onSubmit="return check();">
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <table width="100%" border="0" cellpadding="9" cellspacing="0" bgcolor="#ffffff" class="qbt_heniwodsk">
      <tr bgcolor="#FFFFFF">
        <td width="16%" align="right" bgcolor="#FFFFFF"><strong>用户名</strong></td>
        <td width="84%" bgcolor="#FFFFFF">
          <?php if((($_GET['id'] && check_admin_action("admin_user_user_list_edit")) || (!$_GET['id'] && check_admin_action("admin_user_user_add"))) && ($a_user_id==1 || $_GET['id']!=$a_user_id)){ ?>
          <input name="user" type="text" id="user" value="<?php echo $rs['admin_user'];?>" size="30" class="qbt_syzsf">
          <?php }else{?>
          <?php echo $rs['admin_user']; ?>
          <input name="user" type="hidden" id="user" value="<?php echo $rs['admin_user'];?>" size="30" class="qbt_syzsf">
          <?php } ?>
        </td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td width="16%" align="right" bgcolor="#FFFFFF"><strong>密　码</strong></td>
        <td width="84%" bgcolor="#FFFFFF"><input name="pwd" type="password" id="pwd" size="30" class="qbt_syzsf"></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td width="16%" align="right" bgcolor="#FFFFFF"><strong>确认密码</strong></td>
        <td width="84%" bgcolor="#FFFFFF"><input name="pwd1" type="password" id="pwd1" size="30" class="qbt_syzsf"></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td width="16%" align="right" bgcolor="#FFFFFF"><strong>所属角色</strong></td>
        <td width="84%" bgcolor="#FFFFFF">
          <?php if(check_admin_action("admin_user_role_list",true)){ ?>
          <select name="role_id" class="qbt_buyao_bawo_mjj">
          <?php
            $role_query = mysql_query("SELECT * FROM `web_admin_role`");
            while($role_info = mysql_fetch_assoc($role_query)){
          ?>
          <option value="<?php echo $role_info['id']; ?>" <?php $role_info['id']==$admininfo['role_id'] && print('selected="selected"'); ?>><?php echo $role_info['role_name']; ?></option>
          <?php
            }
          ?>
          </select>
          <?php }else{
            echo mysql_result(mysql_query("SELECT `role_name` FROM `web_admin_role` WHERE `id`='{$admininfo['role_id']}'"), 0);
          ?>
          <input type="hidden" name="role_id" value="<?php echo $admininfo['role_id']; ?>">
          <?php } ?>
        </td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td width="16%" align="right" bgcolor="#FFFFFF">&nbsp;</td>
        <td width="84%" bgcolor="#FFFFFF">
          <button class="button button_blue" type="submit">保存</button>&nbsp;<button class="button button_white" type="reset">重置</button>
          <input name="action" type="hidden" id="action" value="save">
        </td>
      </tr>
    </table>
  </form>
  
</div>
</div>

</body>
</html>


