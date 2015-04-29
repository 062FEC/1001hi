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
  if(is_file(CC_SAVE_PATH.($_REQUEST['class_alone_table_name']?($_REQUEST['class_alone_table_name'].'_'):'').'conf_'.$cc_id.'.ccset')){
    $cc_info = unserialize(file_get_contents(CC_SAVE_PATH.($_REQUEST['class_alone_table_name']?($_REQUEST['class_alone_table_name'].'_'):'').'conf_'.$cc_id.'.ccset'));
  }else{
    $cc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_'.$cc_id.'.ccset'));
  }

  //存在独立设置表名
  if($cc_info['class_alone_table_name']){
    $table_name1 = $cc_info['class_alone_table_name'];
  }
  if($cc_info['info_alone_table_name']){
    $table_name2 = $cc_info['info_alone_table_name'];
  }

  unset($cc_info['menu'],$cc_info['custom_menu'],$cc_info['class_level_num'],$cc_info['class_no_show_list']);
}

if ($t_action=='0001' || $t_action=='0003'){
    //加载类别添加前的脚本
    if($cc_info['class_script']['add_top']['status']=='show' && $cc_info['class_script']['add_top']['content']!=''){
        if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_add_top_'.$cc_id.'.php')){
            include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_add_top_'.$cc_id.'.php';
        }
    }
}elseif($t_action=='0002'){
    //加载类别修改前的脚本
    if($cc_info['class_script']['edit_top']['status']=='show' && $cc_info['class_script']['edit_top']['content']!=''){
        if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_edit_top_'.$cc_id.'.php')){
            include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_edit_top_'.$cc_id.'.php';
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

$get_p_url = $_COOKIE['atype'];
$level_num_i=2;
$id=trim(rp($_REQUEST['id']));
$cn_type=trim(rp($_REQUEST['cn_type']));
$en_type=trim(rp($_REQUEST['en_type']));
$cn_title=trim(rp($_REQUEST['cn_title']));
$en_title=trim(rp($_REQUEST['en_title']));
$cn_keywords=trim(rp($_REQUEST['cn_keywords']));
$en_keywords=trim(rp($_REQUEST['en_keywords']));
$cn_description=trim(rp($_REQUEST['cn_description']));
$en_description=trim(rp($_REQUEST['en_description']));
$old_cn_type=trim(rp($_REQUEST['old_cn_type']));
$old_en_type=trim(rp($_REQUEST['old_en_type']));
$old_type_id=trim(rp($_REQUEST['old_type_id']));
$num=trim(rp($_REQUEST['num']));

if ($t_action=='0002'){
  check_id($id,1);

  //需要检测是否删除文件的字段
  $__check_del_file_arr = array();
  $__old_info = mysql_fetch_assoc(mysql_query("SELECT * FROM `{$table_name1}` WHERE `id`='{$id}'"));
}

if ($action=='save')
{
    //加载自定义规则
    $_set=false;
    if(is_file(CC_SAVE_PATH.'conf_'.$type_id.'.ccset')){
        $_set=true;
        $cc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_'.$type_id.'.ccset'));
    }

    //加载自定义规则
    if(is_file(CC_SAVE_PATH.'conf_class_info_'.$id.'.ccset')){
      $_set=true;
      $_temp = unserialize(file_get_contents(CC_SAVE_PATH.'conf_class_info_'.$id.'.ccset'));
      if($_temp['alone_ccset_class_info']=='yes') $cc_info['class_info'] = $_temp['class_info'];
      if($_temp['alone_ccset_class_extend_field']=='yes') $cc_info['class_extend_field'] = $_temp['class_extend_field'];
    }

    //type_id不存在设置采用父级ID延伸设置
    if(!$_set && is_file(CC_SAVE_PATH.'conf_'.$manage_id.'.ccset')){
        $pcc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_'.$manage_id.'.ccset'));
        foreach($pcc_info as $_key=>$_value){
            foreach($_value as $_key2=>$_value2){
                if($_value2['extend']=='yes'){
                    $cc_info[$_key][$_key2] = $_value2;
                }
            }
        }
        //独立表扩展
        if($pcc_info['class_alone_table_name']) $cc_info['class_alone_table_name'] = $pcc_info['class_alone_table_name'];
        if($pcc_info['info_alone_table_name']) $cc_info['info_alone_table_name'] = $pcc_info['info_alone_table_name'];
        unset($pcc_info);
    }

    if($table_name1=='atype') check_drop('c_int',$type_id,($cc_info['class_info']['parent_class']['title']?$cc_info['class_info']['parent_class']['title']:'所属分类'),'',$go_to_num,'type_id','','','','','','','','','');
    if($table_name1=='atype') check_drop('c_int',$num,($cc_info['class_info']['class_order']['title']?$cc_info['class_info']['class_order']['title']:'排列序号'),'',$go_to_num,'num','','','','','','','','','');
    if($table_name1=='atype') check_drop('c_str',$cn_type,($cc_info['class_info']['cn_class_name']['title']?$cc_info['class_info']['cn_class_name']['title']:'类别名称').$bb_cn_show,'',$go_to_num,'cn_type','','','','','','','','','');

    //扩展字段处理
    $_extend_fields = array();

    $unique_where_sql = " AND `type_id`='{$type_id}'";
    if($id) $unique_where_sql = " AND `id`!='{$id}'";

    if($cc_info['class_extend_field']){
        foreach($cc_info['class_extend_field'] as $_key=>$_value){
            $_varname = "extend_field_{$type_id}_{$_value['pos']}_{$_value['field']}";
            if(isset($_REQUEST[$_varname])){
                if(is_array($_REQUEST[$_varname])){
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
            if($_value['type']=='checkbox'){
                $_varvalue = '||'.implode('||', $_varvalue).'||';
            }
            //重复检测
            if($_value['unique']=='yes' && $_varvalue){
                if(mysql_num_rows(mysql_query("SELECT * FROM `{$table_name1}` WHERE `{$_value['field']}`='{$_varvalue}' {$unique_where_sql}"))>0){
                  show_msg("【{$_value['title']}】已存在");
                }
            }
            $_extend_fields['value'][$_key] = $_varvalue;
        }
    }

    //加载老菜单信息
    $old_conf_showmenu = file_get_contents(CC_SAVE_PATH.'conf_showmenu.ccset');

    if ($t_action=='0001' || $t_action=='0003')
    {
        if($table_name1=='atype') check_one_type_is_exist($table_name1,'cn_type',$cn_type,'type_id',$type_id,'所属类别的类别名称'.$bb_cn_show.'《'.$_REQUEST['cn_type'].'》已经存在，请使用其他类别名称！',$go_to_num,'','cn_type','','','','','','','','','');
        
        if ($bb_en == '001') {
            if($table_name1=='atype') check_drop('c_str',$en_type,'类别名称'.$bb_en_show,'','','en_type','','','','','','','','','');
            if($table_name1=='atype') check_one_type_is_exist($table_name1,'en_type',$en_type,'type_id',$type_id,'所属类别的类别名称'.$bb_en_show.'《'.$_REQUEST['en_type'].'》已经存在，请使用其他类别名称！',$go_to_num,'','en_type','','','','','','','','','');
        }
        
        $sql="insert into `{$table_name1}` (";

        //过滤默认字段
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_type'))        $sql.='`cn_type`,';
        if(!check_default_field_in_extend_field($_extend_fields, 'en_type'))        $sql.='`en_type`,';
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_title'))       $sql.='`cn_title`,';
        if(!check_default_field_in_extend_field($_extend_fields, 'en_title'))       $sql.='`en_title`,';
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_keywords'))    $sql.='`cn_keywords`,';
        if(!check_default_field_in_extend_field($_extend_fields, 'en_keywords'))    $sql.='`en_keywords`,';
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_description')) $sql.='`cn_description`,';
        if(!check_default_field_in_extend_field($_extend_fields, 'en_description')) $sql.='`en_description`,';
        if(!check_default_field_in_extend_field($_extend_fields, 'type_id'))        $sql.='`type_id`,';
        if(!check_default_field_in_extend_field($_extend_fields, 'num'))            $sql.='`num`,';

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

        $sql.='`admin_id`';

        substr($sql, -1)==',' && $sql=substr($sql,0,-1);
        $sql.=') values (';

        //过滤默认字段
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_type'))        $sql.="'".mysql_real_escape_string($cn_type)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'en_type'))        $sql.="'".mysql_real_escape_string($en_type)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_title'))       $sql.="'".mysql_real_escape_string($cn_title)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'en_title'))       $sql.="'".mysql_real_escape_string($en_title)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_keywords'))    $sql.="'".mysql_real_escape_string($cn_keywords)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'en_keywords'))    $sql.="'".mysql_real_escape_string($en_keywords)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_description')) $sql.="'".mysql_real_escape_string($cn_description)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'en_description')) $sql.="'".mysql_real_escape_string($en_description)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'type_id'))        $sql.="'".mysql_real_escape_string($type_id)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'num'))            $sql.="'".mysql_real_escape_string($num)."',";

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

        $sql.="'{$a_user_id}'";
        substr($sql, -1)==',' && $sql=substr($sql,0,-1);
        $sql.=')';
        mysql_query($sql,$conn);
        is_err(3,'');

        $id = mysql_insert_id();

        /* 采用方案 */
        if($_REQUEST['cc_default_id'] && is_file(CC_SAVE_PATH.'conf_default_'.$_REQUEST['cc_default_id'].'.ccset')){
            $_temp = unserialize(file_get_contents(CC_SAVE_PATH.'conf_default_'.$_REQUEST['cc_default_id'].'.ccset'));
            $_REQUEST['cc'] = $_temp['cc_info'];
        }

        //另存方案
        if($_REQUEST['cc_save_to_default']){
            if(empty($_REQUEST['cc_save_to_default_id'])) show_msg('请输入方案ID');
            if(empty($_REQUEST['cc_save_to_default_name'])) show_msg('请输入方案名称');
            if(is_file(CC_SAVE_PATH.'conf_default_'.$_REQUEST['cc_save_to_default_id'].'.ccset')) show_msg('另存方案ID已存在');
            $infos = array(
                'name'=>$_REQUEST['cc_save_to_default_name'],
                'cc_info'=>$_REQUEST['cc']
                );
            file_put_contents(CC_SAVE_PATH.'conf_default_'.$_REQUEST['cc_save_to_default_id'].'.ccset', serialize($infos));
        }

        file_put_contents(CC_SAVE_PATH.($cc_info['class_alone_table_name']?$cc_info['class_alone_table_name'].'_':'').'conf_'.$id.'.ccset', serialize($_REQUEST['cc']));
        include 'ccaction.php';

        //复制添加，复制独立控制
        if($t_action=='0003' && is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?$cc_info['class_alone_table_name'].'_':'').'conf_class_info_'.$_POST['id'].'.ccset')){
            $oldrcc = $_REQUEST['cc'];
            $copycc = file_get_contents(CC_SAVE_PATH.($cc_info['class_alone_table_name']?$cc_info['class_alone_table_name'].'_':'').'conf_class_info_'.$_POST['id'].'.ccset');
            file_put_contents(CC_SAVE_PATH.($cc_info['class_alone_table_name']?$cc_info['class_alone_table_name'].'_':'').'conf_class_info_'.$id.'.ccset', $copycc);
            $_REQUEST['cc'] = unserialize($copycc);
            include 'ccaction.php';

            $_REQUEST['cc'] = $oldrcc;
        }
        


        //加载类别添加后的脚本
        if($cc_info['class_script']['add_bottom']['status']=='show' && $cc_info['class_script']['add_bottom']['content']!=''){
            if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_add_bottom_'.$type_id.'.php')){
                include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_add_bottom_'.$type_id.'.php';
            }
        }

        //更新左侧菜单
        $new_conf_showmenu = file_get_contents(CC_SAVE_PATH.'conf_showmenu.ccset');
        if($old_conf_showmenu!=$new_conf_showmenu){
            echo '<script type="text/javascript">parent.leftFrame.location.reload();</script>';
        }

        show_msg_ok('分类信息已成功保存！',4,'class_save.php?manage_id='.$manage_id.'&t_action=0001&id='.$type_id.'&class_alone_table_name='.$_POST['class_alone_table_name'].'&info_alone_table_name='.$_POST['info_alone_table_name']);
        //show_msg_ok('分类信息已成功保存！',4,$get_p_url);
    }
    elseif ($t_action=='0002')
    {

        if (str_to_lower_num($cn_type) != str_to_lower_num($old_cn_type) || $type_id != $old_type_id)
        {
            if($table_name1=='atype') check_one_type_is_exist($table_name1,'cn_type',$cn_type,'type_id',$type_id,'所属类别的类别名称'.$bb_cn_show.'《'.$_REQUEST['cn_type'].'》已经存在，请使用其他类别名称！',$go_to_num,'','cn_type','','','','','','','','','');
        }
        if ($bb_en == '001') {
            if($table_name1=='atype') check_drop('c_str',$en_type,'类别名称'.$bb_en_show,'',$go_to_num,'en_type','','','','','','','','','');
            if (str_to_lower_num($en_type) != str_to_lower_num($old_en_type) || $type_id != $old_type_id)
            {
            if($table_name1=='atype') check_one_type_is_exist($table_name1,'en_type',$en_type,'type_id',$type_id,'所属类别的类别名称'.$bb_en_show.'《'.$_REQUEST['en_type'].'》已经存在，请使用其他类别名称！',$go_to_num,'','en_type','','','','','','','','','');
            }
        }
        
        $sql="update `{$table_name1}` set ";
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_type'))        $sql.="`cn_type`='".mysql_real_escape_string($cn_type)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'en_type'))        $sql.="`en_type`='".mysql_real_escape_string($en_type)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_title'))       $sql.="`cn_title`='".mysql_real_escape_string($cn_title)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'en_title'))       $sql.="`en_title`='".mysql_real_escape_string($en_title)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_keywords'))    $sql.="`cn_keywords`='".mysql_real_escape_string($cn_keywords)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'en_keywords'))    $sql.="`en_keywords`='".mysql_real_escape_string($en_keywords)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'cn_description')) $sql.="`cn_description`='".mysql_real_escape_string($cn_description)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'en_description')) $sql.="`en_description`='".mysql_real_escape_string($en_description)."',";
        if(!check_default_field_in_extend_field($_extend_fields, 'type_id'))        $sql.="`type_id`='".mysql_real_escape_string($type_id)."',";
        
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

        if(!check_default_field_in_extend_field($_extend_fields, 'num'))            $sql.="`num`='".mysql_real_escape_string($num)."'";
        $sql.="where id='{$id}'";
        substr($sql, -1)==',' && $sql=substr($sql,0,-1);
        mysql_query($sql,$conn) or die(mysql_error());
        is_err(3,'');

        //删除过期上传文件
        if ($t_action=='0002'){
          $__new_info = mysql_fetch_assoc(mysql_query("SELECT * FROM `{$table_name1}` WHERE `id`='{$id}'"));
          foreach($__check_del_file_arr as $__val){
            if($__old_info[$__val]!=$__new_info[$__val]){
              if(mysql_num_rows(mysql_query("SELECT * FROM `{$table_name1}` WHERE `{$__val}`='{$__old_info[$__val]}'"))<1){
                @unlink(dirname(__FILE__).'/../../uploadfiles/'.$__old_info[$__val]);
              }
            }
          }
        }
        
        /* 采用方案 */
        if($_REQUEST['cc_default_id'] && is_file(CC_SAVE_PATH.'conf_default_'.$_REQUEST['cc_default_id'].'.ccset')){
            $_temp = unserialize(file_get_contents(CC_SAVE_PATH.'conf_default_'.$_REQUEST['cc_default_id'].'.ccset'));
            $_REQUEST['cc'] = $_temp['cc_info'];
        }

        //另存方案
        if($_REQUEST['cc_save_to_default']){
            if(empty($_REQUEST['cc_save_to_default_id'])) show_msg('请输入方案ID');
            if(empty($_REQUEST['cc_save_to_default_name'])) show_msg('请输入方案名称');
            if(is_file(CC_SAVE_PATH.'conf_default_'.$_REQUEST['cc_save_to_default_id'].'.ccset')) show_msg('另存方案ID已存在');
            $infos = array(
                'name'=>$_REQUEST['cc_save_to_default_name'],
                'cc_info'=>$_REQUEST['cc']
                );
            file_put_contents(CC_SAVE_PATH.'conf_default_'.$_REQUEST['cc_save_to_default_id'].'.ccset', serialize($infos));
        }

        file_put_contents(CC_SAVE_PATH.($cc_info['class_alone_table_name']?$cc_info['class_alone_table_name'].'_':'').'conf_'.$id.'.ccset', serialize($_REQUEST['cc']));
        include 'ccaction.php';

        //加载类别修改后的脚本
        if($cc_info['class_script']['edit_bottom']['status']=='show' && $cc_info['class_script']['edit_bottom']['content']!=''){
            if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_edit_bottom_'.$type_id.'.php')){
                include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_edit_bottom_'.$type_id.'.php';
            }
        }

        //更新左侧菜单
        $new_conf_showmenu = file_get_contents(CC_SAVE_PATH.'conf_showmenu.ccset');
        if($old_conf_showmenu!=$new_conf_showmenu){
            echo '<script type="text/javascript">parent.leftFrame.location.reload();</script>';
        }
        show_msg_ok('分类信息已成功保存！',4,($_POST['refurl']?$_POST['refurl']:$get_p_url));
    }
}

if (($t_action=='0002' || $t_action=='0003') && $id)
{
$sql="select * from `{$table_name1}` where `id`='{$id}'";
$result=mysql_query($sql,$conn);
check_rs($result,1);
$rs=mysql_fetch_array($result);

$num=$rs['num'];
$cn_type=$rs['cn_type'];
$en_type=$rs['en_type'];
$cn_title=$rs['cn_title'];
$en_title=$rs['en_title'];
$cn_keywords=$rs['cn_keywords'];
$en_keywords=$rs['en_keywords'];
$cn_description=$rs['cn_description'];
$en_description=$rs['en_description'];
$type_id=$rs['type_id'];



    if ($t_action=='0003')
    {
    $num=show_table_num($table_name1,$table_name1);
    }
}
else
{
$num=show_table_num($table_name1,$table_name1);
}

//$cc_info = array();
$_set = false;
if ($t_action!='0001'){
    if(is_file(CC_SAVE_PATH.'conf_'.$type_id.'.ccset')){
        $_set=true;
        $cc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_'.$type_id.'.ccset'));
    }

    if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?($cc_info['class_alone_table_name'].'_'):'').'conf_'.$id.'.ccset')){
        $ccs_info = unserialize(file_get_contents(CC_SAVE_PATH.($cc_info['class_alone_table_name']?($cc_info['class_alone_table_name'].'_'):'').'conf_'.$id.'.ccset'));
    }

    if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?($cc_info['class_alone_table_name'].'_'):'').'conf_class_info_'.$id.'.ccset')){
      $_set=true;
      $_temp = unserialize(file_get_contents(CC_SAVE_PATH.($cc_info['class_alone_table_name']?($cc_info['class_alone_table_name'].'_'):'').'conf_class_info_'.$id.'.ccset'));
      if($_temp['alone_ccset_class_info']=='yes') $cc_info['class_info'] = $_temp['class_info'];
      if($_temp['alone_ccset_class_extend_field']=='yes') $cc_info['class_extend_field'] = $_temp['class_extend_field'];
      if($_temp['class_alone_table_name']) $cc_info['class_alone_table_name'] = $_temp['class_alone_table_name'];
      if($_temp['info_alone_table_name']) $cc_info['info_alone_table_name'] = $_temp['info_alone_table_name'];
    }
} else {
    $_set = false;
}
//延伸设定
if(!$_set && is_file(CC_SAVE_PATH.'conf_'.$manage_id.'.ccset')){
    if($id && is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?($cc_info['class_alone_table_name'].'_'):'').'conf_'.$id.'.ccset')){
        if(is_file(CC_SAVE_PATH.'conf_'.$id.'.ccset')){
            $pcc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_'.$id.'.ccset'));
            if($pcc_info){
                foreach($pcc_info as $_key=>$_value){
                    if(is_array($_value)){
                        foreach($_value as $_key2=>$_value2){
                            if($_value2['extend']=='yes'){
                                $cc_info[$_key][$_key2] = $_value2;
                            }
                        }
                    }
                }
                if($pcc_info['class_alone_table_name']) $cc_info['class_alone_table_name'] = $pcc_info['class_alone_table_name'];
                if($pcc_info['info_alone_table_name']) $cc_info['info_alone_table_name'] = $pcc_info['info_alone_table_name'];
            }
        }
    }

    if(!$id && is_file(CC_SAVE_PATH.'conf_'.$manage_id.'.ccset')){
        $pcc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_'.$manage_id.'.ccset'));
        if($pcc_info){
            foreach($pcc_info as $_key=>$_value){
                if(is_array($_value)){
                    foreach($_value as $_key2=>$_value2){
                        if($_value2['extend']=='yes'){
                            $cc_info[$_key][$_key2] = $_value2;
                        }
                    }
                }
            }
            if($pcc_info['class_alone_table_name']) $cc_info['class_alone_table_name'] = $pcc_info['class_alone_table_name'];
            if($pcc_info['info_alone_table_name']) $cc_info['info_alone_table_name'] = $pcc_info['info_alone_table_name'];
        }
    }

    unset($pcc_info);
}

//自定义变量调用
if($cc_info['class_extend_field']){
    foreach($cc_info['class_extend_field'] as $_key=>$_value){
        $_varname = "extend_field_{$type_id}_{$_value['pos']}_{$_value['field']}";
        $$_varname = $rs[$_value['field']];
    }
}

//加载父级ID控制
$selcc_info[$manage_id] = array();
if(is_file(CC_SAVE_PATH.'conf_'.$manage_id.'.ccset')){
    $selcc_info[$manage_id] = unserialize(file_get_contents(CC_SAVE_PATH.'conf_'.$manage_id.'.ccset'));
}

//加载可选分类控制
load_type_cc($table_name1,$manage_id,'',$id,$t_action,$level_num,$level_num_i);

//修改时候，存在独立控制则去掉其他
if($t_action!='0001' && is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?($cc_info['class_alone_table_name'].'_'):'').'conf_class_info_'.$id.'.ccset')){
    foreach($selcc_info as $_key=>$_value){
        $selcc_info[$_key]['class_info'] = $cc_info['class_info'];
        $selcc_info[$_key]['class_extend_field'] = $cc_info['class_extend_field'];
    }
}

/* 新增字段整理 */
$newfield = array();
if($selcc_info){
    foreach($selcc_info as $_key=>$_value){
        $_value['class_extend_field'] = array_sort($_value['class_extend_field'],'order','asc');
        if($_value['class_extend_field']){
            foreach($_value['class_extend_field'] as $_key2=>$_value2){
                $_value2['type_id'] = $_key;
                $newfield[$_value2['pos']][$_key.'|'.$_value2['field']] = $_value2;
            }
        }
    }
}

/* 控制方案加载 */
$default_cc_infos = array();
$dh = opendir(CC_SAVE_PATH);
while($fn = readdir($dh)){
    if(substr($fn,0,13)=='conf_default_'){
        $default_cc_infos[str_replace(array('conf_default_','.ccset'), '', $fn)] = unserialize(file_get_contents(CC_SAVE_PATH.$fn));
    }
}
closedir($dh);

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
<span><b><?php if($_GET['__save_view']){ ?>查看<?php }else{ ?><?php echo $show_a;?><?php } ?>类别</b></span></div>
<div class="qbt_omnissguai">
<?php if(!$_GET['__save_view']){ ?>
  <form action="class_save.php" method="post" name="save_form" target="<?php echo $tempFrame;?>" onSubmit="return check()">
<?php } ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="9" bgcolor="#ffffff" class="qbt_heniwodsk">
        <?php if($newfield['top']) foreach($newfield['top'] as $_field){ insert_extend_field_box($_field); } ?>
        <?php if ($level_num > 1) { ?>
        <tr style="<?php if($selcc_info[$manage_id]['class_info']['parent_class']['status']=='hide') echo 'display:none;'; ?>">
          <td width="15%" align="right" bgcolor="#FFFFFF"><?php if($selcc_info[$manage_id]['class_info']['parent_class']['title']!=''){ echo $selcc_info[$manage_id]['class_info']['parent_class']['title']; }else{ echo '所属分类'; }?>：</td>
          <td width="84%" bgcolor="#FFFFFF">
            <select name="type_id" id="type_id" onchange="ccsel(this.value)" class="qbt_buyao_bawo_mjj">
                <option value="<?php echo $manage_id;?>"><?php echo $show_select_name;?></option>
                <?php show_type($table_name1,$manage_id,'',$id,$t_action,$level_num,$level_num_i); ?>
            </select>
            </td>
        </tr>
        <?php } ?>
        <?php if($newfield['type_id']) foreach($newfield['type_id'] as $_field){ insert_extend_field_box($_field); } ?>
        <tr id="page_class_order_box">
          <td width="15%" align="right" bgcolor="#FFFFFF"><span id="page_class_order_txt">排列序号</span>：</td>
          <td width="84%" bgcolor="#FFFFFF"><input name="num" type="text" id="num" value="<?php echo $num;?>" <?php echo show_m('','','','',''); ?> class="qbt_syzsf"></td>
        </tr>
        <?php if($newfield['num']) foreach($newfield['num'] as $_field){ insert_extend_field_box($_field); } ?>
        <tr id="page_cn_class_name_box">
          <td width="15%" align="right" bgcolor="#FFFFFF"><span id="page_cn_class_name_txt">类别名称<?php echo $bb_cn_show;?></span>：</td>
          <td width="84%" bgcolor="#FFFFFF"><input name="cn_type" type="text" id="cn_type" value="<?php echo $cn_type;?>" <?php echo show_m('','','','',''); ?> class="qbt_syzsf"></td>
        </tr>
        <?php if($newfield['cn_type']) foreach($newfield['cn_type'] as $_field){ insert_extend_field_box($_field); } ?>
        <?php if ($bb_en == '001') { ?>
        <tr id="page_en_class_name_box">
          <td width="15%" align="right" bgcolor="#FFFFFF"><span id="page_en_class_name_txt">类别名称<?php echo $bb_en_show;?></span>：</td>
          <td width="84%" bgcolor="#FFFFFF"><input name="en_type" type="text" id="en_type" value="<?php echo $en_type;?>" <?php echo show_m('','','','',''); ?> class="qbt_syzsf"></td>
        </tr>
        <?php } ?>
        <?php if($newfield['en_type']) foreach($newfield['en_type'] as $_field){ insert_extend_field_box($_field); } ?>
        <tr id="page_cn_class_title_box">
          <td width="15%" align="right" bgcolor="#FFFFFF"><span id="page_cn_class_title_txt">标　　题<?php echo $bb_cn_show;?></span>：</td>
          <td width="84%" bgcolor="#FFFFFF"><input name="cn_title" type="text" id="cn_title" value="<?php echo $cn_title;?>" class="qbt_syzsf"></td>
        </tr>
        <?php if($newfield['cn_title']) foreach($newfield['cn_title'] as $_field){ insert_extend_field_box($_field); } ?>
        <?php if ($bb_en == '001') { ?>
        <tr id="page_en_class_title_box">
          <td width="15%" align="right" bgcolor="#FFFFFF"><span id="page_en_class_title_txt">标　　题<?php echo $bb_en_show;?></span>：</td>
          <td width="84%" bgcolor="#FFFFFF"><input name="en_title" type="text" id="en_title" value="<?php echo $en_title;?>" class="qbt_syzsf"></td>
        </tr>
        <?php } ?>
        <?php if($newfield['en_title']) foreach($newfield['en_title'] as $_field){ insert_extend_field_box($_field); } ?>
        <tr id="page_cn_class_keyword_box">
          <td width="15%" align="right" bgcolor="#FFFFFF"><span id="page_cn_class_keyword_txt">关 键 词<?php echo $bb_cn_show;?></span>：</td>
          <td width="84%" bgcolor="#FFFFFF"><input name="cn_keywords" type="text" id="cn_keywords" value="<?php echo $cn_keywords;?>" class="qbt_syzsf"></td>
        </tr>
        <?php if($newfield['cn_keywords']) foreach($newfield['cn_keywords'] as $_field){ insert_extend_field_box($_field); } ?>
        <?php if ($bb_en == '001') { ?>
        <tr id="page_en_class_keyword_box">
          <td width="15%" align="right" bgcolor="#FFFFFF"><span id="page_en_class_keyword_txt">关 键 词<?php echo $bb_en_show;?></span>：</td>
          <td width="84%" bgcolor="#FFFFFF"><input name="en_keywords" type="text" id="en_keywords" value="<?php echo $en_keywords;?>" class="qbt_syzsf"></td>
        </tr>
        <?php } ?>
        <?php if($newfield['en_keywords']) foreach($newfield['en_keywords'] as $_field){ insert_extend_field_box($_field); } ?>
        <tr id="page_cn_class_description_box">
          <td width="15%" align="right" bgcolor="#FFFFFF"><span id="page_cn_class_description_txt">描　　述<?php echo $bb_cn_show;?></span>：</td>
          <td width="84%" bgcolor="#FFFFFF"><textarea name="cn_description" rows="5"  id="cn_description" class="qbt_syzsff"><?php echo $cn_description;?></textarea></td>
        </tr>
        <?php if($newfield['cn_description']) foreach($newfield['cn_description'] as $_field){ insert_extend_field_box($_field); } ?>
        <?php if ($bb_en == '001') { ?>
        <tr id="page_en_class_description_box">
          <td width="15%" align="right" bgcolor="#FFFFFF"><span id="page_en_class_description_txt">描　　述<?php echo $bb_en_show;?></span>：</td>
          <td width="84%" bgcolor="#FFFFFF"><textarea name="en_description" rows="5"  id="en_description" class="qbt_syzsff"><?php echo $en_description;?></textarea></td>
        </tr>
        <?php } ?>
        <?php if($newfield['en_description']) foreach($newfield['en_description'] as $_field){ insert_extend_field_box($_field); } ?>
        <?php if($newfield['bottom']) foreach($newfield['bottom'] as $_field){ insert_extend_field_box($_field); } ?>

    <tr <?php if (!$_SESSION['superadmin']){ ?>style="display:none"<?php } ?>>
      <td height="20" colspan="2" align="center" class="qbt_biaoshiwocunzai"><b>控 制 设 置</b></td>
    </tr>
    <?php if(!empty($default_cc_infos)){ ?>
    <tr bgcolor="#FFFFFF" <?php if (!$_SESSION['superadmin']){ ?>style="display:none"<?php } ?>>
      <td width="120" height="20" align="right" bgcolor="#FFFFFF">方案选择：</td>
      <td height="20">
        <select name="cc_default_id" onchange="chnCCDefaultId(this.value)">
            <option value="0">自定义</option>
            <optgroup label="可选方案">
            <?php foreach($default_cc_infos as $key=>$value){ ?>
            <option value="<?php echo $key; ?>" <?php if($key==$id) echo 'selected="selected"'; ?>><?php echo $value['name']; ?></option>
            <?php } ?>
            </optgroup>
        </select>
      </td>
    </tr>
    <?php } ?>
    <tr class="extend_tr" bgcolor="#FFFFFF" <?php if (!$_SESSION['superadmin']){ ?>style="display:none"<?php } ?>>
      <td width="120" height="20" align="right" bgcolor="#FFFFFF">方案另存：</td>
      <td height="20">
        <input type="checkbox" name="cc_save_to_default" value="1" onclick="if(this.checked){ document.getElementById('cc_save_to_default').style.display=''; }else{ document.getElementById('cc_save_to_default').style.display='none'; }">
        <table id="cc_save_to_default" style="display:none">
            <tr>
                <td>ID: </td>
                <td><input name="cc_save_to_default_id" type="text" value="" /> *英文、数字，用于区别方案和方案保存名称有关，注意唯一性</td>
            </tr>
            <tr>
                <td>名称: </td>
                <td><input name="cc_save_to_default_name" type="text" value="" /> *中、英文、数字，用于展示方案选择</td>
            </tr>
        </table>
      </td>
    </tr>
    <?php if ($_SESSION['superadmin'] && !$_set && !empty($cc_info)){ ?>
    <tr class="extend_tr" bgcolor="#FFFFFF">
        <td colspan="2" align="center" class="aw"><b style="color:red">！！存在延伸设置，请注意！！</b></td>
    </tr>
    <?php } ?>
    <?php
        $_ccset['all'] = true;
        if(isset($ccs_info)){
            $cc_info_bak = $cc_info;
            $cc_info = $ccs_info;
        }
        include 'ccform.php';

        if($ccs_info) $cc_info = $cc_info_bak;
        unset($cc_info_bak);
    ?>
    </table>
    <div class="qbt_guding_bottom"><button class="button button_blue" type="submit">保存</button>&nbsp;<button class="button button_white" type="reset">重置</button></div>
    <input name="id" type="hidden" id="id" value="<?php echo $id;?>">
    <?php if($t_action=='0002'){ ?>
    <input name="refurl" type="hidden" id="refurl" value="<?php echo $_SERVER['HTTP_REFERER']; ?>">
    <?php } ?>
    <input name="action" type="hidden" id="action" value="save">
    <input name="t_action" type="hidden" id="t_action" value="<?php echo $t_action;?>">
    <input name="old_cn_type" type="hidden" id="old_cn_type" value="<?php echo $cn_type;?>">
    <input name="old_en_type" type="hidden" id="old_en_type" value="<?php echo $en_type;?>">
    <input name="old_type_id" type="hidden" id="old_type_id" value="<?php echo $type_id;?>">
    <input name="manage_id" type="hidden" id="manage_id" value="<?php echo $manage_id;?>">
    <input name="old_class_alone_table_name" type="hidden" id="old_class_alone_table_name" value="<?php echo $_REQUEST['class_alone_table_name']; ?>">
    <input name="old_info_alone_table_name" type="hidden" id="old_info_alone_table_name" value="<?php echo $_REQUEST['info_alone_table_name']; ?>">
    <input type="hidden" id="class_alone_table_name" name="class_alone_table_name" value="<?php echo $_REQUEST['class_alone_table_name']; ?>" />
    <input type="hidden" id="info_alone_table_name" name="info_alone_table_name" value="<?php echo $_REQUEST['info_alone_table_name']; ?>" />
  <?php if(!$_GET['__save_view']){ ?></form><?php } ?>
<script type="text/javascript">
<?php

if($t_action!='0001' && is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?($cc_info['class_alone_table_name'].'_'):'').'conf_class_info_'.$id.'.ccset')){
  foreach($selcc_info as $k=>$v){
    $selcc_info[$k]['class_info'] = $cc_info['class_info'];
    $selcc_info[$k]['class_extend_field'] = $cc_info['class_extend_field'];
  }
}
?>
var type_ccinfo = <?php echo json_encode($selcc_info); ?>;
function ccsel(id){
    document.getElementById('page_class_order_box').style.display='';
    document.getElementById('page_class_order_txt').innerHTML='排列序号';
    document.getElementById('page_cn_class_name_box').style.display='';
    document.getElementById('page_cn_class_name_txt').innerHTML='类别名称<?php echo $bb_cn_show;?>';

    <?php if ($bb_en == '001') { ?>
    document.getElementById('page_en_class_name_box').style.display='';
    document.getElementById('page_en_class_name_txt').innerHTML='类别名称<?php echo $bb_en_show;?>';
    <?php } ?>

    document.getElementById('page_cn_class_title_box').style.display='';
    document.getElementById('page_cn_class_title_txt').innerHTML='标　　题<?php echo $bb_cn_show;?>';

    <?php if ($bb_en == '001') { ?>
    document.getElementById('page_en_class_title_box').style.display='';
    document.getElementById('page_en_class_title_txt').innerHTML='标　　题<?php echo $bb_en_show;?>';
    <?php } ?>

    document.getElementById('page_cn_class_keyword_box').style.display='';
    document.getElementById('page_cn_class_keyword_txt').innerHTML='关 键 词<?php echo $bb_cn_show;?>';

    <?php if ($bb_en == '001') { ?>
    document.getElementById('page_en_class_keyword_box').style.display='';
    document.getElementById('page_en_class_keyword_txt').innerHTML='关 键 词<?php echo $bb_en_show;?>';
    <?php } ?>

    document.getElementById('page_cn_class_description_box').style.display='';
    document.getElementById('page_cn_class_description_txt').innerHTML='描　　述<?php echo $bb_cn_show;?>';

    <?php if ($bb_en == '001') { ?>
    document.getElementById('page_en_class_description_box').style.display='';
    document.getElementById('page_en_class_description_txt').innerHTML='描　　述<?php echo $bb_en_show;?>';
    <?php } ?>
    
    for(t in type_ccinfo){
        if(t==id){
            //type_ccinfo[t].menu.class_list.title
            for(tt in type_ccinfo[t].class_info){
                //alert(type_ccinfo[t].class_info[tt].title);
                if(document.getElementById('page_'+tt+'_box')){
                    if(type_ccinfo[t].class_info[tt].status=='hide') document.getElementById('page_'+tt+'_box').style.display='none';
                    
                    if(type_ccinfo[t].class_info[tt].title.length>0
                        && type_ccinfo[t].class_info[tt].title!='类别名称'
                        && type_ccinfo[t].class_info[tt].title!='标　　题'
                        && type_ccinfo[t].class_info[tt].title!='关 键 词'
                        && type_ccinfo[t].class_info[tt].title!='描　　述'
                        ) document.getElementById('page_'+tt+'_txt').innerHTML=type_ccinfo[t].class_info[tt].title;
                }
            }

            var extend_field_trs = getElementsByClassName('extend_field_tr');
            for (var i = 0; i<extend_field_trs.length; i++) {
                extend_field_trs[i].style.display='none';
            }
            for(tt in type_ccinfo[t].class_extend_field){
                if(type_ccinfo[t].class_extend_field[tt].status=='show'){
                  var name_id = t+'_'+type_ccinfo[t].class_extend_field[tt].pos+'_'+type_ccinfo[t].class_extend_field[tt].field;
                  if(document.getElementById('page_extend_field_'+name_id+'_box')) document.getElementById('page_extend_field_'+name_id+'_box').style.display='';
                  if(document.getElementById('page_extend_field_'+name_id+'_txt')) document.getElementById('page_extend_field_'+name_id+'_txt').innerHTML=type_ccinfo[t].class_extend_field[tt].title;
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
<?php
    if($id && $t_action!='0002' && $t_action!='0003'){
        echo "ccsel({$id});";
    }else{
        if($type_id){
            echo "ccsel({$type_id});";
        }else{
            echo "ccsel({$manage_id});";
        }
    }
?>
</script>
</div>
</div>
<script type="text/javascript">
<?php
if ($t_action=='0001' || $t_action=='0003'){
  //加载信息添加JS脚本
  if($cc_info['class_script']['add_js']['status']=='show' && $cc_info['class_script']['add_js']['content']!=''){
    if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_add_js_'.$cc_id.'.php')){
      include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_add_js_'.$cc_id.'.php';
    }
  }
}elseif($t_action=='0002'){
  //加载信息修改JS脚本
  if($cc_info['class_script']['edit_js']['status']=='show' && $cc_info['class_script']['edit_js']['content']!=''){
    if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_edit_js_'.$cc_id.'.php')){
      include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_edit_js_'.$cc_id.'.php';
    }
  }
}
?>
</script>
</body>
</html>