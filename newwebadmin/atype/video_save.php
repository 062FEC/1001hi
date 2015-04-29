<?php
  include('../includes/php_conn.php');
  include('../includes/check.php');
  include('setup.php');
  
  /**
 * 更新数据库函数
 * @param string $table 数据表名称
 * @param array $data 要更新的字段内容，数组结构
 * @param string $conditions 条件
 * @return boolean
 */
function update($table,$data,$conditions){
	$str="update `$table` set ";
	foreach($data as $k=>$v){
		$str.='`'.$k."`='".$v."',";
	}
	$str= rtrim($str,",");
	$str.=' WHERE '.$conditions;
	$res= mysql_query($str);
	if($res){
		return true;
	}else{
		return false;
	}
}

  $id = $_REQUEST['id'];//视频id 
	
	$sql = 'SELECT * FROM `videos` WHERE `id` = '.$id;
	$query = mysql_query($sql,$conn);
	$res = mysql_fetch_assoc($query); 
	if($res['type']==1){
		$vtype = '首页视频';
	}else{
		$vtype = '子页视频';
	}
  
	if($_POST){
		$data = array(
			'name'		=> $_POST['real_name'],//视频名称
			'path'		=> $_POST['video'],//视频路径
			'date'		=> time(),//上传时间
			'img'		=> $_POST['images1']
		);
		$result = update('videos',$data,' `id` = '.$id);
		if($result){
			show_msg('保存成功！',4,'video_index.php');
		}
	}
  
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>视频详情</title>
<link href="../css/qbt.css" rel="stylesheet" type="text/css">
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
/* window.onbeforeunload = function() { 
    if(is_form_changed()) { 
        return "当前页面内容还没有保存，您确定离开吗？"; 
    } 
} */
</script>
</head>

<body style="background:#eee; padding:20px 20px 40px 9px;">
<div class="qbt_nidelikai">
<div class="qbt_shujuguanli">
<span><?php echo $vtype;?></span></div>
<div class="qbt_omnissguai">
<form action="" method="post">
    <table width="100%" border="0" cellspacing="0" cellpadding="9" bgcolor="#ffffff" class="qbt_heniwodsk">
	
		<tr>
          <td width="16%" align="right" bgcolor="#FFFFFF"><span>视频缩略图</span>：</td>
          <td width="84%" bgcolor="#FFFFFF">
			<input name="images1" type="text" id="images1" value="<?php echo $res['img'];?>" class="qbt_syzsf">
              <input name="shang" type="button"  class="button button_huise" id="shang" onClick="open_upload('images1','','')" value="上传"> 
			  <a href="javascript:;" target="_blank" onmouseover="if($('#images1').val().length>0){ this.href='../../uploadfiles/'+$('#images1').val(); }else{ this.href='javascript:;'; }">预览</a>
		  </td>
        </tr>
		<tr>
			<td width="16%" align="right" bgcolor="#FFFFFF"><span>视频名称</span>：</td>
			<td width="84%" bgcolor="#FFFFFF">
				<input name="real_name" type="text" class="qbt_syzsf" value="<?php echo $res['name'];?>" id="vdname"/>
			</td>
		</tr>
		<tr>
			<td width="16%" align="right" bgcolor="#FFFFFF"><span>视频路径</span>：</td>
			<td width="84%" bgcolor="#FFFFFF">
			<input name="video" type="text" id="video" value="<?php echo $res['path'];?>" class="qbt_syzsf">
              <input name="" type="button"  class="button button_huise" id="" onClick="open_upload2('video','vdname')" value="上传"> 
			  <a href="javascript:;" target="_blank" onmouseover="if($('#video').val().length>0){ this.href='play.php?id=<?php echo $id;?>'; }else{ this.href='javascript:;'; }">预览</a>
		  </td>
		</tr>
		<tr>
			<td width="16%" align="right" bgcolor="#FFFFFF"><span>操作</span>：</td>
			<td width="84%" bgcolor="#FFFFFF">
				<button class="button button_blue" type="submit" onclick="return check_form();">保存</button>&nbsp;<button class="button button_white" type="reset">重置</button>
			</td>
		</tr>
    </table>
</form>	
</div>
</div>
<script type="text/javascript">
	//视频上传
	 	function open_upload2(f_path,vdname)
	{
	//if (!f_file_path) f_file_path='../uploadfiles/';
	var sss="../../upload_tool/index.php?f_path="+f_path+'&vdname='+vdname;
	window.open(sss,"上传视频","toolbar=no,menubar=no,resizable=yes,top="+(screen.availHeight - parseFloat(300))/2+",left="+(screen.availWidth - parseFloat(500))/2+",width=500pt,height=300pt");
	} 
	
	//表单验证 
	function check_form(){
		var img = $('input[name=images1]').val();
		var video = $('#video').val();
		if(img==''){
			alert('请上传视频缩略图');
			return false;
		}
		if(video==''){
			alert('请上传视频');
			return false;
		}
		return true;
	}
</script>
</body>
</html>