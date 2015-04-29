<?php include("dbpath.php"); ?>
<?php
$conn=$db_path;
if (!$conn)
  {
  die('错误提示: ' . mysql_error());
  }
mysql_select_db($table_db,$conn);

?>
<?php include("function.php"); ?>