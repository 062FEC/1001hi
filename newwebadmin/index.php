<?php
    include("php_conn.php");
    include("check.php");
    include("includes/refresh.php");
    if(!is_file(CC_SAVE_PATH.'conf_showmenu.ccset')){
        file_put_contents(CC_SAVE_PATH.'conf_showmenu.ccset', serialize(array('0'=>'0')));
    }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="none"/>
<title><?php echo $admin_site_title;?></title>
<script type="text/javascript">
function toggle(){
  return true;
}
</script>
</head>
<frameset rows="0,88,*" cols="*" frameborder="NO" border="0" framespacing="0"> 
    <frame name="tempFrame" scrolling="NO" noresize src="UntitledFrame-1" >
    <frame name="topFrame" scrolling="NO" noresize src="top.php" >
    <frameset cols="180, 11,*" framespacing="0" border="0" id="frame-body" name="frame-body">
    <frame src="menu.php?abc=<?php echo $_REQUEST['abc']; ?>" id="leftFrame" name="leftFrame" frameborder="no" scrolling="auto">
    <frame src="drag.php" id="drag-frame" name="drag-frame" frameborder="no" scrolling="no">
    <frame src="welcome/index.php" id="mainFrame" name="mainFrame" frameborder="no" scrolling="auto">
  </frameset>
</frameset>
  <noframes></noframes>
  <iframe id='popIframe' class='popIframe' frameborder='0' ></iframe>
<body>
</body>
</html>