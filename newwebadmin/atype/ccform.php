    <style type="text/css">
        .extend_tr td{
            height:20px;
            line-height:25px;
        }
    </style>
    <?php
    if($_ccset['all'] || $_ccset['menu']){
    ?>
    <tr class="extend_tr" bgcolor="#FFFFFF" <?php if (!$_SESSION['superadmin']){ ?>style="display:none"<?php } ?>>
      <td width="120" height="20" align="right" bgcolor="#FFFFFF">菜单控制：</td>
      <td height="20">
      	<table><tr>
      		<td valign="top">
		      	 <select name="cc[menu][class_show][status]">
		      	 	<option value="show" <?php if($cc_info['menu']['class_show']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if(empty($cc_info['menu']['class_show']['status']) || $cc_info['menu']['class_show']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 菜单栏
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[menu][class_list][extend]" style="display:none">
		      	 	<option value="yes" <?php if($cc_info['menu']['class_list']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['menu']['class_list']['extend']) || $cc_info['menu']['class_list']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[menu][class_list][status]">
		      	 	<option value="show" <?php if($cc_info['menu']['class_list']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['menu']['class_list']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[menu][class_list][title]" value="<?php if(empty($cc_info['menu']['class_list']['title'])){ echo '类别管理'; }else{ echo $cc_info['menu']['class_list']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[menu][class_add][extend]" style="display:none">
		      	 	<option value="yes" <?php if($cc_info['menu']['class_add']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['menu']['class_add']['extend']) || $cc_info['menu']['class_add']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[menu][class_add][status]">
		      	 	<option value="show" <?php if($cc_info['menu']['class_add']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['menu']['class_add']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[menu][class_add][title]" value="<?php if(empty($cc_info['menu']['class_add']['title'])){ echo '类别添加'; }else{ echo $cc_info['menu']['class_add']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[menu][info_list][extend]" style="display:none">
		      	 	<option value="yes" <?php if($cc_info['menu']['info_list']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['menu']['info_list']['extend']) || $cc_info['menu']['info_list']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[menu][info_list][status]">
		      	 	<option value="show" <?php if($cc_info['menu']['info_list']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['menu']['info_list']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[menu][info_list][title]" value="<?php if(empty($cc_info['menu']['info_list']['title'])){ echo '信息管理'; }else{ echo $cc_info['menu']['info_list']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[menu][info_add][extend]" style="display:none">
		      	 	<option value="yes" <?php if($cc_info['menu']['info_add']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['menu']['info_add']['extend']) || $cc_info['menu']['info_add']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[menu][info_add][status]">
		      	 	<option value="show" <?php if($cc_info['menu']['info_add']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['menu']['info_add']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[menu][info_add][title]" value="<?php if(empty($cc_info['menu']['info_add']['title'])){ echo '信息添加'; }else{ echo $cc_info['menu']['info_add']['title']; } ?>" />
		    </td>
		    <td>
		    	自定义内容上：
				<?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			<select name="cc[custom_menu][top][extend]" style="display:none">
		      		<option value="yes" <?php if($cc_info['custom_menu']['top']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      		<option value="no" <?php if(empty($cc_info['custom_menu']['top']['extend']) || $cc_info['custom_menu']['top']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			</select>
      			<?php } ?>
		      	<select name="cc[custom_menu][top][status]">
		      		<option value="show" <?php if($cc_info['custom_menu']['top']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
		      		<option value="hide" <?php if($cc_info['custom_menu']['top']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
		      	</select>
		      	<select name="cc[custom_menu][top][type]">
		      		<option value="html" <?php if($cc_info['custom_menu']['top']['type']=='html') echo 'selected="selected"'; ?>>HTML</option>
		      		<option value="php" <?php if($cc_info['custom_menu']['top']['type']=='php') echo 'selected="selected"'; ?>>PHP</option>
		      	</select>
				<br />
		    	<textarea name="cc[custom_menu][top][content]" style="width:276px;height:100px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['custom_menu']['top']['content']; ?></textarea>
		    </td>
		    <td>
		    	自定义内容下：<?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			<select name="cc[custom_menu][bottom][extend]" style="display:none">
		      		<option value="yes" <?php if($cc_info['custom_menu']['bottom']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      		<option value="no" <?php if(empty($cc_info['custom_menu']['bottom']['extend']) || $cc_info['custom_menu']['bottom']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			</select>
      			<?php } ?>
		      	<select name="cc[custom_menu][bottom][status]">
		      		<option value="show" <?php if($cc_info['custom_menu']['bottom']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
		      		<option value="hide" <?php if($cc_info['custom_menu']['bottom']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
		      	</select>
		      	<select name="cc[custom_menu][bottom][type]">
		      		<option value="html" <?php if($cc_info['custom_menu']['bottom']['type']=='html') echo 'selected="selected"'; ?>>HTML</option>
		      		<option value="php" <?php if($cc_info['custom_menu']['bottom']['type']=='php') echo 'selected="selected"'; ?>>PHP</option>
		      	</select>
				<br />
		    	<textarea name="cc[custom_menu][bottom][content]" style="width:276px;height:100px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['custom_menu']['bottom']['content']; ?></textarea>
		    </td>
		</tr>
		<tr><td colspan="2">
		 <div id="newmenu" style="margin-top:5px">
      	 	 <div style="height:25px;line-height:25px;">新增链接：<input id="newmenu_0_add" type="button" value="添加" onclick="add_newmenu()" /></div>
            <?php
            $key=0;
            if(!empty($cc_info['extend_menu'])){
              foreach($cc_info['extend_menu'] as $val){
                if($val['url']){
            ?>
      	 	 <div id="newmenu_<?php echo $key; ?>" style="height:25px;">
			 	<select name="cc[extend_menu][<?php echo $key; ?>][status]">
		      	 	<option value="show" <?php if($cc_info['extend_menu'][$key]['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['extend_menu'][$key]['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
			 	</select>
			 	名称: <input type="text" name="cc[extend_menu][<?php echo $key; ?>][name]" value="<?php echo $val['name']; ?>">
			 	链接: <input type="text" size="50" name="cc[extend_menu][<?php echo $key; ?>][url]" value="<?php echo $val['url']; ?>">
			 	<input id="newmenu_<?php echo $key; ?>_del" type="button" value="删除" onclick="del_newmenu(<?php echo $key; ?>)" />
			 </div>
			 <?php 
			 		$key++;
					}
				}
			 }
			 ?>
      	 </div>
      	 <script type="text/javascript">
      	 	var newnum_id =<?php echo $key; ?>;
      	 	function add_newmenu(){
      	 		newnum_id++;
      	 		var newmenu = document.getElementById('newmenu');
      	 		var newdiv = document.createElement("div");
      	 		newdiv.id='newmenu_'+newnum_id;
      	 		newmenu.appendChild(newdiv);
      	 		document.getElementById(newdiv.id).style.height='25px';
      	 		document.getElementById(newdiv.id).innerHTML="<select name=\"cc[extend_menu]["+newnum_id+"][status]\"><option value=\"show\">显示</option><option value=\"hide\">隐藏</option></select>\n名称: <input type=\"text\" name=\"cc[extend_menu]["+newnum_id+"][name]\">\n链接: <input type=\"text\" size=\"50\" name=\"cc[extend_menu]["+newnum_id+"][url]\">\n<input id=\"newmenu_"+newnum_id+"_del\" type=\"button\" value=\"删除\" onclick=\"del_newmenu("+newnum_id+")\" />";
      	 	}
      	 	function del_newmenu(id){
      	 		var newmenu = document.getElementById('newmenu');
      	 		newmenu.removeChild(document.getElementById('newmenu_'+id));
      	 	}
      	 </script>
		</td></tr>
		</table>
      </td>
    </tr>
    <?php
	}
    if($_ccset['all'] || $_ccset['class_alone_table']){
    ?>
    <tr class="extend_tr" bgcolor="#c8d9ed" <?php if (!$_SESSION['superadmin']){ ?>style="display:none"<?php } ?>>
    	<td width="120" height="20" align="right">【类别】独立数据表：</td>
    	<td height="20">
    		<input type="text" name="cc[class_alone_table_name]" value="<?php echo $cc_info['class_alone_table_name']; ?>" /> *填写则将自动建立新表，否则追加在atype表中
    	</td>
	</tr>
    <?php
	}
	if($_ccset['all'] || $_ccset['class']){
    ?>
    <tr class="extend_tr" bgcolor="#FFFFFF" <?php if (!$_SESSION['superadmin']){ ?>style="display:none"<?php } ?>>
      <td width="120" height="20" align="right" bgcolor="#FFFFFF">
        【类别】控制：<br />
        <br/>
        批量处理
        <br/>
        <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
         <select onchange="$('#class_ccset_box select[name$=\\[extend\\]]').val(this.value);">
            <option value="yes">延伸</option>
            <option value="no" selected="selected">不延伸</option>
         </select><br />
         <?php } ?>
         <select onchange="$('#class_ccset_box select[name$=\\[status\\]]').val(this.value);">
            <option value="show" selected="selected">显示</option>
            <option value="hide">隐藏</option>
         </select>
      </td>
      <td height="20" id="class_ccset_box">
      	<table><tr>
      		<?php
      		if($_ccset['all'] || $_ccset['class']['index']){
      		?>
      		<td valign="top">
                <?php if(!$_ccset['alone_ccset']){ ?>
                级别限制：<input type="text" size="10" name="cc[class_level_num]" value="<?php if(empty($cc_info['class_level_num'])){ echo ''; }else{ echo $cc_info['class_level_num']; } ?>" /><br />
                后台管理不展示：<input type="checkbox" name="cc[class_no_show_list]" value='1' <?php if($cc_info['class_no_show_list']){ echo 'checked="checked"'; } ?>><br />
                排序规则：<input type="text" size="30" name="cc[class_order_rule]" value="<?php if(empty($cc_info['class_order_rule'])){ echo ''; }else{ echo $cc_info['class_order_rule']; } ?>" /><br /><br />
                <?php } ?>
		      	列表功能：<?php if($_ccset['alone_ccset']){ ?><input type="checkbox" name="cc[alone_ccset_class_extend_column]" value='yes' <?php if($cc_info['alone_ccset_class_extend_column']=='yes'){ ?>checked="checked"<?php } ?> style="height:auto" />启用<?php } ?><br />
		      	<?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[class][order_change][extend]">
		      	 	<option value="yes" <?php if($cc_info['class']['order_change']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['class']['order_change']['extend']) || $cc_info['class']['order_change']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[class][order_change][status]">
		      	 	<option value="show" <?php if($cc_info['class']['order_change']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['class']['order_change']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 排序修改
		      	 <br />
      			 <br />
      			 新增列表栏目:<input type="button" value="添加" onclick="add_new_class_extend_column()"><br />
      			 <div id="new_class_extend_column">
      			 	<?php
      			 	$_key=1;
      			 	if($cc_info['class_extend_column']){
	      			 	foreach($cc_info['class_extend_column'] as $val){
      			 	?>
      			 	<div id="new_class_extend_column_<?php echo $_key; ?>" style="background:#eee;line-height:25px;border:#ddd 1px solid">
		      			 <select name="cc[class_extend_column][<?php echo $_key; ?>][extend]">
				      	 	<option value="yes" <?php if($val['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
				      	 	<option value="no" <?php if(empty($val['extend']) || $val['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
		      			 </select>
				      	 <select name="cc[class_extend_column][<?php echo $_key; ?>][status]">
				      	 	<option value="show" <?php if($val['status']=='show') echo 'selected="selected"'; ?>>显示</option>
				      	 	<option value="hide" <?php if($val['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
				      	 </select>
				      	 <input type="text" name="cc[class_extend_column][<?php echo $_key; ?>][title]" value="<?php if(empty($val['title'])){ echo ''; }else{ echo $val['title']; } ?>" />
				      	 <br />
						 跟随：
					     <select name="cc[class_extend_column][<?php echo $_key; ?>][pos]">
				  	 	 <option value="first" <?php if($val['pos']=='first') echo 'selected="selected"'; ?>>最前</option>
				  	 	 <option value="order_change" <?php if($val['pos']=='order_change') echo 'selected="selected"'; ?>>排序修改</option>
						 <option value="last" <?php if($val['pos']=='' || $val['pos']=='last') echo 'selected="selected"'; ?>>最后</option>
				  	 	 </select>
				  	 	 类型：
				  	 	 <select name="cc[class_extend_column][<?php echo $_key; ?>][type]">
				  	 	 <option value="html" <?php if($val['type']=='html') echo 'selected="selected"'; ?>>HTML</option>
				  	 	 <option value="php" <?php if($val['type']=='php') echo 'selected="selected"'; ?>>PHP</option>
				  	 	 </select>
				      	 <br />
				      	 <textarea style="width:98%;resize:none;overflow:hidden" name="cc[class_extend_column][<?php echo $_key; ?>][content]" onpropertychange="if(this.scrollHeight>40) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>40) this.style.height=this.scrollHeight+'px';"><?php if(empty($val['content'])){ echo ''; }else{ echo $val['content']; } ?></textarea>
				      	 <input type="button" style="width:98%" value="删除" onclick="del_new_class_extend_column(<?php echo $_key; ?>)" />
      			 	</div>
      			 	<?php
      			 			$_key++;
	      				}
	      			}
	      			?>
		      	 </div>
		      	 <script type="text/javascript">
		      	 	var new_class_extend_column_id = <?php echo $_key; ?>;
		      	 	function add_new_class_extend_column(){
		      	 		new_class_extend_column_id++;
		      	 		var new_class_extend_column = document.getElementById('new_class_extend_column');
		      	 		var newdiv = document.createElement("div");
		      	 		newdiv.id='new_class_extend_column_'+new_class_extend_column_id;
		      	 		new_class_extend_column.appendChild(newdiv);
		      	 		document.getElementById(newdiv.id).style.background='#eee';
		      	 		document.getElementById(newdiv.id).style.lineHeight='25px';
		      	 		document.getElementById(newdiv.id).style.border='#ddd 1px solid';
		      	 		document.getElementById(newdiv.id).innerHTML="<select name=\"cc[class_extend_column]["+new_class_extend_column_id+"][extend]\"><option value=\"yes\">延伸</option><option value=\"no\" selected=\"selected\">不延伸</option></select><select name=\"cc[class_extend_column]["+new_class_extend_column_id+"][status]\"><option value=\"show\">显示</option><option value=\"hide\">隐藏</option></select><input type=\"text\" name=\"cc[class_extend_column]["+new_class_extend_column_id+"][title]\" /><br />跟随：<select name=\"cc[class_extend_column]["+new_class_extend_column_id+"][pos]\"><option value=\"first\">最前</option><option value=\"order_change\">排序修改</option><option value=\"last\" selected=\"selected\">最后</option></select>类型：<select name=\"cc[class_extend_column]["+new_class_extend_column_id+"][type]\"><option value=\"html\">HTML</option><option value=\"php\">PHP</option></select><br /><textarea style=\"width:98%;resize:none;\" name=\"cc[class_extend_column]["+new_class_extend_column_id+"][content]\" onpropertychange=\"if(this.scrollHeight>40) this.style.height=this.scrollHeight+'px';\"  oninput=\"if(this.scrollHeight>40) this.style.height=this.scrollHeight+'px';\"></textarea><input type=\"button\" style=\"width:98%\" value=\"删除\" onclick=\"del_new_class_extend_column("+new_class_extend_column_id+")\">";
		      	 	}
		      	 	function del_new_class_extend_column(id){
		      	 		var new_class_extend_column = document.getElementById('new_class_extend_column');
		      	 		new_class_extend_column.removeChild(document.getElementById('new_class_extend_column_'+id));
		      	 	}
		      	 </script>
		      	 <br />
		      	 <br />
		      	 操作功能：<?php if($_ccset['alone_ccset']){ ?><input type="checkbox" name="cc[alone_ccset_class_extend_action]" value='yes' <?php if($cc_info['alone_ccset_class_extend_action']=='yes'){ ?>checked="checked"<?php } ?> style="height:auto" />启用<?php } ?><br />
                 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
                 <select name="cc[class][class_view][extend]">
                    <option value="yes" <?php if($cc_info['class']['class_view']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
                    <option value="no" <?php if(empty($cc_info['class']['class_view']['extend']) || $cc_info['class']['class_view']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
                 </select>
                 <?php } ?>
                 <select name="cc[class][class_view][status]">
                    <option value="show" <?php if($cc_info['class']['class_view']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
                    <option value="hide" <?php if($cc_info['class']['class_view']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
                 </select>
                 <input type="text" name="cc[class][class_view][title]" value="<?php if(empty($cc_info['class']['class_view']['title'])){ echo '查看'; }else{ echo $cc_info['class']['class_view']['title']; } ?>" />
                 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[class][subclass_add][extend]">
		      	 	<option value="yes" <?php if($cc_info['class']['subclass_add']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['class']['subclass_add']['extend']) || $cc_info['class']['subclass_add']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[class][subclass_add][status]">
		      	 	<option value="show" <?php if($cc_info['class']['subclass_add']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['class']['subclass_add']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[class][subclass_add][title]" value="<?php if(empty($cc_info['class']['subclass_add']['title'])){ echo '添加子类别'; }else{ echo $cc_info['class']['subclass_add']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[class][info_add][extend]">
		      	 	<option value="yes" <?php if($cc_info['class']['info_add']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['class']['info_add']['extend']) || $cc_info['class']['info_add']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[class][info_add][status]">
		      	 	<option value="show" <?php if($cc_info['class']['info_add']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['class']['info_add']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[class][info_add][title]" value="<?php if(empty($cc_info['class']['info_add']['title'])){ echo '添加资料'; }else{ echo $cc_info['class']['info_add']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[class][info_copy][extend]">
		      	 	<option value="yes" <?php if($cc_info['class']['info_copy']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['class']['info_copy']['extend']) || $cc_info['class']['info_copy']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[class][info_copy][status]">
		      	 	<option value="show" <?php if($cc_info['class']['info_copy']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['class']['info_copy']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[class][info_copy][title]" value="<?php if(empty($cc_info['class']['info_copy']['title'])){ echo '复制添加'; }else{ echo $cc_info['class']['info_copy']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[class][class_change][extend]">
		      	 	<option value="yes" <?php if($cc_info['class']['class_change']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['class']['class_change']['extend']) || $cc_info['class']['class_change']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[class][class_change][status]">
		      	 	<option value="show" <?php if($cc_info['class']['class_change']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['class']['class_change']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[class][class_change][title]" value="<?php if(empty($cc_info['class']['class_change']['title'])){ echo '更改'; }else{ echo $cc_info['class']['class_change']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[class][class_detete][extend]">
		      	 	<option value="yes" <?php if($cc_info['class']['class_detete']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['class']['class_detete']['extend']) || $cc_info['class']['class_detete']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[class][class_detete][status]">
		      	 	<option value="show" <?php if($cc_info['class']['class_detete']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['class']['class_detete']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[class][class_detete][title]" value="<?php if(empty($cc_info['class']['class_detete']['title'])){ echo '删除'; }else{ echo $cc_info['class']['class_detete']['title']; } ?>" />
		      	 <br />
		      	 <br />
      			 新增操作链接:<input type="button" value="添加" onclick="add_new_class_extend_action()"><br />
      			 <div id="new_class_extend_action">
      			 	<?php
      			 	$_key=1;
      			 	if($cc_info['class_extend_action']){
	      			 	foreach($cc_info['class_extend_action'] as $val){
      			 	?>
      			 	<div id="new_class_extend_action_<?php echo $_key; ?>" style="background:#eee;line-height:25px;border:#ddd 1px solid">
		      			 <select name="cc[class_extend_action][<?php echo $_key; ?>][extend]">
				      	 	<option value="yes" <?php if($val['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
				      	 	<option value="no" <?php if(empty($val['extend']) || $val['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
		      			 </select>
				      	 <select name="cc[class_extend_action][<?php echo $_key; ?>][status]">
				      	 	<option value="show" <?php if($val['status']=='show') echo 'selected="selected"'; ?>>显示</option>
				      	 	<option value="hide" <?php if($val['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
				      	 </select>
				      	 <input type="text" name="cc[class_extend_action][<?php echo $_key; ?>][title]" value="<?php if(empty($val['title'])){ echo ''; }else{ echo $val['title']; } ?>" />
				      	 <br />
				      	 跟随：
						    <select name="cc[class_extend_action][<?php echo $_key; ?>][pos]">
					  	 	<option value="first" <?php if($val['pos']=='first') echo 'selected="selected"'; ?>>最前</option>
					  	 	<option value="subclass_add" <?php if($val['pos']=='subclass_add') echo 'selected="selected"'; ?>>添加子类别</option>
					  	 	<option value="info_add" <?php if($val['pos']=='info_add') echo 'selected="selected"'; ?>>添加资料</option>
					  	 	<option value="info_copy" <?php if($val['pos']=='info_copy') echo 'selected="selected"'; ?>>复制添加</option>
					  	 	<option value="class_change" <?php if($val['pos']=='class_change') echo 'selected="selected"'; ?>>更改</option>
					  	 	<option value="class_detete" <?php if($val['pos']=='class_detete') echo 'selected="selected"'; ?>>删除</option>
							<option value="last" <?php if($val['pos']=='' || $val['pos']=='last') echo 'selected="selected"'; ?>>最后</option>
					  	 	</select>
					  	 	属性：<input size="10" name="cc[class_extend_action][<?php echo $_key; ?>][attr]" value="<?php if(empty($val['attr'])){ echo ''; }else{ echo rp($val['attr']); } ?>"/>
				      	 <br />
				      	 <input style="width:98%;" name="cc[class_extend_action][<?php echo $_key; ?>][url]" value="<?php if(empty($val['url'])){ echo ''; }else{ echo $val['url']; } ?>"><br />
				      	 <input type="button" style="width:98%" value="删除" onclick="del_new_class_extend_action(<?php echo $_key; ?>)" />
      			 	</div>
      			 	<?php
      			 			$_key++;
	      				}
	      			}
	      			?>
		      	 </div>
		      	 <script type="text/javascript">
		      	 	var new_class_extend_action_id = <?php echo $_key; ?>;
		      	 	function add_new_class_extend_action(){
		      	 		new_class_extend_action_id++;
		      	 		var new_class_extend_action = document.getElementById('new_class_extend_action');
		      	 		var newdiv = document.createElement("div");
		      	 		newdiv.id='new_class_extend_action_'+new_class_extend_action_id;
		      	 		new_class_extend_action.appendChild(newdiv);
		      	 		document.getElementById(newdiv.id).style.background='#eee';
		      	 		document.getElementById(newdiv.id).style.lineHeight='25px';
		      	 		document.getElementById(newdiv.id).style.border='#ddd 1px solid';
		      	 		document.getElementById(newdiv.id).innerHTML="<select name=\"cc[class_extend_action]["+new_class_extend_action_id+"][extend]\"><option value=\"yes\">延伸</option><option value=\"no\" selected=\"selected\">不延伸</option></select><select name=\"cc[class_extend_action]["+new_class_extend_action_id+"][status]\"><option value=\"show\">显示</option><option value=\"hide\">隐藏</option></select><input type=\"text\" name=\"cc[class_extend_action]["+new_class_extend_action_id+"][title]\" /><br />跟随：<select name=\"cc[class_extend_action]["+new_class_extend_action_id+"][pos]\"><option value=\"first\">最前</option><option value=\"class_view\">查看</option><option value=\"subclass_add\">添加子类别</option><option value=\"info_add\">添加资料</option><option value=\"info_copy\">复制添加</option><option value=\"class_change\">更改</option><option value=\"class_detete\">删除</option><option value=\"last\" selected=\"selected\">最后</option></select>属性：<input size=\"10\" name=\"cc[class_extend_action]["+new_class_extend_action_id+"][attr]\" /><br /><input style=\"width:98%;\" name=\"cc[class_extend_action]["+new_class_extend_action_id+"][url]\"><br /><input type=\"button\" style=\"width:98%\" value=\"删除\" onclick=\"del_new_class_extend_action("+new_class_extend_action_id+")\">";
		      	 	}
		      	 	function del_new_class_extend_action(id){
		      	 		var new_class_extend_action = document.getElementById('new_class_extend_action');
		      	 		new_class_extend_action.removeChild(document.getElementById('new_class_extend_action_'+id));
		      	 	}
		      	 </script>
		      	 <br />
		      	 <br />
      	 	</td>
      	 	<?php
      	 	}
      	 	if($_ccset['all'] || $_ccset['class']['save']){
      	 	?>
      	 	<td valign="top">
                <?php if($_ccset['alone_ccset']){ ?>表单信息：<input type="checkbox" name="cc[alone_ccset_class_info]" value='yes' <?php if($cc_info['alone_ccset_class_info']=='yes'){ ?>checked="checked"<?php } ?> style="height:auto" />启用<br /><?php } ?>
		      	 单一属性：<br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[class_info][parent_class][extend]">
		      	 	<option value="yes" <?php if($cc_info['class_info']['parent_class']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['class_info']['parent_class']['extend']) || $cc_info['class_info']['parent_class']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[class_info][parent_class][status]">
		      	 	<option value="show" <?php if($cc_info['class_info']['parent_class']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['class_info']['parent_class']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[class_info][parent_class][title]" value="<?php if(empty($cc_info['class_info']['parent_class']['title'])){ echo '所属分类'; }else{ echo $cc_info['class_info']['parent_class']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[class_info][class_order][extend]">
		      	 	<option value="yes" <?php if($cc_info['class_info']['class_order']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['class_info']['class_order']['extend']) || $cc_info['class_info']['class_order']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[class_info][class_order][status]">
		      	 	<option value="show" <?php if($cc_info['class_info']['class_order']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['class_info']['class_order']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[class_info][class_order][title]" value="<?php if(empty($cc_info['class_info']['class_order']['title'])){ echo '排列序号'; }else{ echo $cc_info['class_info']['class_order']['title']; } ?>" />
		      	 <br />
		    </td>
		    <td valign="top">
                 <?php if($_ccset['alone_ccset']){ ?><br /><?php } ?>
		      	 中文属性：<br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[class_info][cn_class_name][extend]">
		      	 	<option value="yes" <?php if($cc_info['class_info']['cn_class_name']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['class_info']['cn_class_name']['extend']) || $cc_info['class_info']['cn_class_name']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[class_info][cn_class_name][status]">
		      	 	<option value="show" <?php if($cc_info['class_info']['cn_class_name']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['class_info']['cn_class_name']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[class_info][cn_class_name][title]" value="<?php if(empty($cc_info['class_info']['cn_class_name']['title'])){ echo '类别名称'; }else{ echo $cc_info['class_info']['cn_class_name']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[class_info][cn_class_title][extend]">
		      	 	<option value="yes" <?php if($cc_info['class_info']['cn_class_title']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['class_info']['cn_class_title']['extend']) || $cc_info['class_info']['cn_class_title']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[class_info][cn_class_title][status]">
		      	 	<option value="show" <?php if($cc_info['class_info']['cn_class_title']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['class_info']['cn_class_title']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[class_info][cn_class_title][title]" value="<?php if(empty($cc_info['class_info']['cn_class_title']['title'])){ echo '标　　题'; }else{ echo $cc_info['class_info']['cn_class_title']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[class_info][cn_class_keyword][extend]">
		      	 	<option value="yes" <?php if($cc_info['class_info']['cn_class_keyword']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['class_info']['cn_class_keyword']['extend']) || $cc_info['class_info']['cn_class_keyword']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[class_info][cn_class_keyword][status]">
		      	 	<option value="show" <?php if($cc_info['class_info']['cn_class_keyword']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['class_info']['cn_class_keyword']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[class_info][cn_class_keyword][title]" value="<?php if(empty($cc_info['class_info']['cn_class_keyword']['title'])){ echo '关 键 词'; }else{ echo $cc_info['class_info']['cn_class_keyword']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[class_info][cn_class_description][extend]">
		      	 	<option value="yes" <?php if($cc_info['class_info']['cn_class_description']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['class_info']['cn_class_description']['extend']) || $cc_info['class_info']['cn_class_description']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[class_info][cn_class_description][status]">
		      	 	<option value="show" <?php if($cc_info['class_info']['cn_class_description']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['class_info']['cn_class_description']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[class_info][cn_class_description][title]" value="<?php if(empty($cc_info['class_info']['cn_class_description']['title'])){ echo '描　　述'; }else{ echo $cc_info['class_info']['cn_class_description']['title']; } ?>" />
		    </td>
	      	<?php if ($bb_en == '001') { ?>
	      	<td valign="top">
                <?php if($_ccset['alone_ccset']){ ?><br /><?php } ?>
		      	英文属性：<br />
		      	<?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[class_info][en_class_name][extend]">
		      	 	<option value="yes" <?php if($cc_info['class_info']['en_class_name']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['class_info']['en_class_name']['extend']) || $cc_info['class_info']['en_class_name']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[class_info][en_class_name][status]">
		      	 	<option value="show" <?php if($cc_info['class_info']['en_class_name']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['class_info']['en_class_name']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[class_info][en_class_name][title]" value="<?php if(empty($cc_info['class_info']['en_class_name']['title'])){ echo '类别名称'; }else{ echo $cc_info['class_info']['en_class_name']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[class_info][en_class_title][extend]">
		      	 	<option value="yes" <?php if($cc_info['class_info']['en_class_title']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['class_info']['en_class_title']['extend']) || $cc_info['class_info']['en_class_title']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[class_info][en_class_title][status]">
		      	 	<option value="show" <?php if($cc_info['class_info']['en_class_title']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['class_info']['en_class_title']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[class_info][en_class_title][title]" value="<?php if(empty($cc_info['class_info']['en_class_title']['title'])){ echo '标　　题'; }else{ echo $cc_info['class_info']['en_class_title']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[class_info][en_class_keyword][extend]">
		      	 	<option value="yes" <?php if($cc_info['class_info']['en_class_keyword']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['class_info']['en_class_keyword']['extend']) || $cc_info['class_info']['en_class_keyword']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[class_info][en_class_keyword][status]">
		      	 	<option value="show" <?php if($cc_info['class_info']['en_class_keyword']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['class_info']['en_class_keyword']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[class_info][en_class_keyword][title]" value="<?php if(empty($cc_info['class_info']['en_class_keyword']['title'])){ echo '关 键 词'; }else{ echo $cc_info['class_info']['en_class_keyword']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[class_info][en_class_description][extend]">
		      	 	<option value="yes" <?php if($cc_info['class_info']['en_class_description']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['class_info']['en_class_description']['extend']) || $cc_info['class_info']['en_class_description']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[class_info][en_class_description][status]">
		      	 	<option value="show" <?php if($cc_info['class_info']['en_class_description']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['class_info']['en_class_description']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[class_info][en_class_description][title]" value="<?php if(empty($cc_info['class_info']['en_class_description']['title'])){ echo '描　　述'; }else{ echo $cc_info['class_info']['en_class_description']['title']; } ?>" />
	      	 </td>
	      	<?php } ?>
	      	<?php } ?>
	    </tr></table>
      </td>
    </tr>
    <?php
	}
	if($_ccset['all'] || $_ccset['class_extend_field']){
    ?>
    <tr class="extend_tr" bgcolor="#FFFFFF" <?php if (!$_SESSION['superadmin']){ ?>style="display:none"<?php } ?>>
      <td width="120" height="20" align="right" bgcolor="#FFFFFF">【类别】字段扩展：</td>
      <td height="20">
        <?php if($_ccset['alone_ccset']){ ?><input type="checkbox" name="cc[alone_ccset_class_extend_field]" value='yes' <?php if($cc_info['alone_ccset_class_extend_field']=='yes'){ ?>checked="checked"<?php } ?> style="height:auto" />启用<br /><?php } ?>
      	<table id="class_extend_field_box" width="100%">
      		<tr style="background:#eee">
		      	<?php if($_ccset['all'] || $_ccset['extend_set']){ ?><td>延伸</td><?php } ?>
		      	<td>跟随位置</td>
		      	<td>排序</td>
		      	<td>状态</td>
		      	<td>类型</td>
		      	<td>必填</td>
		      	<td>唯一</td>
		      	<td>字段名</td>
		      	<td>名称</td>
		      	<td>
		      		选项(下拉、单选、复选)<br />
		      		1.用竖线分割<br />
		      		2.赋值可以用=,例如:1=深圳<br />
		      		3.atype/atype_info:分类ID可分别调用类别和信息,例如:atype:88
		      	</td>
		      	<td>默认值</td>
		      	<td>属性附加</td>
		      	<td>前文本</td>
		      	<td>后文本</td>
		      	<td>
		      		<input type="button" value="添加" onclick="add_class_extend_field()">
		      	</td>
		    </tr>
		    <?php
		    $key=0;
		    if($cc_info['class_extend_field']){
                $cc_info['class_extend_field'] = array_sort($cc_info['class_extend_field'], 'order');
			    foreach($cc_info['class_extend_field'] as $val){
			    	$key++;
		    ?>
		    <tr id="class_extend_field_row_<?php echo $key; ?>">
		    	<?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
		    	<td>
					<select name="cc[class_extend_field][<?php echo $key; ?>][extend]">
			  	 	<option value="yes" <?php if($val['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
			  	 	<option value="no" <?php if(empty($val['extend']) || $val['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
					</select>
				</td>
				<?php } ?>
				<td>
			  	 	<select name="cc[class_extend_field][<?php echo $key; ?>][pos]">
			  	 	<option value="top" <?php if($val['pos']=='top') echo 'selected="selected"'; ?>>顶部</option>
			  	 	<option value="type_id" <?php if($val['pos']=='type_id') echo 'selected="selected"'; ?>>所属分类</option>
			  	 	<option value="num" <?php if($val['pos']=='num') echo 'selected="selected"'; ?>>排列序号</option>
			  	 	<option value="cn_type" <?php if($val['pos']=='cn_type') echo 'selected="selected"'; ?>>类别名称<?php if ($bb_en == '001') { ?>(中文)<?php } ?></option>
			  	 	<?php if ($bb_en == '001') { ?>
			  	 	<option value="en_type" <?php if($val['pos']=='en_type') echo 'selected="selected"'; ?>>类别名称(英文)</option>
			  	 	<?php } ?>
			  	 	<option value="cn_title" <?php if($val['pos']=='cn_title') echo 'selected="selected"'; ?>>标题<?php if ($bb_en == '001') { ?>(中文)<?php } ?></option>
			  	 	<?php if ($bb_en == '001') { ?>
			  	 	<option value="en_title" <?php if($val['pos']=='en_title') echo 'selected="selected"'; ?>>标题(英文)</option>
			  	 	<?php } ?>
			  	 	<option value="cn_keywords" <?php if($val['pos']=='cn_keywords') echo 'selected="selected"'; ?>>关 键 词<?php if ($bb_en == '001') { ?>(中文)<?php } ?></option>
			  	 	<?php if ($bb_en == '001') { ?>
			  	 	<option value="en_keywords" <?php if($val['pos']=='en_keywords') echo 'selected="selected"'; ?>>关 键 词(英文)</option>
			  	 	<?php } ?>
			  	 	<option value="cn_description" <?php if($val['pos']=='cn_description') echo 'selected="selected"'; ?>>描述<?php if ($bb_en == '001') { ?>(中文)<?php } ?></option>
			  	 	<?php if ($bb_en == '001') { ?>
			  	 	<option value="en_description" <?php if($val['pos']=='en_description') echo 'selected="selected"'; ?>>描述(英文)</option>
			  	 	<?php } ?>
					<option value="bottom" <?php if($val['pos']=='' || $val['pos']=='bottom') echo 'selected="selected"'; ?>>底部</option>
			  	 	</select>
				</td>
				<td>
		  	 		<input type="text" name="cc[class_extend_field][<?php echo $key; ?>][order]" value="<?php if(empty($val['order'])){ echo '0'; }else{ echo $val['order']; } ?>" style="width:30px" />
				</td>
				<td>
			  	 	<select name="cc[class_extend_field][<?php echo $key; ?>][status]">
			  	 	<option value="show" <?php if($val['status']=='show') echo 'selected="selected"'; ?>>显示</option>
			  	 	<option value="hide" <?php if($val['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
			  	 	</select>
				</td>
				<td>
			  	 	<select name="cc[class_extend_field][<?php echo $key; ?>][type]">
			  	 	<option value="string" <?php if($val['type']=='string') echo 'selected="selected"'; ?>>字符串框</option>
                    <option value="int" <?php if($val['type']=='int') echo 'selected="selected"'; ?>>字符串框(数值型)</option>
			  	 	<option value="password" <?php if($val['type']=='password') echo 'selected="selected"'; ?>>密码框</option>
			  	 	<option value="password_md5" <?php if($val['type']=='password_md5') echo 'selected="selected"'; ?>>密码框(MD5)</option>
			  	 	<option value="text" <?php if($val['type']=='text') echo 'selected="selected"'; ?>>文本框</option>
			  	 	<option value="rtext" <?php if($val['type']=='rtext') echo 'selected="selected"'; ?>>富文本框</option>
			  	 	<option value="img" <?php if($val['type']=='img') echo 'selected="selected"'; ?>>文件上传</option>
			  	 	<option value="select" <?php if($val['type']=='select') echo 'selected="selected"'; ?>>下拉</option>
			  	 	<option value="radio" <?php if($val['type']=='radio') echo 'selected="selected"'; ?>>单选</option>
			  	 	<option value="checkbox" <?php if($val['type']=='checkbox') echo 'selected="selected"'; ?>>复选</option>
			  	 	</select>
				</td>
				<td>
		  	 		<input type="checkbox" value="yes" name="cc[class_extend_field][<?php echo $key; ?>][check]" <?php echo $val['check']=='yes'?'checked':''; ?> />
				</td>
				<td>
		  	 		<input type="checkbox" value="yes" name="cc[class_extend_field][<?php echo $key; ?>][unique]" <?php echo $val['unique']=='yes'?'checked':''; ?> />
				</td>
				<td>
		  	 		<input type="text" name="cc[class_extend_field][<?php echo $key; ?>][field]" value="<?php echo $val['field']; ?>" size="10" />
				</td>
				<td>
		  	 		<input type="text" name="cc[class_extend_field][<?php echo $key; ?>][title]" value="<?php echo $val['title']; ?>" size="10" />
				</td>
				<td>
		  	 		<input type="text" size="20" name="cc[class_extend_field][<?php echo $key; ?>][option]" value="<?php echo $val['option']; ?>" />
				</td>
				<td>
		  	 		<input type="text" name="cc[class_extend_field][<?php echo $key; ?>][defval]" value="<?php echo rp($val['defval']); ?>" size="5" />
				</td>
				<td>
		  	 		<input type="text" name="cc[class_extend_field][<?php echo $key; ?>][attr]" value="<?php echo rp($val['attr']); ?>" size="10" />
				</td>
				<td>
		  	 		<input type="text" name="cc[class_extend_field][<?php echo $key; ?>][qtxt]" value="<?php echo rp($val['qtxt']); ?>" size="5" />
				</td>
				<td>
		  	 		<input type="text" name="cc[class_extend_field][<?php echo $key; ?>][htxt]" value="<?php echo rp($val['htxt']); ?>" size="5" />
				</td>
				<td>
					<a href="javascript:;" onclick="del_class_extend_field(<?php echo $key; ?>)">删除</a>
				</td>
			</tr>
			<?php
				}
			}
			?>
		</table>
		<script type="text/javascript">
			var class_extend_field_id=<?php echo $key; ?>;
			function add_class_extend_field(){
				class_extend_field_id++;
				var table = document.getElementById('class_extend_field_box');
				var tr = table.insertRow(-1);
				tr.id="class_extend_field_row_"+class_extend_field_id;

				<?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
				var td1 = tr.insertCell(-1);
				td1.innerHTML = "<select name=\"cc[class_extend_field]["+class_extend_field_id+"][extend]\"><option value=\"yes\">延伸</option><option value=\"no\">不延伸</option></select>";
				<?php } ?>
				
				var td2 = tr.insertCell(-1);
				td2.innerHTML = "<select name=\"cc[class_extend_field]["+class_extend_field_id+"][pos]\"><option value=\"top\">顶部</option><option value=\"type_id\">所属分类</option><option value=\"num\">排列序号</option><option value=\"cn_type\">类别名称<?php if ($bb_en == '001') { ?>(中文)<?php } ?></option><?php if ($bb_en == '001') { ?><option value=\"en_type\">类别名称(英文)</option><?php } ?><option value=\"cn_title\">标题<?php if ($bb_en == '001') { ?>(中文)<?php } ?></option><?php if ($bb_en == '001') { ?><option value=\"en_title\">标题(英文)</option><?php } ?><option value=\"cn_keywords\">关 键 词<?php if ($bb_en == '001') { ?>(中文)<?php } ?></option><?php if ($bb_en == '001') { ?><option value=\"en_keywords\">关 键 词(英文)</option><?php } ?><option value=\"cn_description\">描述<?php if ($bb_en == '001') { ?>(中文)<?php } ?></option><?php if ($bb_en == '001') { ?><option value=\"en_description\">描述(英文)</option><?php } ?><option value=\"bottom\" selected=\"selected\">底部</option></select>";
				
				var td3 = tr.insertCell(-1);
				td3.innerHTML = "<input type=\"text\" name=\"cc[class_extend_field]["+class_extend_field_id+"][order]\" value=\""+(class_extend_field_id*10)+"\" style=\"width:30px\" />";

				var td4 = tr.insertCell(-1);
				td4.innerHTML = "<select name=\"cc[class_extend_field]["+class_extend_field_id+"][status]\"><option value=\"show\">显示</option><option value=\"hide\">隐藏</option></select>";
				
				var td5 = tr.insertCell(-1);
				td5.innerHTML = "<select name=\"cc[class_extend_field]["+class_extend_field_id+"][type]\"><option value=\"string\">字符串框</option><option value=\"int\">字符串框(数值型)</option><option value=\"password\">密码框</option><option value=\"password_md5\">密码框(MD5)</option><option value=\"text\">文本框</option><option value=\"rtext\">富文本框</option><option value=\"img\">文件上传</option><option value=\"select\">下拉</option><option value=\"radio\">单选</option><option value=\"checkbox\">复选</option></select>";
				
				var td6 = tr.insertCell(-1);
				td6.innerHTML = "<input type=\"checkbox\" value=\"yes\" name=\"cc[class_extend_field]["+class_extend_field_id+"][check]\" />";

				var td7 = tr.insertCell(-1);
				td7.innerHTML = "<input type=\"checkbox\" value=\"yes\" name=\"cc[class_extend_field]["+class_extend_field_id+"][unique]\" />";

				var td8 = tr.insertCell(-1);
				td8.innerHTML = "<input type=\"text\" name=\"cc[class_extend_field]["+class_extend_field_id+"][field]\" size=\"10\" />";
				
				var td9 = tr.insertCell(-1);
				td9.innerHTML = "<input type=\"text\" name=\"cc[class_extend_field]["+class_extend_field_id+"][title]\" size=\"10\" />";
				
				var td10 = tr.insertCell(-1);
				td10.innerHTML = "<input type=\"text\" size=\"20\" name=\"cc[class_extend_field]["+class_extend_field_id+"][option]\" />";
				
				var td11 = tr.insertCell(-1);
				td11.innerHTML = "<input type=\"text\" name=\"cc[class_extend_field]["+class_extend_field_id+"][defval]\" size=\"5\" />";

				var td12 = tr.insertCell(-1);
				td12.innerHTML = "<input type=\"text\" name=\"cc[class_extend_field]["+class_extend_field_id+"][attr]\" size=\"10\" />";

				var td13 = tr.insertCell(-1);
				td13.innerHTML = "<input type=\"text\" name=\"cc[class_extend_field]["+class_extend_field_id+"][qtxt]\" size=\"5\" />";

				var td14 = tr.insertCell(-1);
				td14.innerHTML = "<input type=\"text\" name=\"cc[class_extend_field]["+class_extend_field_id+"][htxt]\" size=\"5\" />";

				var td15 = tr.insertCell(-1);
				td15.innerHTML = "<a href=\"javascript:;\" onclick=\"del_class_extend_field("+class_extend_field_id+")\">删除</a>";
			}
			function del_class_extend_field(id){
				var t = document.getElementById('class_extend_field_box');
				var d = t.getElementsByTagName('tr');
				for(var i=0;i<d.length;i++){
					if(d[i].id=="class_extend_field_row_"+id){
						t.deleteRow(i);
					}
				}
			}
		</script>
      </td>
    </tr>
    <?php
	}
	if($_ccset['all'] || $_ccset['class_extend_script']){
    ?>
    <tr class="extend_tr" bgcolor="#FFFFFF" <?php if (!$_SESSION['superadmin']){ ?>style="display:none"<?php } ?>>
    	<td width="120" height="20" align="right" bgcolor="#FFFFFF">【类别】脚本扩展：</td>
    	<td height="20">
    		<table><tr>
    			<td valign="top">
    				列表前：
					<?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
	      			<select name="cc[class_script][list_top][extend]">
			      		<option value="yes" <?php if($cc_info['class_script']['list_top']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
			      		<option value="no" <?php if(empty($cc_info['class_script']['list_top']['extend']) || $cc_info['class_script']['list_top']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
	      			</select>
	      			<?php } ?>
			      	<select name="cc[class_script][list_top][status]">
			      		<option value="show" <?php if($cc_info['class_script']['list_top']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
			      		<option value="hide" <?php if($cc_info['class_script']['list_top']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
			      	</select>
    				<br />
    				<textarea name="cc[class_script][list_top][content]" style="width:226px;height:250px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['class_script']['list_top']['content']; ?></textarea>
                    <br /><br />
                    列表JS脚本：
                    <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
                    <select name="cc[class_script][list_js][extend]">
                        <option value="yes" <?php if($cc_info['class_script']['list_js']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
                        <option value="no" <?php if(empty($cc_info['class_script']['list_js']['extend']) || $cc_info['class_script']['list_js']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
                    </select>
                    <?php } ?>
                    <select name="cc[class_script][list_js][status]">
                        <option value="show" <?php if($cc_info['class_script']['list_js']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
                        <option value="hide" <?php if($cc_info['class_script']['list_js']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
                    </select>
                    <br />
                    <textarea name="cc[class_script][list_js][content]" style="width:226px;height:100px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['class_script']['list_js']['content']; ?></textarea>
    			</td>
    			<td valign="top">
    				添加前：
					<?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
	      			<select name="cc[class_script][add_top][extend]">
			      		<option value="yes" <?php if($cc_info['class_script']['add_top']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
			      		<option value="no" <?php if(empty($cc_info['class_script']['add_top']['extend']) || $cc_info['class_script']['add_top']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
	      			</select>
	      			<?php } ?>
			      	<select name="cc[class_script][add_top][status]">
			      		<option value="show" <?php if($cc_info['class_script']['add_top']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
			      		<option value="hide" <?php if($cc_info['class_script']['add_top']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
			      	</select>
    				<br />
    				<textarea name="cc[class_script][add_top][content]" style="width:226px;height:100px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['class_script']['add_top']['content']; ?></textarea>
    				<br /><br />
    				添加后：
					<?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
	      			<select name="cc[class_script][add_bottom][extend]">
			      		<option value="yes" <?php if($cc_info['class_script']['add_bottom']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
			      		<option value="no" <?php if(empty($cc_info['class_script']['add_bottom']['extend']) || $cc_info['class_script']['add_bottom']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
	      			</select>
	      			<?php } ?>
			      	<select name="cc[class_script][add_bottom][status]">
			      		<option value="show" <?php if($cc_info['class_script']['add_bottom']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
			      		<option value="hide" <?php if($cc_info['class_script']['add_bottom']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
			      	</select>
    				<br />
    				<textarea name="cc[class_script][add_bottom][content]" style="width:226px;height:100px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['class_script']['add_bottom']['content']; ?></textarea>
                    <br /><br />
                    添加JS脚本：
                    <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
                    <select name="cc[class_script][add_js][extend]">
                        <option value="yes" <?php if($cc_info['class_script']['add_js']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
                        <option value="no" <?php if(empty($cc_info['class_script']['add_js']['extend']) || $cc_info['class_script']['add_js']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
                    </select>
                    <?php } ?>
                    <select name="cc[class_script][add_js][status]">
                        <option value="show" <?php if($cc_info['class_script']['add_js']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
                        <option value="hide" <?php if($cc_info['class_script']['add_js']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
                    </select>
                    <br />
                    <textarea name="cc[class_script][add_js][content]" style="width:226px;height:100px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['class_script']['add_js']['content']; ?></textarea>
    			</td>
    			<td valign="top">
    				修改前：
					<?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
	      			<select name="cc[class_script][edit_top][extend]">
			      		<option value="yes" <?php if($cc_info['class_script']['edit_top']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
			      		<option value="no" <?php if(empty($cc_info['class_script']['edit_top']['extend']) || $cc_info['class_script']['edit_top']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
	      			</select>
	      			<?php } ?>
			      	<select name="cc[class_script][edit_top][status]">
			      		<option value="show" <?php if($cc_info['class_script']['edit_top']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
			      		<option value="hide" <?php if($cc_info['class_script']['edit_top']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
			      	</select>
    				<br />
    				<textarea name="cc[class_script][edit_top][content]" style="width:226px;height:100px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['class_script']['edit_top']['content']; ?></textarea>
    				<br /><br />
    				修改后：
					<?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
	      			<select name="cc[class_script][edit_bottom][extend]">
			      		<option value="yes" <?php if($cc_info['class_script']['edit_bottom']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
			      		<option value="no" <?php if(empty($cc_info['class_script']['edit_bottom']['extend']) || $cc_info['class_script']['edit_bottom']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
	      			</select>
	      			<?php } ?>
			      	<select name="cc[class_script][edit_bottom][status]">
			      		<option value="show" <?php if($cc_info['class_script']['edit_bottom']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
			      		<option value="hide" <?php if($cc_info['class_script']['edit_bottom']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
			      	</select>
    				<br />
    				<textarea name="cc[class_script][edit_bottom][content]" style="width:226px;height:100px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['class_script']['edit_bottom']['content']; ?></textarea>
                    <br /><br />
                    修改JS脚本：
                    <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
                    <select name="cc[class_script][edit_js][extend]">
                        <option value="yes" <?php if($cc_info['class_script']['edit_js']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
                        <option value="no" <?php if(empty($cc_info['class_script']['edit_js']['extend']) || $cc_info['class_script']['edit_js']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
                    </select>
                    <?php } ?>
                    <select name="cc[class_script][edit_js][status]">
                        <option value="show" <?php if($cc_info['class_script']['edit_js']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
                        <option value="hide" <?php if($cc_info['class_script']['edit_js']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
                    </select>
                    <br />
                    <textarea name="cc[class_script][edit_js][content]" style="width:226px;height:100px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['class_script']['edit_js']['content']; ?></textarea>
    			</td>
    			<td valign="top">
    				删除前：
					<?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
	      			<select name="cc[class_script][del_top][extend]">
			      		<option value="yes" <?php if($cc_info['class_script']['del_top']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
			      		<option value="no" <?php if(empty($cc_info['class_script']['del_top']['extend']) || $cc_info['class_script']['del_top']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
	      			</select>
	      			<?php } ?>
			      	<select name="cc[class_script][del_top][status]">
			      		<option value="show" <?php if($cc_info['class_script']['del_top']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
			      		<option value="hide" <?php if($cc_info['class_script']['del_top']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
			      	</select>
    				<br />
    				<textarea name="cc[class_script][del_top][content]" style="width:226px;height:100px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['class_script']['del_top']['content']; ?></textarea>
    				<br /><br />
    				删除后：
					<?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
	      			<select name="cc[class_script][del_bottom][extend]">
			      		<option value="yes" <?php if($cc_info['class_script']['del_bottom']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
			      		<option value="no" <?php if(empty($cc_info['class_script']['del_bottom']['extend']) || $cc_info['class_script']['del_bottom']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
	      			</select>
	      			<?php } ?>
			      	<select name="cc[class_script][del_bottom][status]">
			      		<option value="show" <?php if($cc_info['class_script']['del_bottom']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
			      		<option value="hide" <?php if($cc_info['class_script']['del_bottom']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
			      	</select>
    				<br />
    				<textarea name="cc[class_script][del_bottom][content]" style="width:226px;height:250px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['class_script']['del_bottom']['content']; ?></textarea>
    			</td>
    		</tr></table>
    	</td>
    </tr>
    <?php
	}
    if($_ccset['all'] || $_ccset['info_alone_table']){
    ?>
    <tr class="extend_tr" bgcolor="#c8d9ed" <?php if (!$_SESSION['superadmin']){ ?>style="display:none"<?php } ?>>
    	<td width="120" height="20" align="right">【信息】独立数据表：</td>
    	<td height="20">
    		<input type="text" name="cc[info_alone_table_name]" value="<?php echo $cc_info['info_alone_table_name']; ?>" /> *填写则将自动建立新表，否则追加在atype_info表中
    	</td>
	</tr>
    <?php
	}
	if($_ccset['all'] || $_ccset['info']){
    ?>
    <tr class="extend_tr" bgcolor="#FFFFFF" <?php if (!$_SESSION['superadmin']){ ?>style="display:none"<?php } ?>>
      <td width="120" height="20" align="right" bgcolor="#FFFFFF">
        【信息】控制：<br />
        <br/>
        批量处理
        <br/>
        <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
         <select onchange="$('#info_ccset_box select[name$=\\[extend\\]]').val(this.value);">
            <option value="yes">延伸</option>
            <option value="no" selected="selected">不延伸</option>
         </select><br />
         <?php } ?>
         <select onchange="$('#info_ccset_box select[name$=\\[status\\]]').val(this.value);">
            <option value="show" selected="selected">显示</option>
            <option value="hide">隐藏</option>
         </select>
      </td>
      <td height="20" id="info_ccset_box">
      	<table><tr>
      		<?php
      		if($_ccset['all'] || $_ccset['info']['index']){
      		?>
      		<td valign="top">
                <?php if(!$_ccset['alone_ccset']){ ?>
                <?php
                if($_GET['t_action']=='0002'){
                    $query = mysql_query("SELECT * FROM `{$table_name1}` WHERE `type_id`='{$id}'");
                    if(mysql_num_rows($query)>0){
                ?>
                默认类别：<select name="cc[info_deftype]">
                    <option value="">不指定</option>
                    <?php
                    while($_tmpinfo = mysql_fetch_assoc($query)){
                        $sel = '';
                        if($cc_info['info_deftype']==$_tmpinfo['id']) $sel='selected="selected"';
                        echo "<option value='{$_tmpinfo['id']}' {$sel}>{$_tmpinfo['cn_type']}</option>";
                    }
                    ?>
                </select>
                <br />
                <?php
                    }else{
                ?>
                <input type="hidden" name="cc[info_deftype]" value="" />
                <?php
                    }
                }
                ?>
                排序规则：<input type="text" size="30" name="cc[info_order_rule]" value="<?php if(empty($cc_info['info_order_rule'])){ echo ''; }else{ echo $cc_info['info_order_rule']; } ?>" /><br />
                <?php } ?>
		      	列表功能：<?php if($_ccset['alone_ccset']){ ?><input type="checkbox" name="cc[alone_ccset_info_extend_column]" value='yes' <?php if($cc_info['alone_ccset_info_extend_column']=='yes'){ ?>checked="checked"<?php } ?> style="height:auto" />启用<?php } ?><br />
		      	<?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info_list][order_title][extend]">
		      	 	<option value="yes" <?php if($cc_info['info_list']['order_title']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info_list']['order_title']['extend']) || $cc_info['info_list']['order_title']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[info_list][order_title][status]">
		      	 	<option value="show" <?php if($cc_info['info_list']['order_title']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info_list']['order_title']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[info_list][order_title][title]" value="<?php if(empty($cc_info['info_list']['order_title']['title'])){ echo '信息名称'; }else{ echo $cc_info['info_list']['order_title']['title']; } ?>" />
		      	 <br />
		      	<?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info_list][order_change][extend]">
		      	 	<option value="yes" <?php if($cc_info['info_list']['order_change']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info_list']['order_change']['extend']) || $cc_info['info_list']['order_change']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[info_list][order_change][status]">
		      	 	<option value="show" <?php if($cc_info['info_list']['order_change']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info_list']['order_change']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[info_list][order_change][title]" value="<?php if(empty($cc_info['info_list']['order_change']['title'])){ echo '排序修改'; }else{ echo $cc_info['info_list']['order_change']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info_list][list_info_class][extend]">
		      	 	<option value="yes" <?php if($cc_info['info_list']['list_info_class']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info_list']['list_info_class']['extend']) || $cc_info['info_list']['list_info_class']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[info_list][list_info_class][status]">
		      	 	<option value="show" <?php if($cc_info['info_list']['list_info_class']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info_list']['list_info_class']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[info_list][list_info_class][title]" value="<?php if(empty($cc_info['info_list']['list_info_class']['title'])){ echo '所属类别'; }else{ echo $cc_info['info_list']['list_info_class']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info_list][list_recommend_info][extend]">
		      	 	<option value="yes" <?php if($cc_info['info_list']['list_recommend_info']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info_list']['list_recommend_info']['extend']) || $cc_info['info_list']['list_recommend_info']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[info_list][list_recommend_info][status]">
		      	 	<option value="show" <?php if($cc_info['info_list']['list_recommend_info']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info_list']['list_recommend_info']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[info_list][list_recommend_info][title]" value="<?php if(empty($cc_info['info_list']['list_recommend_info']['title'])){ echo '推荐信息'; }else{ echo $cc_info['info_list']['list_recommend_info']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info_list][list_thumb][extend]">
		      	 	<option value="yes" <?php if($cc_info['info_list']['list_thumb']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info_list']['list_thumb']['extend']) || $cc_info['info_list']['list_thumb']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[info_list][list_thumb][status]">
		      	 	<option value="show" <?php if($cc_info['info_list']['list_thumb']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info_list']['list_thumb']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[info_list][list_thumb][title]" value="<?php if(empty($cc_info['info_list']['list_thumb']['title'])){ echo '缩略图'; }else{ echo $cc_info['info_list']['list_thumb']['title']; } ?>" />
		      	 <br />
		      	 <br />
      			 新增列表栏目:<input type="button" value="添加" onclick="add_new_info_extend_column()"><br />
      			 <div id="new_info_extend_column">
      			 	<?php
      			 	$_key=1;
      			 	if($cc_info['info_extend_column']){
	      			 	foreach($cc_info['info_extend_column'] as $val){
      			 	?>
      			 	<div id="new_info_extend_column_<?php echo $_key; ?>" style="background:#eee;line-height:25px;border:#ddd 1px solid">
		      			 <select name="cc[info_extend_column][<?php echo $_key; ?>][extend]">
				      	 	<option value="yes" <?php if($val['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
				      	 	<option value="no" <?php if(empty($val['extend']) || $val['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
		      			 </select>
				      	 <select name="cc[info_extend_column][<?php echo $_key; ?>][status]">
				      	 	<option value="show" <?php if($val['status']=='show') echo 'selected="selected"'; ?>>显示</option>
				      	 	<option value="hide" <?php if($val['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
				      	 </select>
				      	 <input type="text" name="cc[info_extend_column][<?php echo $_key; ?>][title]" value="<?php if(empty($val['title'])){ echo ''; }else{ echo $val['title']; } ?>" />
				      	 <br />
						 跟随：
					     <select name="cc[info_extend_column][<?php echo $_key; ?>][pos]">
				  	 	 <option value="first" <?php if($val['pos']=='first') echo 'selected="selected"'; ?>>最前</option>
				  	 	 <option value="order_title" <?php if($val['pos']=='order_title') echo 'selected="selected"'; ?>>信息名称</option>
				  	 	 <option value="order_change" <?php if($val['pos']=='order_change') echo 'selected="selected"'; ?>>排序修改</option>
				  	 	 <option value="list_info_class" <?php if($val['pos']=='list_info_class') echo 'selected="selected"'; ?>>所属类别</option>
				  	 	 <option value="list_recommend_info" <?php if($val['pos']=='list_recommend_info') echo 'selected="selected"'; ?>>推荐信息</option>
				  	 	 <option value="list_thumb" <?php if($val['pos']=='list_thumb') echo 'selected="selected"'; ?>>缩略图</option>
						 <option value="last" <?php if($val['pos']=='' || $val['pos']=='last') echo 'selected="selected"'; ?>>最后</option>
				  	 	 </select>
				  	 	 类型：
				  	 	 <select name="cc[info_extend_column][<?php echo $_key; ?>][type]">
				  	 	 <option value="html" <?php if($val['type']=='html') echo 'selected="selected"'; ?>>HTML</option>
				  	 	 <option value="php" <?php if($val['type']=='php') echo 'selected="selected"'; ?>>PHP</option>
				  	 	 </select>
				      	 <br />
				      	 <textarea style="width:98%;resize:none;overflow:hidden" name="cc[info_extend_column][<?php echo $_key; ?>][content]" onpropertychange="if(this.scrollHeight>40) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>40) this.style.height=this.scrollHeight+'px';"><?php if(empty($val['content'])){ echo ''; }else{ echo $val['content']; } ?></textarea>
				      	 <input type="button" style="width:98%" value="删除" onclick="del_new_info_extend_column(<?php echo $_key; ?>)" />
      			 	</div>
      			 	<?php
      			 			$_key++;
	      				}
	      			}
	      			?>
		      	 </div>
		      	 <script type="text/javascript">
		      	 	var new_info_extend_column_id = <?php echo $_key; ?>;
		      	 	function add_new_info_extend_column(){
		      	 		new_info_extend_column_id++;
		      	 		var new_info_extend_column = document.getElementById('new_info_extend_column');
		      	 		var newdiv = document.createElement("div");
		      	 		newdiv.id='new_info_extend_column_'+new_info_extend_column_id;
		      	 		new_info_extend_column.appendChild(newdiv);
		      	 		document.getElementById(newdiv.id).style.background='#eee';
		      	 		document.getElementById(newdiv.id).style.lineHeight='25px';
		      	 		document.getElementById(newdiv.id).style.border='#ddd 1px solid';
		      	 		document.getElementById(newdiv.id).innerHTML="<select name=\"cc[info_extend_column]["+new_info_extend_column_id+"][extend]\"><option value=\"yes\">延伸</option><option value=\"no\" selected=\"selected\">不延伸</option></select><select name=\"cc[info_extend_column]["+new_info_extend_column_id+"][status]\"><option value=\"show\">显示</option><option value=\"hide\">隐藏</option></select><input type=\"text\" name=\"cc[info_extend_column]["+new_info_extend_column_id+"][title]\" /><br />跟随：<select name=\"cc[info_extend_column]["+new_info_extend_column_id+"][pos]\"><option value=\"first\">最前</option><option value=\"order_title\">信息名称</option><option value=\"order_change\">排序修改</option><option value=\"list_info_class\">所属类别</option><option value=\"list_recommend_info\">推荐信息</option><option value=\"list_thumb\">缩略图</option><option value=\"last\" selected=\"selected\">最后</option></select>类型：<select name=\"cc[info_extend_column]["+new_info_extend_column_id+"][type]\"><option value=\"html\">HTML</option><option value=\"php\">PHP</option></select><br /><textarea style=\"width:98%;resize:none;\" name=\"cc[info_extend_column]["+new_info_extend_column_id+"][content]\" onpropertychange=\"if(this.scrollHeight>40) this.style.height=this.scrollHeight+'px';\"  oninput=\"if(this.scrollHeight>40) this.style.height=this.scrollHeight+'px';\"></textarea><input type=\"button\" style=\"width:98%\" value=\"删除\" onclick=\"del_new_info_extend_column("+new_info_extend_column_id+")\">";
		      	 	}
		      	 	function del_new_info_extend_column(id){
		      	 		var new_info_extend_column = document.getElementById('new_info_extend_column');
		      	 		new_info_extend_column.removeChild(document.getElementById('new_info_extend_column_'+id));
		      	 	}
		      	 </script>
		      	 <br />
		      	 <br />
		      	 操作功能：<?php if($_ccset['alone_ccset']){ ?><input type="checkbox" name="cc[alone_ccset_info_extend_action]" value='yes' <?php if($cc_info['alone_ccset_info_extend_action']=='yes'){ ?>checked="checked"<?php } ?> style="height:auto" />启用<?php } ?><br />
                 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
                 <select name="cc[info_list][info_view][extend]">
                    <option value="yes" <?php if($cc_info['info_list']['info_view']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
                    <option value="no" <?php if(empty($cc_info['info_list']['info_view']['extend']) || $cc_info['info_list']['info_view']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
                 </select>
                 <?php } ?>
                 <select name="cc[info_list][info_view][status]">
                    <option value="show" <?php if($cc_info['info_list']['info_view']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
                    <option value="hide" <?php if($cc_info['info_list']['info_view']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
                 </select>
                 <input type="text" name="cc[info_list][info_view][title]" value="<?php if(empty($cc_info['info_list']['info_view']['title'])){ echo '查看'; }else{ echo $cc_info['info_list']['info_view']['title']; } ?>" />
                 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info_list][info_copy][extend]">
		      	 	<option value="yes" <?php if($cc_info['info_list']['info_copy']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info_list']['info_copy']['extend']) || $cc_info['info_list']['info_copy']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[info_list][info_copy][status]">
		      	 	<option value="show" <?php if($cc_info['info_list']['info_copy']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info_list']['info_copy']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[info_list][info_copy][title]" value="<?php if(empty($cc_info['info_list']['info_copy']['title'])){ echo '复制添加'; }else{ echo $cc_info['info_list']['info_copy']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info_list][info_change][extend]">
		      	 	<option value="yes" <?php if($cc_info['info_list']['info_change']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info_list']['info_change']['extend']) || $cc_info['info_list']['info_change']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[info_list][info_change][status]">
		      	 	<option value="show" <?php if($cc_info['info_list']['info_change']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info_list']['info_change']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[info_list][info_change][title]" value="<?php if(empty($cc_info['info_list']['info_change']['title'])){ echo '更改'; }else{ echo $cc_info['info_list']['info_change']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info_list][info_detete][extend]">
		      	 	<option value="yes" <?php if($cc_info['info_list']['info_detete']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info_list']['info_detete']['extend']) || $cc_info['info_list']['info_detete']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[info_list][info_detete][status]">
		      	 	<option value="show" <?php if($cc_info['info_list']['info_detete']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info_list']['info_detete']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[info_list][info_detete][title]" value="<?php if(empty($cc_info['info_list']['info_detete']['title'])){ echo '删除'; }else{ echo $cc_info['info_list']['info_detete']['title']; } ?>" />
		      	 <br />
		      	 <br />
      			 新增操作链接:<input type="button" value="添加" onclick="add_new_info_extend_action()"><br />
      			 <div id="new_info_extend_action">
      			 	<?php
      			 	$_key=1;
      			 	if($cc_info['info_extend_action']){
	      			 	foreach($cc_info['info_extend_action'] as $val){
      			 	?>
      			 	<div id="new_info_extend_action_<?php echo $_key; ?>" style="background:#eee;line-height:25px;border:#ddd 1px solid">
		      			 <select name="cc[info_extend_action][<?php echo $_key; ?>][extend]">
				      	 	<option value="yes" <?php if($val['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
				      	 	<option value="no" <?php if(empty($val['extend']) || $val['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
		      			 </select>
				      	 <select name="cc[info_extend_action][<?php echo $_key; ?>][status]">
				      	 	<option value="show" <?php if($val['status']=='show') echo 'selected="selected"'; ?>>显示</option>
				      	 	<option value="hide" <?php if($val['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
				      	 </select>
				      	 <input type="text" name="cc[info_extend_action][<?php echo $_key; ?>][title]" value="<?php if(empty($val['title'])){ echo ''; }else{ echo $val['title']; } ?>" />
				      	 <br />
				      	 跟随：
						    <select name="cc[info_extend_action][<?php echo $_key; ?>][pos]">
					  	 	<option value="first" <?php if($val['pos']=='first') echo 'selected="selected"'; ?>>最前</option>
                            <option value="info_view" <?php if($val['pos']=='info_view') echo 'selected="selected"'; ?>>查看</option>
					  	 	<option value="info_copy" <?php if($val['pos']=='info_copy') echo 'selected="selected"'; ?>>复制添加</option>
					  	 	<option value="info_change" <?php if($val['pos']=='info_change') echo 'selected="selected"'; ?>>更改</option>
					  	 	<option value="info_detete" <?php if($val['pos']=='info_detete') echo 'selected="selected"'; ?>>删除</option>
							<option value="last" <?php if($val['pos']=='' || $val['pos']=='last') echo 'selected="selected"'; ?>>最后</option>
					  	 	</select>
					  	 	属性：<input size="10" name="cc[info_extend_action][<?php echo $_key; ?>][attr]" value="<?php if(empty($val['attr'])){ echo ''; }else{ echo rp($val['attr']); } ?>"/>
				      	 <br />
				      	 <input style="width:98%;" name="cc[info_extend_action][<?php echo $_key; ?>][url]" value="<?php if(empty($val['url'])){ echo ''; }else{ echo $val['url']; } ?>"><br />
				      	 <input type="button" style="width:98%" value="删除" onclick="del_new_info_extend_action(<?php echo $_key; ?>)" />
      			 	</div>
      			 	<?php
      			 			$_key++;
	      				}
	      			}
	      			?>
		      	 </div>
		      	 <script type="text/javascript">
		      	 	var new_info_extend_action_id = <?php echo $_key; ?>;
		      	 	function add_new_info_extend_action(){
		      	 		new_info_extend_action_id++;
		      	 		var new_info_extend_action = document.getElementById('new_info_extend_action');
		      	 		var newdiv = document.createElement("div");
		      	 		newdiv.id='new_info_extend_action_'+new_info_extend_action_id;
		      	 		new_info_extend_action.appendChild(newdiv);
		      	 		document.getElementById(newdiv.id).style.background='#eee';
		      	 		document.getElementById(newdiv.id).style.lineHeight='25px';
		      	 		document.getElementById(newdiv.id).style.border='#ddd 1px solid';
		      	 		document.getElementById(newdiv.id).innerHTML="<select name=\"cc[info_extend_action]["+new_info_extend_action_id+"][extend]\"><option value=\"yes\">延伸</option><option value=\"no\" selected=\"selected\">不延伸</option></select><select name=\"cc[info_extend_action]["+new_info_extend_action_id+"][status]\"><option value=\"show\">显示</option><option value=\"hide\">隐藏</option></select><input type=\"text\" name=\"cc[info_extend_action]["+new_info_extend_action_id+"][title]\" /><br />跟随：<select name=\"cc[info_extend_action]["+new_info_extend_action_id+"][pos]\"><option value=\"first\">最前</option><option value=\"info_view\">查看</option><option value=\"info_copy\">复制添加</option><option value=\"info_change\">更改</option><option value=\"info_detete\">删除</option><option value=\"last\">最后</option></select>属性：<input size=\"10\" name=\"cc[info_extend_action]["+new_info_extend_action_id+"][attr]\"/><br /><input style=\"width:98%;\" name=\"cc[info_extend_action]["+new_info_extend_action_id+"][url]\"><br /><input type=\"button\" style=\"width:98%\" value=\"删除\" onclick=\"del_new_info_extend_action("+new_info_extend_action_id+")\">";
		      	 	}
		      	 	function del_new_info_extend_action(id){
		      	 		var new_info_extend_action = document.getElementById('new_info_extend_action');
		      	 		new_info_extend_action.removeChild(document.getElementById('new_info_extend_action_'+id));
		      	 	}
		      	 </script>
		      	 <br />
		      	 <br />
		      	 界面功能：<?php if($_ccset['alone_ccset']){ ?><input type="checkbox" name="cc[alone_ccset_info_list]" value='yes' <?php if($cc_info['alone_ccset_info_list']=='yes'){ ?>checked="checked"<?php } ?> style="height:auto" />启用<?php } ?><br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info_list][class_select][extend]">
		      	 	<option value="yes" <?php if($cc_info['info_list']['class_select']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info_list']['class_select']['extend']) || $cc_info['info_list']['class_select']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
                 <?php if(!$_ccset['alone_ccset']){ ?>
		      	 <select name="cc[info_list][class_select][status]">
		      	 	<option value="show" <?php if($cc_info['info_list']['class_select']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info_list']['class_select']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 类别选择
		      	 <br />
                 <?php } ?>
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info_list][batch_action][extend]">
		      	 	<option value="yes" <?php if($cc_info['info_list']['batch_action']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info_list']['batch_action']['extend']) || $cc_info['info_list']['batch_action']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[info_list][batch_action][status]">
		      	 	<option value="show" <?php if($cc_info['info_list']['batch_action']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info_list']['batch_action']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 批量操作
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info_list][search_action][extend]">
		      	 	<option value="yes" <?php if($cc_info['info_list']['search_action']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info_list']['search_action']['extend']) || $cc_info['info_list']['search_action']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
                 <?php if(!$_ccset['alone_ccset']){ ?>
		      	 <select name="cc[info_list][search_action][status]">
		      	 	<option value="show" <?php if($cc_info['info_list']['search_action']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info_list']['search_action']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 搜索功能
		      	 <br />
                 <?php } ?>
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info_list][page_action][extend]">
		      	 	<option value="yes" <?php if($cc_info['info_list']['page_action']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info_list']['page_action']['extend']) || $cc_info['info_list']['page_action']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
                 <?php if(!$_ccset['alone_ccset']){ ?>
		      	 <select name="cc[info_list][page_action][status]">
		      	 	<option value="show" <?php if($cc_info['info_list']['page_action']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info_list']['page_action']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 分页功能
		      	 <br />
                 <?php } ?>
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info_list][page_select][extend]">
		      	 	<option value="yes" <?php if($cc_info['info_list']['page_select']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info_list']['page_select']['extend']) || $cc_info['info_list']['page_select']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
                 <?php if(!$_ccset['alone_ccset']){ ?>
		      	 <select name="cc[info_list][page_select][status]">
		      	 	<option value="show" <?php if($cc_info['info_list']['page_select']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info_list']['page_select']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 分页下拉框(*大数据，请隐藏)
                 <?php } ?>
		    </td>
		    <?php
			}
			if($_ccset['all'] || $_ccset['info']['save']){
			?>
		    <td valign="top">
                 <?php if($_ccset['alone_ccset']){ ?>表单信息：<input type="checkbox" name="cc[alone_ccset_info]" value='yes' <?php if($cc_info['alone_ccset_info']=='yes'){ ?>checked="checked"<?php } ?> style="height:auto" />启用<br /><?php } ?>
		      	 单一属性：<br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info][info_class][extend]">
		      	 	<option value="yes" <?php if($cc_info['info']['info_class']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info']['info_class']['extend']) || $cc_info['info']['info_class']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[info][info_class][status]">
		      	 	<option value="show" <?php if($cc_info['info']['info_class']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info']['info_class']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[info][info_class][title]" value="<?php if(empty($cc_info['info']['info_class']['title'])){ echo '信息类别选择'; }else{ echo $cc_info['info']['info_class']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info][info_order][extend]">
		      	 	<option value="yes" <?php if($cc_info['info']['info_order']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info']['info_order']['extend']) || $cc_info['info']['info_order']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[info][info_order][status]">
		      	 	<option value="show" <?php if($cc_info['info']['info_order']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info']['info_order']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[info][info_order][title]" value="<?php if(empty($cc_info['info']['info_order']['title'])){ echo '排列序号'; }else{ echo $cc_info['info']['info_order']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info][save_date][extend]">
		      	 	<option value="yes" <?php if($cc_info['info']['save_date']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info']['save_date']['extend']) || $cc_info['info']['save_date']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[info][save_date][status]">
		      	 	<option value="show" <?php if($cc_info['info']['save_date']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info']['save_date']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[info][save_date][title]" value="<?php if(empty($cc_info['info']['save_date']['title'])){ echo '录入日期'; }else{ echo $cc_info['info']['save_date']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info][info_simg][extend]">
		      	 	<option value="yes" <?php if($cc_info['info']['info_simg']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info']['info_simg']['extend']) || $cc_info['info']['info_simg']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[info][info_simg][status]">
		      	 	<option value="show" <?php if($cc_info['info']['info_simg']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info']['info_simg']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[info][info_simg][title]" value="<?php if(empty($cc_info['info']['info_simg']['title'])){ echo '信息小图片'; }else{ echo $cc_info['info']['info_simg']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info][info_bimg][extend]">
		      	 	<option value="yes" <?php if($cc_info['info']['info_bimg']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info']['info_bimg']['extend']) || $cc_info['info']['info_bimg']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[info][info_bimg][status]">
		      	 	<option value="show" <?php if($cc_info['info']['info_bimg']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info']['info_bimg']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[info][info_bimg][title]" value="<?php if(empty($cc_info['info']['info_bimg']['title'])){ echo '信息大图片'; }else{ echo $cc_info['info']['info_bimg']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info][info_recommend][extend]">
		      	 	<option value="yes" <?php if($cc_info['info']['info_recommend']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info']['info_recommend']['extend']) || $cc_info['info']['info_recommend']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[info][info_recommend][status]">
		      	 	<option value="show" <?php if($cc_info['info']['info_recommend']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info']['info_recommend']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[info][info_recommend][title]" value="<?php if(empty($cc_info['info']['info_recommend']['title'])){ echo '设为推荐信息'; }else{ echo $cc_info['info']['info_recommend']['title']; } ?>" />
		    </td>
		    <td valign="top">
                 <?php if($_ccset['alone_ccset']){ ?><br /><?php } ?>
		      	 中文属性：<br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info][cn_info_name][extend]">
		      	 	<option value="yes" <?php if($cc_info['info']['cn_info_name']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info']['cn_info_name']['extend']) || $cc_info['info']['cn_info_name']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[info][cn_info_name][status]">
		      	 	<option value="show" <?php if($cc_info['info']['cn_info_name']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info']['cn_info_name']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[info][cn_info_name][title]" value="<?php if(empty($cc_info['info']['cn_info_name']['title'])){ echo '信息名称'; }else{ echo $cc_info['info']['cn_info_name']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info][cn_info_title][extend]">
		      	 	<option value="yes" <?php if($cc_info['info']['cn_info_title']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info']['cn_info_title']['extend']) || $cc_info['info']['cn_info_title']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[info][cn_info_title][status]">
		      	 	<option value="show" <?php if($cc_info['info']['cn_info_title']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info']['cn_info_title']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[info][cn_info_title][title]" value="<?php if(empty($cc_info['info']['cn_info_title']['title'])){ echo '标　　题'; }else{ echo $cc_info['info']['cn_info_title']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info][cn_info_keyword][extend]">
		      	 	<option value="yes" <?php if($cc_info['info']['cn_info_keyword']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info']['cn_info_keyword']['extend']) || $cc_info['info']['cn_info_keyword']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[info][cn_info_keyword][status]">
		      	 	<option value="show" <?php if($cc_info['info']['cn_info_keyword']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info']['cn_info_keyword']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[info][cn_info_keyword][title]" value="<?php if(empty($cc_info['info']['cn_info_keyword']['title'])){ echo '关 键 词'; }else{ echo $cc_info['info']['cn_info_keyword']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info][cn_info_description][extend]">
		      	 	<option value="yes" <?php if($cc_info['info']['cn_info_description']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info']['cn_info_description']['extend']) || $cc_info['info']['cn_info_description']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[info][cn_info_description][status]">
		      	 	<option value="show" <?php if($cc_info['info']['cn_info_description']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info']['cn_info_description']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[info][cn_info_description][title]" value="<?php if(empty($cc_info['info']['cn_info_description']['title'])){ echo '描　　述'; }else{ echo $cc_info['info']['cn_info_description']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info][cn_info_content][extend]">
		      	 	<option value="yes" <?php if($cc_info['info']['cn_info_content']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info']['cn_info_content']['extend']) || $cc_info['info']['cn_info_content']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[info][cn_info_content][status]">
		      	 	<option value="show" <?php if($cc_info['info']['cn_info_content']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info']['cn_info_content']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[info][cn_info_content][title]" value="<?php if(empty($cc_info['info']['cn_info_content']['title'])){ echo '信息说明'; }else{ echo $cc_info['info']['cn_info_content']['title']; } ?>" />
		    </td>
	      	<?php if ($bb_en == '001') { ?>
	      	<td valign="top">
                <?php if($_ccset['alone_ccset']){ ?><br /><?php } ?>
		      	英文属性：<br />
		      	<?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info][en_info_name][extend]">
		      	 	<option value="yes" <?php if($cc_info['info']['en_info_name']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info']['en_info_name']['extend']) || $cc_info['info']['en_info_name']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[info][en_info_name][status]">
		      	 	<option value="show" <?php if($cc_info['info']['en_info_name']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info']['en_info_name']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[info][en_info_name][title]" value="<?php if(empty($cc_info['info']['en_info_name']['title'])){ echo '信息名称'; }else{ echo $cc_info['info']['en_info_name']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info][en_info_title][extend]">
		      	 	<option value="yes" <?php if($cc_info['info']['en_info_title']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info']['en_info_title']['extend']) || $cc_info['info']['en_info_title']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[info][en_info_title][status]">
		      	 	<option value="show" <?php if($cc_info['info']['en_info_title']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info']['en_info_title']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[info][en_info_title][title]" value="<?php if(empty($cc_info['info']['en_info_title']['title'])){ echo '标　　题'; }else{ echo $cc_info['info']['en_info_title']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info][en_info_keyword][extend]">
		      	 	<option value="yes" <?php if($cc_info['info']['en_info_keyword']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info']['en_info_keyword']['extend']) || $cc_info['info']['en_info_keyword']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[info][en_info_keyword][status]">
		      	 	<option value="show" <?php if($cc_info['info']['en_info_keyword']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info']['en_info_keyword']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[info][en_info_keyword][title]" value="<?php if(empty($cc_info['info']['en_info_keyword']['title'])){ echo '关 键 词'; }else{ echo $cc_info['info']['en_info_keyword']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info][en_info_description][extend]">
		      	 	<option value="yes" <?php if($cc_info['info']['en_info_description']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info']['en_info_description']['extend']) || $cc_info['info']['en_info_description']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[info][en_info_description][status]">
		      	 	<option value="show" <?php if($cc_info['info']['en_info_description']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info']['en_info_description']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[info][en_info_description][title]" value="<?php if(empty($cc_info['info']['en_info_description']['title'])){ echo '描　　述'; }else{ echo $cc_info['info']['en_info_description']['title']; } ?>" />
		      	 <br />
		      	 <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
      			 <select name="cc[info][en_info_content][extend]">
		      	 	<option value="yes" <?php if($cc_info['info']['en_info_content']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
		      	 	<option value="no" <?php if(empty($cc_info['info']['en_info_content']['extend']) || $cc_info['info']['en_info_content']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
      			 </select>
      			 <?php } ?>
		      	 <select name="cc[info][en_info_content][status]">
		      	 	<option value="show" <?php if($cc_info['info']['en_info_content']['status']=='show') echo 'selected="selected"'; ?>>显示</option>
		      	 	<option value="hide" <?php if($cc_info['info']['en_info_content']['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
		      	 </select>
		      	 <input type="text" name="cc[info][en_info_content][title]" value="<?php if(empty($cc_info['info']['en_info_content']['title'])){ echo '信息说明'; }else{ echo $cc_info['info']['en_info_content']['title']; } ?>" />
	      	</td>
	      	<?php } ?>
	      	<?php } ?>
	    </tr></table>
      </td>
    </tr>
    <?php
	}
	if($_ccset['all'] || $_ccset['info_extend_field']){
    ?>
    <tr class="extend_tr" bgcolor="#FFFFFF" <?php if (!$_SESSION['superadmin']){ ?>style="display:none"<?php } ?>>
      <td width="120" height="20" align="right" bgcolor="#FFFFFF">【信息】字段扩展：</td>
      <td height="20">
        <?php if($_ccset['alone_ccset']){ ?><input type="checkbox" name="cc[alone_ccset_info_extend_field]" value='yes' <?php if($cc_info['alone_ccset_info_extend_field']=='yes'){ ?>checked="checked"<?php } ?> style="height:auto" />启用<br /><?php } ?>
      	<table id="info_extend_field_box" width="100%">
      		<tr style="background:#eee">
		      	<?php if($_ccset['all'] || $_ccset['extend_set']){ ?><td>延伸</td><?php } ?>
		      	<td>跟随位置</td>
		      	<td>排序</td>
		      	<td>状态</td>
		      	<td>类型</td>
		      	<td>必填</td>
		      	<td>唯一</td>
		      	<td>字段名</td>
		      	<td>名称</td>
		      	<td>
		      		选项(下拉、单选、复选)<br />
		      		1.用竖线分割<br />
		      		2.赋值可以用=,例如:1=深圳<br />
		      		3.atype/atype_info:分类ID可分别调用类别和信息,例如:atype:88
		      	</td>
		      	<td>默认值</td>
		      	<td>属性附加</td>
		      	<td>前文本</td>
		      	<td>后文本</td>
		      	<td>
		      		<input type="button" value="添加" onclick="add_info_extend_field()">
		      	</td>
		    </tr>
		    <?php
		    $key=0;
		    if($cc_info['info_extend_field']){
                $cc_info['info_extend_field'] = array_sort($cc_info['info_extend_field'], 'order');
			    foreach($cc_info['info_extend_field'] as $val){
			    	$key++;
		    ?>
		    <tr id="info_extend_field_row_<?php echo $key; ?>">
		    	<?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
		    	<td>
					<select name="cc[info_extend_field][<?php echo $key; ?>][extend]">
			  	 	<option value="yes" <?php if($val['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
			  	 	<option value="no" <?php if(empty($val['extend']) || $val['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
					</select>
				</td>
				<?php } ?>
				<td>
			  	 	<select name="cc[info_extend_field][<?php echo $key; ?>][pos]">
			  	 	<option value="top" <?php if($val['pos']=='top') echo 'selected="selected"'; ?>>顶部</option>
			  	 	<option value="type_id" <?php if($val['pos']=='type_id') echo 'selected="selected"'; ?>>信息类别选择</option>
			  	 	<option value="num" <?php if($val['pos']=='num') echo 'selected="selected"'; ?>>排列序号</option>
			  	 	<option value="cn_name" <?php if($val['pos']=='cn_name') echo 'selected="selected"'; ?>>信息名称<?php if ($bb_en == '001') { ?>(中文)<?php } ?></option>
			  	 	<?php if ($bb_en == '001') { ?>
			  	 	<option value="en_name" <?php if($val['pos']=='en_name') echo 'selected="selected"'; ?>>信息名称(英文)</option>
			  	 	<?php } ?>
			  	 	<option value="date1" <?php if($val['pos']=='date1') echo 'selected="selected"'; ?>>录入日期</option>
			  	 	<option value="cn_title" <?php if($val['pos']=='cn_title') echo 'selected="selected"'; ?>>标题<?php if ($bb_en == '001') { ?>(中文)<?php } ?></option>
			  	 	<?php if ($bb_en == '001') { ?>
			  	 	<option value="en_title" <?php if($val['pos']=='en_title') echo 'selected="selected"'; ?>>标题(英文)</option>
			  	 	<?php } ?>
			  	 	<option value="cn_keywords" <?php if($val['pos']=='cn_keywords') echo 'selected="selected"'; ?>>关 键 词<?php if ($bb_en == '001') { ?>(中文)<?php } ?></option>
			  	 	<?php if ($bb_en == '001') { ?>
			  	 	<option value="en_keywords" <?php if($val['pos']=='en_keywords') echo 'selected="selected"'; ?>>关 键 词(英文)</option>
			  	 	<?php } ?>
			  	 	<option value="cn_description" <?php if($val['pos']=='cn_description') echo 'selected="selected"'; ?>>描述<?php if ($bb_en == '001') { ?>(中文)<?php } ?></option>
			  	 	<?php if ($bb_en == '001') { ?>
			  	 	<option value="en_description" <?php if($val['pos']=='en_description') echo 'selected="selected"'; ?>>描述(英文)</option>
			  	 	<?php } ?>
			  	 	<option value="images1" <?php if($val['pos']=='images1') echo 'selected="selected"'; ?>>信息小图片</option>
			  	 	<option value="images2" <?php if($val['pos']=='images2') echo 'selected="selected"'; ?>>信息大图片</option>
			  	 	<option value="cn_content" <?php if($val['pos']=='cn_content') echo 'selected="selected"'; ?>>信息说明<?php if ($bb_en == '001') { ?>(中文)<?php } ?></option>
			  	 	<?php if ($bb_en == '001') { ?>
			  	 	<option value="en_content" <?php if($val['pos']=='en_content') echo 'selected="selected"'; ?>>信息说明(英文)</option>
			  	 	<?php } ?>
			  	 	<option value="hot1" <?php if($val['pos']=='hot1') echo 'selected="selected"'; ?>>设为推荐信息</option>
					<option value="bottom" <?php if($val['pos']=='' || $val['pos']=='bottom') echo 'selected="selected"'; ?>>底部</option>
			  	 	</select>
				</td>
				<td>
		  	 		<input type="text" name="cc[info_extend_field][<?php echo $key; ?>][order]" value="<?php if(empty($val['order'])){ echo '0'; }else{ echo $val['order']; } ?>" style="width:30px" />
				</td>
				<td>
			  	 	<select name="cc[info_extend_field][<?php echo $key; ?>][status]">
			  	 	<option value="show" <?php if($val['status']=='show') echo 'selected="selected"'; ?>>显示</option>
			  	 	<option value="hide" <?php if($val['status']=='hide') echo 'selected="selected"'; ?>>隐藏</option>
			  	 	</select>
				</td>
				<td>
			  	 	<select name="cc[info_extend_field][<?php echo $key; ?>][type]">
			  	 	<option value="string" <?php if($val['type']=='string') echo 'selected="selected"'; ?>>字符串框</option>
                    <option value="int" <?php if($val['type']=='int') echo 'selected="selected"'; ?>>字符串框(数值型)</option>
			  	 	<option value="password" <?php if($val['type']=='password') echo 'selected="selected"'; ?>>密码框</option>
			  	 	<option value="password_md5" <?php if($val['type']=='password_md5') echo 'selected="selected"'; ?>>密码框(MD5)</option>
			  	 	<option value="text" <?php if($val['type']=='text') echo 'selected="selected"'; ?>>文本框</option>
			  	 	<option value="rtext" <?php if($val['type']=='rtext') echo 'selected="selected"'; ?>>富文本框</option>
			  	 	<option value="img" <?php if($val['type']=='img') echo 'selected="selected"'; ?>>文件上传</option>
			  	 	<option value="select" <?php if($val['type']=='select') echo 'selected="selected"'; ?>>下拉</option>
			  	 	<option value="radio" <?php if($val['type']=='radio') echo 'selected="selected"'; ?>>单选</option>
			  	 	<option value="checkbox" <?php if($val['type']=='checkbox') echo 'selected="selected"'; ?>>复选</option>
			  	 	</select>
				</td>
				<td>
		  	 		<input type="checkbox" value="yes" name="cc[info_extend_field][<?php echo $key; ?>][check]" <?php echo $val['check']=='yes'?'checked':''; ?> />
				</td>
				<td>
		  	 		<input type="checkbox" value="yes" name="cc[info_extend_field][<?php echo $key; ?>][unique]" <?php echo $val['unique']=='yes'?'checked':''; ?> />
				</td>
				<td>
		  	 		<input type="text" name="cc[info_extend_field][<?php echo $key; ?>][field]" value="<?php echo $val['field'];  ?>" size="10" />
				</td>
				<td>
		  	 		<input type="text" name="cc[info_extend_field][<?php echo $key; ?>][title]" value="<?php echo $val['title'];  ?>" size="10" />
				</td>
				<td>
		  	 		<input type="text" size="20" name="cc[info_extend_field][<?php echo $key; ?>][option]" value="<?php echo $val['option']; ?>" />
				</td>
				<td>
		  	 		<input type="text" name="cc[info_extend_field][<?php echo $key; ?>][defval]" value="<?php echo rp($val['defval']); ?>" size="5" />
				</td>
				<td>
		  	 		<input type="text" name="cc[info_extend_field][<?php echo $key; ?>][attr]" value="<?php echo rp($val['attr']); ?>" size="10" />
				</td>
				<td>
		  	 		<input type="text" name="cc[info_extend_field][<?php echo $key; ?>][qtxt]" value="<?php echo rp($val['qtxt']); ?>" size="5" />
				</td>
				<td>
		  	 		<input type="text" name="cc[info_extend_field][<?php echo $key; ?>][htxt]" value="<?php echo rp($val['htxt']);  ?>" size="5" />
				</td>
				<td>
					<a href="javascript:;" onclick="del_info_extend_field(<?php echo $key; ?>)">删除</a>
				</td>
			</tr>
			<?php
				}
			}
			?>
		</table>
		<script type="text/javascript">
			var info_extend_field_id=<?php echo $key; ?>;
			function add_info_extend_field(){
				info_extend_field_id++;
				var table = document.getElementById('info_extend_field_box');
				var tr = table.insertRow(-1);
				tr.id="info_extend_field_row_"+info_extend_field_id;

				<?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
				var td1 = tr.insertCell(-1);
				td1.innerHTML = "<select name=\"cc[info_extend_field]["+info_extend_field_id+"][extend]\"><option value=\"yes\">延伸</option><option value=\"no\">不延伸</option></select>";
				<?php } ?>
				
				var td2 = tr.insertCell(-1);
				td2.innerHTML = "<select name=\"cc[info_extend_field]["+info_extend_field_id+"][pos]\"><option value=\"top\">顶部</option><option value=\"type_id\">信息类别选择</option><option value=\"num\">排列序号</option><option value=\"cn_name\">信息名称<?php if ($bb_en == '001') { ?>(中文)<?php } ?></option><?php if ($bb_en == '001') { ?><option value=\"en_name\">信息名称(英文)</option><?php } ?><option value=\"date1\">录入日期</option><option value=\"cn_title\">标题<?php if ($bb_en == '001') { ?>(中文)<?php } ?></option><?php if ($bb_en == '001') { ?><option value=\"en_title\">标题(英文)</option><?php } ?><option value=\"cn_keywords\">关 键 词<?php if ($bb_en == '001') { ?>(中文)<?php } ?></option><?php if ($bb_en == '001') { ?><option value=\"en_keywords\">关 键 词(英文)</option><?php } ?><option value=\"cn_description\">描述<?php if ($bb_en == '001') { ?>(中文)<?php } ?></option><?php if ($bb_en == '001') { ?><option value=\"en_description\">描述(英文)</option><?php } ?><option value=\"images1\">信息小图片</option><option value=\"images2\">信息大图片</option><option value=\"cn_content\">信息说明<?php if ($bb_en == '001') { ?>(中文)<?php } ?></option><?php if ($bb_en == '001') { ?><option value=\"en_content\">信息说明(英文)</option><?php } ?><option value=\"hot1\">设为推荐信息</option><option value=\"bottom\" selected=\"selected\">底部</option></select>";
				
				var td3 = tr.insertCell(-1);
				td3.innerHTML = "<input type=\"text\" name=\"cc[info_extend_field]["+info_extend_field_id+"][order]\" value=\""+(info_extend_field_id*10)+"\" style=\"width:30px\" />";

				var td4 = tr.insertCell(-1);
				td4.innerHTML = "<select name=\"cc[info_extend_field]["+info_extend_field_id+"][status]\"><option value=\"show\">显示</option><option value=\"hide\">隐藏</option></select>";
				
				var td5 = tr.insertCell(-1);
				td5.innerHTML = "<select name=\"cc[info_extend_field]["+info_extend_field_id+"][type]\"><option value=\"string\">字符串框</option><option value=\"int\">字符串框(数值型)</option><option value=\"password\">密码框</option><option value=\"password_md5\">密码框(MD5)</option><option value=\"text\">文本框</option><option value=\"rtext\">富文本框</option><option value=\"img\">文件上传</option><option value=\"select\">下拉</option><option value=\"radio\">单选</option><option value=\"checkbox\">复选</option></select>";
				
				var td6 = tr.insertCell(-1);
				td6.innerHTML = "<input type=\"checkbox\" value=\"yes\" name=\"cc[info_extend_field]["+info_extend_field_id+"][check]\" />";

				var td7 = tr.insertCell(-1);
				td7.innerHTML = "<input type=\"checkbox\" value=\"yes\" name=\"cc[info_extend_field]["+info_extend_field_id+"][unique]\" />";

				var td8 = tr.insertCell(-1);
				td8.innerHTML = "<input type=\"text\" name=\"cc[info_extend_field]["+info_extend_field_id+"][field]\" size=\"10\" />";

				var td9 = tr.insertCell(-1);
				td9.innerHTML = "<input type=\"text\" name=\"cc[info_extend_field]["+info_extend_field_id+"][title]\" size=\"10\" />";
				
				var td10 = tr.insertCell(-1);
				td10.innerHTML = "<input type=\"text\" size=\"20\" name=\"cc[info_extend_field]["+info_extend_field_id+"][option]\" />";
				
				var td11 = tr.insertCell(-1);
				td11.innerHTML = "<input type=\"text\" name=\"cc[info_extend_field]["+info_extend_field_id+"][defval]\" size=\"5\" />";

				var td12 = tr.insertCell(-1);
				td12.innerHTML = "<input type=\"text\" name=\"cc[info_extend_field]["+info_extend_field_id+"][attr]\" size=\"10\" />";

				var td13 = tr.insertCell(-1);
				td13.innerHTML = "<input type=\"text\" name=\"cc[info_extend_field]["+info_extend_field_id+"][qtxt]\" size=\"5\" />";

				var td14 = tr.insertCell(-1);
				td14.innerHTML = "<input type=\"text\" name=\"cc[info_extend_field]["+info_extend_field_id+"][htxt]\" size=\"5\" />";

				var td15 = tr.insertCell(-1);
				td15.innerHTML = "<a href=\"javascript:;\" onclick=\"del_info_extend_field("+info_extend_field_id+")\">删除</a>";
			}
			function del_info_extend_field(id){
				var t = document.getElementById('info_extend_field_box');
				var d = t.getElementsByTagName('tr');
				for(var i=0;i<d.length;i++){
					if(d[i].id=="info_extend_field_row_"+id){
						t.deleteRow(i);
					}
				}
			}
		</script>
      </td>
    </tr>
    <?php
	}
	if($_ccset['all'] || $_ccset['info_extend_script']){
    ?>
    <tr class="extend_tr" bgcolor="#FFFFFF" <?php if (!$_SESSION['superadmin']){ ?>style="display:none"<?php } ?>>
    	<td width="120" height="20" align="right" bgcolor="#FFFFFF">【信息】脚本扩展：</td>
    	<td height="20">
    		<table><tr>
    			<td valign="top">
    				列表前：
					<?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
	      			<select name="cc[info_script][list_top][extend]">
			      		<option value="yes" <?php if($cc_info['info_script']['list_top']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
			      		<option value="no" <?php if(empty($cc_info['info_script']['list_top']['extend']) || $cc_info['info_script']['list_top']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
	      			</select>
	      			<?php } ?>
			      	<select name="cc[info_script][list_top][status]">
			      		<option value="show" <?php if($cc_info['info_script']['list_top']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
			      		<option value="hide" <?php if($cc_info['info_script']['list_top']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
			      	</select>
    				<br />
    				<textarea name="cc[info_script][list_top][content]" style="width:226px;height:250px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['info_script']['list_top']['content']; ?></textarea>
                    <br /><br />
                    列表JS脚本：
                    <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
                    <select name="cc[info_script][list_js][extend]">
                        <option value="yes" <?php if($cc_info['info_script']['list_js']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
                        <option value="no" <?php if(empty($cc_info['info_script']['list_js']['extend']) || $cc_info['info_script']['list_js']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
                    </select>
                    <?php } ?>
                    <select name="cc[info_script][list_js][status]">
                        <option value="show" <?php if($cc_info['info_script']['list_js']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
                        <option value="hide" <?php if($cc_info['info_script']['list_js']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
                    </select>
                    <br />
                    <textarea name="cc[info_script][list_js][content]" style="width:226px;height:100px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['info_script']['list_js']['content']; ?></textarea>
                    <br /><br />
                    搜索HTML：
                    <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
                    <select name="cc[info_script][search_html][extend]">
                        <option value="yes" <?php if($cc_info['info_script']['search_html']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
                        <option value="no" <?php if(empty($cc_info['info_script']['search_html']['extend']) || $cc_info['info_script']['search_html']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
                    </select>
                    <?php } ?>
                    <select name="cc[info_script][search_html][status]">
                        <option value="show" <?php if($cc_info['info_script']['search_html']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
                        <option value="hide" <?php if($cc_info['info_script']['search_html']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
                    </select>
                    <br />
                    <textarea name="cc[info_script][search_html][content]" style="width:226px;height:100px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['info_script']['search_html']['content']; ?></textarea>
    			</td>
    			<td valign="top">
    				添加前：
					<?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
	      			<select name="cc[info_script][add_top][extend]">
			      		<option value="yes" <?php if($cc_info['info_script']['add_top']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
			      		<option value="no" <?php if(empty($cc_info['info_script']['add_top']['extend']) || $cc_info['info_script']['add_top']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
	      			</select>
	      			<?php } ?>
			      	<select name="cc[info_script][add_top][status]">
			      		<option value="show" <?php if($cc_info['info_script']['add_top']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
			      		<option value="hide" <?php if($cc_info['info_script']['add_top']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
			      	</select>
    				<br />
    				<textarea name="cc[info_script][add_top][content]" style="width:226px;height:100px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['info_script']['add_top']['content']; ?></textarea>
    				<br /><br />
    				添加后：
					<?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
	      			<select name="cc[info_script][add_bottom][extend]">
			      		<option value="yes" <?php if($cc_info['info_script']['add_bottom']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
			      		<option value="no" <?php if(empty($cc_info['info_script']['add_bottom']['extend']) || $cc_info['info_script']['add_bottom']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
	      			</select>
	      			<?php } ?>
			      	<select name="cc[info_script][add_bottom][status]">
			      		<option value="show" <?php if($cc_info['info_script']['add_bottom']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
			      		<option value="hide" <?php if($cc_info['info_script']['add_bottom']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
			      	</select>
    				<br />
    				<textarea name="cc[info_script][add_bottom][content]" style="width:226px;height:100px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['info_script']['add_bottom']['content']; ?></textarea>
                    <br /><br />
                    添加JS脚本：
                    <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
                    <select name="cc[info_script][add_js][extend]">
                        <option value="yes" <?php if($cc_info['info_script']['add_js']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
                        <option value="no" <?php if(empty($cc_info['info_script']['add_js']['extend']) || $cc_info['info_script']['add_js']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
                    </select>
                    <?php } ?>
                    <select name="cc[info_script][add_js][status]">
                        <option value="show" <?php if($cc_info['info_script']['add_js']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
                        <option value="hide" <?php if($cc_info['info_script']['add_js']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
                    </select>
                    <br />
                    <textarea name="cc[info_script][add_js][content]" style="width:226px;height:100px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['info_script']['add_js']['content']; ?></textarea>
                    <br /><br />
                    搜索PHP：
                    <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
                    <select name="cc[info_script][search_php][extend]">
                        <option value="yes" <?php if($cc_info['info_script']['search_php']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
                        <option value="no" <?php if(empty($cc_info['info_script']['search_php']['extend']) || $cc_info['info_script']['search_php']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
                    </select>
                    <?php } ?>
                    <select name="cc[info_script][search_php][status]">
                        <option value="show" <?php if($cc_info['info_script']['search_php']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
                        <option value="hide" <?php if($cc_info['info_script']['search_php']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
                    </select>
                    <br />
                    <textarea name="cc[info_script][search_php][content]" style="width:226px;height:100px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['info_script']['search_php']['content']; ?></textarea>
    			</td>
    			<td valign="top">
    				修改前：
					<?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
	      			<select name="cc[info_script][edit_top][extend]">
			      		<option value="yes" <?php if($cc_info['info_script']['edit_top']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
			      		<option value="no" <?php if(empty($cc_info['info_script']['edit_top']['extend']) || $cc_info['info_script']['edit_top']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
	      			</select>
	      			<?php } ?>
			      	<select name="cc[info_script][edit_top][status]">
			      		<option value="show" <?php if($cc_info['info_script']['edit_top']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
			      		<option value="hide" <?php if($cc_info['info_script']['edit_top']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
			      	</select>
    				<br />
    				<textarea name="cc[info_script][edit_top][content]" style="width:226px;height:100px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['info_script']['edit_top']['content']; ?></textarea>
    				<br /><br />
    				修改后：
					<?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
	      			<select name="cc[info_script][edit_bottom][extend]">
			      		<option value="yes" <?php if($cc_info['info_script']['edit_bottom']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
			      		<option value="no" <?php if(empty($cc_info['info_script']['edit_bottom']['extend']) || $cc_info['info_script']['edit_bottom']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
	      			</select>
	      			<?php } ?>
			      	<select name="cc[info_script][edit_bottom][status]">
			      		<option value="show" <?php if($cc_info['info_script']['edit_bottom']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
			      		<option value="hide" <?php if($cc_info['info_script']['edit_bottom']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
			      	</select>
    				<br />
    				<textarea name="cc[info_script][edit_bottom][content]" style="width:226px;height:100px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['info_script']['edit_bottom']['content']; ?></textarea>
                    <br /><br />
                    修改JS脚本：
                    <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
                    <select name="cc[info_script][edit_js][extend]">
                        <option value="yes" <?php if($cc_info['info_script']['edit_js']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
                        <option value="no" <?php if(empty($cc_info['info_script']['edit_js']['extend']) || $cc_info['info_script']['edit_js']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
                    </select>
                    <?php } ?>
                    <select name="cc[info_script][edit_js][status]">
                        <option value="show" <?php if($cc_info['info_script']['edit_js']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
                        <option value="hide" <?php if($cc_info['info_script']['edit_js']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
                    </select>
                    <br />
                    <textarea name="cc[info_script][edit_js][content]" style="width:226px;height:100px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['info_script']['edit_js']['content']; ?></textarea>
                    <br /><br />
                    批量HTML：
                    <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
                    <select name="cc[info_script][batch_html][extend]">
                        <option value="yes" <?php if($cc_info['info_script']['batch_html']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
                        <option value="no" <?php if(empty($cc_info['info_script']['batch_html']['extend']) || $cc_info['info_script']['batch_html']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
                    </select>
                    <?php } ?>
                    <select name="cc[info_script][batch_html][status]">
                        <option value="show" <?php if($cc_info['info_script']['batch_html']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
                        <option value="hide" <?php if($cc_info['info_script']['batch_html']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
                    </select>
                    <br />
                    <textarea name="cc[info_script][batch_html][content]" style="width:226px;height:100px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['info_script']['batch_html']['content']; ?></textarea>
    			</td>
    			<td valign="top">
    				删除前：
					<?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
	      			<select name="cc[info_script][del_top][extend]">
			      		<option value="yes" <?php if($cc_info['info_script']['del_top']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
			      		<option value="no" <?php if(empty($cc_info['info_script']['del_top']['extend']) || $cc_info['info_script']['del_top']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
	      			</select>
	      			<?php } ?>
			      	<select name="cc[info_script][del_top][status]">
			      		<option value="show" <?php if($cc_info['info_script']['del_top']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
			      		<option value="hide" <?php if($cc_info['info_script']['del_top']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
			      	</select>
    				<br />
    				<textarea name="cc[info_script][del_top][content]" style="width:226px;height:100px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['info_script']['del_top']['content']; ?></textarea>
    				<br /><br />
    				删除后：
					<?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
	      			<select name="cc[info_script][del_bottom][extend]">
			      		<option value="yes" <?php if($cc_info['info_script']['del_bottom']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
			      		<option value="no" <?php if(empty($cc_info['info_script']['del_bottom']['extend']) || $cc_info['info_script']['del_bottom']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
	      			</select>
	      			<?php } ?>
			      	<select name="cc[info_script][del_bottom][status]">
			      		<option value="show" <?php if($cc_info['info_script']['del_bottom']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
			      		<option value="hide" <?php if($cc_info['info_script']['del_bottom']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
			      	</select>
    				<br />
    				<textarea name="cc[info_script][del_bottom][content]" style="width:226px;height:250px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['info_script']['del_bottom']['content']; ?></textarea>
                    <br /><br />
                    批量PHP：
                    <?php if($_ccset['all'] || $_ccset['extend_set']){ ?>
                    <select name="cc[info_script][batch_php][extend]">
                        <option value="yes" <?php if($cc_info['info_script']['batch_php']['extend']=='yes') echo 'selected="selected"'; ?>>延伸</option>
                        <option value="no" <?php if(empty($cc_info['info_script']['batch_php']['extend']) || $cc_info['info_script']['batch_php']['extend']=='no') echo 'selected="selected"'; ?>>不延伸</option>
                    </select>
                    <?php } ?>
                    <select name="cc[info_script][batch_php][status]">
                        <option value="show" <?php if($cc_info['info_script']['batch_php']['status']=='show') echo 'selected="selected"'; ?>>启用</option>
                        <option value="hide" <?php if($cc_info['info_script']['batch_php']['status']=='hide') echo 'selected="selected"'; ?>>停用</option>
                    </select>
                    <br />
                    <textarea name="cc[info_script][batch_php][content]" style="width:226px;height:100px;" onpropertychange="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"  oninput="if(this.scrollHeight>100) this.style.height=this.scrollHeight+'px';"><?php echo $cc_info['info_script']['batch_php']['content']; ?></textarea>

    			</td>
    		</tr></table>
    	</td>
    </tr>
    <?php
	}
	?>