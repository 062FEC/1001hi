<?php include('../includes/php_conn.php'); ?>
<?php
	include('setup.php');
	if (!$_SESSION['superadmin']){
		die('未授权');
	}

	//导入
	if($_POST['import']){
		if($_FILES['ccmodulefile']['tmp_name']){
			//解析模块
			$data = file_get_contents($_FILES['ccmodulefile']['tmp_name']);
			@unlink($_FILES['ccmodulefile']['tmp_name']);
			if(substr($data, 0, 10)!='CCMODULE::') show_msg('模块文件错误');

			//解析模块文件
			$data = substr($data, 10);
			$data = base64_decode($data);
			$data = unserialize($data);
			
			$data['data'] = unserialize(base64_decode($data['data']));
			$data['ccinfo'] = base64_decode($data['ccinfo']);
			$data['alone_ccinfo'] = base64_decode($data['alone_ccinfo']);
			if($data['info']){
				foreach ($data['info'] as $info_key => $info_val) {
					$data['info'][$info_key] = unserialize(base64_decode($info_val));
					foreach ($data['info'][$info_key] as $info_key2 => $info_val2) {
						$data['info'][$info_key][$info_key2] = base64_decode($info_val2);
						if($info_key2=='alone_data'){
							$data['info'][$info_key][$info_key2] = unserialize($data['info'][$info_key][$info_key2]);
						}
					}
				}
			}
			if($data['subcat']){
				foreach($data['subcat'] as $subcat_key=>$subcat_val){
					$data['subcat'][$subcat_key]['data'] = unserialize(base64_decode($subcat_val['data']));
					$data['subcat'][$subcat_key]['ccinfo'] = base64_decode($subcat_val['ccinfo']);
					$data['subcat'][$subcat_key]['alone_ccinfo'] = base64_decode($subcat_val['alone_ccinfo']);
					if($data['subcat'][$subcat_key]['info']){
						foreach ($data['subcat'][$subcat_key]['info'] as $info_key => $info_val) {
							$data['subcat'][$subcat_key]['info'][$info_key] = unserialize(base64_decode($info_val));
							foreach ($data['subcat'][$subcat_key]['info'][$info_key] as $info_key2 => $info_val2) {
								$data['subcat'][$subcat_key]['info'][$info_key][$info_key2] = base64_decode($info_val2);
								if($info_key2=='alone_data'){
									$data['subcat'][$subcat_key]['info'][$info_key][$info_key2] = unserialize($data['subcat'][$subcat_key]['info'][$info_key][$info_key2]);
								}
							}
						}
					}
					if($subcat_val['subcat']){
						foreach($subcat_val['subcat'] as $subcat_subcat_key=>$subcat_subcat_val){
							$data['subcat'][$subcat_key]['subcat'][$subcat_subcat_key]['data'] = unserialize(base64_decode($subcat_subcat_val['data']));
							$data['subcat'][$subcat_key]['subcat'][$subcat_subcat_key]['ccinfo'] = base64_decode($subcat_subcat_val['ccinfo']);
							$data['subcat'][$subcat_key]['subcat'][$subcat_subcat_key]['alone_ccinfo'] = base64_decode($subcat_subcat_val['alone_ccinfo']);
							if($data['subcat'][$subcat_key]['subcat']['subcat'][$subcat_key]['info']){
								foreach ($data['subcat'][$subcat_key]['subcat']['subcat'][$subcat_key]['info'] as $info_key => $info_val) {
									$data['subcat'][$subcat_key]['subcat']['subcat'][$subcat_key]['info'][$info_key] = unserialize(base64_decode($info_val));
									foreach ($data['subcat'][$subcat_key]['subcat']['info'][$info_key] as $info_key2 => $info_val2) {
										$data['subcat'][$subcat_key]['subcat']['subcat'][$subcat_key]['info'][$info_key][$info_key2] = base64_decode($info_val2);
										if($info_key2=='alone_data'){
											$data['subcat'][$subcat_key]['subcat']['subcat'][$subcat_key]['info'][$info_key][$info_key2] = unserialize($data['subcat'][$subcat_key]['subcat']['subcat'][$subcat_key]['info'][$info_key][$info_key2]);
										}
									}
								}
							}
						}
					}
				}
			}
			if($data['in_file']){
				foreach($data['in_file'] as $in_file_key=>$in_file_val){
					foreach($in_file_val as $key=>$value){
						$data['in_file'][$in_file_key][$key] = base64_decode($value);
					}
				}
			}

			$old_conf_showmenu = file_get_contents(CC_SAVE_PATH.'conf_showmenu.ccset');

			$cc_info = array();

			//插入数据
			$sql = "INSERT INTO `atype` SET `type_id`=0,`num`=0";
			foreach ($data['data'] as $field=>$value) {
				$value = mysql_real_escape_string($value);
				$sql.=",`{$field}`='{$value}'";
			}
			if(mysql_query($sql)){
				$id = $type_id = mysql_insert_id();
				
				//处理默认控制
				file_put_contents(CC_SAVE_PATH.'conf_'.$id.'.ccset', $data['ccinfo']);
				$_REQUEST['cc'] = unserialize($data['ccinfo']);
				include 'ccaction.php';
				$main_cc_info = $_REQUEST['cc'];

				//处理独立控制
				if($data['alone_ccinfo']){
					$__last_type = $type;
					$type = 'class_info';
					file_put_contents(CC_SAVE_PATH.'conf_'.$type.'_'.$id.'.ccset', $data['alone_ccinfo']);
					$_REQUEST['cc'] = unserialize($data['alone_ccinfo']);
					include 'ccaction.php';
					$main_cc_info['class_info'] = $_REQUEST['cc']['class_info'];
	  				$main_cc_info['class_extend_field'] = $_REQUEST['cc']['class_extend_field'];
	  				$type = $__last_type;
				}

				//处理信息内容
				if($data['info']){
					$__last_id = $id;
					$__last_type = $type;
					foreach($data['info'] as $info_key=>$info_val){
						$sql = "INSERT INTO `".($main_cc_info['info_alone_table_name']?"{$main_cc_info['info_alone_table_name']}":'atype_info')."` SET `type_id`='{$type_id}'";
						foreach ($info_val as $field=>$value) {
							if(in_array($field, array('alone_ccinfo','alone_data'))) continue;
							$value = mysql_real_escape_string($value);
							$sql.=",`{$field}`='{$value}'";
						}
						if(mysql_query($sql)){
							$id = mysql_insert_id();
							$type = 'info';

							//独立控制数据处理
							if(!empty($info_val['alone_ccinfo'])){
								file_put_contents(CC_SAVE_PATH.($main_cc_info['info_alone_table_name']?$main_cc_info['info_alone_table_name'].'_':'').'conf_'.$type.'_'.$id.'.ccset', $info_val['alone_ccinfo']);
								$_REQUEST['cc'] = unserialize($info_val['alone_ccinfo']);
								$_REQUEST['cc']['info_alone_table_name'] = $main_cc_info['info_alone_table_name'];
								include 'ccaction.php';
							}
                            if(!empty($info_val['alone_data'])){
	                            $sql = "UPDATE `".($main_cc_info['info_alone_table_name']?"{$main_cc_info['info_alone_table_name']}":'atype_info')."` SET `id`='{$id}'";
		                        foreach ($info_val['alone_data'] as $field=>$value) {
		                            $value = mysql_real_escape_string($value);
		                            $sql.=",`{$field}`='{$value}'";
		                        }
		                        $sql.=" WHERE `id`='{$id}'";
		                        mysql_query($sql);
                            }
						}else{
							show_msg("导入失败: \\nSQL: {$sql}\\n".mysql_error());
						}
					}
					$_REQUEST['cc'] = $main_cc_info;
					$id = $__last_id;
					$type = $__last_type;
				}

				//处理二级子分类
				if($data['subcat']){
					foreach($data['subcat'] as $subcat_key=>$subcat_val){
						$cc_info = $main_cc_info;
						//插入数据
						$sql = "INSERT INTO `".($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}":'atype')."` SET `type_id`='{$type_id}'";
						foreach ($subcat_val['data'] as $field=>$value) {
							$value = mysql_real_escape_string($value);
							$sql.=",`{$field}`='{$value}'";
						}
						if(mysql_query($sql)){
							$id = $subcat_type_id = mysql_insert_id();

							//处理默认控制
							file_put_contents(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'conf_'.$id.'.ccset', $subcat_val['ccinfo']);
							$_REQUEST['cc'] = unserialize($subcat_val['ccinfo']);
							include 'ccaction.php';
							$subcat_cc_info = $_REQUEST['cc'];

							//处理独立控制
							if($subcat_val['alone_ccinfo']){
			                    $__last_type = $type;
			                    $type = 'class_info';
								file_put_contents(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'conf_'.$type.'_'.$id.'.ccset', $subcat_val['alone_ccinfo']);
								$_REQUEST['cc'] = unserialize($subcat_val['alone_ccinfo']);
								$_REQUEST['cc']['class_alone_table_name'] = $cc_info['class_alone_table_name'];
								include 'ccaction.php';
								$subcat_cc_info['class_info'] = $_REQUEST['cc']['class_info'];
				  				$subcat_cc_info['class_extend_field'] = $_REQUEST['cc']['class_extend_field'];
				  				$type = $__last_type;
							}

			                //处理信息内容
			                if($subcat_val['info']){
			                    $__last_id = $id;
			                    $__last_type = $type;
			                    foreach($subcat_val['info'] as $info_key=>$info_val){
			                        $sql = "INSERT INTO `".($subcat_cc_info['info_alone_table_name']?"{$subcat_cc_info['info_alone_table_name']}":'atype_info')."` SET `type_id`='{$subcat_type_id}'";
			                        foreach ($info_val as $field=>$value) {
			                            if(in_array($field, array('alone_ccinfo','alone_data'))) continue;
			                            $value = mysql_real_escape_string($value);
			                            $sql.=",`{$field}`='{$value}'";
			                        }
			                        if(mysql_query($sql)){
			                            $id = mysql_insert_id();
			                            $type = 'info';

			                            //独立控制数据处理
			                            if(!empty($info_val['alone_ccinfo'])){
			                                file_put_contents(CC_SAVE_PATH.($subcat_cc_info['info_alone_table_name']?$subcat_cc_info['info_alone_table_name'].'_':'').'conf_'.$type.'_'.$id.'.ccset', $info_val['alone_ccinfo']);
			                                $_REQUEST['cc'] = unserialize($info_val['alone_ccinfo']);
			                                $_REQUEST['cc']['info_alone_table_name'] = $subcat_cc_info['info_alone_table_name'];
			                                include 'ccaction.php';
			                            }
			                            if(!empty($info_val['alone_data'])){
				                            $sql = "UPDATE `".($subcat_cc_info['info_alone_table_name']?"{$subcat_cc_info['info_alone_table_name']}":'atype_info')."` SET `id`='{$id}'";
					                        foreach ($info_val['alone_data'] as $field=>$value) {
					                            $value = mysql_real_escape_string($value);
					                            $sql.=",`{$field}`='{$value}'";
					                        }
					                        $sql.=" WHERE `id`='{$id}'";
					                        mysql_query($sql);
			                            }
			                        }else{
			                            show_msg("导入失败: \\nSQL: {$sql}\\n".mysql_error());
			                        }
			                    }
			                    $_REQUEST['cc'] = $subcat_cc_info;
			                    $id = $__last_id;
			                    $type = $__last_type;
			                }

							//处理三级子分类
							if($subcat_val['subcat']){
								foreach($subcat_val['subcat'] as $subcat_subcat_key=>$subcat_subcat_val){
									$cc_info = $subcat_cc_info;
									//插入数据
									$sql = "INSERT INTO `".($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}":'atype')."` SET `type_id`='{$subcat_type_id}'";
									foreach ($subcat_subcat_val['data'] as $field=>$value) {
										$value = mysql_real_escape_string($value);
										$sql.=",`{$field}`='{$value}'";
									}
									if(mysql_query($sql)){
										$id = $subcat_subcat_type_id = mysql_insert_id();
									
										//处理默认控制
										file_put_contents(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'conf_'.$type.'_'.$id.'.ccset', $subcat_subcat_val['ccinfo']);
										$_REQUEST['cc'] = unserialize($subcat_subcat_val['ccinfo']);
										include 'ccaction.php';
										$subcat_subcat_cc_info = $_REQUEST['cc'];

										//处理独立控制
										if($subcat_subcat_val['alone_ccinfo']){
						                    $__last_type = $type;
						                    $type = 'class_info';
											file_put_contents(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'conf_'.$type.'_'.$id.'.ccset', $subcat_subcat_val['alone_ccinfo']);
											$_REQUEST['cc'] = unserialize($subcat_subcat_val['alone_ccinfo']);
											$_REQUEST['cc']['class_alone_table_name'] = $cc_info['class_alone_table_name'];
											include 'ccaction.php';
											$subcat_subcat_cc_info['class_info'] = $_REQUEST['cc']['class_info'];
							  				$subcat_subcat_cc_info['class_extend_field'] = $_REQUEST['cc']['class_extend_field'];
                   							$type = $__last_type;
										}

						                //处理信息内容
						                if($subcat_subcat_val['info']){
						                    $__last_id = $id;
						                    $__last_type = $type;
						                    foreach($subcat_subcat_val['info'] as $info_key=>$info_val){
						                        $sql = "INSERT INTO `".($subcat_subcat_cc_info['info_alone_table_name']?"{$subcat_subcat_cc_info['info_alone_table_name']}":'atype_info')."` SET `type_id`='{$type_id}'";
						                        foreach ($info_val as $field=>$value) {
						                            if(in_array($field, array('alone_ccinfo','alone_data'))) continue;
						                            $value = mysql_real_escape_string($value);
						                            $sql.=",`{$field}`='{$value}'";
						                        }
						                        if(mysql_query($sql)){
						                            $id = mysql_insert_id();
						                            $type = 'info';

						                            //独立控制数据处理
						                            if(!empty($info_val['alone_ccinfo'])){
						                                file_put_contents(CC_SAVE_PATH.($subcat_subcat_cc_info['info_alone_table_name']?$subcat_subcat_cc_info['info_alone_table_name'].'_':'').'conf_'.$type.'_'.$id.'.ccset', $info_val['alone_ccinfo']);
						                                $_REQUEST['cc'] = unserialize($info_val['alone_ccinfo']);
						                                $_REQUEST['cc']['info_alone_table_name'] = $subcat_subcat_cc_info['info_alone_table_name'];
						                                include 'ccaction.php';
						                            }
						                            if(!empty($info_val['alone_data'])){
							                            $sql = "UPDATE `".($subcat_subcat_cc_info['info_alone_table_name']?"{$subcat_subcat_cc_info['info_alone_table_name']}":'atype_info')."` SET `id`='{$id}'";
								                        foreach ($info_val['alone_data'] as $field=>$value) {
								                            $value = mysql_real_escape_string($value);
								                            $sql.=",`{$field}`='{$value}'";
								                        }
								                        $sql.=" WHERE `id`='{$id}'";
								                        mysql_query($sql);
						                            }
						                        }else{
						                            show_msg("导入失败: \\nSQL: {$sql}\\n".mysql_error());
						                        }
						                    }
						                    $_REQUEST['cc'] = $subcat_subcat_cc_info;
						                    $id = $__last_id;
						                    $type = $__last_type;
						                }
									}else{
										show_msg("导入失败: \\nSQL: {$sql}\\n".mysql_error());
									}
								}
							}
						}else{
							show_msg("导入失败: \\nSQL: {$sql}\\n".mysql_error());
						}
					}
				}
			}else{
				show_msg("导入失败: \\nSQL: {$sql}\\n".mysql_error());
			}

			//还原附带文件
			function parse_in_file_path($path){
				$path = dirname($path);
				$path = explode('/', $path);
				$nowpath = WEB_ROOT;
				foreach ($path as $dir) {
					$nowpath.="{$dir}/";
					if(!is_dir($nowpath) && !mkdir($nowpath,777)){
						show_msg("权限不足建立目录失败: \\nPath: {$nowpath}");
					}
				}
			}
			foreach ($data['in_file'] as $in_file_key => $in_file_val) {
				parse_in_file_path($in_file_val['path']);
				file_put_contents(WEB_ROOT.$in_file_val['path'], $in_file_val['content']);
			}

			$new_conf_showmenu = file_get_contents(CC_SAVE_PATH.'conf_showmenu.ccset');
			if($old_conf_showmenu!=$new_conf_showmenu){
				echo '<script type="text/javascript">parent.parent.leftFrame.location.reload();</script>';
			}
			show_msg("导入成功",5);
		}else{
			show_msg('请上传文件');
		}
	}

	//导出
	if($_POST['export']){

		//加载选中类别控制信息
		$ccmodule_data = array();
		$ccmodule_data['data'] = mysql_fetch_assoc(mysql_query("SELECT `cn_type`,`en_type`,`cn_title`,`en_title`,`cn_keywords`,`en_keywords`,`cn_description`,`en_description` FROM `atype` WHERE `id`='{$_POST['type_id']}'"));
		$ccmodule_name = $ccmodule_data['data']['cn_type'];
		$ccmodule_data['data'] = serialize($ccmodule_data['data']);
		$ccmodule_data['ccinfo'] = is_file(CC_SAVE_PATH.'conf_'.$_POST['type_id'].'.ccset')?file_get_contents(CC_SAVE_PATH.'conf_'.$_POST['type_id'].'.ccset'):'';
		$ccmodule_data['alone_ccinfo'] = is_file(CC_SAVE_PATH.'conf_class_info_'.$_POST['type_id'].'.ccset')?file_get_contents(CC_SAVE_PATH.'conf_class_info_'.$_POST['type_id'].'.ccset'):'';

		$_atype_table1 = 'atype';
		$_atypeinfo_table1 = 'atype_info';
		$_ccinfo = unserialize($ccmodule_data['ccinfo']);
		if($_ccinfo['class_alone_table_name']) $_atype_table1 = $_ccinfo['class_alone_table_name'];
		if($_ccinfo['info_alone_table_name']) $_atypeinfo_table1 = $_ccinfo['info_alone_table_name'];
		if(!empty($ccmodule_data['alone_ccinfo'])){
			$__alone_ccinfo = unserialize($ccmodule_data['alone_ccinfo']);
			$_ccinfo['class_extend_field'] = $__alone_ccinfo['class_extend_field'];
		}

		//导出选中分类数据
		if(isset($_POST['in_data'])){

			//获取信息自定义字段
			$_add_atypeinfo_field = '';
			if($_ccinfo['info_extend_field']){
				foreach($_ccinfo['info_extend_field'] as $_key=>$_val){
					$_add_atypeinfo_field.=",`{$_val['field']}`";
				}
			}

			//获取信息数据
			$export_cat_query = mysql_query("SELECT `id`, `num`, `cn_name`, `en_name`, `cn_title`, `en_title`, `cn_keywords`, `en_keywords`, `cn_description`, `en_description`, `images1`, `images2`, `cn_content`, `en_content`, `date1`, `hot1`{$_add_atypeinfo_field} FROM `{$_atypeinfo_table1}` WHERE `type_id`='{$_POST['type_id']}'");
			while($atypeinfodata = mysql_fetch_assoc($export_cat_query)){
				$_atypeinfo_id = $atypeinfodata['id'];
				if($_atypeinfo_table1!='atype_info') unset($atypeinfodata['id']);
				$atypeinfodata['alone_ccinfo'] = is_file(CC_SAVE_PATH.($_ccinfo['info_alone_table_name']?$_ccinfo['info_alone_table_name'].'_':'').'conf_info_'.$_atypeinfo_id.'.ccset')?file_get_contents(CC_SAVE_PATH.($_ccinfo['info_alone_table_name']?$_ccinfo['info_alone_table_name'].'_':'').'conf_info_'.$_atypeinfo_id.'.ccset'):'';

				//获取信息独立控制自定义字段数据
				if(!empty($atypeinfodata['alone_ccinfo'])){
					$__atypeinfodata_ccinfo = unserialize($atypeinfodata['alone_ccinfo']);
					$_add_atypeinfo_alone_field = '';
					if($__atypeinfodata_ccinfo['info_extend_field']){
						foreach($__atypeinfodata_ccinfo['info_extend_field'] as $_key=>$_val){
							$_add_atypeinfo_alone_field.=",`{$_val['field']}`";
						}
					}
					$atypeinfodata['alone_data'] = mysql_fetch_assoc(mysql_query("SELECT `id`{$_add_atypeinfo_alone_field} FROM `{$_atypeinfo_table1}` WHERE `id`='{$_atypeinfo_id}'"));
					unset($atypeinfodata['alone_data']['id']);
					$atypeinfodata['alone_data'] = serialize($atypeinfodata['alone_data']);
				}

				foreach ($atypeinfodata as $atypeinfodata_key => $atypeinfodata_value) {
					$atypeinfodata[$atypeinfodata_key] = base64_encode($atypeinfodata_value);
				}
				$ccmodule_data['info'][] = base64_encode(serialize($atypeinfodata));
			}
		}
		
		$ccmodule_data['subcat'] = array();

		//获取下级分类自定义字段
		$_add_atype_field = '';
		if($_ccinfo['class_extend_field']){
			foreach($_ccinfo['class_extend_field'] as $_key=>$_val){
				$_add_atype_field.=",`{$_val['field']}`";
			}
		}

		/* 获取二级类别信息 */
		$export_cat2_query = mysql_query("SELECT `id`,`num`,`cn_type`,`en_type`,`cn_title`,`en_title`,`cn_keywords`,`en_keywords`,`cn_description`,`en_description`{$_add_atype_field} FROM `{$_atype_table1}` WHERE `type_id`='{$_POST['type_id']}'");
		while($info = mysql_fetch_assoc($export_cat2_query)){
			$_id = $info['id'];
			unset($info['id']);
			$_sub_cat = array(
				'data'=>serialize($info),
				'ccinfo'=> is_file(CC_SAVE_PATH.($_ccinfo['class_alone_table_name']?$_ccinfo['class_alone_table_name'].'_':'').'conf_'.$_id.'.ccset')?file_get_contents(CC_SAVE_PATH.($_ccinfo['class_alone_table_name']?$_ccinfo['class_alone_table_name'].'_':'').'conf_'.$_id.'.ccset'):'',
				'alone_ccinfo'=> is_file(CC_SAVE_PATH.($_ccinfo['class_alone_table_name']?$_ccinfo['class_alone_table_name'].'_':'').'conf_class_info_'.$_id.'.ccset')?file_get_contents(CC_SAVE_PATH.($_ccinfo['class_alone_table_name']?$_ccinfo['class_alone_table_name'].'_':'').'conf_class_info_'.$_id.'.ccset'):'',
				'subcat'=>array()
				);

			$_atype_table2 = 'atype';
			$_atypeinfo_table2 = 'atype_info';
			$_ccinfo2 = unserialize($_sub_cat['ccinfo']);
			if($_ccinfo2['class_alone_table_name']) $_atype_table2 = $_ccinfo2['class_alone_table_name'];
			if($_ccinfo2['info_alone_table_name']) $_atypeinfo_table2 = $_ccinfo2['info_alone_table_name'];
			if(!empty($_sub_cat['alone_ccinfo'])){
				$__alone_ccinfo2 = unserialize($_sub_cat['alone_ccinfo']);
				$_ccinfo2['class_extend_field'] = $__alone_ccinfo2['class_extend_field'];
			}

			//导出二级分类数据
			if(isset($_POST['in_data'])){

				//获取信息自定义字段
				$_add_atypeinfo_field = '';
				if($_ccinfo2['info_extend_field']){
					foreach($_ccinfo2['info_extend_field'] as $_key=>$_val){
						$_add_atypeinfo_field.=",`{$_val['field']}`";
					}
				}

				//获取信息数据
				$export_cat2_info_query = mysql_query("SELECT `id`, `num`, `cn_name`, `en_name`, `cn_title`, `en_title`, `cn_keywords`, `en_keywords`, `cn_description`, `en_description`, `images1`, `images2`, `cn_content`, `en_content`, `date1`, `hot1`{$_add_atypeinfo_field} FROM `{$_atypeinfo_table2}` WHERE `type_id`='{$_id}'");
				while($atypeinfodata = mysql_fetch_assoc($export_cat2_info_query)){
					$_atypeinfo_id = $atypeinfodata['id'];
					if($_atypeinfo_table2!='atype_info') unset($atypeinfodata['id']);
					$atypeinfodata['alone_ccinfo'] = is_file(CC_SAVE_PATH.($_ccinfo2['info_alone_table_name']?$_ccinfo2['info_alone_table_name'].'_':'').'conf_info_'.$_atypeinfo_id.'.ccset')?file_get_contents(CC_SAVE_PATH.($_ccinfo2['info_alone_table_name']?$_ccinfo2['info_alone_table_name'].'_':'').'conf_info_'.$_atypeinfo_id.'.ccset'):'';

					//获取信息独立控制自定义字段数据
					if(!empty($atypeinfodata['alone_ccinfo'])){
						$__atypeinfodata_ccinfo = unserialize($atypeinfodata['alone_ccinfo']);
						$_add_atypeinfo_alone_field = '';
						if($__atypeinfodata_ccinfo['info_extend_field']){
							foreach($__atypeinfodata_ccinfo['info_extend_field'] as $_key=>$_val){
								$_add_atypeinfo_alone_field.=",`{$_val['field']}`";
							}
						}
						$atypeinfodata['alone_data'] = mysql_fetch_assoc(mysql_query("SELECT `id`{$_add_atypeinfo_alone_field} FROM `{$_atypeinfo_table2}` WHERE `id`='{$_atypeinfo_id}'"));
						unset($atypeinfodata['alone_data']['id']);
						$atypeinfodata['alone_data'] = serialize($atypeinfodata['alone_data']);
					}

					foreach ($atypeinfodata as $atypeinfodata_key => $atypeinfodata_value) {
						$atypeinfodata[$atypeinfodata_key] = base64_encode($atypeinfodata_value);
					}
					$_sub_cat['info'][] = base64_encode(serialize($atypeinfodata));
				}
			}

			/* 整理自定义字段 */
			$_add_atype_field2 = '';
			if($_ccinfo2['class_extend_field']){
				foreach($_ccinfo2['class_extend_field'] as $_key=>$_val){
					$_add_atype_field2.=",`{$_val['field']}`";
				}
			}
			/* 获取三级类别信息 */
			$export_cat3_query = mysql_query("SELECT `id`,`num`,`cn_type`,`en_type`,`cn_title`,`en_title`,`cn_keywords`,`en_keywords`,`cn_description`,`en_description`{$_add_atype_field2} FROM `{$_atype_table2}` WHERE `type_id`='{$_id}'");
			while($info2 = mysql_fetch_assoc($export_cat3_query)){
				$_id2 = $info2['id'];
				unset($info2['id']);
				$_sub_cat2 = array(
					'data'=>serialize($info2),
					'ccinfo'=> is_file(CC_SAVE_PATH.($_ccinfo2['class_alone_table_name']?$_ccinfo2['class_alone_table_name'].'_':'').'conf_'.$_id2.'.ccset')?file_get_contents(CC_SAVE_PATH.($_ccinfo2['class_alone_table_name']?$_ccinfo2['class_alone_table_name'].'_':'').'conf_'.$_id2.'.ccset'):'',
					'alone_ccinfo'=> is_file(CC_SAVE_PATH.($_ccinfo2['class_alone_table_name']?$_ccinfo2['class_alone_table_name'].'_':'').'conf_class_info_'.$_id2.'.ccset')?file_get_contents(CC_SAVE_PATH.($_ccinfo2['class_alone_table_name']?$_ccinfo2['class_alone_table_name'].'_':'').'conf_class_info_'.$_id2.'.ccset'):''
					);
				$_sub_cat2['data'] = base64_encode($_sub_cat2['data']);
				$_sub_cat2['ccinfo'] = base64_encode($_sub_cat2['ccinfo']);
				$_sub_cat2['alone_ccinfo'] = base64_encode($_sub_cat2['alone_ccinfo']);

				$_atype_table3 = 'atype';
				$_atypeinfo_table3 = 'atype_info';
				$_ccinfo3 = unserialize($_sub_cat2['ccinfo']);
				if($_ccinfo3['class_alone_table_name']) $_atype_table3 = $_ccinfo3['class_alone_table_name'];
				if($_ccinfo3['info_alone_table_name']) $_atypeinfo_table3 = $_ccinfo3['info_alone_table_name'];
				if(!empty($_sub_cat2['alone_ccinfo'])){
					$__alone_ccinfo3 = unserialize($_sub_cat2['alone_ccinfo']);
					$_ccinfo3['class_extend_field'] = $__alone_ccinfo3['class_extend_field'];
				}

				//导出三级分类数据
				if(isset($_POST['in_data'])){

					//获取信息自定义字段
					$_add_atypeinfo_field = '';
					if($_ccinfo3['info_extend_field']){
						foreach($_ccinfo3['info_extend_field'] as $_key=>$_val){
							$_add_atypeinfo_field.=",`{$_val['field']}`";
						}
					}

					//获取信息数据
					$export_cat3_info_query = mysql_query("SELECT `id`, `num`, `cn_name`, `en_name`, `cn_title`, `en_title`, `cn_keywords`, `en_keywords`, `cn_description`, `en_description`, `images1`, `images2`, `cn_content`, `en_content`, `date1`, `hot1`{$_add_atypeinfo_field} FROM `{$_atypeinfo_table3}` WHERE `type_id`='{$_id2}'");
					while($atypeinfodata = mysql_fetch_assoc($export_cat3_info_query)){
						$_atypeinfo_id = $atypeinfodata['id'];
						if($_atypeinfo_table3!='atype_info') unset($atypeinfodata['id']);
						$atypeinfodata['alone_ccinfo'] = is_file(CC_SAVE_PATH.($_ccinfo3['info_alone_table_name']?$_ccinfo3['info_alone_table_name'].'_':'').'conf_info_'.$_atypeinfo_id.'.ccset')?file_get_contents(CC_SAVE_PATH.($_ccinfo3['info_alone_table_name']?$_ccinfo3['info_alone_table_name'].'_':'').'conf_info_'.$_atypeinfo_id.'.ccset'):'';

						//获取信息独立控制自定义字段数据
						if(!empty($atypeinfodata['alone_ccinfo'])){
							$__atypeinfodata_ccinfo = unserialize($atypeinfodata['alone_ccinfo']);
							$_add_atypeinfo_alone_field = '';
							if($__atypeinfodata_ccinfo['info_extend_field']){
								foreach($__atypeinfodata_ccinfo['info_extend_field'] as $_key=>$_val){
									$_add_atypeinfo_alone_field.=",`{$_val['field']}`";
								}
							}
							$atypeinfodata['alone_data'] = mysql_fetch_assoc(mysql_query("SELECT `id`{$_add_atypeinfo_alone_field} FROM `{$_atypeinfo_table3}` WHERE `id`='{$_atypeinfo_id}'"));
							unset($atypeinfodata['alone_data']['id']);
							$atypeinfodata['alone_data'] = serialize($atypeinfodata['alone_data']);
						}

						foreach ($atypeinfodata as $atypeinfodata_key => $atypeinfodata_value) {
							$atypeinfodata[$atypeinfodata_key] = base64_encode($atypeinfodata_value);
						}
						$_sub_cat2['info'][] = base64_encode(serialize($atypeinfodata));
					}
				}

				$_sub_cat['subcat'][] = $_sub_cat2;
			}
			$_sub_cat['data'] = base64_encode($_sub_cat['data']);
			$_sub_cat['ccinfo'] = base64_encode($_sub_cat['ccinfo']);
			$_sub_cat['alone_ccinfo'] = base64_encode($_sub_cat['alone_ccinfo']);
			$ccmodule_data['subcat'][] = $_sub_cat;
		}
		$ccmodule_data['data'] = base64_encode($ccmodule_data['data']);
		$ccmodule_data['ccinfo'] = base64_encode($ccmodule_data['ccinfo']);
		$ccmodule_data['alone_ccinfo'] = base64_encode($ccmodule_data['alone_ccinfo']);

		//文件打包
		$ccmodule_data['in_file'] = array();
		function export_in_file($file){
			$GLOBALS['ccmodule_data']['in_file'][] = array(
				'path'=>base64_encode(str_replace(WEB_ROOT, '', $file)),
				'content'=>base64_encode(file_get_contents($file))
			);
		}
		function export_in_dir($dir){
			$dh = opendir($dir);
			while($file = readdir($dh)){
				if(in_array($file, array('.','..'))) continue;
				$filepath = $dir.'/'.$file;
				if(is_dir($filepath)){
					export_in_dir($filepath);
					continue;
				}
				if(is_file($filepath)){
					export_in_file($filepath);
				}
			}
			closedir($dh);
		}
		if(!empty($_POST['in_file'])){
			$in_file = trim($_POST['in_file']);
			$in_file = str_replace("\r", '', $in_file);
			$in_file = explode("\n", $in_file);
			foreach ($in_file as $value) {
				$fullpath = WEB_ROOT.$value;
				if(is_dir($fullpath)){
					export_in_dir($fullpath);
					continue;
				}
				if(is_file($fullpath)){
					export_in_file($fullpath);
				}
			}
		}

		$ccmodule_data = 'CCMODULE::'.base64_encode(serialize($ccmodule_data));

		header("Content-type: application/octet-stream");
		header("Accept-Ranges: bytes"); 
		header("Accept-Length: ".strlen($ccmodule_data));
		header("Content-Disposition: attachment; filename=".$ccmodule_name.'模块.ccmodule'); 

		echo $ccmodule_data;
		exit;
	}
?>
<?php include('../includes/check.php'); ?>
<html>
<head>
<title><?php echo $admin_site_title;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/qbt.css" rel="stylesheet" type="text/css">
</head>


<body style="background:#eee; padding:20px 20px 20px 9px;">

<div class="qbt_nidelikai">
<div class="qbt_shujuguanli">
  <span>模块导入</span>
</div>
<div class="qbt_omnissguai">
  
<iframe src="" name="webiframe" style="display:none" frameborder="0"></iframe>
<form action="" target="webiframe" method="post" enctype="multipart/form-data">
  <table width="100%" border="0" cellspacing="1" cellpadding="1" class="t02_3">
    <tr bgcolor="#FFFFFF">
      <td width="120" height="20" bgcolor="#FFFFFF" align="right">选择模块：</td>
      <td height="20">
      	<input type="file" name="ccmodulefile" /> *.ccmodule
	  </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="120" height="20" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="20">
		  <input type="hidden" name="import" value="1" />
      	  <button class="button button_blue" type="submit">导入</button>
		</td>
    </tr>
  </table>
</form>
  
</div>
</div>

<?php
	$query = mysql_query("SELECT * FROM `atype` WHERE `type_id`=0");
	if(mysql_num_rows($query)>0){
?>
<br /><br />
<div class="qbt_nidelikai">
<div class="qbt_shujuguanli">
  <span>模块导出</span>
</div>
<div class="qbt_omnissguai">

<form action="" target="webiframe" method="post" enctype="multipart/form-data">
  <table width="100%" border="0" cellspacing="1" cellpadding="1" class="t02_3">
    <tr bgcolor="#FFFFFF">
      <td width="120" height="20" bgcolor="#FFFFFF" align="right">选择分类：</td>
      <td height="20">
      	<select name="type_id">
	      <?php
	      while($info = mysql_fetch_assoc($query)){
	      	echo '<option value="'.$info['id'].'">'.$info['cn_type'].'</option>';
	      }
	      ?>
  		</select>
	  </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="120" height="20" bgcolor="#FFFFFF" align="right">包含数据：</td>
      <td height="20">
      	<input type="checkbox" name="in_data" value="1" />
	  </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="120" height="20" bgcolor="#FFFFFF" align="right">包含文件：</td>
      <td height="20">
      	<textarea name="in_file" cols="60" rows="8"></textarea>
	  </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="120" height="20" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="20">
      	  <input type="hidden" name="export" value="1" />
      	  <button class="button button_blue" type="submit">导出</button>
		</td>
    </tr>
  </table>
</form>
  
</div>
</div>
<?php
	}
?>

</body>
</html>