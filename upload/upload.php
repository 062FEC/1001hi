<?php include("../php_conn.php"); ?>
<?php include("../check.php"); ?>

<?php
$action=$_REQUEST['action'];
$form_name=$_REQUEST['form_name'];

$wname=$_REQUEST['wname'];
$type=$_REQUEST['type'];

$t_name=$_REQUEST['t_name'];
$file_path=rp($_REQUEST['file_path']);
if (!$file_path) $file_path='../uploadfiles/';

if ($action=='save')
{
$date_path=date('Ymd').'/';
$file_path=$file_path.$date_path;
$max_size=1000000000;

	if(!is_dir($file_path)){
		  mkdir($file_path);
		  //如果不存在此目录，则创建，请保证您有相应的权限
	   }
	
	//文件上传类型
	$all_name_type='|flv|gif|jpg|jpeg|bmp|png|pdf|swf|rm|mp3|wav|mid|midi|ra|avi|mpg|mpeg|asf|asx|wma|mov|rar|zip|doc|xls|chm|hlp|docx|xlsx|pptx|mp4|rm|7z|gz|ppt|';
	
	if (($_FILES["file"]["size"] ==0))
	{
	?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<SCRIPT language=javascript>
	alert("请选择要上传的文件，允许上传的文件类型有：\n\n<?php echo $all_name_type;?>");
	parent.location.reload();
	</SCRIPT>
	<?php
	exit();
	}
	
	if (($_FILES["file"]["size"] >= $max_size))
	{
	?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<SCRIPT language=javascript>
	alert("允许上传的文件大小：<?php echo $max_size/1000000;?> M");
	parent.location.reload();
	</SCRIPT>
	<?php
	exit();
	}
	
	if (($_FILES["file"]["size"] < $max_size))
	  {
	  
	  $file_name=date('YmdHis').mt_rand(1000,9999);
	  $file_name_f=explode('.',$_FILES["file"]["name"]);
	  
	  //strtolower将字符串转换为小写形式
	  $file_name_type=strtolower($file_name_f[count($file_name_f)-1]);
	  
	  if (!strpos($all_name_type,$file_name_type))
	  {
	  ?>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	  <SCRIPT language=javascript>
	  alert("该类型文件不能上传，允许上传的文件类型有：\n\n<?php echo $all_name_type;?>");
	  parent.location.reload();
	  </SCRIPT>
	  <?php
	  exit();
	  }
	  
	  $file_name=$file_name.'.'.$file_name_type;
	  
	  if ($_FILES["file"]["error"] > 0)
		{
		echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		exit();
		}
		else
		{
	
		  move_uploaded_file($_FILES["file"]["tmp_name"],$file_path . $file_name);
		  ?>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		  <SCRIPT language=javascript>
		  alert("上传成功！");
		  parent.opener.document.getElementById("<?php echo $t_name;?>").value="<?php echo $date_path.$file_name;?>";
		  parent.window.close();
		  </SCRIPT>
		  <?php
		  }
	  }
	else
	  {
	  echo '请选择要上传的文件！';
	  }
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $wname?$wname:'文件上传'; ?></title>

<script language="javascript">
function to_submit() {
	var show_div1 = document.getElementById('show_div1');
	show_div1.style.display = '';
}

function show_div1() {
	var show_div1 = document.getElementById('show_div1');
	var show_div2 = document.getElementById('show_div2');
	var s_width = document.documentElement.scrollWidth  - parseFloat(4);
	var s_height = document.documentElement.scrollHeight  - parseFloat(3);
	show_div1.style.width = s_width + 'px';
	show_div1.style.height = s_height + 'px';
	show_div2.style.paddingTop = s_height/2 - parseFloat(32) + 'px';
}
window.onload = function(){show_div1()};
</script>
<style type="text/css">
<!--
body {
	margin-left: 5px;
	margin-top: 5px;
	margin-right: 5px;
	margin-bottom: 5px;
}
body,td,th,input {
	font-size: 12px;
}
-->
</style></head>

<body style="margin:0px;">
<?php echo show_frame(''); ?>
<div style="z-index:1000; background:#FFF; position:absolute; filter: Alpha(Opacity=70, Style=0); opacity: 0.70; text-align:center; display:none" id="show_div1">
	<div id="show_div2">
    	<div><img src="loading.gif"></div>
        <div style="padding-top:5px;">文件上传中，请稍候...</div>
    </div>
</div>
<table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>
      <table width="100%"  border="0" cellpadding="1" cellspacing="1" class="t02_3">
	  <form action="" method="post" enctype="multipart/form-data" name="form1" onSubmit="to_submit();" target="webtempframe">
      <tr align="center">
        <td height="22" colspan="2" class="txtt" style="background:#333 url(../newwebadmin/images/texturebg.png) repeat-x;text-align:left;padding-left:10px;font-weight:bold;height:50px;color:#fff"><?php echo $wname?$wname:'文件上传'; ?></td>
        </tr>
      <tr>
        <td height="20">&nbsp; </td>
      </tr>
      <tr>
        <td align="right" bgcolor="#FFFFFF">文件上传：</td>
        <td bgcolor="#FFFFFF" height="50"><input name="file" type="file" id="file" size="55" />
          <input name="action" type="hidden" id="action" value="save">
          <input name="form_name" type="hidden" id="form_name" value="<?php echo $form_name;?>">
          <input name="t_name" type="hidden" id="t_name" value="<?php echo $t_name;?>">
          <input name="file_path" type="hidden" id="file_path" value="<?php echo $file_path;?>"></td>
      </tr>
      <tr align="center">
        <td colspan="2" bgcolor="#FFFFFF"><input type="submit" name="Submit" value="确定上传"></td>
      </tr>
	  </form>
    </table>
      </td>
  </tr>
</table>
</body>
</html>