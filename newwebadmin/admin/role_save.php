<?php
  include("../includes/php_conn.php");
  include("../includes/check.php");
?>
<html>
<head>
<title>admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/qbt.css" rel="stylesheet" type="text/css">
<script type="text/javascript" charset="utf-8" src="../js/jquery.js"></script>
<script language="javascript">
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
<?php

if ($action == 'save')
{

  $newqx = get_all_action();
  if($_POST['qx']){
    $newqx = array_merge($newqx, $_POST['qx']);
  }
  $_POST['name'] = trim($_POST['name']);
  $_POST['desc'] = trim($_POST['desc']);
  $newqx = serialize($newqx);
  if($_POST['id']){
    $sql="UPDATE `web_admin_role` SET 
      `role_name`='{$_POST['name']}',
      `role_desc`='{$_POST['desc']}',
      `action`='{$newqx}'
      WHERE `id`='{$_POST['id']}'";
  }else{
    $sql="INSERT INTO `web_admin_role` SET 
      `role_name`='{$_POST['name']}',
      `role_desc`='{$_POST['desc']}',
      `action`='{$newqx}',
      `admin_id`='{$a_user_id}'";
  }

  mysql_query($sql,$conn);
  is_err();

  if($_POST['id']){
?>
<script language="javascript">
alert("资料更改成功，按确定返回！");
window.self.location='role.php';
</script>
<?php
    exit;
  }else{
?>
<script language="javascript">
alert("添加角色成功");
window.self.location='role.php';
</script>
<?php
    exit;
  }
}

if($_GET['id']){
  $sql='select * from web_admin_role where id='.$_GET['id'];
  $result=mysql_query($sql,$conn);
  $rs=mysql_fetch_array($result);
  $rs['action'] = unserialize($rs['action']);
}
?>
<script language="javascript">
function check()
{
if (document.form1.name.value=="")
{alert("角色名称不能为空！");
document.form1.name.focus();
return false;
}
is_form_submited = true;
return true;
}
</script>
</head>

<body style="background:#eee; padding:20px 20px 20px 9px;">

<div class="qbt_nidelikai">
<div class="qbt_shujuguanli">
  <span><?php if($_GET['id']){ ?>角色更改<?php }else{ ?>添加新角色<?php } ?></span>
</div>
<div class="qbt_omnissguai">
  
  <form name="form1" method="post" action="" onSubmit="return check();">
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <table width="100%" border="0" cellpadding="9" cellspacing="0" bgcolor="#ffffff" class="qbt_heniwodsk">
      <tr bgcolor="#FFFFFF">
        <td width="16%" align="right" bgcolor="#FFFFFF"><strong>角色名称</strong></td>
        <td width="84%" bgcolor="#FFFFFF"><input name="name" type="text" id="name" value="<?php echo $rs['role_name'];?>" size="30" class="qbt_syzsf"></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td width="16%" align="right" bgcolor="#FFFFFF"><strong>角色描述</strong></td>
        <td width="84%" bgcolor="#FFFFFF"><input name="desc" type="text" id="desc" value="<?php echo $rs['role_desc'];?>" size="30" class="qbt_syzsf"></td>
      </tr>
      <?php if(!$_GET['id'] || $_GET['id']>1){ ?>
      <tr bgcolor="#FFFFFF">
        <td width="16%" align="right" bgcolor="#FFFFFF"><strong>权限管理</strong> <input type="checkbox" onclick="checkboxall(this.checked)" /></td>
        <td width="84%" bgcolor="#FFFFFF">
          <script type="text/javascript">
            function checkboxall(checked){
              if(checked){
                $('.qxbox input[type=checkbox]').prop('checked','checked');
              }else{
                $('.qxbox input[type=checkbox]').attr('checked',false);
              }
            }
            function checksubbox(checked,subname){
              if(checked){
                $('.qxbox input[name^='+subname+']').prop('checked','checked');
              }else{
                $('.qxbox input[name^='+subname+']').attr('checked',false);
              }
            }
          </script>
          <style type="text/css">
            .qxbox input{ vertical-align: middle; }
          </style>
          <table width="100%" class="qxbox">
          <?php
            if($qbt_admin_config['qxmenu']){
              foreach($qbt_admin_config['qxmenu'] as $key=>$val){
                if(empty($val['check'])) continue;
          ?>
            <tr>
              <td bgcolor="#dddddd" height="30" colspan="2">&nbsp; <input type="checkbox" name="qx[<?php echo $key;?>]" <?php if($rs['action'][$key]){ ?>checked="checked"<?php } ?> value="1" onclick="checksubbox(this.checked,'qx\\[<?php echo $key;?>');" /><?php echo $val['text'];?><?php if($_SESSION['superadmin']){ echo " ({$key})"; } ?></td>
            </tr>
            <?php
                if($val['sub']){
                  foreach($val['sub'] as $key2=>$val2){
                    if(empty($val2['check'])) continue;
            ?>
            <tr>
              <td bgcolor="#eeeeee" width="<?php if($_SESSION['superadmin']){ ?>200<?php }else{ ?>120<?php }?>" height="25">&nbsp; <input type="checkbox" name="qx[<?php echo $key.'_'.$key2;?>]" <?php if($rs['action'][$key.'_'.$key2]){ ?>checked="checked"<?php } ?> value="1" onclick="checksubbox(this.checked,'qx\\[<?php echo $key.'_'.$key2;?>');" /><?php echo $val2['text']; ?><?php if($_SESSION['superadmin']){ echo "<br>&nbsp; ({$key}_{$key2})"; } ?></td>
              <td bgcolor="#eeeeee" height="25" align="left">&nbsp; 
                <?php
                  if($val2['cats']){
                    foreach($val2['cats'] as $key3=>$val3){
                      if(empty($val3['check'])) continue;
                ?>
                <input type="checkbox" value="1" <?php if($rs['action'][$key.'_'.$key2.'_'.$key3]){ ?>checked="checked"<?php } ?> name="qx[<?php echo $key.'_'.$key2.'_'.$key3;?>]" /><?php echo $val3['text']; ?><?php if($_SESSION['superadmin']){ echo " ({$key}_{$key2}_{$key3})<br>&nbsp; "; } ?>
                <?php
                    }
                  }
                ?>
                <?php
                  if($val2['custom']){
                    foreach($val2['custom'] as $key3=>$val3){
                      if(empty($val3['check'])) continue;
                ?>
                <input type="checkbox" value="1" <?php if($rs['action'][$key.'_'.$key2.'_'.$val3]){ ?>checked="checked"<?php } ?> name="qx[<?php echo $key.'_'.$key2.'_'.$val3;?>]" /><?php echo $val3; ?><?php if($_SESSION['superadmin']){ echo " ({$key}_{$key2}_{$key3})<br>&nbsp; "; } ?>
                <?php
                    }
                  }
                ?>
              </td>
            </tr>
            <?php
                  }
                }
              }
            }
          ?>
          </table>
        </td>
      </tr>
      <?php } ?>
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


