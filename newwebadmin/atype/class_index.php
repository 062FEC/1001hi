<?php 
  include('../includes/php_conn.php');
  set_cookie('atype');
  include('../includes/check.php');
  include('../includes/refresh.php');
  include('setup.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>><?php echo $admin_site_title;?></title>
<link href="../css/qbt.css" rel="stylesheet" type="text/css">
<?php

  /* 加载独立设置 */
  if($manage_id){
    //加载自定义规则
    if(is_file(CC_SAVE_PATH.'conf_'.$manage_id.'.ccset')){
      $cc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_'.$manage_id.'.ccset'));
    }

    //加载父级类自定义规则
    if(is_file(CC_SAVE_PATH.'conf_class_info_'.$manage_id.'.ccset')){
      $_temp = unserialize(file_get_contents(CC_SAVE_PATH.'conf_class_info_'.$manage_id.'.ccset'));
      if($_temp['alone_ccset_class_info']=='yes') $cc_info['class_info'] = $_temp['class_info'];
      if($_temp['alone_ccset_class_extend_field']=='yes') $cc_info['class_extend_field'] = $_temp['class_extend_field'];
    }

    //存在独立设置表名
    if($cc_info['class_alone_table_name']){
      $table_name1 = $cc_info['class_alone_table_name'];
    }
    if($cc_info['info_alone_table_name']){
      $table_name2 = $cc_info['info_alone_table_name'];
    }
  }

  //加载类别列表前的脚本
  if($cc_info['class_script']['list_top']['status']=='show' && $cc_info['class_script']['list_top']['content']!=''){
    if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_list_top_'.$manage_id.'.php')){
      include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_list_top_'.$manage_id.'.php';
    }else{
      if(is_file(CC_SAVE_PATH.'class_script_list_top_'.$manage_id.'.php')){
        include CC_SAVE_PATH.'class_script_list_top_'.$manage_id.'.php';
      }
    }
    
  }

  //属于独立表数据
  if($_REQUEST['class_alone_table_name']){
    $table_name1 = $_REQUEST['class_alone_table_name'];
  }else{
    $_REQUEST['class_alone_table_name'] = $cc_info['class_alone_table_name'];
  }
  if($_REQUEST['info_alone_table_name']){
    $table_name2 = $_REQUEST['info_alone_table_name'];
  }else{
    $_REQUEST['info_alone_table_name'] = $cc_info['info_alone_table_name'];
  }

  $page=ceil(trim(rp($_REQUEST['page'])));
  $sql='select * from `'.$table_name1.'` order by num desc';
  $result=mysql_query($sql,$conn);

  $keyword=$_REQUEST['keyword'];
?>
<script language="javascript">
function class_delete(){
  if (confirm("确认删除所选分类？删除类别的同时将删除类别下的所有子分类以及所有信息！")) return true;
  else return false;
}
</script>
</head>

<body style="background:#eee; padding:20px 20px 20px 9px;">
<div class="qbt_nidelikai">
<div class="qbt_shujuguanli">
  <span>类别管理</span>
  <?php if($manage_id==0 && $_SESSION['superadmin']){ ?><span style="float:right;font-size:12px;padding-right:10px;">[<a href="ccset.php?reloadallset=1" style="color:#fff">刷新所有控制</a>]</span><?php } ?>
</div>
<div class="qbt_omnissguai">
  
  <form action="" method="get">
    <table width="100%" border="0" cellpadding="9" cellspacing="0" bgcolor="#ffffff" class="qbt_heniwodsk">
      <?php show_type_table($table_name1,$manage_id,$manage_id,'',$keyword,$level_num); ?>
    </table>
  </form>
  
</div>
</div>
<script type="text/javascript">
<?php
/* 载入自定义JS脚本 */
if($cc_info['class_script']['list_js']['status']=='show' && $cc_info['class_script']['list_js']['content']!=''){
  if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_list_js_'.$manage_id.'.php')){
    include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_list_js_'.$manage_id.'.php';
  }else{
    if(is_file(CC_SAVE_PATH.'class_script_list_js_'.$manage_id.'.php')){
      include CC_SAVE_PATH.'class_script_list_js_'.$manage_id.'.php';
    }
  }
}
?>
</script>
</body>
</html>