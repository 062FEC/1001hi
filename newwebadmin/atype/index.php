<?php
  include('../includes/php_conn.php');
  set_cookie('atype_info');
  include('../includes/check.php');
  include('../includes/refresh.php');
  include('setup.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $admin_site_title;?></title>
<link href="../css/qbt.css" rel="stylesheet" type="text/css">
<?php

/* 加载独立设置 */
if($manage_id || $type_id){

  $cc_id = $manage_id;
  if($type_id) $cc_id = $type_id;
  //加载自定义规则
  if(is_file(CC_SAVE_PATH.'conf_'.$cc_id.'.ccset')){
    $cc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_'.$cc_id.'.ccset'));
  }

  //存在独立设置表名
  if($cc_info['class_alone_table_name']){
    $table_name1 = $cc_info['class_alone_table_name'];
  }
  if($cc_info['info_alone_table_name']){
    $table_name2 = $cc_info['info_alone_table_name'];
  }
}

//加载信息列表前的脚本
if($cc_info['info_script']['list_top']['status']=='show' && $cc_info['info_script']['list_top']['content']!=''){
  if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_list_top_'.$cc_id.'.php')){
    include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_list_top_'.$cc_id.'.php';
  }else{
    if(is_file(CC_SAVE_PATH.'info_script_list_top_'.$cc_id.'.php')){
      include CC_SAVE_PATH.'info_script_list_top_'.$cc_id.'.php';
    }
  }
}

//属于独立表数据
if($_REQUEST['class_alone_table_name']){
  $table_name1 = $_REQUEST['class_alone_table_name'];
}
if($_REQUEST['info_alone_table_name']){
  $table_name2 = $_REQUEST['info_alone_table_name'];
}

$this_page_name = 'index.php';
$keyword=trim(rp($_REQUEST['keyword']));
$sql_t='SELECT * FROM `'.$table_name2.'` WHERE 1=1';

//多管理员
if($a_user_id>1 && $qbt_admin_config['atype_info_m_admin']) $sql_t.=" AND `admin_id`='{$a_user_id}'";

if ($action=='search') $sql_t .= " AND `cn_name` LIKE '%".mysql_escape_string($keyword)."%'";

$f_sql_name = '';
show_type_all_id($table_name1,$type_id);
$sql_t .= ' AND (';
$sql_t .= $f_sql_name;
$f_sql_name = '';
$sql_t .= "`type_id`='{$type_id}')";

/* 载入自定义搜索条件 */
if($cc_info['info_script']['search_php']['status']=='show' && $cc_info['info_script']['search_php']['content']!=''){
  if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_search_php_'.$cc_id.'.php')){
    include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_search_php_'.$cc_id.'.php';
  }else{
    if(is_file(CC_SAVE_PATH.'info_script_search_php_'.$cc_id.'.php')){
      include CC_SAVE_PATH.'info_script_search_php_'.$cc_id.'.php';
    }
  }
}

//自定义排序
!isset($custom_order) && $custom_order='';
if($cc_info['info_order_rule']){
  $custom_order = $cc_info['info_order_rule'];
}
if(!empty($custom_order)){
  $sql_t .= ' ORDER BY '.$custom_order;
}else{
  $sql_t .= ' ORDER BY `num` DESC,`id` DESC';
}


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


$pcc_info = $cc_info = array();
if(is_file(CC_SAVE_PATH.'conf_'.$manage_id.'.ccset')){
  $pcc_info = $cc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_'.$manage_id.'.ccset'));
}
if($type_id && is_file(CC_SAVE_PATH.'conf_'.$type_id.'.ccset')){
  $cc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_'.$type_id.'.ccset'));
}

?>
<script type="text/javascript">
function ChangeClass(){
  this.location.href="index.php?id="+document.list_form.id.value;
}
function unselectall(){
    if(document.list_form.chkAll.checked){
      document.list_form.chkAll.checked = document.list_form.chkAll.checked&0;
    }
}
function CheckAll(form){
  for (var i=0;i<form.elements.length;i++){
    var e = form.elements[i];
    if (e.Name != "") e.checked = form.chkAll.checked;
  }
}
function del(){
  if (confirm("确认批量操作所选信息？")) return true;
  else return false;
}
function MM_jumpMenu(targ,selObj,restore){
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
</head>

<body style="background:#eee; padding:20px 20px 20px 9px;">
<div class="qbt_nidelikai">
<div class="qbt_shujuguanli">
  <span>数据管理</span>
    <?php if($cc_info['info_list']['search_action']['status']!='hide'){ ?>
    <div class="qbt_fenzhong_nl" style="width:auto;">
        <form name="form3" method="get" action="index.php" style="line-height: 30px;height: 30px;">
            <input name="Submit2" type="submit" class="qbt_sjglz_anniu" value=" ">
            <?php
              /* 载入自定义搜索表单 */
              if($cc_info['info_script']['search_html']['status']=='show' && $cc_info['info_script']['search_html']['content']!=''){
                if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_search_html_'.$cc_id.'.php')){
                  include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_search_html_'.$cc_id.'.php';
                }else{
                  if(is_file(CC_SAVE_PATH.'info_script_search_html_'.$cc_id.'.php')){
                    include CC_SAVE_PATH.'info_script_search_html_'.$cc_id.'.php';
                  }
                }
              }else{
            ?>
            <input name="keyword" type="text" class="qbt_sjglz_shuru" value="<?php echo $_GET['keyword']; ?>" />
            <?php
              }
            ?>
            <input type="hidden" name="class_alone_table_name" value="<?php echo $cc_info['class_alone_table_name']; ?>" />
            <input type="hidden" name="info_alone_table_name" value="<?php echo $cc_info['info_alone_table_name']; ?>" />
            <input name="action" type="hidden" id="action" value="search">
            <input name="manage_id" type="hidden" id="manage_id" value="<?php echo $manage_id;?>">
            <input name="type_id" type="hidden" id="type_id" value="<?php echo $type_id;?>">
        </form>
    </div>
    <?php } ?>
</div>
<div class="qbt_omnissguai">
  
  <form name="list_form" id="list_form" method="post" action="delete.php" target="<?php echo $tempFrame;?>" onSubmit="return del();">
    <input type="hidden" name="class_alone_table_name" value="<?php echo $cc_info['class_alone_table_name']; ?>">
    <input type="hidden" name="info_alone_table_name" value="<?php echo $cc_info['info_alone_table_name']; ?>">
    <table width="100%" border="0" cellpadding="9" cellspacing="0" bgcolor="#ffffff" class="qbt_heniwodsk">
    <tr class="qbt_biaoshiwocunzai">
      <?php if($_SESSION['superadmin']){ ?><td><strong>ID</strong></td><?php } ?>
      <?php

      //显示扩展栏目 first
      show_info_extend_column_title($cc_info,'first');

      ?>
      <?php if($cc_info['info_list']['order_title']['status']!='hide'){ ?><td align="center"><strong><?php echo $cc_info['info_list']['order_title']['title']?$cc_info['info_list']['order_title']['title']:'信息名称'; ?></strong></td><?php } ?>
      <?php

      //显示扩展栏目 order_title
      show_info_extend_column_title($cc_info,'order_title');

      ?>
      <?php if($cc_info['info_list']['order_change']['status']!='hide'){ ?><td align="center"><strong><?php echo $cc_info['info_list']['order_change']['title']?$cc_info['info_list']['order_change']['title']:'排列序号'; ?></strong></td><?php } ?>
      <?php

      //显示扩展栏目 order_change
      show_info_extend_column_title($cc_info,'order_change');

      ?>
      <?php if($cc_info['info_list']['list_info_class']['status']!='hide'){ ?><td align="center"><strong><?php echo $cc_info['info_list']['list_info_class']['title']?$cc_info['info_list']['list_info_class']['title']:'所属类别'; ?></strong></td><?php } ?>
      <?php

      //显示扩展栏目 list_info_class
      show_info_extend_column_title($cc_info,'list_info_class');

      ?>
      <?php if($cc_info['info_list']['list_recommend_info']['status']!='hide'){ ?><td align="center"><strong><?php echo $cc_info['info_list']['list_recommend_info']['title']?$cc_info['info_list']['list_recommend_info']['title']:'推荐信息'; ?></strong></td><?php } ?>
      <?php

      //显示扩展栏目 list_recommend_info
      show_info_extend_column_title($cc_info,'list_recommend_info');

      ?>
      <?php if($cc_info['info_list']['list_thumb']['status']!='hide'){ ?><td align="center"><strong><?php echo $cc_info['info_list']['list_thumb']['title']?$cc_info['info_list']['list_thumb']['title']:'缩略图'; ?></strong></td><?php } ?>
      <?php

      //显示扩展栏目 list_thumb
      show_info_extend_column_title($cc_info,'list_thumb');

      //显示扩展栏目 last
      show_info_extend_column_title($cc_info,'last');

      ?>
      <td align="center"><strong>操作</strong></td>
      <?php if($cc_info['info_list']['batch_action']['status']!='hide'){ ?>
      <td align="center"><strong>选?</strong></td>
      <?php } ?>
  </tr>
  <?php
    $old_cc_info = $cc_info;
    $i_line=0;
    while ($rs=mysql_fetch_array($result))
    {
      $i_line++;

      //还原上级控制，防止独立控制覆盖
      $cc_info = $old_cc_info;

      //加载信息独立控制菜单
      $alone_cc_info = array();
      if(is_file(CC_SAVE_PATH.($cc_info['info_alone_table_name']?"{$cc_info['info_alone_table_name']}_":'').'conf_info_'.$rs['id'].'.ccset')){
        $alone_cc_info = unserialize(file_get_contents(CC_SAVE_PATH.($cc_info['info_alone_table_name']?"{$cc_info['info_alone_table_name']}_":'').'conf_info_'.$rs['id'].'.ccset'));
      }

      //独立控制栏目
      if($alone_cc_info['alone_ccset_info_extend_column']=='yes'){
        $cc_info['info_list']['order_title'] = $alone_cc_info['info_list']['order_title'];
        $cc_info['info_list']['order_change'] = $alone_cc_info['info_list']['order_change'];
        $cc_info['info_list']['list_info_class'] = $alone_cc_info['info_list']['list_info_class'];
        $cc_info['info_list']['list_recommend_info'] = $alone_cc_info['info_list']['list_recommend_info'];
        $cc_info['info_list']['list_thumb'] = $alone_cc_info['info_list']['list_thumb'];
        $cc_info['info_extend_column'] = $alone_cc_info['info_extend_column'];
      }

      //独立控制操作菜单
      if($alone_cc_info['alone_ccset_info_extend_action']=='yes'){
        $cc_info['info_list']['info_view'] = $alone_cc_info['info_list']['info_view'];
        $cc_info['info_list']['info_copy'] = $alone_cc_info['info_list']['info_copy'];
        $cc_info['info_list']['info_change'] = $alone_cc_info['info_list']['info_change'];
        $cc_info['info_list']['info_detete'] = $alone_cc_info['info_list']['info_detete'];
        $cc_info['info_extend_action'] = $alone_cc_info['info_extend_action'];
      }
  ?>

    <tr>

      <?php if($_SESSION['superadmin']){ ?><td><?php echo $rs['id']; ?></td><?php } ?>

      <?php

      //显示类目扩展栏目 first
      show_info_extend_column_content($cc_info,$rs,'first');
      
      ?>

      <?php
        if($cc_info['info_list']['order_title']['status']!='hide'){
          if($cc_info['info_list']['info_change']['status']!='hide' && check_admin_action("info_change")){
      ?>
      <td <?php if($i_line%2==0){ ?>bgcolor="#fcfcfc"<?php } ?>><a href="save.php?__action=<?php echo urlencode($_GET['__action']); ?>&manage_id=<?php echo $manage_id;?>&t_action=0002&id=<?php echo $rs['id'];?>&class_alone_table_name=<?php echo $cc_info['class_alone_table_name']; ?>&info_alone_table_name=<?php echo $cc_info['info_alone_table_name']; ?>" title="更改"><?php echo re_keyword($rs['cn_name'],$keyword,'');?></a></td>
      <?php
          }else{
      ?>
      <td <?php if($i_line%2==0){ ?>bgcolor="#fcfcfc"<?php } ?>><?php echo re_keyword($rs['cn_name'],$keyword,'');?></td>
      <?php
          }
        }
      ?>

      <?php

      //显示类目扩展栏目 order_title
      show_info_extend_column_content($cc_info,$rs,'order_title');
      
      ?>

      <?php if($cc_info['info_list']['order_change']['status']!='hide'){ ?>
      <td align="center" <?php if($i_line%2==0){ ?>bgcolor="#fcfcfc"<?php } ?>>
        <?php if(check_admin_action("info_change")){ ?>
        <script language="javascript">
        function Check_ID<?php echo $rs['id'];?>()
        {
        var num<?php echo $rs['id'];?>=document.getElementById("num<?php echo $rs['id'];?>").value;
        window.parent.<?php echo $tempFrame;?>.location="update_num.php?__action=<?php echo urlencode($_GET['__action']); ?>&num="+num<?php echo $rs['id'];?>+"&class_alone_table_name=<?php echo $cc_info['class_alone_table_name']; ?>&info_alone_table_name=<?php echo $cc_info['info_alone_table_name']; ?>&id=<?php echo $rs['id'];?>";
        }
        </script>
          <input name="num<?php echo $rs['id'];?>" type="text" id="num<?php echo $rs['id'];?>" value="<?php echo $rs['num'];?>"  class="qbt_longjunfeng">
          <button class="button button_white" onClick="javascript:Check_ID<?php echo $rs['id'];?>();return false;">修改</button>
        <?php }else{ ?>
        <?php echo $rs['num'];?>
        <?php } ?>
      </td>
      <?php } ?>

      <?php

      //显示类目扩展栏目 order_change
      show_info_extend_column_content($cc_info,$rs,'order_change');
      
      ?>

      <?php if($cc_info['info_list']['list_info_class']['status']!='hide'){ ?>
      <td align="center" <?php if($i_line%2==0){ ?>bgcolor="#fcfcfc"<?php } ?>>
      <?php
      echo '<a href="index.php?__action='.urlencode($_GET['__action']).'&manage_id='.$manage_id.'&type_id='.$rs['type_id'].'&class_alone_table_name='.$cc_info['class_alone_table_name'].'&info_alone_table_name='.$cc_info['info_alone_table_name'].'" title="查看该类别信息">'.show_type_name($table_name1,$rs['type_id'],'id').'</a>';
      ?>
      </td>
    <?php } ?>

      <?php

      //显示类目扩展栏目 list_info_class
      show_info_extend_column_content($cc_info,$rs,'list_info_class');
      
      ?>

    <?php if($cc_info['info_list']['list_recommend_info']['status']!='hide'){ ?>
      <td align="center" <?php if($i_line%2==0){ ?>bgcolor="#fcfcfc"<?php } ?>>
      <?php
      if ($rs['hot1'] == 1)
      echo '<a href="hot.php?id='.$rs['id'].'&hot1=0&class_alone_table_name='.$cc_info['class_alone_table_name'].'&info_alone_table_name='.$cc_info['info_alone_table_name'].'" title="取消推荐信息" target="'.$tempFrame.'">是</a>';
      else
      echo '<a href="hot.php?id='.$rs['id'].'&hot1=1&class_alone_table_name='.$cc_info['class_alone_table_name'].'&info_alone_table_name='.$cc_info['info_alone_table_name'].'" title="设为推荐信息" target="'.$tempFrame.'">否</a>';
      ?>
      </td>
    <?php } ?>

      <?php

      //显示类目扩展栏目 list_recommend_info
      show_info_extend_column_content($cc_info,$rs,'list_recommend_info');
      
      ?>

    <?php if($cc_info['info_list']['list_thumb']['status']!='hide'){ ?>
      <td align="center" <?php if($i_line%2==0){ ?>bgcolor="#fcfcfc"<?php } ?>>
      <?php
      if ($rs['images1']=="")
      echo '暂无缩略图';
      else
      {
      ?>
      <img src="../../uploadfiles/<?php echo $rs['images1'];?>" width="50">
      <?php } ?></td>
    <?php } ?>

      <?php

      //显示类目扩展栏目 list_thumb
      show_info_extend_column_content($cc_info,$rs,'list_thumb');

      //显示类目扩展栏目 last
      show_info_extend_column_content($cc_info,$rs,'last');
      
      ?>

      <td align="center" <?php if($i_line%2==0){ ?>bgcolor="#fcfcfc"<?php } ?>>
        <?php

        $fgx = false;

        //扩展操作链接 first
        show_info_extend_action($cc_info,$rs,'first',$fgx);

        if($cc_info['info_list']['info_view']['status']!='hide' && check_admin_action("info_view")){
          //if($fgx) echo ' | ';
          $fgx = true;
          echo '<button class="button button_white" onClick="location.href=\'save.php?manage_id='.$manage_id.'&t_action=0002&id='.$rs['id'].'&class_alone_table_name='.$cc_info['class_alone_table_name'].'&info_alone_table_name='.$cc_info['info_alone_table_name'].'&__save_view=1\';return false;">查看</button>';
        }

        //扩展操作链接 info_view
        show_info_extend_action($cc_info,$rs,'info_view',$fgx);

        if($cc_info['info_list']['info_copy']['status']!='hide' && check_admin_action("info_copy")){
          //if($fgx) echo ' | ';
          $fgx = true;
          echo '<button class="button button_white" onClick="location.href=\'save.php?manage_id='.$manage_id.'&t_action=0003&id='.$rs['id'].'&class_alone_table_name='.$cc_info['class_alone_table_name'].'&info_alone_table_name='.$cc_info['info_alone_table_name'].'\';return false;">'.(empty($cc_info['info_list']['info_copy']['title'])?'复制添加':$cc_info['info_list']['info_copy']['title']).'</button>';
        }

        //扩展操作链接 info_copy
        show_info_extend_action($cc_info,$rs,'info_copy',$fgx);

        if($cc_info['info_list']['info_change']['status']!='hide' && check_admin_action("info_change")){
          //if($fgx) echo ' | ';
          $fgx = true;
          echo '<button class="button button_white" onClick="location.href=\'save.php?manage_id='.$manage_id.'&t_action=0002&id='.$rs['id'].'&class_alone_table_name='.$cc_info['class_alone_table_name'].'&info_alone_table_name='.$cc_info['info_alone_table_name'].'\';return false;">'.(empty($cc_info['info_list']['info_change']['title'])?'更改':$cc_info['info_list']['info_change']['title']).'</button>';
        }

        //扩展操作链接 info_change
        show_info_extend_action($cc_info,$rs,'info_change',$fgx);

        if($cc_info['info_list']['info_detete']['status']!='hide' && check_admin_action("info_detete")){
          //if($fgx) echo ' | ';
          $fgx = true;
          echo '<button class="button button_white" onClick="if(del()){ parent.'.$tempFrame.'.location.href=\'delete.php?manage_id='.$manage_id.'&class_alone_table_name='.$cc_info['class_alone_table_name'].'&info_alone_table_name='.$cc_info['info_alone_table_name'].'&id['.$rs['id'].']='.$rs['id'].'\'; } return false;">'.(empty($cc_info['info_list']['info_detete']['title'])?'删除':$cc_info['info_list']['info_detete']['title']).'</button>';
        }

        //扩展操作链接 info_detete
        show_info_extend_action($cc_info,$rs,'info_detete',$fgx);

        //扩展操作链接 last
        show_info_extend_action($cc_info,$rs,'last',$fgx);

        if ($_SESSION['superadmin']){
          if($fgx) echo ' | ';
          $fgx = true;
          echo '<a href="ccset.php?id='.$rs['id'].'&type=info&class_alone_table_name='.$cc_info['class_alone_table_name'].'&info_alone_table_name='.$cc_info['info_alone_table_name'].'">独立控制</a>';
          if(is_file(CC_SAVE_PATH.($cc_info['info_alone_table_name']?"{$cc_info['info_alone_table_name']}_":'').'conf_info_'.$rs['id'].'.ccset')){
            echo '(<a href="ccset.php?id='.$rs['id'].'&type=info&class_alone_table_name='.$cc_info['class_alone_table_name'].'&info_alone_table_name='.$cc_info['info_alone_table_name'].'&del=1" onclick="return confirm(\'确定要解除独立控制吗？\')">解除</a>)';
          }
        }

        ?>
      </td>
      <?php if($cc_info['info_list']['batch_action']['status']!='hide'){ ?>
      <td align="center" <?php if($i_line%2==0){ ?>bgcolor="#fcfcfc"<?php } ?>>
        <input name="id[<?php echo $rs['id'];?>]" type="checkbox" id="id[<?php echo $rs['id'];?>]" value="<?php echo $rs['id'];?>" onClick="unselectall()" class="qbt_danxuan_anniu_bfd" <?php if($alone_cc_info['alone_ccset_info_list']=='yes' && $alone_cc_info['info_list']['batch_action']['status']=='hide'){ ?>disabled="disabled"<?php } ?>></td>
      <?php } ?>
    </tr>

  <?php
    }
  ?>
</table>
<?php if($cc_info['info_list']['class_select']['status']!='hide' || $cc_info['info_list']['batch_action']['status']!='hide'){ ?>
<table width="100%" border="0" cellpadding="9" cellspacing="0" class="qbt_heniwodsk_duzitong">
  <tr>
    <td width="37%" height="45">
      <?php if($cc_info['info_list']['class_select']['status']!='hide'){ ?>
      <strong>类别选择：</strong>
      <select name="jumpMenu_type" id="jumpMenu_type" onChange="MM_jumpMenu('self',this,0)"  class="qbt_buyao_bawo">
          <option value="<?php echo $this_page_name; ?>?__action=<?php echo urlencode($_GET['__action']);?>&manage_id=<?php echo $manage_id; ?><?php if($pcc_info['info_deftype']){ ?>&type_id=<?php echo $pcc_info['info_deftype']; ?><?php } ?>">所有信息</option>
        <?php show_type_jump($table_name1,$manage_id,'',$type_id,'0001',$level_num,$level_num_i); ?>
      </select>
      <?php } ?>
    </td>
    <td width="50%" height="45" align="right">
      <?php
          /* 载入自定义搜索表单 */
          if($cc_info['info_script']['batch_html']['status']=='show' && $cc_info['info_script']['batch_html']['content']!=''){
            if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_batch_html_'.$cc_id.'.php')){
              include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_batch_html_'.$cc_id.'.php';
              $ext_batch_script = CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_batch_php_'.$cc_id.'.php';
            }else{
              if(is_file(CC_SAVE_PATH.'info_script_batch_html_'.$cc_id.'.php')){
                include CC_SAVE_PATH.'info_script_batch_html_'.$cc_id.'.php';
                $ext_batch_script = CC_SAVE_PATH.'info_script_batch_php_'.$cc_id.'.php';
              }
            }
          }else{
        ?>
        <?php if($cc_info['info_list']['batch_action']['status']!='hide' && check_admin_action("info_detete")){ ?><button type="submit" class="button button_blue" name="batch_delete">删除所选</button><?php } ?>
        <?php } ?>
        <input type="hidden" name="ext_batch_script" value="<?php echo $ext_batch_script; ?>" />
    </td>
    <td width="20%" height="45"> <?php if($cc_info['info_list']['batch_action']['status']!='hide'){ ?><span>选中所有</span>      <input name="chkAll" type="checkbox" id="chkAll" value="1" onClick='CheckAll(this.form)' class="qbt_danxuan_anniu_bfdd"><?php } ?></td>
    </tr>
</table>
<?php } ?>
  </form>
  <?php
  if($cc_info['info_list']['page_action']['status']!='hide'){
    $goto_href = '';
    if($_GET){
      foreach ($_GET as $key => $value) {
        if(in_array($key, array('page','class_alone_table_name','info_alone_table_name'))) continue;
        $goto_href .= (empty($goto_href)?'?':'&').$key.'='.urlencode($value);
      }
    }
    $goto_href .= (empty($goto_href)?'?':'&')."class_alone_table_name={$cc_info['class_alone_table_name']}&info_alone_table_name={$cc_info['info_alone_table_name']}&page=";
  ?>

    <div id="example_paginate" class="dataTables_paginate paging_full_numbers"><span id="example_first" class="qbt_gongjilup">共记录：<?php echo $t_size;?>篇</span> 页次：<?php echo $page;?>/<?php echo $total;?>　

      <?php if ($page!=1) { ?>

      <span id="example_previous" class="previous paginate_button" onclick="location.href='<?php echo $goto_href.($page-1);?>'">上一页</span>

      <?php }else{ ?>

      <span id="example_previous" class="previous paginate_button paginate_button_disabled">上一页</span>

      <?php } ?>

      <?php if ($page!=$total && $total>0) { ?>

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
  <?php } ?>
</div>
</div>
<script type="text/javascript">
<?php
/* 载入自定义JS脚本 */
if($cc_info['info_script']['list_js']['status']=='show' && $cc_info['info_script']['list_js']['content']!=''){
  if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_list_js_'.$cc_id.'.php')){
    include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_list_js_'.$cc_id.'.php';
  }else{
    if(is_file(CC_SAVE_PATH.'info_script_list_js_'.$cc_id.'.php')){
      include CC_SAVE_PATH.'info_script_list_js_'.$cc_id.'.php';
    }
  }
}
?>
</script>
</body>
</html>