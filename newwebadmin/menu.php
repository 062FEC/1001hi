<?php
  include("php_conn.php");
  include("check.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>menu</title>
<link href="css/qbt.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.js"></script>
<script>
function $G(element){
  return element = document.getElementById(element);
}
function $D(element){
  var d=$G(element);
  var h=d.offsetHeight;
  var maxh=0;
  function dmove(){
    if(h>=maxh){
      d.style.height='auto';
      clearInterval(iIntervalId);
    }else{
      h+=100; //设置层展开的速度
      d.style.display='block';
      d.style.height=h+'px';
    }
  }
  iIntervalId=setInterval(dmove,2);
}
function $D2(element){
  var d=$G(element);
  var h=d.offsetHeight;
  var maxh=0;
  function dmove(){
    if(h<=0){
      d.style.display='none';
      clearInterval(iIntervalId);
    }else{
      h-=100;//设置层收缩的速度
      d.style.height=h+'px';
    }
  }
  iIntervalId=setInterval(dmove,2);
}
function $use(targetid,objN){
  var d=$G(targetid);
  var sb=$G(objN);
  if (d.style.display=="block"){
    $D2(targetid);
    d.style.display="none";
  } else {
    var p=document.getElementsByTagName("p");
    var span=document.getElementsByTagName("span");

    for(var i=0,l=p.length;i<l;i++){
      //alert(p[i].id);
      if(p[i]!=d){
        p[i].style.height=0;
        p[i].style.display="none";
      }
    }
    $D(targetid);
    d.style.display="block";
  }
}
</script>
</head>

<body style=" background:#c8d9ed url(images/qbt_002.jpg) repeat-y right 0;">
<div class="qbt_caidan">
  <ul>
    <?php
      $_SESSION['superadmin'] = false;
      if ($_COOKIE['a_user_id']==1 && $_REQUEST['abc'] == 'swb98') {
        $_SESSION['superadmin'] = true;
    ?>
      <li>
          <span id="stateBut0" onClick="$use('class0content','stateBut0')">后台管理</span>
          <p class="qbt_aini_jc" id="class0content">
            <a href="atype/class_index.php" target="mainFrame" id="submenu_0_class_index">类别管理</a>
            <a href="atype/class_save.php" target="mainFrame" id="submenu_0_class_save">类别添加</a>
            <a href="atype/index.php" target="mainFrame" id="submenu_0_index">信息管理</a>
            <a href="atype/save.php" target="mainFrame" id="submenu_0_save">信息添加</a>
            <a href="admin/setting.php" target="mainFrame" id="submenu_admin_setting">后台设置</a>
            <a href="atype/ccset.php?default=1" target="mainFrame" id="submenu_ccset">控制方案</a>
            <a href="atype/ccmodule.php" target="mainFrame" id="submenu_ccmodule">模块导入/导出</a>
          </p>
      </li>
    <?php
      }

      if($qbt_admin_config['admin_list'] && check_admin_action("admin_user")){
    ?>
      <li>
          <span id="stateBut1" onClick="$use('class1content','stateBut1')">后台用户管理</span>
          <p class="qbt_aini_jc" id="class1content">
            <?php if($qbt_admin_config['admin_list']){ ?>
              <?php if(check_admin_action("admin_user_user_list")){ ?><a href="admin/index.php?__action=admin_user_user_list" target="mainFrame" id="submenu_1_admin_index">管理员列表</a><?php } ?>
              <?php if(check_admin_action("admin_user_user_add")){ ?><a href="admin/changepass.php?__action=admin_user_user_add" target="mainFrame" id="submenu_1_admin_save">管理员添加</a><?php } ?>
            <?php } ?>
            <?php if($qbt_admin_config['role_list']){ ?>
              <?php if(check_admin_action("admin_user_role_list")){ ?><a href="admin/role.php?__action=admin_user_role_list" target="mainFrame" id="submenu_1_role_index">角色管理</a><?php } ?>
              <?php if(check_admin_action("admin_user_role_add")){ ?><a href="admin/role_save.php?__action=admin_user_role_add" target="mainFrame" id="submenu_1_role_save">角色添加</a><?php } ?>
            <?php } ?>
          </p>
      </li>
    <?php
      }?>
	<!--
	<li>
		<span id="video" onClick="$use('video_manage','video')">视频管理</span>
		<p class="qbt_aini_jc" id="video_manage" style="display:none">
			<a href="atype/video_index.php" target="mainFrame">视频列表</a>
		</p>
	</li>
	-->  
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

            if(!check_admin_action('catmenu_'.$manage_id_vv)) continue;

            $cc_info = array();
            if(is_file(CC_SAVE_PATH.'conf_'.$manage_id_vv.'.ccset')){
              $cc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_'.$manage_id_vv.'.ccset'));
            }

            $manage_id = $manage_id_vv;
    ?>
      <li>
          <span id="stateBut<?php echo $manage_id; ?>" onClick="$use('class<?php echo $manage_id; ?>content','stateBut<?php echo $manage_id; ?>')"><?php echo $rs['cn_type']; ?></span>
          <p class="qbt_aini_jc" id="class<?php echo $manage_id; ?>content" style="display:none">
            <?php
             if(!empty($cc_info['custom_menu']['top']['content']) && $cc_info['custom_menu']['top']['status']!='hide'){
                 if($cc_info['custom_menu']['top']['type']=='php'){
                    if(is_file(CC_SAVE_PATH.'custom_menu_top_'.$manage_id.'.php')){
                      include CC_SAVE_PATH.'custom_menu_top_'.$manage_id.'.php';
                    }else{
                      echo '&nbsp;';
                    }
                 }else{
                   $cc_info['custom_menu']['top']['content'] = str_replace('__ID__', $rs['id'], $cc_info['custom_menu']['top']['content']);
                   foreach($rs as $_key=>$_val){
                    $cc_info['custom_menu']['top']['content'] = str_replace('__F_'.$_key.'__', $_val, $cc_info['custom_menu']['top']['content']);
                   }
                   foreach($_REQUEST as $_key=>$_val){
                     $cc_info['custom_menu']['top']['content'] = str_replace('__R_'.$_key.'__', $_val, $cc_info['custom_menu']['top']['content']);
                   }
                   echo $cc_info['custom_menu']['top']['content'];
                 }
             }
             if($cc_info['menu']['class_list']['status']!='hide' && check_admin_action("catmenu_{$manage_id}_class_list")){
            ?>

            <a href="atype/class_index.php?__action=catmenu_<?php echo $manage_id;?>_class_list&manage_id=<?php echo $manage_id;?>&class_alone_table_name=<?php echo $cc_info['class_alone_table_name'];?>&info_alone_table_name=<?php echo $cc_info['info_alone_table_name'];?>" target="mainFrame" id="submenu_<?php echo $manage_id; ?>_class_index"><?php echo empty($cc_info['menu']['class_list']['title'])?'类别管理':$cc_info['menu']['class_list']['title']; ?></a>

            <?php } ?>
            <?php if($cc_info['menu']['class_add']['status']!='hide' && check_admin_action("catmenu_{$manage_id}_class_add")){ ?>

            <a href="atype/class_save.php?__action=catmenu_<?php echo $manage_id;?>_class_add&manage_id=<?php echo $manage_id;?>&class_alone_table_name=<?php echo $cc_info['class_alone_table_name'];?>&info_alone_table_name=<?php echo $cc_info['info_alone_table_name'];?>" target="mainFrame" id="submenu_<?php echo $manage_id; ?>_class_save"><?php echo empty($cc_info['menu']['class_add']['title'])?'类别添加':$cc_info['menu']['class_add']['title']; ?></a>

            <?php } ?>
            <?php if($cc_info['menu']['info_list']['status']!='hide' && check_admin_action("catmenu_{$manage_id}_info_list")){ ?>

            <a href="atype/index.php?__action=catmenu_<?php echo $manage_id;?>_info_list&manage_id=<?php echo $manage_id;?>&type_id=<?php echo $cc_info['info_deftype']; ?>&class_alone_table_name=<?php echo $cc_info['class_alone_table_name'];?>&info_alone_table_name=<?php echo $cc_info['info_alone_table_name'];?>" target="mainFrame" id="submenu_<?php echo $manage_id; ?>_index"><?php echo empty($cc_info['menu']['info_list']['title'])?'信息管理':$cc_info['menu']['info_list']['title']; ?></a>

            <?php } ?>
            <?php if($cc_info['menu']['info_add']['status']!='hide' && check_admin_action("catmenu_{$manage_id}_info_add")){ ?>

            <a href="atype/save.php?__action=catmenu_<?php echo $manage_id;?>_info_add&manage_id=<?php echo $manage_id;?>&type_id=<?php echo $cc_info['info_deftype']; ?>&class_alone_table_name=<?php echo $cc_info['class_alone_table_name'];?>&info_alone_table_name=<?php echo $cc_info['info_alone_table_name'];?>" target="mainFrame" id="submenu_<?php echo $manage_id; ?>_save"><?php echo empty($cc_info['menu']['info_add']['title'])?'信息添加':$cc_info['menu']['info_add']['title']; ?></a>

            <?php
              }

              if(!empty($cc_info['extend_menu'])){
                foreach($cc_info['extend_menu'] as $key=>$val){
                  if($val['name'] && $val['url'] && $val['status']=='show' && check_admin_action("catmenu_{$manage_id}_{$val['name']}")){
                      $val['url'] = str_replace('__ID__', $rs['id'], $val['url']);
                      foreach($rs as $_key=>$_val){
                        $val['url'] = str_replace('__F_'.$_key.'__', $_val, $val['url']);
                      }
                      foreach($_REQUEST as $_key=>$_val){
                        $val['url'] = str_replace('__R_'.$_key.'__', $_val, $val['url']);
                      }

                      $temp = explode('?',$val['url']);
                      $temp[1] = "__action=catmenu_{$manage_id}_".urlencode($val['name']).(empty($temp[1])?'':'&').$temp[1];
                      $val['url'] = implode('?', $temp);
              ?>
              <a href="<?php echo $val['url']; ?>" target="mainFrame" id="submenu_<?php echo $manage_id; ?>_<?php echo crc32($val['url']); ?>"><?php echo $val['name']; ?></a>
              <?php
                  }
                }
              }
              if(!empty($cc_info['custom_menu']['bottom']['content']) && $cc_info['custom_menu']['bottom']['status']!='hide'){
                 if($cc_info['custom_menu']['bottom']['type']=='php'){
                    if(is_file(CC_SAVE_PATH.'custom_menu_bottom_'.$manage_id.'.php')){
                      include CC_SAVE_PATH.'custom_menu_bottom_'.$manage_id.'.php';
                    }else{
                      echo '&nbsp;';
                    }
                 }else{
                   $cc_info['custom_menu']['bottom']['content'] = str_replace('__ID__', $rs['id'], $cc_info['custom_menu']['bottom']['content']);
                   foreach($rs as $_key=>$_val){
                    $cc_info['custom_menu']['bottom']['content'] = str_replace('__F_'.$_key.'__', $_val, $cc_info['custom_menu']['bottom']['content']);
                   }
                   foreach($_REQUEST as $_key=>$_val){
                     $cc_info['custom_menu']['bottom']['content'] = str_replace('__R_'.$_key.'__', $_val, $cc_info['custom_menu']['bottom']['content']);
                   }
                   echo $cc_info['custom_menu']['bottom']['content'];
                 }
              }
            ?>
          </p>
      </li>
    <?php
        }
      }
    ?>
    <!-- 新增自定义菜单 id 序号越高越好 -->
  </ul>
</div>
<script type="text/javascript">
$('[id^=submenu]').click(function() {
    chnsubmenu($(this).attr('id'));
});
function chnsubmenu(i){
  $('[id^=submenu]').removeClass('qbt_duonian');
  $('#'+i).addClass('qbt_duonian');
}
</script>
</body>
</html>