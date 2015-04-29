<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<head>
<meta name="robots" content="none"/>
<title>drag</title>
<style type="text/css">
body {
  margin: 0;
  padding: 0;
  background:#eee;
  cursor: E-resize;
}
</style>
<script type="text/javascript" language="JavaScript">
<!--
var pic = new Image();
pic.src="images/arrow_right.gif";
function toggleMenu()
{
  frmBody = parent.document.getElementById('frame-body');
  imgArrow = document.getElementById('images');
  if (frmBody.cols == "0, 11, *")
  {
    frmBody.cols="225, 11, *";
    imgArrow.src = "images/arrow_left.gif";
  }
  else
  {
    frmBody.cols="0, 11, *";
    imgArrow.src = pic.src;
  }
}
var orgX = 0;
document.onmousedown = function(e)
{
  var evt = Utils.fixEvent(e);
  orgX = evt.clientX;
  if (Browser.isIE) document.getElementById('tbl').setCapture();
}
document.onmouseup = function(e)
{
  var evt = Utils.fixEvent(e);
  frmBody = parent.document.getElementById('frame-body');
  frmWidth = frmBody.cols.substr(0, frmBody.cols.indexOf(','));
  frmWidth = (parseInt(frmWidth) + (evt.clientX - orgX));
  frmBody.cols = frmWidth + ", 11, *";
  if (Browser.isIE) document.releaseCapture();
}
var Browser = new Object();
Browser.isMozilla = (typeof document.implementation != 'undefined') && (typeof document.implementation.createDocument != 'undefined') && (typeof HTMLDocument != 'undefined');
Browser.isIE = window.ActiveXObject ? true : false;
Browser.isFirefox = (navigator.userAgent.toLowerCase().indexOf("firefox") != - 1);
Browser.isSafari = (navigator.userAgent.toLowerCase().indexOf("safari") != - 1);
Browser.isOpera = (navigator.userAgent.toLowerCase().indexOf("opera") != - 1);
var Utils = new Object();
Utils.fixEvent = function(e)
{
  var evt = (typeof e == "undefined") ? window.event : e;
  return evt;
}
//-->
</script>

</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" >
<table width="11" height="100%" cellpadding="0" cellspacing="1" id="tbl">
  <tr><td width="12"><a href="javascript:toggleMenu();"><img src="images/arrow_left.gif" name="images" width="9"  height="172" border="0" id="images" /></a></td>
  </tr>
</table>
</body>
</html>