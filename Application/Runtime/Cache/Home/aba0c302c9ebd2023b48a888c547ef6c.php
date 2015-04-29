<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title><?php echo ($video["cn_name"]); ?></title>
</head>
<body>
	
	<embed id="index-video" src="http://yuntv.letv.com/bcloud.swf" allowFullScreen="true" quality="high" width="600" height="400" align="middle" allowScriptAccess="always" flashvars="<?php echo ($video["mv_link"]); ?>" type="application/x-shockwave-flash"></embed>
	
</body>
</html>