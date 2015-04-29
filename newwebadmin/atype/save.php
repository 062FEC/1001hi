<?php
  include('../includes/php_conn.php');
  include('../includes/check.php');
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
  unset($cc_info['menu']);
}

if ($t_action=='0001' || $t_action=='0003'){
  //加载信息添加前的脚本
  if($cc_info['info_script']['add_top']['status']=='show' && $cc_info['info_script']['add_top']['content']!=''){
    if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_add_top_'.$cc_id.'.php')){
      include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_add_top_'.$cc_id.'.php';
    }
  }
}elseif($t_action=='0002'){
  //加载信息修改前的脚本
  if($cc_info['info_script']['edit_top']['status']=='show' && $cc_info['info_script']['edit_top']['content']!=''){
    if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_edit_top_'.$cc_id.'.php')){
      include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_edit_top_'.$cc_id.'.php';
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

check_type_is_exist($table_name1,$manage_id);
$get_p_url = $_COOKIE['atype_info'];
$level_num_i=1;
$id=trim(rp($_REQUEST['id']));
$cn_name=trim(rp($_REQUEST['cn_name']));
$en_name=trim(rp($_REQUEST['en_name']));
$cn_title=trim(rp($_REQUEST['cn_title']));
$en_title=trim(rp($_REQUEST['en_title']));
$cn_keywords=trim(rp($_REQUEST['cn_keywords']));
$en_keywords=trim(rp($_REQUEST['en_keywords']));
$cn_description=trim(rp($_REQUEST['cn_description']));
$en_description=trim(rp($_REQUEST['en_description']));
$images1 = rp($_REQUEST['images1']);
$images2 = rp($_REQUEST['images2']);
$old_cn_name=trim(rp($_REQUEST['old_cn_name']));
$old_en_name=trim(rp($_REQUEST['old_en_name']));
$old_type_id=trim(rp($_REQUEST['old_type_id']));
$num=trim(rp($_REQUEST['num']));
$date1=trim(rp($_REQUEST['date1']));
$cn_content=$_REQUEST['cn_content'];
$en_content=$_REQUEST['en_content'];
$cn_content = rp_content($cn_content);
$en_content = rp_content($en_content);
$hot1=$_REQUEST['hot1'];
$hot1 = intval($hot1);

if ($t_action=='0002'){
  check_id($id,1);

  //需要检测是否删除文件的字段
  $__check_del_file_arr = array('images1','images2');
  $__old_info = mysql_fetch_assoc(mysql_query("SELECT * FROM `{$table_name2}` WHERE `id`='{$id}'"));
}

if ($action=='save')
{
  //加载分类控制设置
  $_set=false;
  if(is_file(CC_SAVE_PATH.($_REQUEST['class_alone_table_name']?"{$_REQUEST['class_alone_table_name']}_":'').'conf_'.$type_id.'.ccset')){
    $cc_info = unserialize(file_get_contents(CC_SAVE_PATH.($_REQUEST['class_alone_table_name']?"{$_REQUEST['class_alone_table_name']}_":'').'conf_'.$type_id.'.ccset'));
  }

  //加载分类独立控制设置
  if(is_file(CC_SAVE_PATH.($_REQUEST['class_alone_table_name']?"{$_REQUEST['class_alone_table_name']}_":'').'conf_class_info_'.$type_id.'.ccset')){
    $_temp = unserialize(file_get_contents(CC_SAVE_PATH.($_REQUEST['class_alone_table_name']?"{$_REQUEST['class_alone_table_name']}_":'').'conf_class_info_'.$type_id.'.ccset'));
    $cc_info['class_info'] = $_temp['class_info'];
    $cc_info['class_extend_field'] = $_temp['class_extend_field'];
  }

  //加载信息独立控制设置
  if($id){
    if(is_file(CC_SAVE_PATH.($_REQUEST['info_alone_table_name']?"{$_REQUEST['info_alone_table_name']}_":'').'conf_info_'.$id.'.ccset')){
      $_temp = unserialize(file_get_contents(CC_SAVE_PATH.($_REQUEST['info_alone_table_name']?"{$_REQUEST['info_alone_table_name']}_":'').'conf_info_'.$id.'.ccset'));
      if($_temp['alone_ccset_info']=='yes')  $cc_info['info'] = $_temp['info'];
      if($_temp['alone_ccset_info_extend_field']=='yes')$cc_info['info_extend_field'] = $_temp['info_extend_field'];
    }
  }

  if($table_name2=='atype_info') check_drop('c_int',$type_id,($cc_info['info']['info_class']['title']?$cc_info['info']['info_class']['title']:'所属分类'),'',$go_to_num,'type_id','','','','','','','','','');
  if($table_name2=='atype_info') check_drop('c_int',$num,($cc_info['info']['info_order']['title']?$cc_info['info']['info_order']['title']:'排列序号'),'',$go_to_num,'num','','','','','','','','','');
  if($table_name2=='atype_info') check_drop('c_datetime',$date1,($cc_info['info']['save_date']['title']?$cc_info['info']['save_date']['title']:'录入日期'),'',$go_to_num,'date1','','','','','','','','','');
  if($table_name2=='atype_info') check_drop('c_str',$cn_name,($cc_info['info']['cn_info_name']['title']?$cc_info['info']['cn_info_name']['title']:'信息名称').$bb_cn_show,'',$go_to_num,'cn_name','','','','','','','','','');
  if($table_name2=='atype_info') check_drop('c_bit',$hot1,($cc_info['info']['info_recommend']['title']?$cc_info['info']['info_recommend']['title']:'设为推荐信息'),'',$go_to_num,'hot1','','','','','','','','','');

  //扩展字段处理
  $_extend_fields = array();

  $unique_where_sql = " AND `type_id`='{$type_id}'";
  if($id) $unique_where_sql = " AND `id`!='{$id}'";

  if($cc_info['info_extend_field']){
    foreach($cc_info['info_extend_field'] as $_key=>$_value){
      //if($_value['status']=='show'){
        $_varname = "extend_field_{$type_id}_{$_value['pos']}_{$_value['field']}";
        if(isset($_REQUEST[$_varname])){
          if(is_array($_REQUEST[$_varname])){
            $_varvalue = array();
            foreach($_REQUEST[$_varname] as $_key2=>$_value2){
              $_varvalue[$_key2] = trim($_value2);
            }
          }else{
            $_varvalue = trim($_REQUEST[$_varname]);
            if($_value['type']=='int' && $_REQUEST[$_varname]===''){
              $_varvalue = $_value['defval']?$_value['defval']:'0';
            }
          }
        }else{
          $_varvalue = $_value['defval'];
        }

        //必填检测
        if($_value['check']=='yes' && ($t_action!='0002' || $_value['type']!='password_md5')) check_drop('c_str',$_varvalue,$_value['title'],'',$go_to_num,$_varname,'','','','','','','','','');

        $_extend_fields['field'][$_key] = $_value['field'];
        $_extend_fields['type'][$_key] = $_value['type'];
        if($_value['type']=='checkbox') $_varvalue = '||'.implode('||', $_varvalue).'||';

        //重复检测
        if($_value['unique']=='yes' && $_varvalue){
          if(mysql_num_rows(mysql_query("SELECT * FROM `{$table_name2}` WHERE `{$_value['field']}`='{$_varvalue}' {$unique_where_sql}"))>0){
            show_msg("【{$_value['title']}】已存在");
          }
        }
        
        $_extend_fields['value'][$_key] = $_varvalue;
      //}
    }
  }

    if ($t_action=='0001' || $t_action=='0003')
    {
        if($table_name2=='atype_info') check_one_type_is_exist($table_name2,'cn_name',$cn_name,'type_id',$type_id,($cc_info['info']['cn_info_name']['title']?$cc_info['info']['cn_info_name']['title']:'所属类别的信息名称').$bb_cn_show.'《'.$_REQUEST['cn_name'].'》已经存在，请使用其他数据名称！',$go_to_num,'','cn_name','','','','','','','','','');
            
        if ($bb_en == '001') {
            if($table_name2=='atype_info') check_drop('c_str',$en_name,'信息名称'.$bb_en_show,'','','en_name','','','','','','','','','');
            if($table_name2=='atype_info') check_one_type_is_exist($table_name2,'en_name',$en_name,'type_id',$type_id,($cc_info['info']['en_info_name']['title']?$cc_info['info']['en_info_name']['title']:'所属类别的信息名称').$bb_en_show.'《'.$_REQUEST['en_name'].'》已经存在，请使用其他数据名称！',$go_to_num,'','en_name','','','','','','','','','');
        }
        
        $sql='insert into `'.$table_name2.'` ( ';

        //过滤默认字段
        if(!check_default_field_in_extend_field($_extend_fields, 'type_id'))        $sql.='`type_id`,';
        if(!check_default_field_in_extend_field($_extend_fields, 'num'))            $sql.='`num`,';
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_name'))        $sql.='`cn_name`,';
        if(!check_default_field_in_extend_field($_extend_fields, 'en_name'))        $sql.='`en_name`,';
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_title'))       $sql.='`cn_title`,';
        if(!check_default_field_in_extend_field($_extend_fields, 'en_title'))       $sql.='`en_title`,';
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_keywords'))    $sql.='`cn_keywords`,';
        if(!check_default_field_in_extend_field($_extend_fields, 'en_keywords'))    $sql.='`en_keywords`,';
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_description')) $sql.='`cn_description`,';
        if(!check_default_field_in_extend_field($_extend_fields, 'en_description')) $sql.='`en_description`,';
        if(!check_default_field_in_extend_field($_extend_fields, 'images1'))        $sql.='`images1`,';
        if(!check_default_field_in_extend_field($_extend_fields, 'images2'))        $sql.='`images2`,';
        if(!check_default_field_in_extend_field($_extend_fields, 'date1'))          $sql.='`date1`,';
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_content'))     $sql.='`cn_content`,';
        if(!check_default_field_in_extend_field($_extend_fields, 'en_content'))     $sql.='`en_content`,';
        if(!check_default_field_in_extend_field($_extend_fields, 'hot1'))           $sql.='`hot1`,';

    //自定义字段处理
    if(!empty($_extend_fields['field'])){
      foreach($_extend_fields['field'] as $_key=>$_value){
        if($_extend_fields['type'][$_key]=='password_md5'){
          if(!empty($_extend_fields['value'][$_key])){
            $sql.="`{$_value}`,";
          }
        }else{
          $sql.="`{$_value}`,";
        }
      }
    }

        //多管理员
        $sql.='`admin_id`';

    substr($sql, -1)==',' && $sql=substr($sql,0,-1);
    $sql.=') values (';

    //过滤默认字段
        if(!check_default_field_in_extend_field($_extend_fields, 'type_id'))        $sql.="'".mysql_real_escape_string($type_id)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'num'))            $sql.="'".mysql_real_escape_string($num)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_name'))        $sql.="'".mysql_real_escape_string($cn_name)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'en_name'))        $sql.="'".mysql_real_escape_string($en_name)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_title'))       $sql.="'".mysql_real_escape_string($cn_title)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'en_title'))       $sql.="'".mysql_real_escape_string($en_title)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_keywords'))    $sql.="'".mysql_real_escape_string($cn_keywords)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'en_keywords'))    $sql.="'".mysql_real_escape_string($en_keywords)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_description')) $sql.="'".mysql_real_escape_string($cn_description)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'en_description')) $sql.="'".mysql_real_escape_string($en_description)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'images1'))        $sql.="'".mysql_real_escape_string($images1)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'images2'))        $sql.="'".mysql_real_escape_string($images2)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'date1'))          $sql.="'".mysql_real_escape_string($date1)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_content'))     $sql.="'".mysql_real_escape_string($cn_content)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'en_content'))     $sql.="'".mysql_real_escape_string($en_content)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'hot1'))     $sql.="'".mysql_real_escape_string($hot1)."',";

    //自定义字段处理
    if(!empty($_extend_fields['field'])){
      foreach($_extend_fields['field'] as $_key=>$_value){
        if($_extend_fields['type'][$_key]=='password_md5'){
          if(!empty($_extend_fields['value'][$_key])){
            $sql.="'".mysql_real_escape_string(md5($_extend_fields['value'][$_key]))."',";
          }
        }elseif($_extend_fields['type'][$_key]=='rtext'){
          $sql.="'".mysql_real_escape_string(rp_content($_extend_fields['value'][$_key]))."',";
        }else{
          $sql.="'".mysql_real_escape_string($_extend_fields['value'][$_key])."',";
        }
      }
    }

        $sql .="'{$a_user_id}'";

    substr($sql, -1)==',' && $sql=substr($sql,0,-1);
        $sql.=')';

        mysql_query($sql,$conn);
        is_err(3,'');

        $id=mysql_insert_id();

    //复制添加，复制独立控制
    if($t_action=='0003' && is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?$cc_info['class_alone_table_name'].'_':'').'conf_info_'.$_POST['id'].'.ccset')){
        $copycc = file_get_contents(CC_SAVE_PATH.($cc_info['class_alone_table_name']?$cc_info['class_alone_table_name'].'_':'').'conf_info_'.$_POST['id'].'.ccset');
        file_put_contents(CC_SAVE_PATH.($cc_info['class_alone_table_name']?$cc_info['class_alone_table_name'].'_':'').'conf_info_'.$id.'.ccset', $copycc);
        $_REQUEST['cc'] = unserialize($copycc);
        include 'ccaction.php';
    }

    //加载信息添加后的脚本
    if($cc_info['info_script']['add_bottom']['status']=='show' && $cc_info['info_script']['add_bottom']['content']!=''){
      if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_add_bottom_'.$type_id.'.php')){
        include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_add_bottom_'.$type_id.'.php';
      }
    }

        show_msg_ok('资料信息已成功保存！',4,'save.php?manage_id='.$manage_id.'&t_action=0001&type_id='.$type_id.'&class_alone_table_name='.$_POST['class_alone_table_name'].'&info_alone_table_name='.$_POST['info_alone_table_name']);
        //show_msg_ok('资料信息已成功保存！',4, $get_p_url);
    }
    elseif ($t_action=='0002')
    {
        $oldinfo = mysql_fetch_assoc(mysql_query("SELECT * FROM `{$table_name2}` WHERE `id`='{$id}'"));

        if (str_to_lower_num($cn_name) != str_to_lower_num($old_cn_name) || $type_id != $old_type_id)
        {
            check_one_type_is_exist($table_name2,'cn_name',$cn_name,'type_id',$type_id,($cc_info['info']['cn_info_name']['title']?$cc_info['info']['cn_info_name']['title']:'所属类别的信息名称').$bb_cn_show.'《'.$_REQUEST['cn_name'].'》已经存在，请使用其他数据名称！',$go_to_num,'','cn_name','','','','','','','','','');
        }
        
        if ($bb_en == '001') {
            check_drop('c_str',$en_name,'信息名称'.$bb_en_show,'',$go_to_num,'en_name','','','','','','','','','');
            if (str_to_lower_num($en_name) != str_to_lower_num($old_en_name) || $type_id != $old_type_id)
            {
                check_one_type_is_exist($table_name2,'en_name',$en_name,'type_id',$type_id,($cc_info['info']['en_info_name']['title']?$cc_info['info']['en_info_name']['title']:'所属类别的信息名称').$bb_en_show.'《'.$_REQUEST['en_name'].'》已经存在，请使用其他数据名称！',$go_to_num,'','en_name','','','','','','','','','');
            }
        }
        
        $sql='update `'.$table_name2.'` set ';

        //过滤默认字段
        if(!check_default_field_in_extend_field($_extend_fields, 'type_id'))        $sql.="`type_id`='".mysql_real_escape_string($type_id)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'num'))            $sql.="`num`='".mysql_real_escape_string($num)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_name'))        $sql.="`cn_name`='".mysql_real_escape_string($cn_name)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'en_name'))        $sql.="`en_name`='".mysql_real_escape_string($en_name)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_title'))       $sql.="`cn_title`='".mysql_real_escape_string($cn_title)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'en_title'))       $sql.="`en_title`='".mysql_real_escape_string($en_title)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_keywords'))    $sql.="`cn_keywords`='".mysql_real_escape_string($cn_keywords)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'en_keywords'))    $sql.="`en_keywords`='".mysql_real_escape_string($en_keywords)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_description')) $sql.="`cn_description`='".mysql_real_escape_string($cn_description)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'en_description')) $sql.="`en_description`='".mysql_real_escape_string($en_description)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'images1'))        $sql.="`images1`='".mysql_real_escape_string($images1)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'images2'))        $sql.="`images2`='".mysql_real_escape_string($images2)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'date1'))          $sql.="`date1`='".mysql_real_escape_string($date1)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_content'))     $sql.="`cn_content`='".mysql_real_escape_string($cn_content)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'en_content'))     $sql.="`en_content`='".mysql_real_escape_string($en_content)."',";

        //自定义字段处理
        if(!empty($_extend_fields['field'])){
          foreach($_extend_fields['field'] as $_key=>$_value){
            if($_extend_fields['type'][$_key]=='password_md5'){
              if(!empty($_extend_fields['value'][$_key])){
                $sql.="`{$_value}`='".mysql_real_escape_string(md5($_extend_fields['value'][$_key]))."',";
              }
            }elseif($_extend_fields['type'][$_key]=='rtext'){
              $sql.="`{$_value}`='".mysql_real_escape_string(rp_content($_extend_fields['value'][$_key]))."',";
            }else{
              $sql.="`{$_value}`='".mysql_real_escape_string($_extend_fields['value'][$_key])."',";
            }
          }
        }

        if(!check_default_field_in_extend_field($_extend_fields, 'hot1')) $sql.="`hot1`='".mysql_real_escape_string($hot1)."'";
        substr($sql, -1)==',' && $sql=substr($sql,0,-1);
        $sql.=' where id='.$id;

        mysql_query($sql,$conn) or die(mysql_error());
        is_err(3,'');

        //删除过期上传文件
        if ($t_action=='0002'){
          $__new_info = mysql_fetch_assoc(mysql_query("SELECT * FROM `{$table_name2}` WHERE `id`='{$id}'"));
          foreach($__check_del_file_arr as $__val){
              if($__old_info[$__val]!=$__new_info[$__val]){
                if(mysql_num_rows(mysql_query("SELECT * FROM `{$table_name2}` WHERE `{$__val}`='{$__old_info[$__val]}'"))<1){
                  @unlink(dirname(__FILE__).'/../../uploadfiles/'.$__old_info[$__val]);
                }
              }
          }
        }

        //加载信息修改后的脚本
        if($cc_info['info_script']['edit_bottom']['status']=='show' && $cc_info['info_script']['edit_bottom']['content']!=''){
          if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_edit_bottom_'.$type_id.'.php')){
            include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_edit_bottom_'.$type_id.'.php';
          }
        }

        show_msg_ok('资料信息已成功保存！',4,($_POST['refurl']?$_POST['refurl']:$get_p_url));
    }

}
if (($t_action=='0002' || $t_action=='0003') && $id)
{
$sql='select * from `'.$table_name2.'` where `id`=\''.$id."'";
$result=mysql_query($sql,$conn);
check_rs($result,1);
$rs=mysql_fetch_array($result);
$num=$rs['num'];
$cn_name=$rs['cn_name'];
$en_name=$rs['en_name'];
$cn_title=$rs['cn_title'];
$en_title=$rs['en_title'];
$cn_keywords=$rs['cn_keywords'];
$en_keywords=$rs['en_keywords'];
$cn_description=$rs['cn_description'];
$en_description=$rs['en_description'];
$images1 = $rs['images1'];
$images2 = $rs['images2'];
$date1=show_date($rs['date1'],'Y-m-d H:i:s');
$cn_content=$rs['cn_content'];
$en_content=$rs['en_content'];
$type_id=$rs['type_id'];
$hot1 = $rs['hot1'];
    if ($t_action=='0003')
    {
    $num=show_table_num($table_name1,$table_name2);
    }
}
else
{
$num=show_table_num($table_name1,$table_name2);
$date1=date('Y-m-d H:i:s');
}


$cc_info = array();
if ($t_action!='0001'){

  //加载分类控制设置
  if(is_file(CC_SAVE_PATH.($_REQUEST['class_alone_table_name']?"{$_REQUEST['class_alone_table_name']}_":'').'conf_'.$type_id.'.ccset')){
    $cc_info = unserialize(file_get_contents(CC_SAVE_PATH.($_REQUEST['class_alone_table_name']?"{$_REQUEST['class_alone_table_name']}_":'').'conf_'.$type_id.'.ccset'));
  }

  unset($cc_info['menu']);

  //加载分类独立控制设置
  if(is_file(CC_SAVE_PATH.($_REQUEST['class_alone_table_name']?"{$_REQUEST['class_alone_table_name']}_":'').'conf_class_info_'.$type_id.'.ccset')){
    $_temp = unserialize(file_get_contents(CC_SAVE_PATH.($_REQUEST['class_alone_table_name']?"{$_REQUEST['class_alone_table_name']}_":'').'conf_class_info_'.$type_id.'.ccset'));
    if($_temp['alone_ccset_class_info']=='yes') $cc_info['class_info'] = $_temp['class_info'];
    if($_temp['alone_ccset_class_extend_field']=='yes') $cc_info['class_extend_field'] = $_temp['class_extend_field'];
  }

  //加载信息控制设置
  if(is_file(CC_SAVE_PATH.($_REQUEST['info_alone_table_name']?"{$_REQUEST['info_alone_table_name']}_":'').'conf_info_'.$id.'.ccset')){
    $_temp = unserialize(file_get_contents(CC_SAVE_PATH.($_REQUEST['info_alone_table_name']?"{$_REQUEST['info_alone_table_name']}_":'').'conf_info_'.$id.'.ccset'));
    if($_temp['alone_ccset_info']=='yes') $cc_info['info'] = $_temp['info'];
    if($_temp['alone_ccset_info_extend_field']=='yes') $cc_info['info_extend_field'] = $_temp['info_extend_field'];
  }
}

//自定义变量调用
if($cc_info['info_extend_field']){
  foreach($cc_info['info_extend_field'] as $_key=>$_value){
    $_varname = "extend_field_{$type_id}_{$_value['pos']}_{$_value['field']}";
    $$_varname = $rs[$_value['field']];
    $_REQUEST[$_value['field']] = $rs[$_value['field']];
  }
}

/* 加载父级控制设置 */
$selcc_info[$manage_id] = array();
if(is_file(CC_SAVE_PATH.($_REQUEST['class_alone_table_name']?"{$_REQUEST['class_alone_table_name']}_":'').'conf_'.$manage_id.'.ccset')){
  $selcc_info[$manage_id] = unserialize(file_get_contents(CC_SAVE_PATH.'conf_'.$manage_id.'.ccset'));
}
if(is_file(CC_SAVE_PATH.($_REQUEST['class_alone_table_name']?"{$_REQUEST['class_alone_table_name']}_":'').'conf_class_info_'.$manage_id.'.ccset')){
  $selcc_info[$manage_id] = unserialize(file_get_contents(CC_SAVE_PATH.'conf_class_info_'.$manage_id.'.ccset'));
}

//加载可选分类控制
load_type_cc($table_name1,$manage_id,'',$type_id,'0001',$level_num,$level_num_i);

//修改时候，存在独立控制则去掉其他
if($t_action!='0001' && is_file(CC_SAVE_PATH.($_REQUEST['info_alone_table_name']?"{$_REQUEST['info_alone_table_name']}_":'').'conf_info_'.$id.'.ccset')){
  foreach($selcc_info as $_key=>$_value){
    $selcc_info[$_key]['info'] = $cc_info['info'];
    $selcc_info[$_key]['info_extend_field'] = $cc_info['info_extend_field'];
  }
}

$newfield = array();
if($selcc_info){
  foreach($selcc_info as $_key=>$_value){
    $_value['info_extend_field'] = array_sort($_value['info_extend_field'],'order','asc');
    if($_value['info_extend_field']){
      foreach($_value['info_extend_field'] as $_key2=>$_value2){
        $_value2['type_id'] = $_key;
        $newfield[$_value2['pos']][$_key.'|'.$_value2['field']] = $_value2;
      }
    }
  }
}

?>
<script type="text/javascript" charset="utf-8" src="../../editor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="../../editor/ueditor.all.min.js"></script>
<script type="text/javascript" charset="utf-8" src="../../editor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" charset="utf-8" src="../js/jquery.js"></script>
<script language="javascript">
function check(){
    if (confirm("确定保存所填信息？")){
      is_form_submited = true;
      return true;
    }else{
      return false;
    }
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

<body style="background:#eee; padding:20px 20px 40px 9px;">
<div class="qbt_nidelikai">
<div class="qbt_shujuguanli">
<span><?php if($_GET['__save_view']){ ?>查看<?php }else{ ?><?php echo $show_a;?><?php } ?>数据</span></div>
<div class="qbt_omnissguai">
  <?php if(!$_GET['__save_view']){ ?>
  <form name="save_form" method="post" action="save.php" target="<?php echo $tempFrame;?>" onSubmit="return check()">
  <?php } ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="9" bgcolor="#ffffff" class="qbt_heniwodsk">
        <?php if($newfield['top']) foreach($newfield['top'] as $_field){ insert_extend_field_box($_field); } ?>
        <tr style="<?php if($selcc_info[$manage_id]['info']['info_class']['status']=='hide') echo 'display:none;'; ?>">
          <td width="16%" align="right" bgcolor="#FFFFFF"><?php if($selcc_info[$manage_id]['info']['info_class']['title']!=''){ echo $selcc_info[$manage_id]['info']['info_class']['title']; }else{ echo '信息类别选择：'; }?></td>
          <td width="84%" bgcolor="#FFFFFF"><select name="type_id" id="type_id" onchange="ccsel(this.value)" class="qbt_buyao_bawo_mjj">
            <?php show_type($table_name1,$manage_id,'',$type_id,'0001',$level_num,$level_num_i); ?>
          </select>
          </td>
        </tr>
        <?php if($newfield['type_id']) foreach($newfield['type_id'] as $_field){ insert_extend_field_box($_field); } ?>
        <tr id="page_info_order_box">
          <td width="16%" align="right" bgcolor="#FFFFFF"><span id="page_info_order_txt">排列序号</span>：</td>
          <td width="84%" bgcolor="#FFFFFF"><input name="num" type="text" id="num" value="<?php echo $num;?>" class="qbt_syzsf" <?php echo show_m('','','','',''); ?>></td>
        </tr>
        <?php if($newfield['num']) foreach($newfield['num'] as $_field){ insert_extend_field_box($_field); } ?>
        <tr id="page_cn_info_name_box">
          <td width="16%" align="right" bgcolor="#FFFFFF"><span id="page_cn_info_name_txt">信息名称<?php echo $bb_cn_show;?></span>：</td>
          <td width="84%" bgcolor="#FFFFFF"><input name="cn_name" type="text" id="cn_name" value="<?php echo $cn_name;?>" class="qbt_syzsf" <?php echo show_m('','','','',''); ?>></td>
        </tr>
        <?php if($newfield['cn_name']) foreach($newfield['cn_name'] as $_field){ insert_extend_field_box($_field); } ?>
        <?php if ($bb_en == '001') { ?>
        <tr id="page_en_info_name_box">
          <td width="16%" align="right" bgcolor="#FFFFFF"><span id="page_en_info_name_txt">信息名称<?php echo $bb_en_show;?></span>：</td>
          <td width="84%" bgcolor="#FFFFFF"><input name="en_name" type="text" id="en_name" value="<?php echo $en_name;?>" class="qbt_syzsf" <?php echo show_m('','','','',''); ?>></td>
        </tr>
        <?php } ?>
        <?php if($newfield['en_name']) foreach($newfield['en_name'] as $_field){ insert_extend_field_box($_field); } ?>
        <tr id="page_save_date_box">
          <td width="16%" align="right" bgcolor="#FFFFFF"><span id="page_save_date_txt">录入日期</span>：</td>
          <td width="84%" bgcolor="#FFFFFF"><input name="date1" type="text" id="date1" value="<?php echo $date1;?>" class="qbt_syzsf" <?php echo show_m('','','','',''); ?>></td>
        </tr>
        <?php if($newfield['date1']) foreach($newfield['date1'] as $_field){ insert_extend_field_box($_field); } ?>
        <tr id="page_cn_info_title_box">
          <td width="16%" align="right" bgcolor="#FFFFFF"><span id="page_cn_info_title_txt">标　　题<?php echo $bb_cn_show;?></span>：</td>
          <td height="20"><input name="cn_title" type="text" id="cn_title" value="<?php echo $cn_title;?>" class="qbt_syzsf"></td>
        </tr>
        <?php if($newfield['cn_title']) foreach($newfield['cn_title'] as $_field){ insert_extend_field_box($_field); } ?>
        <?php if ($bb_en == '001') { ?>
        <tr id="page_en_info_title_box">
          <td width="16%" align="right" bgcolor="#FFFFFF"><span id="page_en_info_title_txt">标　　题<?php echo $bb_en_show;?></span>：</td>
          <td height="20"><input name="en_title" type="text" id="en_title" value="<?php echo $en_title;?>" class="qbt_syzsf"></td>
        </tr>
        <?php } ?>
        <?php if($newfield['en_title']) foreach($newfield['en_title'] as $_field){ insert_extend_field_box($_field); } ?>
        <tr id="page_cn_info_keyword_box">
          <td width="16%" align="right" bgcolor="#FFFFFF"><span id="page_cn_info_keyword_txt">关 键 词<?php echo $bb_cn_show;?></span>：</td>
          <td height="20"><input name="cn_keywords" type="text" id="cn_keywords" value="<?php echo $cn_keywords;?>" class="qbt_syzsf"></td>
        </tr>
        <?php if($newfield['cn_keywords']) foreach($newfield['cn_keywords'] as $_field){ insert_extend_field_box($_field); } ?>
        <?php if ($bb_en == '001') { ?>
        <tr id="page_en_info_keyword_box">
          <td width="16%" align="right" bgcolor="#FFFFFF"><span id="page_en_info_keyword_txt">关 键 词<?php echo $bb_en_show;?></span>：</td>
          <td height="20"><input name="en_keywords" type="text" id="en_keywords" value="<?php echo $en_keywords;?>" class="qbt_syzsf"></td>
        </tr>
        <?php } ?>
        <?php if($newfield['en_keywords']) foreach($newfield['en_keywords'] as $_field){ insert_extend_field_box($_field); } ?>
        <tr id="page_cn_info_description_box">
          <td width="16%" align="right" bgcolor="#FFFFFF"><span id="page_cn_info_description_txt">描　　述<?php echo $bb_cn_show;?></span>：</td>
          <td height="20"><textarea name="cn_description" rows="5" class="qbt_syzsff" id="cn_description"><?php echo $cn_description;?></textarea></td>
        </tr>
        <?php if($newfield['cn_description']) foreach($newfield['cn_description'] as $_field){ insert_extend_field_box($_field); } ?>
        <?php if ($bb_en == '001') { ?>
        <tr id="page_en_info_description_box">
          <td width="16%" align="right" bgcolor="#FFFFFF"><span id="page_en_info_description_txt">描　　述<?php echo $bb_en_show;?></span>：</td>
          <td height="20"><textarea name="en_description" rows="5" class="qbt_syzsff" id="en_description"><?php echo $en_description;?></textarea></td>
        </tr>
        <?php } ?>
        <?php if($newfield['en_description']) foreach($newfield['en_description'] as $_field){ insert_extend_field_box($_field); } ?>
        <tr id="page_info_simg_box">
          <td width="16%" align="right" bgcolor="#FFFFFF"><span id="page_info_simg_txt">信息小图片</span>：</td>
          <td width="84%" bgcolor="#FFFFFF"><input name="images1" type="text" id="images1" value="<?php echo $images1;?>" class="qbt_syzsf">
              <input name="shang" type="button"  class="button button_huise" id="shang" onClick="open_upload('images1','','')" value="上传"> <a href="javascript:;" target="_blank" onmouseover="if($('#images1').val().length>0){ this.href='../../uploadfiles/'+$('#images1').val(); }else{ this.href='javascript:;'; }">预览</a>
          </td>
        </tr>
        <?php if($newfield['images1']) foreach($newfield['images1'] as $_field){ insert_extend_field_box($_field); } ?>
        <tr id="page_info_bimg_box">
          <td width="120" align="right"><span id="page_info_bimg_txt">信息大图片</span>：</td>
          <td width="84%" bgcolor="#FFFFFF"><input name="images2" type="text" id="images2" value="<?php echo $images2;?>" class="qbt_syzsf">
          <input name="shang" type="button"  class="button button_huise" id="shang" onClick="open_upload('images2','','')" value="上传">  <a href="javascript:;" target="_blank" onmouseover="if($('#images2').val().length>0){ this.href='../../uploadfiles/'+$('#images2').val(); }else{ this.href='javascript:;'; }">预览</a></td>
        </tr>
        <?php if($newfield['images2']) foreach($newfield['images2'] as $_field){ insert_extend_field_box($_field); } ?>
        <tr id="page_cn_info_content_box">
          <td width="16%" align="right" bgcolor="#FFFFFF"><span id="page_cn_info_content_txt">信息说明<?php echo $bb_cn_show;?></span>：</td>
          <td width="84%" bgcolor="#FFFFFF">
          <script type="text/plain" id="cn_content" name="cn_content"><?php echo $cn_content; ?></script>
          <script type="text/javascript">
              UE.getEditor('cn_content');
          </script>
          </td>
        </tr>
        <?php if($newfield['cn_content']) foreach($newfield['cn_content'] as $_field){ insert_extend_field_box($_field); } ?>
        <?php if ($bb_en == '001') { ?>
        <tr id="page_en_info_content_box">
          <td width="16%" align="right" bgcolor="#FFFFFF"><span id="page_en_info_content_txt">信息说明<?php echo $bb_en_show;?></span>：</td>
          <td width="84%" bgcolor="#FFFFFF">
          <script type="text/plain" id="en_content" name="en_content"><?php echo $en_content; ?></script>
          <script type="text/javascript">
             UE.getEditor('en_content');
        </script>
          </td>
        </tr>
        <?php if($newfield['en_content']) foreach($newfield['en_content'] as $_field){ insert_extend_field_box($_field); } ?>
        <?php } ?>
        <tr id="page_info_recommend_box">
          <td width="16%" align="right" bgcolor="#FFFFFF"><span id="page_info_recommend_txt">设为推荐信息</span>：</td>
          <td width="84%" bgcolor="#FFFFFF"><input type="radio" name="hot1" value="1" <?php if($hot1 == 1) echo 'checked';?>>
        是
          <input name="hot1" type="radio" value="0" <?php if($hot1 != 1) echo 'checked';?>>
        否    </td>
        </tr>
        <?php if($newfield['hot1']) foreach($newfield['hot1'] as $_field){ insert_extend_field_box($_field); } ?>
        <?php if($newfield['bottom']) foreach($newfield['bottom'] as $_field){ insert_extend_field_box($_field); } ?>
    </table>
    <div class="qbt_guding_bottom"><button class="button button_blue" type="submit">保存</button>&nbsp;<button class="button button_white" type="reset">重置</button></div>
    <input name="id" type="hidden" id="id" value="<?php echo $id;?>">
    <?php if($t_action=='0002'){ ?>
    <input name="refurl" type="hidden" id="refurl" value="<?php echo $_SERVER['HTTP_REFERER']; ?>">
    <?php } ?>
    <input name="action" type="hidden" id="action" value="save">
    <input name="t_action" type="hidden" id="t_action" value="<?php echo $t_action;?>">
    <input name="f_value" type="hidden" id="f_value" value="<?php echo $f_value;?>">
    <input name="old_cn_name" type="hidden" id="old_cn_name" value="<?php echo $cn_name;?>">
    <input name="old_en_name" type="hidden" id="old_en_name" value="<?php echo $en_name;?>">
    <input name="old_type_id" type="hidden" id="old_type_id" value="<?php echo $type_id;?>">
    <input name="manage_id" type="hidden" id="manage_id" value="<?php echo $manage_id;?>">
    <input name="old_class_alone_table_name" type="hidden" id="old_class_alone_table_name" value="<?php echo $_REQUEST['class_alone_table_name']; ?>">
    <input name="old_info_alone_table_name" type="hidden" id="old_info_alone_table_name" value="<?php echo $_REQUEST['info_alone_table_name']; ?>">
    <input type="hidden" id="class_alone_table_name" name="class_alone_table_name" value="<?php echo $_REQUEST['class_alone_table_name']; ?>" />
    <input type="hidden" id="info_alone_table_name" name="info_alone_table_name" value="<?php echo $_REQUEST['info_alone_table_name']; ?>" />
  <?php if(!$_GET['__save_view']){ ?></form><?php } ?>
<script type="text/javascript">
<?php

if(is_file(CC_SAVE_PATH.($_REQUEST['info_alone_table_name']?"{$_REQUEST['info_alone_table_name']}_":'').'conf_info_'.$id.'.ccset')){
  foreach($selcc_info as $k=>$v){
    $selcc_info[$k]['info'] = $cc_info['info'];
    $selcc_info[$k]['info_extend_field'] = $cc_info['info_extend_field'];
  }
}
?>
var type_ccinfo = <?php echo json_encode($selcc_info); ?>;
function ccsel(id){
  document.getElementById('page_info_order_box').style.display='';
  document.getElementById('page_info_order_txt').innerHTML='排列序号';
  document.getElementById('page_cn_info_name_box').style.display='';
  document.getElementById('page_cn_info_name_txt').innerHTML='信息名称<?php echo $bb_cn_show;?>';

  <?php if ($bb_en == '001') { ?>
  document.getElementById('page_en_info_name_box').style.display='';
  document.getElementById('page_en_info_name_txt').innerHTML='信息名称<?php echo $bb_en_show;?>';
  <?php } ?>

  document.getElementById('page_save_date_box').style.display='';
  document.getElementById('page_save_date_txt').innerHTML='录入日期';
  document.getElementById('page_cn_info_title_box').style.display='';
  document.getElementById('page_cn_info_title_txt').innerHTML='标　　题<?php echo $bb_cn_show;?>';

  <?php if ($bb_en == '001') { ?>
  document.getElementById('page_en_info_title_box').style.display='';
  document.getElementById('page_en_info_title_txt').innerHTML='标　　题<?php echo $bb_en_show;?>';
  <?php } ?>

  document.getElementById('page_cn_info_keyword_box').style.display='';
  document.getElementById('page_cn_info_keyword_txt').innerHTML='关 键 词<?php echo $bb_cn_show;?>';

  <?php if ($bb_en == '001') { ?>
  document.getElementById('page_en_info_keyword_box').style.display='';
  document.getElementById('page_en_info_keyword_txt').innerHTML='关 键 词<?php echo $bb_en_show;?>';
  <?php } ?>


  document.getElementById('page_cn_info_description_box').style.display='';
  document.getElementById('page_cn_info_description_txt').innerHTML='描　　述<?php echo $bb_cn_show;?>';

  <?php if ($bb_en == '001') { ?>
  document.getElementById('page_en_info_description_box').style.display='';
  document.getElementById('page_en_info_description_txt').innerHTML='描　　述<?php echo $bb_en_show;?>';
  <?php } ?>

  document.getElementById('page_info_simg_box').style.display='';
  document.getElementById('page_info_simg_txt').innerHTML='信息小图片';
  document.getElementById('page_info_bimg_box').style.display='';
  document.getElementById('page_info_bimg_txt').innerHTML='信息大图片';
  document.getElementById('page_cn_info_content_box').style.display='';
  document.getElementById('page_cn_info_content_txt').innerHTML='信息说明<?php echo $bb_cn_show;?>';

  <?php if ($bb_en == '001') { ?>
  document.getElementById('page_en_info_content_box').style.display='';
  document.getElementById('page_en_info_content_txt').innerHTML='信息说明<?php echo $bb_en_show;?>';
  <?php } ?>

  document.getElementById('page_info_recommend_box').style.display='';
  document.getElementById('page_info_recommend_txt').innerHTML='设为推荐信息';

  //去除不必要提交数据
  $('[id$=_box] input').attr('disabled',true);
  $('[id$=_box] select').attr('disabled',true);

  for(t in type_ccinfo){
    if(t==id){
      //type_ccinfo[t].menu.info.title
      for(tt in type_ccinfo[t].info){
        if(document.getElementById('page_'+tt+'_box')){
          //开启需要提交项目
          $('#page_'+tt+'_box input').attr('disabled',false);
          $('#page_'+tt+'_box select').attr('disabled',false);

          if(type_ccinfo[t].info[tt].status=='hide') document.getElementById('page_'+tt+'_box').style.display='none';
          
          if(type_ccinfo[t].info[tt].title.length>0
            && type_ccinfo[t].info[tt].title!='信息名称'
            && type_ccinfo[t].info[tt].title!='标　　题'
            && type_ccinfo[t].info[tt].title!='关 键 词'
            && type_ccinfo[t].info[tt].title!='描　　述'
            && type_ccinfo[t].info[tt].title!='信息说明'
            ) document.getElementById('page_'+tt+'_txt').innerHTML=type_ccinfo[t].info[tt].title;
        }
      }
      var extend_field_trs = getElementsByClassName('extend_field_tr');
      for (var i = 0; i<extend_field_trs.length; i++) {
        extend_field_trs[i].style.display='none';
      }
      for(tt in type_ccinfo[t].info_extend_field){
        var name_id = t+'_'+type_ccinfo[t].info_extend_field[tt].pos+'_'+type_ccinfo[t].info_extend_field[tt].field;

        //开启需要提交自定义字段
        $('#page_extend_field_'+name_id+'_box input').attr('disabled',false);
        $('#page_extend_field_'+name_id+'_box select').attr('disabled',false);
        
        if(type_ccinfo[t].info_extend_field[tt].status=='show'){
          if(document.getElementById('page_extend_field_'+name_id+'_box')) document.getElementById('page_extend_field_'+name_id+'_box').style.display='';
          if(document.getElementById('page_extend_field_'+name_id+'_txt')) document.getElementById('page_extend_field_'+name_id+'_txt').innerHTML=type_ccinfo[t].info_extend_field[tt].title;
        }
      }

      if(type_ccinfo[t].class_alone_table_name!=undefined) document.getElementById('class_alone_table_name').value = type_ccinfo[t].class_alone_table_name;
      if(type_ccinfo[t].info_alone_table_name!=undefined) document.getElementById('info_alone_table_name').value = type_ccinfo[t].info_alone_table_name;
      break;
    }
  }
  <?php if($_GET['__save_view']){ ?>
  $(function(){
    $('input,textarea').each(function(){
      if(!$(this) || $(this).attr('type')=='hidden') return '';
      if($(this).parent().find('a').html()=='预览'){
        if($(this).val()!=''){
          if($(this).val().indexOf('jpg')>-1 || $(this).val().indexOf('gif')>-1 || $(this).val().indexOf('png')>-1 || $(this).val().indexOf('bmp')>-1){
            if($(this).val().indexOf('http')>-1){
              $(this).parent().html('<a href="'+$(this).val()+'" target="_blank"><img src="'+$(this).val()+'" onload="if(this.height>200){ this.height=\'200\'; }"></a>');
            }else{
              $(this).parent().html('<a href="../../uploadfiles/'+$(this).val()+'" target="_blank"><img src="../../uploadfiles/'+$(this).val()+'" onload="if(this.height>200){ this.height=\'200\'; }"></a>');
            }
          }else{
            if($(this).val().indexOf('http')>-1){
              $(this).parent().html('<a href="'+$(this).val()+'" target="_blank">查看文件</a>');
            }else{
              $(this).parent().html('<a href="../../uploadfiles/'+$(this).val()+'" target="_blank">查看文件</a>');
            }
          }
        }else{
          $(this).parent().html('未上传');
        }
      }else if($(this).attr('type')=='radio' || $(this).attr('type')=='checkbox'){
        var tmp = [];
        $(this).parent().find(":checked").each(function(){
          tmp[tmp.length]=$(this).data('val');
        });
        $(this).parent().html(tmp.join(','));
      }else{
        if($(this).val().substring(0, 4)=='http'){
          $(this).parent().html('<a href="../../uploadfiles/'+$(this).val()+'" target="_blank">'+$(this).val()+'</a>');
        }else{
          $(this).parent().html($(this).val());
        }
      }
    });
    $('select').each(function(){
      $(this).parent().html($(this).find("option:selected").text().replace(/(^\s*)|(\s*$)|(├*)/g, ""));
    });
    $("script[type='text/plain']").each(function(){
      $(this).parent().html($(this).html());
    });
    $('.qbt_guding_bottom').hide();
    $('select').css('border','none').attr('readonly',true);
  });
  <?php } ?>
}
ccsel(document.getElementById('type_id').value);
</script>
</div>
</div>
<script type="text/javascript">
<?php
if ($t_action=='0001' || $t_action=='0003'){
  //加载信息添加JS脚本
  if($cc_info['info_script']['add_js']['status']=='show' && $cc_info['info_script']['add_js']['content']!=''){
    if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_add_js_'.$cc_id.'.php')){
      include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_add_js_'.$cc_id.'.php';
    }
  }
}elseif($t_action=='0002'){
  //加载信息修改JS脚本
  if($cc_info['info_script']['edit_js']['status']=='show' && $cc_info['info_script']['edit_js']['content']!=''){
    if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_edit_js_'.$cc_id.'.php')){
      include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_edit_js_'.$cc_id.'.php';
    }
  }
}
?>
</script>
</body>
</html>