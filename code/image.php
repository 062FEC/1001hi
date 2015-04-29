<?php
session_start();
$code = $_POST['code'];
$code = strtoupper(trim($code));
$submit = $_POST['submit'];
if(isset($submit)){
if($code==$_SESSION['validationcode']){
   echo 'true';
} else {
   echo 'false';
}
}
?>

<html>
<head>
<title>Image</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<script language="javascript">
function newgdcode(obj,url) {
obj.src = url+ '?nowtime=' + new Date().getTime();
//后面传递一个随机参数，否则在IE7和火狐下，不刷新图片
}
</script>
<body>
<img src="imgcode.php" alt="看不清楚，换一张" align="absmiddle" style="cursor: pointer;" onClick="javascript:newgdcode(this,this.src);" />
<form method="POST" name="form1" action="image.php">
<input name="code" type="text" size="4">
<br />
<input type="submit" name="submit" value="提交">
</form>
</body>
</head>
</html>
