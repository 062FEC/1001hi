<?php include('../includes/php_conn.php'); ?>
<?php include('../includes/check.php'); ?>
<?php include('setup.php'); ?>
<?php

//属于独立表数据
if($_REQUEST['class_alone_table_name']){
  $table_name1 = $_REQUEST['class_alone_table_name'];
}
if($_REQUEST['info_alone_table_name']){
  $table_name2 = $_REQUEST['info_alone_table_name'];
}

$id=$_REQUEST['id'];
if($id){
	rsort($id);
}else{
	show_msg('请选择要批量处理的数据');
}

if(is_file($_POST['ext_batch_script'])) include $_POST['ext_batch_script'];

if(isset($_POST['batch_delete'])){
	for ($i=0;$i<count($id);$i++)
	{
	check_id($id[$i],$go_to_num);
	}
	for ($i=0;$i<count($id);$i++)
	{
		$_temp = mysql_fetch_assoc(mysql_query("SELECT * FROM `{$table_name2}` where id='{$id[$i]}'"));

		$cc_info = array();
		if(is_file(CC_SAVE_PATH.($_REQUEST['class_alone_table_name']?$_REQUEST['class_alone_table_name'].'_':'').'conf_'.$_temp['type_id'].'.ccset')){
			$cc_info = unserialize(file_get_contents(CC_SAVE_PATH.($_REQUEST['class_alone_table_name']?$_REQUEST['class_alone_table_name'].'_':'').'conf_'.$_temp['type_id'].'.ccset'));
		}

		//加载信息删除前的脚本
		if($cc_info['info_script']['del_top']['status']=='show' && $cc_info['info_script']['del_top']['content']!=''){
			if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_del_top_'.$_temp['type_id'].'.php')){
				include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_del_top_'.$_temp['type_id'].'.php';
			}
		}

		$sql='delete from `'.$table_name2.'` where `id`='.$id[$i];
		mysql_query($sql,$conn);

		is_err($go_to_num,'');

		//删除默认字段(images1),(images2)文件
		!empty($_temp['images1']) && @unlink(dirname(__FILE__).'/../../uploadfiles/'.$_temp['images1']);
		!empty($_temp['images2']) && @unlink(dirname(__FILE__).'/../../uploadfiles/'.$_temp['images2']);

		//删除自定义上传字段文件
		if($cc_info['info_extend_field']){
			foreach($cc_info['info_extend_field'] as $_key=>$_value){
				if($_value['type']=='img'){
					!empty($_temp[$_value['field']]) && @unlink(dirname(__FILE__).'/../../uploadfiles/'.$_temp[$_value['field']]);
				}
			}
		}

		//删除信息独立设置自定义上传字段文件
		if($cc_info['info_alone_table_name']){
			$alone_cc_info = unserialize(file_get_contents(CC_SAVE_PATH.$cc_info['info_alone_table_name'].'_conf_info_'.$id[$i].'.ccset'));
			if($alone_cc_info['info_extend_field']){
				foreach($alone_cc_info['info_extend_field'] as $_key=>$_value){
					if($_value['type']=='img'){
						!empty($_temp[$_value['field']]) && @unlink(dirname(__FILE__).'/../../uploadfiles/'.$_temp[$_value['field']]);
					}
				}
			}
		}

		//删除信息控制设置
		@unlink(CC_SAVE_PATH.($cc_info['info_alone_table_name']?($cc_info['info_alone_table_name'].'_'):'').'conf_info_'.$id[$i].'.ccset');

		//加载信息删除后的脚本
		if($cc_info['info_script']['del_bottom']['status']=='show' && $cc_info['info_script']['del_bottom']['content']!=''){
			if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_del_bottom_'.$_temp['type_id'].'.php')){
				include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_del_bottom_'.$_temp['type_id'].'.php';
			}
		}
	}
}
show_msg_ok('',5,'');
?>