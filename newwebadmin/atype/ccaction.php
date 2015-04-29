<?php
/** 
 * 特别处理
 * 动态字段/PHP栏目功能处理
 */

/* 创建类别数据表语句 */
$alone_table_sql = "
CREATE TABLE IF NOT EXISTS `__TABLE_NAME__` (
  `id` int(11) NOT NULL auto_increment,
  `cn_type` varchar(200) collate utf8_general_ci NULL default '',
  `en_type` varchar(200) collate utf8_general_ci NULL default '',
  `cn_title` varchar(200) collate utf8_general_ci NULL default '',
  `en_title` varchar(200) collate utf8_general_ci NULL default '',
  `cn_keywords` varchar(200) collate utf8_general_ci NULL default '',
  `en_keywords` varchar(200) collate utf8_general_ci NULL default '',
  `cn_description` longtext collate utf8_general_ci NULL,
  `en_description` longtext collate utf8_general_ci NULL,
  `num` int(11) default '0',
  `type_id` int(11) default '__TYPE_ID__',
  `admin_id` int(11) DEFAULT '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=".($id+1).";
";

/**
 * 类别处理
 */
$table_name = 'atype';

/* 建立独立数据表 */
if($_REQUEST['cc']['class_alone_table_name']){
	$table_name = $_REQUEST['cc']['class_alone_table_name'];
	if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '{$_REQUEST['cc']['class_alone_table_name']}'"))<1){
		mysql_query(
			str_replace(
				array('__TABLE_NAME__','__TYPE_ID__'),
				array($_REQUEST['cc']['class_alone_table_name'],$id),
				$alone_table_sql
			)
		) or die('Create Class Alone Table: '.mysql_error());
	}
}

/* 表扩展字段处理 */
if(isset($_REQUEST['cc']['class_extend_field'])){
	$atype_fields = array();
	$fields = mysql_list_fields($mysql_db, $table_name);
	$columns = mysql_num_fields($fields);
	for ($i = 0; $i < $columns; $i++) {
		$fields_name = mysql_field_name($fields, $i);
		$atype_fields[$fields_name] = array(
			'name'=>$fields_name,
			'type'=>mysql_field_type($fields, $i),
			'len'=>mysql_field_len($fields, $i),
			'flags'=>mysql_field_flags($fields, $i)
			);
	}
	foreach($_REQUEST['cc']['class_extend_field'] as $field_info){
		if(empty($field_info['field'])) continue;

		//构建SQL语句
		$field_type_sql = '';
		$index_sql = '';
		$field_defval_sql = '';
		get_extend_field_csql($table_name, $field_info);

		if(isset($atype_fields[$field_info['field']])){
			if(
				(in_array($atype_fields[$field_info['field']]['type'], array('string','datetime')) && !in_array($field_info['type'],array('string','int','password','password_md5','img','select','radio','checkbox')))
				||
				(in_array($atype_fields[$field_info['field']]['type'], array('int')) && !in_array($field_info['type'],array('int')))
				||
				(in_array($atype_fields[$field_info['field']]['type'], array('blob')) && !in_array($field_info['type'],array('text','rtext')))
				){
				show_msg("字段 '{$field_info['field']}' 已存在！\\n当前类型为: {$atype_fields[$field_info['field']]['type']}\\n请更换字段类型或者字段名称。");
			}
			if(!mysql_query("ALTER TABLE `{$table_name}` CHANGE `{$field_info['field']}` `{$field_info['field']}` {$field_type_sql} {$field_defval_sql} COMMENT '{$field_info['title']}'")){
				show_msg("类别字段 '{$field_info['field']}' 修改失败！\n".mysql_error());
			}
		}else{
			if(!mysql_query("ALTER TABLE `{$table_name}` ADD `{$field_info['field']}` {$field_type_sql} {$field_defval_sql} COMMENT '{$field_info['title']}'")){
				show_msg("类别字段 '{$field_info['field']}' 添加失败！\n".mysql_error());
			}
			if($index_sql) mysql_query($index_sql);
		}
	}
}


/* 创建类别数据表语句 */
$alone_table_sql = "
CREATE TABLE IF NOT EXISTS `__TABLE_NAME__` (
  `id` int(11) NOT NULL auto_increment,
  `type_id` int(11) default '__TYPE_ID__',
  `num` int(11) default '0',
  `cn_name` varchar(200) collate utf8_general_ci NULL default '',
  `en_name` varchar(200) collate utf8_general_ci NULL default '',
  `cn_title` varchar(200) collate utf8_general_ci NULL default '',
  `en_title` varchar(200) collate utf8_general_ci NULL default '',
  `cn_keywords` varchar(200) collate utf8_general_ci NULL default '',
  `en_keywords` varchar(200) collate utf8_general_ci NULL default '',
  `cn_description` longtext collate utf8_general_ci NULL,
  `en_description` longtext collate utf8_general_ci NULL,
  `images1` varchar(200) collate utf8_general_ci NULL default '',
  `images2` varchar(200) collate utf8_general_ci NULL default '',
  `cn_content` longtext collate utf8_general_ci NULL,
  `en_content` longtext collate utf8_general_ci NULL,
  `date1` datetime default '0000-00-00 00:00:00',
  `hot1` int(11) default '0',
  `admin_id` int(11) DEFAULT '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;
";

/**
 * 信息处理
 */
$table_name = 'atype_info';

/* 建立独立数据表 */
if(!empty($_REQUEST['cc']['info_alone_table_name'])){
	$table_name = $_REQUEST['cc']['info_alone_table_name'];

	if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '{$_REQUEST['cc']['info_alone_table_name']}'"))<1){
		mysql_query(
			str_replace(
				array('__TABLE_NAME__','__TYPE_ID__'),
				array($_REQUEST['cc']['info_alone_table_name'],$id),
				$alone_table_sql
			)
		) or die('Create Info Alone Table: '.mysql_error());
	}
}

/* 表扩展字段处理 */
if(isset($_REQUEST['cc']['info_extend_field'])){
	$atype_info_fields = array();
	$fields = mysql_list_fields($mysql_db, $table_name);
	$columns = mysql_num_fields($fields);
	for ($i = 0; $i < $columns; $i++) {
		$fields_name = mysql_field_name($fields, $i);
		$atype_info_fields[$fields_name] = array(
			'name'=>$fields_name,
			'type'=>mysql_field_type($fields, $i),
			'len'=>mysql_field_len($fields, $i),
			'flags'=>mysql_field_flags($fields, $i)
			);
	}
	foreach($_REQUEST['cc']['info_extend_field'] as $field_info){
		if(empty($field_info['field'])) continue;

		//构建SQL语句
		$field_type_sql = '';
		$index_sql = '';
		$field_defval_sql = '';
		get_extend_field_csql($table_name, $field_info);

		if(isset($atype_info_fields[$field_info['field']])){
			if(
				(in_array($atype_info_fields[$field_info['field']]['type'], array('string','datetime')) && !in_array($field_info['type'],array('string','int','password','password_md5','img','select','radio','checkbox')))
				||
				(in_array($atype_info_fields[$field_info['field']]['type'], array('int')) && !in_array($field_info['type'],array('int')))
				||
				(in_array($atype_info_fields[$field_info['field']]['type'], array('blob')) && !in_array($field_info['type'],array('text','rtext')))
				){
				show_msg("字段 '{$field_info['field']}' 已存在！\\n当前类型为: {$atype_info_fields[$field_info['field']]['type']}\\n请更换字段类型或者字段名称。");
			}
			if(!mysql_query("ALTER TABLE `{$table_name}` CHANGE `{$field_info['field']}` `{$field_info['field']}` {$field_type_sql} {$field_defval_sql} COMMENT '{$field_info['title']}'")){
				show_msg("信息字段 '{$field_info['field']}' 修改失败！\n".mysql_error());
			}
		}else{
			if(!mysql_query("ALTER TABLE `{$table_name}` ADD `{$field_info['field']}` {$field_type_sql} {$field_defval_sql} COMMENT '{$field_info['title']}'")){
				show_msg("信息字段 '{$field_info['field']}' 添加失败！\n".mysql_error());
			}
			if($index_sql) mysql_query($index_sql);
		}
	}
}

/* 自定义菜单内容处理 */
if(is_array($_REQUEST['cc']['custom_menu'])){
	foreach($_REQUEST['cc']['custom_menu'] as $_key=>$_val){
		//先清除原有设置
		@unlink(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'custom_menu_'.$_key.'_'.$id.'.php');
		if($_REQUEST['cc']['custom_menu'][$_key]['content'] && $_REQUEST['cc']['custom_menu'][$_key]['type']=='php'){
			file_put_contents(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'custom_menu_'.$_key.'_'.$id.'.php', "<?php\n".$_REQUEST['cc']['custom_menu'][$_key]['content']);
		}
	}
}


/* 类别，信息列表栏目处理 */
/* 先清除之前已设置类别，信息列表栏目PHP功能 */
$class_file_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_extend_column_'.$id.'_';
$class_file_head_len = strlen($class_file_head);
$info_file_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_extend_column_'.$id.'_';
$info_file_head_len = strlen($info_file_head);
$dh = opendir(CC_SAVE_PATH);
while($fn = readdir($dh)){
	if(substr($fn,0,$class_file_head_len)==$class_file_head || substr($fn,0,$info_file_head_len)==$info_file_head){
		@unlink(CC_SAVE_PATH.$fn);
	}
}
closedir($dh);

/* 重新生成类别列表栏目PHP文件 */
if(isset($_REQUEST['cc']['class_extend_column'])){
	foreach($_REQUEST['cc']['class_extend_column'] as $extend_column_info){
		if($extend_column_info['type']=='php'){
			file_put_contents(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_extend_column_'.($type?($type.'_'):'').$id.'_'.create_extend_column_mark($extend_column_info['title']).'.php', "<?php\n".$extend_column_info['content']);
		}
	}
}

/* 重新生成信息列表栏目PHP文件 */
if(isset($_REQUEST['cc']['info_extend_column'])){
	foreach($_REQUEST['cc']['info_extend_column'] as $extend_column_info){
		if($extend_column_info['type']=='php'){
			file_put_contents(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_extend_column_'.$id.'_'.create_extend_column_mark($extend_column_info['title']).'.php', "<?php\n".$extend_column_info['content']);
		}
	}
}

/* 自定义扩展脚本处理 */
//类别扩展脚本
if($_REQUEST['cc']['class_script']){
	foreach($_REQUEST['cc']['class_script'] as $_key=>$_val){
		//先清除原有设置
		@unlink(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_'.$_key.'_'.$id.'.php');
		if($_REQUEST['cc']['class_script'][$_key]['content']){
			file_put_contents(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_'.$_key.'_'.$id.'.php', "<?php\n".$_REQUEST['cc']['class_script'][$_key]['content']);
		}
	}
}

//信息扩展脚本
if($_REQUEST['cc']['info_script']){
	foreach($_REQUEST['cc']['info_script'] as $_key=>$_val){
		//先清除原有设置
		@unlink(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_'.$_key.'_'.$id.'.php');
		if($_REQUEST['cc']['info_script'][$_key]['content']){
			file_put_contents(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_'.$_key.'_'.$id.'.php', "<?php\n".$_REQUEST['cc']['info_script'][$_key]['content']);
		}
	}
}

//更新菜单
$conf_showmenu = is_file(CC_SAVE_PATH.'conf_showmenu.ccset')?unserialize(file_get_contents(CC_SAVE_PATH.'conf_showmenu.ccset')):array();
unset($conf_showmenu[$id]);
if($_REQUEST['cc']['menu']['class_show']['status']=='show'){
	$conf_showmenu[$id] = $id;
}

if(!empty($conf_showmenu)){
	$query = mysql_query("SELECT * FROM `atype` WHERE `id` IN ('".implode("','", $conf_showmenu)."') ORDER BY `num` ASC");
	$conf_showmenu = array();
	while($_info = mysql_fetch_assoc($query)){
		$conf_showmenu[$_info['id']]=$_info['id'];
	}
}

file_put_contents(CC_SAVE_PATH.'conf_showmenu.ccset', serialize($conf_showmenu));

//整理自定义字段内容
include dirname(__FILE__).'/ccupdate.php';