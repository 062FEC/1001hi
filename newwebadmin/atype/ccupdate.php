<?php
/* 整理所有字段 */
$_extend_field_info = array();
$dh = opendir(CC_SAVE_PATH);
while($fn = readdir($dh)){
	if(substr($fn,-6)=='.ccset' && $fn!='conf_showmenu.ccset'){
		$_ccid = substr($fn, strrpos($fn, '_')+1, strrpos($fn, '.')-strrpos($fn, '_')-1);
		$_cc_info = unserialize(file_get_contents(CC_SAVE_PATH.$fn));
		if($_cc_info['class_extend_field']){
			$_extend_field_info['atype'][$_ccid] = array();
			foreach($_cc_info['class_extend_field'] as $_key=>$_val){
				$_extend_field_info['atype'][$_ccid][$_val['field']] = $_val;
			}
		}
		if($_cc_info['info_extend_field']){
			$_extend_field_info['atype_info'][$_ccid] = array();
			foreach($_cc_info['info_extend_field'] as $_key=>$_val){
				$_extend_field_info['atype_info'][$_ccid][$_val['field']] = $_val;
			}
		}
	}
}
closedir($dh);
file_put_contents(CC_SAVE_PATH.'extend_field_info.php','<?php $extend_field_info='.var_export($_extend_field_info,true).';');