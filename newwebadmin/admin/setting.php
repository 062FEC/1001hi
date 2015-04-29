<?php
    include('../includes/php_conn.php');
    include('../includes/check.php');
    if (!$_SESSION['superadmin']){
        die('未授权');
    }

    //保存设置
    if(isset($_POST['post'])){
        $oldconfig = file_get_contents(CC_SAVE_PATH.'/qbt_admin_config.ccset');
        $qbt_admin_config = array();
        $qbt_admin_config['en_enable'] = isset($_POST['en_enable'])?1:0;
        $qbt_admin_config['del_cat_check_data'] = isset($_POST['del_cat_check_data'])?1:0;
        $qbt_admin_config['admin_list'] = isset($_POST['admin_list'])?1:0;
        $qbt_admin_config['role_list']  = isset($_POST['role_list'])?1:0;
        $qbt_admin_config['atype_m_admin']  = isset($_POST['atype_m_admin'])?1:0;
        $qbt_admin_config['atype_info_m_admin']  = isset($_POST['atype_info_m_admin'])?1:0;
        $qbt_admin_config['qxmenu'] = $_POST['qxmenu']?$_POST['qxmenu']:array();
        $newconfig = serialize($qbt_admin_config);
        file_put_contents(CC_SAVE_PATH.'/qbt_admin_config.ccset', $newconfig);
        $oldconfig!=$newconfig && print('<script type="text/javascript">top.leftFrame.location.reload();</script>');
        show_msg('保存成功', 4, 'setting.php');
    }
?>
<html>
<head>
<title><?php echo $admin_site_title;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/qbt.css" rel="stylesheet" type="text/css">
<script type="text/javascript" charset="utf-8" src="../js/jquery.js"></script>
</head>

<body style="background:#eee; padding:20px 20px 20px 9px;">
<iframe src="" name="webiframe" style="display:none" frameborder="0"></iframe>
<div class="qbt_nidelikai">
<div class="qbt_shujuguanli"> <span>后台设置</span> </div>
<div class="qbt_omnissguai">
  
<form action="" target="webiframe" method="post">
  <table width="100%" border="0" cellpadding="9" cellspacing="0" bgcolor="#ffffff" class="qbt_heniwodsk">

    <tr class="extend_tr" bgcolor="#FFFFFF">
      <td width="120" height="20" align="right" bgcolor="#FFFFFF">启用双语版：</td>
      <td height="20">
        <input type="checkbox" name="en_enable" value="1" <?php $qbt_admin_config['en_enable'] && print('checked="checked"'); ?>>
      </td>
    </tr>

    <tr class="extend_tr" bgcolor="#FFFFFF">
      <td width="120" height="20" align="right" bgcolor="#FFFFFF">分类删除检测数据：</td>
      <td height="20">
        <input type="checkbox" name="del_cat_check_data" value="1" <?php $qbt_admin_config['del_cat_check_data'] && print('checked="checked"'); ?>>
      </td>
    </tr>

    <tr class="extend_tr" bgcolor="#FFFFFF">
      <td width="120" height="20" align="right" bgcolor="#FFFFFF">启用后台用户管理：</td>
      <td height="20">
        <input type="checkbox" name="admin_list" value="1" <?php $qbt_admin_config['admin_list'] && print('checked="checked"'); ?>>
      </td>
    </tr>

    <tr class="extend_tr" bgcolor="#FFFFFF">
      <td width="120" height="20" align="right" bgcolor="#FFFFFF">启用分类区分用户：</td>
      <td height="20">
        <input type="checkbox" name="atype_m_admin" value="1" <?php $qbt_admin_config['atype_m_admin'] && print('checked="checked"'); ?>>
      </td>
    </tr>

    <tr class="extend_tr" bgcolor="#FFFFFF">
      <td width="120" height="20" align="right" bgcolor="#FFFFFF">启用信息区分用户：</td>
      <td height="20">
        <input type="checkbox" name="atype_info_m_admin" value="1" <?php $qbt_admin_config['atype_info_m_admin'] && print('checked="checked"'); ?>>
      </td>
    </tr>

    <tr class="extend_tr" bgcolor="#FFFFFF">
      <td width="120" height="20" align="right" bgcolor="#FFFFFF">启用后台角色管理：</td>
      <td height="20">
        <input type="checkbox" name="role_list" value="1" <?php $qbt_admin_config['role_list'] && print('checked="checked"'); ?>>
      </td>
    </tr>

    <tr class="extend_tr" bgcolor="#FFFFFF">
      <td width="120" height="20" align="right" bgcolor="#FFFFFF">开放权限设置功能：<input type="checkbox" onclick="checkboxall(this.checked)"></td>
      <td height="20">
        <script type="text/javascript">
          function checkboxall(checked){
            if(checked){
              $('.qxmenu_box input[type=checkbox]').prop('checked','checked');
            }else{
              $('.qxmenu_box input[type=checkbox]').attr('checked',false);
            }
          }
          function checksubbox(checked,subname){
            if(checked){
              $('.qxmenu_box input[name^='+subname+']').prop('checked','checked');
            }else{
              $('.qxmenu_box input[name^='+subname+']').attr('checked',false);
            }
          }
          var selcc_info = <?php
            $qxmenu = array();
            $query = mysql_query("SELECT * FROM `atype`");
            while($info = mysql_fetch_assoc($query)){

            }
            $selcc_info = array();
            load_type_cc('atype',0,'',0,'0001',$GLOBALS['level_num'],0);
            echo json_encode($selcc_info);
          ?>;
          var cqxmenu_set_info = <?php
            echo json_encode($qbt_admin_config['qxmenu']);
          ?>;
          function cqxmenu(menuid,menun,type_id,type,setdef){
            var menu = $('#qxmenu_cat_opt_'+menuid+'_'+menun);
            menu.html('');
            if(menuid>0){
              var cc_info = selcc_info[type_id];
              var class_extend_action = true;
              if(typeof(cc_info)=='undefined' || typeof(cc_info.class_extend_action)== 'undefined') class_extend_action=false;
              var info_extend_action = true;
              if(typeof(cc_info)=='undefined' || typeof(cc_info.info_extend_action)== 'undefined') info_extend_action=false;
              var check_str = '';
              var title_str = '';
              //console.log(cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['subclass_add'].check);
              if(
                  (type==0 || type==1)
                  &&
                  (typeof(cc_info['class'])!='undefined')
                  &&
                  (
                    cc_info['class'].subclass_add.status=='show'
                    || cc_info['class'].class_change.status=='show'
                    || cc_info['class'].class_detete.status=='show'
                    || cc_info['class'].info_add.status=='show'
                    || cc_info['class'].info_copy.status=='show'
                    || class_extend_action
                  )
                ){
                menu.append('类别：');
                if(cc_info['class'].class_view.status=='show'){
                  title_str = selcc_info[menuid]['class'].class_view.title;
                  if(setdef==1){
                    check_str='';
                    if(typeof(cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['class_view'])!='undefined'){
                      if(typeof(cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['class_view'].check)!='undefined' && cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['class_view'].check=='on'){
                        check_str='checked="checked"';
                      }
                      title_str=cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['class_view'].text;
                    }
                  }else{
                    check_str='checked="checked"';
                  }
                  menu.append('<input type="checkbox" '+check_str+' name="qxmenu[catmenu_'+menuid+'][sub]['+menun+'][cats][class_view][check]"><input type="text" size="10" name="qxmenu[catmenu_'+menuid+'][sub]['+menun+'][cats][class_view][text]" value="'+title_str+'"> ');
                }
                if(cc_info['class'].subclass_add.status=='show'){
                  title_str = selcc_info[menuid]['class'].subclass_add.title;
                  if(setdef==1){
                    check_str='';
                    if(typeof(cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['subclass_add'])!='undefined'){
                      if(typeof(cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['subclass_add'].check)!='undefined' && cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['subclass_add'].check=='on'){
                        check_str='checked="checked"';
                      }
                      title_str=cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['subclass_add'].text;
                    }
                  }else{
                    check_str='checked="checked"';
                  }
                  menu.append('<input type="checkbox" '+check_str+' name="qxmenu[catmenu_'+menuid+'][sub]['+menun+'][cats][subclass_add][check]"><input type="text" size="10" name="qxmenu[catmenu_'+menuid+'][sub]['+menun+'][cats][subclass_add][text]" value="'+title_str+'"> ');
                }
                if(cc_info['class'].class_change.status=='show'){
                  title_str = selcc_info[menuid]['class'].class_change.title;
                  if(setdef==1){
                    check_str='';
                    if(typeof(cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['class_change'])!='undefined'){
                      if(typeof(cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['class_change'].check)!='undefined' && cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['class_change'].check=='on'){
                        check_str='checked="checked"';
                      }
                      title_str=cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['class_change'].text;
                    }
                  }else{
                    check_str='checked="checked"';
                  }
                  menu.append('<input type="checkbox" '+check_str+' name="qxmenu[catmenu_'+menuid+'][sub]['+menun+'][cats][class_change][check]"><input type="text" size="10" name="qxmenu[catmenu_'+menuid+'][sub]['+menun+'][cats][class_change][text]" value="'+title_str+'"> ');
                }
                if(cc_info['class'].class_detete.status=='show'){
                  title_str = selcc_info[menuid]['class'].class_detete.title;
                  if(setdef==1){
                    check_str='';
                    if(typeof(cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['class_detete'])!='undefined'){
                      if(typeof(cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['class_detete'].check)!='undefined' && cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['class_detete'].check=='on'){
                        check_str='checked="checked"';
                      }
                      title_str=cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['class_detete'].text;
                    }
                  }else{
                    check_str='checked="checked"';
                  }
                  menu.append('<input type="checkbox" '+check_str+' name="qxmenu[catmenu_'+menuid+'][sub]['+menun+'][cats][class_detete][check]"><input type="text" size="10" name="qxmenu[catmenu_'+menuid+'][sub]['+menun+'][cats][class_detete][text]" value="'+title_str+'"> ');
                }
                if(cc_info['class'].info_add.status=='show'){
                  title_str = selcc_info[menuid]['class'].info_add.title;
                  if(setdef==1){
                    check_str='';
                    if(typeof(cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['info_add'])!='undefined'){
                      if(typeof(cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['info_add'].check)!='undefined' && cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['info_add'].check=='on'){
                        check_str='checked="checked"';
                      }
                      title_str=cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['info_add'].text;
                    }
                  }else{
                    check_str='checked="checked"';
                  }
                  menu.append('<input type="checkbox" '+check_str+' name="qxmenu[catmenu_'+menuid+'][sub]['+menun+'][cats][info_add][check]"><input type="text" size="10" name="qxmenu[catmenu_'+menuid+'][sub]['+menun+'][cats][info_add][text]" value="'+title_str+'"> ');
                }
                if(cc_info['class'].info_copy.status=='show'){
                  title_str = selcc_info[menuid]['class'].info_copy.title;
                  if(setdef==1){
                    check_str='';
                    if(typeof(cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['info_copy'])!='undefined'){
                      if(typeof(cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['info_copy'].check)!='undefined' && cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['info_copy'].check=='on'){
                        check_str='checked="checked"';
                      }
                      title_str=cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['info_copy'].text;
                    }
                  }else{
                    check_str='checked="checked"';
                  }
                  menu.append('<input type="checkbox" '+check_str+' name="qxmenu[catmenu_'+menuid+'][sub]['+menun+'][cats][info_copy][check]"><input type="text" size="10" name="qxmenu[catmenu_'+menuid+'][sub]['+menun+'][cats][info_copy][text]" value="'+selcc_info[menuid]['class'].info_copy.title+'"> ');
                }
                if(class_extend_action){
                  for(var t in cc_info.class_extend_action){
                    if(cc_info.class_extend_action[t].status=='show'){
                      title_str = cc_info.class_extend_action[t].title;
                      if(setdef==1){
                        check_str='';
                        if(typeof(cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats'][cc_info.class_extend_action[t].title])!='undefined'){
                          if(typeof(cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats'][cc_info.class_extend_action[t].title].check)!='undefined' && cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats'][cc_info.class_extend_action[t].title].check=='on'){
                            check_str='checked="checked"';
                          }
                          title_str = cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats'][cc_info.class_extend_action[t].title].text;
                        }
                      }else{
                        check_str='checked="checked"';
                      }
                      menu.append('<input type="checkbox" '+check_str+' name="qxmenu[catmenu_'+menuid+'][sub]['+menun+'][cats]['+cc_info.class_extend_action[t].title+'][check]"><input type="text" size="10" name="qxmenu[catmenu_'+menuid+'][sub]['+menun+'][cats]['+cc_info.class_extend_action[t].title+'][text]" value="'+title_str+'"> ');
                    }
                  }
                }
                menu.append('<br/>');
              }

              if(
                  (type==0 || type==2)
                  &&
                  (typeof(cc_info.info_list)!='undefined')
                  &&
                  (
                    cc_info.info_list.batch_action.status=='show'
                    || cc_info.info_list.info_copy.status=='show'
                    || cc_info.info_list.info_change.status=='show'
                    || cc_info.info_list.info_detete.status=='show'
                    || info_extend_action
                  )
                ){
                menu.append('信息：');
                if(cc_info.info_list.info_view.status=='show'){
                  title_str = selcc_info[menuid].info_list.info_view.title;
                  if(setdef==1){
                    check_str='';
                    if(typeof(cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['info_view'])!='undefined'){
                      if(typeof(cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['info_view'].check)!='undefined' && cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['info_view'].check=='on'){
                        check_str='checked="checked"';
                      }
                      title_str = cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['info_view'].text;
                    }
                  }else{
                    check_str='checked="checked"';
                  }
                  menu.append('<input type="checkbox" '+check_str+' name="qxmenu[catmenu_'+menuid+'][sub]['+menun+'][cats][info_view][check]"><input type="text" size="10" name="qxmenu[catmenu_'+menuid+'][sub]['+menun+'][cats][info_view][text]" value="'+title_str+'"> ');
                }
                if(cc_info.info_list.info_copy.status=='show'){
                  title_str = selcc_info[menuid].info_list.info_copy.title;
                  if(setdef==1){
                    check_str='';
                    if(typeof(cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['info_copy'])!='undefined'){
                      if(typeof(cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['info_copy'].check)!='undefined' && cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['info_copy'].check=='on'){
                        check_str='checked="checked"';
                      }
                      title_str = cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['info_copy'].text;
                    }
                  }else{
                    check_str='checked="checked"';
                  }
                  menu.append('<input type="checkbox" '+check_str+' name="qxmenu[catmenu_'+menuid+'][sub]['+menun+'][cats][info_copy][check]"><input type="text" size="10" name="qxmenu[catmenu_'+menuid+'][sub]['+menun+'][cats][info_copy][text]" value="'+title_str+'"> ');
                }
                if(cc_info.info_list.info_change.status=='show'){
                  title_str = selcc_info[menuid].info_list.info_change.title;
                  if(setdef==1){
                    check_str='';
                    if(typeof(cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['info_change'])!='undefined'){
                      if(typeof(cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['info_change'].check)!='undefined' && cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['info_change'].check=='on'){
                        check_str='checked="checked"';
                      }
                      title_str = cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['info_change'].text;
                    }
                  }else{
                    check_str='checked="checked"';
                  }
                  menu.append('<input type="checkbox" '+check_str+' name="qxmenu[catmenu_'+menuid+'][sub]['+menun+'][cats][info_change][check]"><input type="text" size="10" name="qxmenu[catmenu_'+menuid+'][sub]['+menun+'][cats][info_change][text]" value="'+title_str+'"> ');
                }
                if(cc_info.info_list.info_detete.status=='show'){
                  title_str = selcc_info[menuid].info_list.info_detete.title;
                  if(setdef==1){
                    check_str='';
                    if(typeof(cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['info_detete'])!='undefined'){
                      if(typeof(cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['info_detete'].check)!='undefined' && cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['info_detete'].check=='on'){
                        check_str='checked="checked"';
                      }
                      title_str = cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats']['info_detete'].text;
                    }
                  }else{
                    check_str='checked="checked"';
                  }
                  menu.append('<input type="checkbox" checked="checked" name="qxmenu[catmenu_'+menuid+'][sub]['+menun+'][cats][info_detete][check]"><input type="text" size="10" name="qxmenu[catmenu_'+menuid+'][sub]['+menun+'][cats][info_detete][text]" value="'+title_str+'"> ');
                }
                if(info_extend_action){
                  for(var t in cc_info.info_extend_action){
                    if(cc_info.info_extend_action[t].status=='show'){
                      title_str = cc_info.info_extend_action[t].title;
                      if(setdef==1){
                        check_str='';
                        if(typeof(cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats'][cc_info.info_extend_action[t].title])!='undefined'){
                          if(typeof(cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats'][cc_info.info_extend_action[t].title].check)!='undefined' && cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats'][cc_info.info_extend_action[t].title].check=='on'){
                            check_str='checked="checked"';
                          }
                          title_str = cqxmenu_set_info['catmenu_'+menuid].sub[menun]['cats'][cc_info.info_extend_action[t].title].text;
                        }
                      }else{
                        check_str='checked="checked"';
                      }
                      menu.append('<input type="checkbox" checked="checked" name="qxmenu[catmenu_'+menuid+'][sub]['+menun+'][cats]['+cc_info.info_extend_action[t].title+'][check]"><input type="text" size="10" name="qxmenu[catmenu_'+menuid+'][sub]['+menun+'][cats]['+cc_info.info_extend_action[t].title+'][text]" value="'+title_str+'"> ');
                    }
                  }
                }
                menu.append('<br/>');
              }
            }
          }

          function csubcatscusqx(idbox,namebox){
            $('#'+idbox).append('<div>[<a href="javascript:;" onclick="$(this).parent().remove();">删</a>]<input type="text" size="10" name="'+namebox+'" value=""></div>');
          }
        </script>
        <style type="text/css">
          .qxmenu_box input{ vertical-align: middle }
          .qxmenu_box li{ line-height:25px; }
          .qxmenu_box fieldset{ border: #ccc 1px solid; }
        </style>
        <div class="qxmenu_box" style="overflow:auto;">
            <ul>
                <li><input type="checkbox" <?php if($qbt_admin_config['qxmenu']['admin_user']['check']){ ?>checked="checked"<?php } ?> name="qxmenu[admin_user][check]" onclick="checksubbox(this.checked,'qxmenu\\[admin_user\\]');"><input type="text" name="qxmenu[admin_user][text]" value="<?php echo $qbt_admin_config['qxmenu']['admin_user']['text']?$qbt_admin_config['qxmenu']['admin_user']['text']:'后台用户管理'; ?>"></li>
                <li><input type="checkbox" <?php if($qbt_admin_config['qxmenu']['admin_user']['sub']['user_list']['check']){ ?>checked="checked"<?php } ?> name="qxmenu[admin_user][sub][user_list][check]" onclick="checksubbox(this.checked,'qxmenu\\[admin_user\\]\\[sub\\]\\[user_list\\]');">  ┣<input type="text" name="qxmenu[admin_user][sub][user_list][text]" value="<?php echo $qbt_admin_config['qxmenu']['admin_user']['sub']['user_list']['text']?$qbt_admin_config['qxmenu']['admin_user']['sub']['user_list']['text']:'管理员列表'; ?>"></li>
                <li>&nbsp; &nbsp; <input type="checkbox" <?php if($qbt_admin_config['qxmenu']['admin_user']['sub']['user_list']['cats']['edit']['check']){ ?>checked="checked"<?php } ?> name="qxmenu[admin_user][sub][user_list][cats][edit][check]"><input type="text" size="10" name="qxmenu[admin_user][sub][user_list][cats][edit][text]" value="<?php echo $qbt_admin_config['qxmenu']['admin_user']['sub']['user_list']['cats']['edit']['text']?$qbt_admin_config['qxmenu']['admin_user']['sub']['user_list']['cats']['edit']['text']:'修改'; ?>"> <input type="checkbox" <?php if($qbt_admin_config['qxmenu']['admin_user']['sub']['user_list']['cats']['del']['check']){ ?>checked="checked"<?php } ?> name="qxmenu[admin_user][sub][user_list][cats][del][check]"><input type="text" size="10" name="qxmenu[admin_user][sub][user_list][cats][del][text]" value="<?php echo $qbt_admin_config['qxmenu']['admin_user']['sub']['user_list']['cats']['del']['text']?$qbt_admin_config['qxmenu']['admin_user']['sub']['user_list']['cats']['del']['text']:'删除'; ?>"></li>
                <li><input type="checkbox" <?php if($qbt_admin_config['qxmenu']['admin_user']['sub']['user_add']['check']){ ?>checked="checked"<?php } ?> name="qxmenu[admin_user][sub][user_add][check]">  ┣<input type="text" name="qxmenu[admin_user][sub][user_add][text]" value="<?php echo $qbt_admin_config['qxmenu']['admin_user']['sub']['user_add']['text']?$qbt_admin_config['qxmenu']['admin_user']['sub']['user_add']['text']:'管理员添加'; ?>"></li>
                <li><input type="checkbox" <?php if($qbt_admin_config['qxmenu']['admin_user']['sub']['role_list']['check']){ ?>checked="checked"<?php } ?> name="qxmenu[admin_user][sub][role_list][check]" onclick="checksubbox(this.checked,'qxmenu\\[admin_user\\]\\[sub\\]\\[role_list\\]');">  ┣<input type="text" name="qxmenu[admin_user][sub][role_list][text]" value="<?php echo $qbt_admin_config['qxmenu']['admin_user']['sub']['role_list']['text']?$qbt_admin_config['qxmenu']['admin_user']['sub']['role_list']['text']:'角色管理'; ?>"></li>
                <li>&nbsp; &nbsp; <input type="checkbox" <?php if($qbt_admin_config['qxmenu']['admin_user']['sub']['role_list']['cats']['edit']['check']){ ?>checked="checked"<?php } ?> name="qxmenu[admin_user][sub][role_list][cats][edit][check]"><input type="text" size="10" name="qxmenu[admin_user][sub][role_list][cats][edit][text]" value="修改"> <input type="checkbox" <?php if($qbt_admin_config['qxmenu']['admin_user']['sub']['role_list']['cats']['del']['check']){ ?>checked="checked"<?php } ?> name="qxmenu[admin_user][sub][role_list][cats][del][check]"><input type="text" size="10" name="qxmenu[admin_user][sub][role_list][cats][del][text]" value="删除"></li>
                <li><input type="checkbox" <?php if($qbt_admin_config['qxmenu']['admin_user']['sub']['role_add']['check']){ ?>checked="checked"<?php } ?> name="qxmenu[admin_user][sub][role_add][check]">  ┣<input type="text" name="qxmenu[admin_user][sub][role_add][text]" value="<?php echo $qbt_admin_config['qxmenu']['admin_user']['sub']['role_add']['text']?$qbt_admin_config['qxmenu']['admin_user']['sub']['role_add']['text']:'角色添加'; ?>"></li>

                <?php
                  $manage_id_array = '0';
                  if(is_file(CC_SAVE_PATH.'conf_showmenu.ccset')){
                    $manage_id_array = implode(',',unserialize(file_get_contents(CC_SAVE_PATH.'conf_showmenu.ccset')));
                  }
                  $manage_id_v = explode(',',$manage_id_array);
                  for ($ia = 0; $ia < count($manage_id_v); $ia++)
                  {
                    $manage_id_vv = $manage_id_v[$ia];
                    if ($manage_id_vv)
                    {
                        $sql = 'select * from atype where id = '.$manage_id_vv;
                        $result = mysql_query($sql,$conn);
                        $rs = mysql_fetch_array($result);

                        //不存在菜单掠过
                        if(!$rs) continue;

                        $cc_info = array();
                        if(is_file(CC_SAVE_PATH.'conf_'.$manage_id_vv.'.ccset')){
                          $cc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_'.$manage_id_vv.'.ccset'));
                        }

                        $manage_id = $manage_id_vv;
                ?>
                <li style="margin-top:20px;"><input type="checkbox" <?php if($qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['check']){ ?>checked="checked"<?php } ?> name="qxmenu[catmenu_<?php echo $rs['id']; ?>][check]" onclick="checksubbox(this.checked,'qxmenu\\[catmenu_<?php echo $rs['id']; ?>\\]');"><input type="text" name="qxmenu[catmenu_<?php echo $rs['id']; ?>][text]" value="<?php echo $qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['text']?$qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['text']:$rs['cn_type']; ?>"></li>
                <?php  if($cc_info['menu']['class_list']['status']!='hide'){ ?>
                <li><input type="checkbox" <?php if($qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['class_list']['check']){ ?>checked="checked"<?php } ?> name="qxmenu[catmenu_<?php echo $rs['id']; ?>][sub][class_list][check]" onclick="checksubbox(this.checked,'qxmenu\\[catmenu_<?php echo $rs['id']; ?>\\]\\[sub\\]\\[class_list\\]');">  ┣<input type="text" name="qxmenu[catmenu_<?php echo $rs['id']; ?>][sub][class_list][text]" value="<?php echo $qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['class_list']['text']?$qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['class_list']['text']:(empty($cc_info['menu']['class_list']['title'])?'类别管理':$cc_info['menu']['class_list']['title']); ?>"></li>
                <li style="line-height:20px;padding-left:23px">
                  <fieldset>
                    <legend>
                      关联类目：
                      <select id="qxmenu_cat_sel_<?php echo $rs['id']; ?>_class_list" name="qxmenu[catmenu_<?php echo $rs['id']; ?>][sub][class_list][cat]" onchange="cqxmenu(<?php echo $rs['id']; ?>,'class_list',this.value,1,0)">
                        <option value="0">无</option>
                        <?php
                          if($qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['class_list']['cat']){
                            show_type('atype',0,'',$qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['class_list']['cat'],'0001',$GLOBALS['level_num'],0,1);
                          }else{
                            show_type('atype',0,'',0,'0001',$GLOBALS['level_num'],0,1);
                          }
                        ?>
                      </select>
                    </legend>
                    <div id="qxmenu_cat_opt_<?php echo $rs['id']; ?>_class_list"></div>
                    <?php
                      if($qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['class_list']['cat']){
                    ?>
                    <script type="text/javascript">cqxmenu(<?php echo $rs['id']; ?>,'class_list',<?php echo $qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['class_list']['cat']; ?>,1,1)</script>
                    <?php
                      }
                    ?>
                    <div id="qxmenu_cat_cusopt_<?php echo $rs['id']; ?>_class_list">
                      自定义：[<a href="javascript:;" onclick="csubcatscusqx('qxmenu_cat_cusopt_<?php echo $rs['id']; ?>_class_list','qxmenu[catmenu_<?php echo $rs['id']; ?>][sub][class_list][custom][]')">添加</a>]
                      <?php
                        if($qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['class_list']['custom']){
                          foreach ($qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['class_list']['custom'] as $key => $value) {
                      ?>
                        <div>[<a href="javascript:;" onclick="$(this).parent().remove();">删</a>]<input type="text" size="10" name="qxmenu[catmenu_<?php echo $rs['id']; ?>][sub][class_list][custom][]" value="<?php echo $value; ?>"></div>
                      <?php
                          }
                      }
                      ?>
                    </div>
                  </fieldset>
                </li>
                <?php } ?>
                <?php if($cc_info['menu']['class_add']['status']!='hide'){ ?>
                <li><input type="checkbox" <?php if($qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['class_add']['check']){ ?>checked="checked"<?php } ?> name="qxmenu[catmenu_<?php echo $rs['id']; ?>][sub][class_add][check]">  ┣<input type="text" name="qxmenu[catmenu_<?php echo $rs['id']; ?>][sub][class_add][text]" value="<?php echo $qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['class_add']['text']?$qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['class_add']['text']:(empty($cc_info['menu']['class_add']['title'])?'类别添加':$cc_info['menu']['class_add']['title']); ?>"></li>
                <?php } ?>
                <?php if($cc_info['menu']['info_list']['status']!='hide'){ ?>
                <li><input type="checkbox" <?php if($qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['info_list']['check']){ ?>checked="checked"<?php } ?> name="qxmenu[catmenu_<?php echo $rs['id']; ?>][sub][info_list][check]" onclick="checksubbox(this.checked,'qxmenu\\[catmenu_<?php echo $rs['id']; ?>\\]\\[sub\\]\\[info_list\\]');">  ┣<input type="text" name="qxmenu[catmenu_<?php echo $rs['id']; ?>][sub][info_list][text]" value="<?php echo $qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['info_list']['text']?$qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['info_list']['text']:(empty($cc_info['menu']['info_list']['title'])?'信息管理':$cc_info['menu']['info_list']['title']); ?>"></li>
                <li style="line-height:20px;padding-left:23px">
                  <fieldset>
                    <legend>
                      关联类目：
                      <select id="qxmenu_cat_sel_<?php echo $rs['id']; ?>_info_list" name="qxmenu[catmenu_<?php echo $rs['id']; ?>][sub][info_list][cat]" onchange="cqxmenu(<?php echo $rs['id']; ?>,'info_list',this.value,2,0)">
                        <option value="0">无</option>
                        <?php
                          if($qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['info_list']['cat']){
                            show_type('atype',0,'',$qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['info_list']['cat'],'0001',$GLOBALS['level_num'],0,1);
                          }else{
                            show_type('atype',0,'',0,'0001',$GLOBALS['level_num'],0,1);
                          }
                        ?>
                      </select>
                    </legend>
                    <div id="qxmenu_cat_opt_<?php echo $rs['id']; ?>_info_list"></div>
                    <?php
                      if($qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['info_list']['cat']){
                    ?>
                    <script type="text/javascript">cqxmenu(<?php echo $rs['id']; ?>,'info_list',<?php echo $qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['info_list']['cat']; ?>,2,1)</script>
                    <?php
                      }
                    ?>
                    <div id="qxmenu_cat_cusopt_<?php echo $rs['id']; ?>_info_list">
                      自定义：[<a href="javascript:;" onclick="csubcatscusqx('qxmenu_cat_cusopt_<?php echo $rs['id']; ?>_info_list','qxmenu[catmenu_<?php echo $rs['id']; ?>][sub][info_list][custom][]')">添加</a>]
                      <?php
                        if($qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['info_list']['custom']){
                          foreach ($qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['info_list']['custom'] as $key => $value) {
                      ?>
                        <div>[<a href="javascript:;" onclick="$(this).parent().remove();">删</a>]<input type="text" size="10" name="qxmenu[catmenu_<?php echo $rs['id']; ?>][sub][info_list][custom][]" value="<?php echo $value; ?>"></div>
                      <?php
                          }
                      }
                      ?>
                    </div>
                  </fieldset>
                </li>
                <?php } ?>
                <?php if($cc_info['menu']['info_add']['status']!='hide'){ ?>
                <li><input type="checkbox" <?php if($qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['info_add']['check']){ ?>checked="checked"<?php } ?> name="qxmenu[catmenu_<?php echo $rs['id']; ?>][sub][info_add][check]">  ┣<input type="text" name="qxmenu[catmenu_<?php echo $rs['id']; ?>][sub][info_add][text]" value="<?php echo $qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['info_add']['text']?$qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['info_add']['text']:(empty($cc_info['menu']['info_add']['title'])?'信息添加':$cc_info['menu']['info_add']['title']); ?>"></li>
                <?php } ?>
                <?php
                      if(!empty($cc_info['extend_menu'])){
                        foreach($cc_info['extend_menu'] as $key=>$val){
                          if($val['name'] && $val['url'] && $val['status']=='show'){
                ?>
                <li><input type="checkbox" <?php if($qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub'][$val['name']]['check']){ ?>checked="checked"<?php } ?> name="qxmenu[catmenu_<?php echo $rs['id']; ?>][sub][<?php echo $val['name']; ?>][check]" onclick="checksubbox(this.checked,'qxmenu\\[catmenu_<?php echo $rs['id']; ?>\\]\\[sub\\]\\[<?php echo $val['name']; ?>\\]');">  ┣<input type="text" name="qxmenu[catmenu_<?php echo $rs['id']; ?>][sub][<?php echo $val['name']; ?>][text]" value="<?php echo $qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub'][$val['name']]['text']?$qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub'][$val['name']]['text']:$val['name']; ?>"></li>
                <li style="line-height:20px;padding-left:23px">
                  <fieldset>
                    <legend>
                      关联类目：
                      <select id="qxmenu_cat_sel_<?php echo $rs['id']; ?>_<?php echo $val['name']; ?>" name="qxmenu[catmenu_<?php echo $rs['id']; ?>][sub][<?php echo $val['name']; ?>][cat]" onchange="cqxmenu(<?php echo $rs['id']; ?>,'<?php echo $val['name']; ?>',this.value,0,0)">
                        <option value="0">无</option>
                        <?php
                          if($qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['info_list']['cat']){
                            show_type('atype',0,'',$qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['info_list']['cat'],'0001',$GLOBALS['level_num'],0,1);
                          }else{
                            show_type('atype',0,'',0,'0001',$GLOBALS['level_num'],0,1);
                          }
                        ?>
                      </select>
                    </legend>
                    <div id="qxmenu_cat_opt_<?php echo $rs['id']; ?>_<?php echo $val['name']; ?>"></div>
                    <?php
                      if($qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub']['info_list']['cat']){
                    ?>
                    <script type="text/javascript">cqxmenu(<?php echo $rs['id']; ?>,'<?php echo $val['name']; ?>',<?php echo $qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub'][$val['name']]['cat']; ?>,0,1)</script>
                    <?php
                      }
                    ?>
                    <div id="qxmenu_cat_cusopt_<?php echo $rs['id']; ?>_<?php echo $val['name']; ?>">
                      自定义：[<a href="javascript:;" onclick="csubcatscusqx('qxmenu_cat_cusopt_<?php echo $rs['id']; ?>_<?php echo $val['name']; ?>','qxmenu[catmenu_<?php echo $rs['id']; ?>][sub][<?php echo $val['name']; ?>][custom][]')">添加</a>]
                      <?php
                        if($qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub'][$val['name']]['custom']){
                          foreach ($qbt_admin_config['qxmenu']['catmenu_'.$rs['id']]['sub'][$val['name']]['custom'] as $key => $value) {
                      ?>
                        <div>[<a href="javascript:;" onclick="$(this).parent().remove();">删</a>]<input type="text" size="10" name="qxmenu[catmenu_<?php echo $rs['id']; ?>][sub][<?php echo $val['name']; ?>][custom][]" value="<?php echo $value; ?>"></div>
                      <?php
                          }
                      }
                      ?>
                    </div>
                  </fieldset>
                </li>
                <?php
                          }
                        }
                      }
                ?>
                <?php
                    }
                  }
                ?>
            </ul>
        </div>
      </td>
    </tr>

    <tr bgcolor="#FFFFFF">
      <td height="20" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="20">
          <button class="button button_blue" type="submit" name="post">保存</button>
        </td>
    </tr>
  </table>
</form>
  
</div>
</div>


</body>
</html>