<?php include('../includes/php_conn.php'); ?>
<?php include('../includes/check.php'); ?>
<?php
    include('setup.php');
    if (!$_SESSION['superadmin']){
        die('未授权');
    }
?>
<html>
<head>
<title><?php echo $admin_site_title;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/qbt.css" rel="stylesheet" type="text/css">
<?php

//属于独立表数据
$CC_ALONE_TABLE['class_info'] = '';
$CC_ALONE_TABLE['info'] = '';
if($_REQUEST['class_alone_table_name']){
  $CC_ALONE_TABLE['class_info'] = $_REQUEST['class_alone_table_name'].'_';
  $table_name1 = $_REQUEST['class_alone_table_name'];
}
if($_REQUEST['info_alone_table_name']){
  $CC_ALONE_TABLE['info'] = $_REQUEST['info_alone_table_name'].'_';
  $table_name2 = $_REQUEST['info_alone_table_name'];
}

$id = $_REQUEST['id'];
$type = $_REQUEST['type'];

/* 解除独立控制 */
if($_REQUEST['del']){
    @unlink(CC_SAVE_PATH.$CC_ALONE_TABLE[$type].'conf_'.$type.'_'.$id.'.ccset');
    $class_file_head = $CC_ALONE_TABLE[$type].'class_extend_column_'.$type.'_'.$id.'_';
    $class_file_head_len = strlen($class_file_head);
    $dh = opendir(CC_SAVE_PATH);
    while($fn = readdir($dh)){
        if(substr($fn,0,$class_file_head_len)==$class_file_head){
            @unlink(CC_SAVE_PATH.$fn);
        }
    }
    closedir($dh);
    die('<script type="text/javascript">location.href="'.$_SERVER['HTTP_REFERER'].'"</script>');
}

/**
 * 刷新所有控制
 * 将控制重新进行整理保存，恢复数据库，和菜单功能
 */
if($_REQUEST['reloadallset']){
    set_time_limit(0);
    echo '<span style="color:#fff">正在刷新，请稍后...</span>';
    $reload_dh = opendir(CC_SAVE_PATH);
    while($reload_fn = readdir($reload_dh)){
        $_REQUEST['cc'] = array();
        if(substr($reload_fn,-6)=='.ccset' && !in_array($reload_fn, array('conf_showmenu.ccset','qbt_admin_config.ccset','conf_init.ccset'))){
            $id = substr($reload_fn, strrpos($reload_fn, '_')+1, strrpos($reload_fn, '.')-strrpos($reload_fn, '_')-1);
            $_REQUEST['cc'] = unserialize(file_get_contents(CC_SAVE_PATH.$reload_fn));
            //独立表数据表问题
            if(substr($reload_fn,0,5)!='conf_' || stristr($reload_fn, '_conf_')){
                $_REQUEST['cc']['info_alone_table_name'] = substr($reload_fn,0,strrpos($reload_fn, 'conf_')-1);
            }
            include 'ccaction.php';
        }
    }
    closedir($reload_dh);
    die('<script type="text/javascript">top.location.reload();</script>');
}

/**
 * 重置控制
 * 删除独立控制，分类控制
 * 若父级存在延伸则继承
 */
if($_REQUEST['reset']){
    @unlink(CC_SAVE_PATH.$CC_ALONE_TABLE[$type].'conf_'.$type.'_'.$id.'.ccset');
    @unlink(CC_SAVE_PATH.$CC_ALONE_TABLE[$type].'conf_'.$id.'.ccset');

    $type_id = mysql_result(mysql_query("SELECT `type_id` FROM `{$table_name1}` WHERE `id`='{$id}'"), 0);

    //父级存在设置
    if(is_file(CC_SAVE_PATH.$CC_ALONE_TABLE[$type].'conf_'.$type_id.'.ccset') || is_file(CC_SAVE_PATH.'conf_'.$type_id.'.ccset')){

        //使用默认值防止属性不全
        $cc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_init.ccset'));

        if(is_file(CC_SAVE_PATH.$CC_ALONE_TABLE[$type].'conf_'.$type_id.'.ccset')){
            $pcc_info = unserialize(file_get_contents(CC_SAVE_PATH.$CC_ALONE_TABLE[$type].'conf_'.$type_id.'.ccset'));
        }else{
            $pcc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_'.$type_id.'.ccset'));
        }

        //延伸处理
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
        }

        //独立表扩展
        if($pcc_info['class_alone_table_name']) $cc_info['class_alone_table_name'] = $pcc_info['class_alone_table_name'];
        if($pcc_info['info_alone_table_name']) $cc_info['info_alone_table_name'] = $pcc_info['info_alone_table_name'];

        unset($cc_info['menu'],$cc_info['custom_menu'],$cc_info['class_level_num'],$cc_info['class_no_show_list'],$pcc_info['menu'],$cc_info['menu'],$pcc_info['class_level_num'],$pcc_info['class_no_show_list']);


        /* 重新生成扩展栏目PHP文件 */
        //清除原有栏目PHP文件
        $class_file_head = ($pcc_info['class_alone_table_name']?"{$pcc_info['class_alone_table_name']}_":'').'class_extend_column_'.$id.'_';
        $class_file_head_len = strlen($class_file_head);
        $info_file_head = ($pcc_info['class_alone_table_name']?"{$pcc_info['class_alone_table_name']}_":'').'info_extend_column_'.$id.'_';
        $info_file_head_len = strlen($info_file_head);
        $dh = opendir(CC_SAVE_PATH);
        while($fn = readdir($dh)){
            if(substr($fn,0,$class_file_head_len)==$class_file_head || substr($fn,0,$info_file_head_len)==$info_file_head){
                @unlink(CC_SAVE_PATH.$fn);
            }
        }
        closedir($dh);

        /* 重新生成类别列表栏目PHP文件 */
        if(isset($cc_info['class_extend_column'])){
            foreach($cc_info['class_extend_column'] as $extend_column_info){
                if($extend_column_info['type']=='php'){
                    file_put_contents(CC_SAVE_PATH.($pcc_info['class_alone_table_name']?"{$pcc_info['class_alone_table_name']}_":'').'class_extend_column_'.$id.'_'.create_extend_column_mark($extend_column_info['title']).'.php', "<?php\n".$extend_column_info['content']);
                }
            }
        }

        /* 重新生成信息列表栏目PHP文件 */
        if(isset($cc_info['info_extend_column'])){
            foreach($cc_info['info_extend_column'] as $extend_column_info){
                if($extend_column_info['type']=='php'){
                    file_put_contents(CC_SAVE_PATH.($pcc_info['class_alone_table_name']?"{$pcc_info['class_alone_table_name']}_":'').'info_extend_column_'.$id.'_'.create_extend_column_mark($extend_column_info['title']).'.php', "<?php\n".$extend_column_info['content']);
                }
            }
        }

        /* 自定义扩展脚本处理 */
        //类别扩展脚本
        if($cc_info['class_script']){
            foreach($cc_info['class_script'] as $_key=>$_val){
                //先清除原有设置
                @unlink(CC_SAVE_PATH.($pcc_info['class_alone_table_name']?"{$pcc_info['class_alone_table_name']}_":'').'class_script_'.$_key.'_'.$id.'.php');
                if($cc_info['class_script'][$_key]['content']){
                    file_put_contents(CC_SAVE_PATH.($pcc_info['class_alone_table_name']?"{$pcc_info['class_alone_table_name']}_":'').'class_script_'.$_key.'_'.$id.'.php', "<?php\n".$cc_info['class_script'][$_key]['content']);
                }
            }
        }

        //信息扩展脚本
        if($cc_info['cc']['info_script']){
            foreach($cc_info['cc']['info_script'] as $_key=>$_val){
                //先清除原有设置
                @unlink(CC_SAVE_PATH.($pcc_info['class_alone_table_name']?"{$pcc_info['class_alone_table_name']}_":'').'info_script_'.$_key.'_'.$id.'.php');
                if($cc_info['info_script'][$_key]['content']){
                    file_put_contents(CC_SAVE_PATH.($pcc_info['class_alone_table_name']?"{$pcc_info['class_alone_table_name']}_":'').'info_script_'.$_key.'_'.$id.'.php', "<?php\n".$cc_info['info_script'][$_key]['content']);
                }
            }
        }

        file_put_contents(CC_SAVE_PATH.$CC_ALONE_TABLE[$type].'conf_'.$id.'.ccset', serialize($cc_info));
    }
    die('<script type="text/javascript">location.href="'.$_SERVER['HTTP_REFERER'].'"</script>');
}

/**
 * 重置子级控制
 * 删除所有子级独立控制，分类控制
 * 若父级存在延伸则继承
 */
if($_REQUEST['reset_sub']){
    $query = mysql_query("SELECT `id` FROM `{$table_name1}` WHERE `type_id`='{$id}'");
    if(mysql_num_rows($query)>0){
        //延伸设定
        if(is_file(CC_SAVE_PATH.$CC_ALONE_TABLE['class_info'].'conf_'.$id.'.ccset')){

            //使用默认值防止属性不全
            $cc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_init.ccset'));

            $pcc_info = unserialize(file_get_contents(CC_SAVE_PATH.$CC_ALONE_TABLE['class_info'].'conf_'.$id.'.ccset'));

            //延伸处理
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
            }

            if($pcc_info['class_alone_table_name']) $cc_info['class_alone_table_name'] = $pcc_info['class_alone_table_name'];
            if($pcc_info['info_alone_table_name']) $cc_info['info_alone_table_name'] = $pcc_info['info_alone_table_name'];

            unset($cc_info['menu'],$cc_info['custom_menu'],$cc_info['class_level_num'],$cc_info['class_no_show_list'],$pcc_info['menu'],$pcc_info['custom_menu'],$pcc_info['class_level_num'],$pcc_info['class_no_show_list']);

            /* 子级控制设置 */
            while($info = mysql_fetch_assoc($query)){

                /* 重新生成扩展栏目PHP文件 */
                //清除原有栏目PHP文件
                $class_file_head = ($pcc_info['class_alone_table_name']?"{$pcc_info['class_alone_table_name']}_":'').'class_extend_column_'.$info['id'].'_';
                $class_file_head_len = strlen($class_file_head);
                $info_file_head = ($pcc_info['class_alone_table_name']?"{$pcc_info['class_alone_table_name']}_":'').'info_extend_column_'.$info['id'].'_';
                $info_file_head_len = strlen($info_file_head);
                $dh = opendir(CC_SAVE_PATH);
                while($fn = readdir($dh)){
                    if(substr($fn,0,$class_file_head_len)==$class_file_head || substr($fn,0,$info_file_head_len)==$info_file_head){
                        @unlink(CC_SAVE_PATH.$fn);
                    }
                }
                closedir($dh);

                /* 重新生成类别列表栏目PHP文件 */
                if(isset($cc_info['class_extend_column'])){
                    foreach($cc_info['class_extend_column'] as $extend_column_info){
                        if($extend_column_info['type']=='php'){
                            file_put_contents(CC_SAVE_PATH.($pcc_info['class_alone_table_name']?"{$pcc_info['class_alone_table_name']}_":'').'class_extend_column_'.$info['id'].'_'.create_extend_column_mark($extend_column_info['title']).'.php', "<?php\n".$extend_column_info['content']);
                        }
                    }
                }

                /* 重新生成信息列表栏目PHP文件 */
                if(isset($cc_info['info_extend_column'])){
                    foreach($cc_info['info_extend_column'] as $extend_column_info){
                        if($extend_column_info['type']=='php'){
                            file_put_contents(CC_SAVE_PATH.($pcc_info['class_alone_table_name']?"{$pcc_info['class_alone_table_name']}_":'').'info_extend_column_'.$info['id'].'_'.create_extend_column_mark($extend_column_info['title']).'.php', "<?php\n".$extend_column_info['content']);
                        }
                    }
                }

                /* 自定义扩展脚本处理 */
                //类别扩展脚本
                if($cc_info['class_script']){
                    foreach($cc_info['class_script'] as $_key=>$_val){
                        //先清除原有设置
                        @unlink(CC_SAVE_PATH.($pcc_info['class_alone_table_name']?"{$pcc_info['class_alone_table_name']}_":'').'class_script_'.$_key.'_'.$info['id'].'.php');
                        if($cc_info['class_script'][$_key]['content']){
                            file_put_contents(CC_SAVE_PATH.($pcc_info['class_alone_table_name']?"{$pcc_info['class_alone_table_name']}_":'').'class_script_'.$_key.'_'.$info['id'].'.php', "<?php\n".$cc_info['class_script'][$_key]['content']);
                        }
                    }
                }

                //信息扩展脚本
                if($cc_info['info_script']){
                    foreach($cc_info['info_script'] as $_key=>$_val){
                        //先清除原有设置
                        @unlink(CC_SAVE_PATH.($pcc_info['class_alone_table_name']?"{$pcc_info['class_alone_table_name']}_":'').'info_script_'.$_key.'_'.$info['id'].'.php');
                        if($cc_info['info_script'][$_key]['content']){
                            file_put_contents(CC_SAVE_PATH.($pcc_info['class_alone_table_name']?"{$pcc_info['class_alone_table_name']}_":'').'info_script_'.$_key.'_'.$info['id'].'.php', "<?php\n".$cc_info['info_script'][$_key]['content']);
                        }
                    }
                }

                file_put_contents(CC_SAVE_PATH.($pcc_info['class_alone_table_name']?"{$pcc_info['class_alone_table_name']}_":'').'conf_'.$info['id'].'.ccset', serialize($cc_info));
            }
        }
    }
    die('<script type="text/javascript">location.href="'.$_SERVER['HTTP_REFERER'].'"</script>');
}

/* 删除控制方案 */
if($_REQUEST['defdel']){
    @unlink(CC_SAVE_PATH.'conf_default_'.$_REQUEST['defdel'].'.ccset');
    die('<script type="text/javascript">location.href="?default=1"</script>');
}

if($_REQUEST['default']){
    //保存方案
    if($_REQUEST['post']){
        $_REQUEST['nid'] = trim($_REQUEST['nid']);
        $_REQUEST['name'] = trim($_REQUEST['name']);
        if(!$_REQUEST['nid']) show_msg('请输入方案ID');
        if(!$_REQUEST['name']) show_msg('请输入方案名称');
        if((!$id || ($id && $id!=$_REQUEST['nid'])) && is_file(CC_SAVE_PATH.'conf_default_'.$_REQUEST['nid'].'.ccset')) show_msg('方案ID已存在');
        $infos = array(
            'name'=>$_REQUEST['name'],
            'cc_info'=>$_REQUEST['cc']
            );
        file_put_contents(CC_SAVE_PATH.'conf_default_'.$_REQUEST['nid'].'.ccset', serialize($infos));
        show_msg_ok_10('方案保存成功',4,'ccset.php?default=1&id='.$_REQUEST['nid']);
    }

    //方案设置
    $_ccset['all']  = true;
}else{

    //保存独立设置
    if($_REQUEST['post']){
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

        file_put_contents(CC_SAVE_PATH.$CC_ALONE_TABLE[$type].'conf_'.$type.'_'.$id.'.ccset', serialize($_REQUEST['cc']));

        //独立控制表情况下，设定表名
        switch ($type){
            case 'class_info':
                $_REQUEST['cc']['class_alone_table_name'] = substr($CC_ALONE_TABLE[$type],0,-1);
                break;
            case 'info':
                $_REQUEST['cc']['info_alone_table_name'] = substr($CC_ALONE_TABLE[$type],0,-1);
                break;
        }

        include 'ccaction.php';
        show_msg_ok_10('独立设置已生效',4,$_REQUEST['lasturl']);
    }

    $title = '信息';
    $table = $table_name2;
    $field = 'cn_name';
    if($type=='class_info'){
        $title = '类别';
        $table = $table_name1;
        $field = 'cn_type';
    }

    //独立设置
    switch ($type){
        case 'class_info':
            $_ccset['class']['index'] = true;
            $_ccset['class']['save'] = true;
            $_ccset['class_extend_field'] = true;
            break;
        case 'info':
            $_ccset['info']['index'] = true;
            $_ccset['info']['save'] = true;
            $_ccset['info_extend_field'] = true;
            break;
    }
    $_ccset['alone_ccset'] = true;
    $_ccset['extend_set'] = false;
    $cc_info = array();
    if(is_file(CC_SAVE_PATH.$CC_ALONE_TABLE[$type].'conf_'.$type.'_'.$id.'.ccset')){
        $cc_info = unserialize(file_get_contents(CC_SAVE_PATH.$CC_ALONE_TABLE[$type].'conf_'.$type.'_'.$id.'.ccset'));
    }
}

/* 获取控制方案列表 */
$default_cc_infos = array();
$dh = opendir(CC_SAVE_PATH);
while($fn = readdir($dh)){
    if(substr($fn,0,13)=='conf_default_'){
        $tmpid = str_replace(array('conf_default_','.ccset'), '', $fn);
        $default_cc_infos[$tmpid] = unserialize(file_get_contents(CC_SAVE_PATH.$fn));
        if($tmpid==$id) $cc_info = $default_cc_infos[$tmpid]['cc_info'];
    }
}
closedir($dh);
?>
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


<body style="background:#eee; padding:20px 20px 20px 9px;">
<iframe src="" name="webiframe" style="display:none" frameborder="0"></iframe>
<div class="qbt_nidelikai">
<div class="qbt_shujuguanli">
<?php
if($_REQUEST['default']){
?>
  <span>控制方案<?php echo $id?($default_cc_infos[$id]['name'].'编辑'):'新增'; ?></span>
<?php }else{ ?>
  <span>独立控制(<?php echo $title.': '.show_info($table,$id,'id',$field); ?>)</span>
<?php } ?>
</div>
<div class="qbt_omnissguai">
  
<form action="" target="webiframe" method="post" onsubmit="return check();">
  <table width="100%" border="0" cellpadding="9" cellspacing="0" bgcolor="#ffffff" class="qbt_heniwodsk">
  <?php
  if($_REQUEST['default']){
  ?>
    <tr bgcolor="#FFFFFF">
      <td height="20" align="right" bgcolor="#FFFFFF">方案：</td>
      <td height="20">
        <select name="id" onchange="location.href='ccset.php?default=1&id='+this.value">
            <option value="0">新建方案</option>
            <?php if(!empty($default_cc_infos)){ ?>
            <optgroup label="已有方案">
            <?php foreach($default_cc_infos as $key=>$value){ ?>
            <option value="<?php echo $key; ?>" <?php if($key==$id) echo 'selected="selected"'; ?>><?php echo $value['name']; ?></option>
            <?php } ?>
            </optgroup>
            <?php } ?>
        </select>
        <?php if($id){ ?>
        <a href="?defdel=<?php echo $id; ?>" onclick="return confirm('确定要删除此方案吗？')">[删除此方案]</a>
        <?php } ?>
        <table>
            <tr>
                <td>ID: </td>
                <td><input name="nid" type="text" value="<?php echo $id?$id:''; ?>" /> *英文、数字，用于区别方案和方案保存名称有关，注意唯一性</td>
            </tr>
            <tr>
                <td>名称: </td>
                <td><input name="name" type="text" value="<?php echo $id?$default_cc_infos[$id]['name']:''; ?>" /> *中、英文、数字，用于展示方案选择</td>
            </tr>
        </table>
      </td>
    </tr>
  <?php
  }else{
  ?>
    <?php if(!empty($default_cc_infos)){ ?>
    <tr bgcolor="#FFFFFF">
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
    <tr class="extend_tr" bgcolor="#FFFFFF">
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
  <?php
  }
  ?>
    <?php
        include 'ccform.php';
    ?>
    <tr bgcolor="#FFFFFF">
      <td height="20" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="20">
          <button class="button button_blue" type="submit">保存</button>
          <input name="post" type="hidden" id="post" value="1">
          <input name="id" type="hidden" id="id" value="<?php echo $id;?>">
          <input name="t_action" type="hidden" id="t_action" value="<?php echo $t_action;?>">
          <input type="hidden" name="lasturl" value="<?php echo $_SERVER['HTTP_REFERER']; ?>" />
        </td>
    </tr>
  </table>
</form>
  
</div>
</div>


</body>
</html>