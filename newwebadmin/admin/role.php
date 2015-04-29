<?php
  include('../includes/php_conn.php');
  set_cookie('web_admin');
  include('../includes/check.php');
  include('../includes/refresh.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $admin_site_title;?></title>
<link href="../css/qbt.css" rel="stylesheet" type="text/css">
<?php

if($_GET['did']){
    if($_GET['did']==1) show_msg("超级管理员权限不可删除",4,'index.php');
    mysql_query("DELETE FROM `web_admin_role` WHERE `id`='{$_GET['did']}'");
    show_msg("删除成功",4,'index.php');
}

$this_page_name = 'role.php';
$keyword=trim(rp($_REQUEST['keyword']));
$sql_t='SELECT * FROM `web_admin_role` WHERE 1=1';
if ($action=='search') $sql_t .= " AND `role_name` LIKE '%".mysql_escape_string($keyword)."%'";


//$t_size=mysql_num_rows(mysql_query($sql_t,$conn));
$t_size=mysql_result(mysql_query(str_replace('SELECT *', 'SELECT COUNT(*)', $sql_t)), 0);
$v_size=18;
$h_size=1;
$p_size=$v_size*$h_size;
$total=ceil($t_size/$p_size);
$page=trim(rp($_REQUEST['page']));

if(empty($page))
$page=1;
else
{
if($page<1)$page=1;
}
if($total>0 && $page>=$total)$page=$total;

$sql=$sql_t." limit ".(($page-1)*$p_size).",".$p_size;
$result=mysql_query($sql,$conn);

?>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
</head>

<body style="background:#eee; padding:20px 20px 20px 9px;">
<div class="qbt_nidelikai">
<div class="qbt_shujuguanli">
  <span>后台角色管理</span>
    <div class="qbt_fenzhong_nl">
        <form name="form3" method="get" action="index.php">
            <input name="keyword" type="text" class="qbt_sjglz_shuru" value="<?php echo $_GET['keyword']; ?>" />
            <input name="Submit2" type="submit" class="qbt_sjglz_anniu" value=" ">
        </form>
    </div>
</div>
<div class="qbt_omnissguai">

    <input type="hidden" name="class_alone_table_name" value="<?php echo $cc_info['class_alone_table_name']; ?>">
    <input type="hidden" name="info_alone_table_name" value="<?php echo $cc_info['info_alone_table_name']; ?>">
    <table width="100%" border="0" cellpadding="9" cellspacing="0" bgcolor="#ffffff" class="qbt_heniwodsk">
    <tr class="qbt_biaoshiwocunzai">
      <?php if($_SESSION['superadmin']){ ?><td align="center"><strong>ID</strong></td><?php } ?>
      <td align="center"><strong>角色名称</strong></td>
      <td align="center"><strong>角色描述</strong></td>
      <td align="center"><strong>操作</strong></td>
  </tr>
  <?php
    $i_line=0;
    while ($rs=mysql_fetch_array($result))
    {
      $i_line++;
  ?>

    <tr>

      <?php if($_SESSION['superadmin']){ ?><td <?php if($i_line%2==0){ ?>bgcolor="#fcfcfc"<?php } ?> align="center"><?php echo $rs['id']; ?></td><?php } ?>

      <td <?php if($i_line%2==0){ ?>bgcolor="#fcfcfc"<?php } ?> align="center"><?php echo $rs['role_name']; ?></td>

      <td <?php if($i_line%2==0){ ?>bgcolor="#fcfcfc"<?php } ?> align="center"><?php echo $rs['role_desc']; ?></td>

      <td align="center" <?php if($i_line%2==0){ ?>bgcolor="#fcfcfc"<?php } ?>>
        <?php if(($rs['id']>1 || $a_user_id==1) && check_admin_action("edit")){ ?><button class="button button_white" onClick="location.href='role_save.php?id=<?php echo $rs['id']; ?>';return false;">修改</button><?php } ?>
        <?php if($rs['id']>1 && check_admin_action("del")){ ?>
        <button class="button button_white" onClick="if(confirm('确认要删除该角色吗？')){ location.href='?did=<?php echo $rs['id']; ?>'; } return false;">删除</button>
        <?php } ?>
      </td>

    </tr>

  <?php
    }
  ?>
</table>
    <?php
      $goto_href = '';
      if($_GET){
        foreach ($_GET as $key => $value) {
          if(in_array($key, array('page'))) continue;
          $goto_href .= (empty($goto_href)?'?':'&').$key.'='.urlencode($value);
        }
      }
      $goto_href .= (empty($goto_href)?'?':'&')."page=";
    ?>

    <div id="example_paginate" class="dataTables_paginate paging_full_numbers"><span id="example_first" class="qbt_gongjilup">共记录：<?php echo $t_size;?>篇</span> 页次：<?php echo $page;?>/<?php echo $total;?>　

      <?php if ($page!=1) { ?>

      <span id="example_previous" class="previous paginate_button" onclick="<?php echo $goto_href.($page-1);?>'">上一页</span>

      <?php }else{ ?>

      <span id="example_previous" class="previous paginate_button paginate_button_disabled">上一页</span>

      <?php } ?>

      <?php if ($page!=$total) { ?>

      <span id="example_next" class="next paginate_button" onclick="location.href='<?php echo $goto_href.($page+1);?>'">下一页</span>

      <?php }else{ ?>

      <span id="example_next" class="next paginate_button paginate_button_disabled">下一页</span>

      <?php } ?>

    <?php if($cc_info['info_list']['page_select']['status']!='hide'){ ?>
    <select name="menu1" class="qbt_buyao_bawo"  onChange="MM_jumpMenu('self',this,0)">
    <?php
      for ($k=1;$k<=$total;$k++)
      {
        if ($k==$page)
        {
    ?>
        <option value="" selected>第<?php echo $k;?>页</option>
    <?php
        }else{
    ?>
        <option value="<?php echo $goto_href.$k;?>">第<?php echo $k;?>页</option>
    <?php
        }
      }
    ?>
    </select>
    <?php } ?>
  </div>
</div>
</div>
</body>
</html>