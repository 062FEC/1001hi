<?php
  include('../includes/php_conn.php');
  set_cookie('web_admin_index');
  include('../includes/check.php');
  include('../includes/refresh.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>weblcome</title>
<link href="../css/qbt.css" rel="stylesheet" type="text/css">
</head>

<body style="background:#eee; padding:20px 20px 20px 9px;">
<div class="qbt_nidelikai">
<div class="qbt_shujuguanli">
  <span><span class="txtt">后 台 管 理 --</span> <span class="aw">Manage </span></span>
</div>
<div class="qbt_omnissguai">
      <br>
      <br>
      <br>
      <br>
      <br>
      <table width="60%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <?php if($_SESSION['superadmin']){ ?>
      <tr>
        <td width="30%" height="30" align="right">系统版本：</td>
        <td width="70%" height="30">v<?php echo SYSTEM_VER; ?></td>
      </tr>
      <tr>
        <td width="30%" height="30" align="right">环境信息：</td>
        <td width="70%" height="30"><a href="server_info.php" target="_blank">点击查看</a></td>
      </tr>
      <tr>
        <td width="30%" height="30" align="right">空间大小：</td>
        <td width="70%" height="30"><?php echo number_format(disk_free_space('../')/1024/1024,2,'.','').'M'.'/'.number_format(disk_total_space('../')/1024/1024,2,'.','').'M';?></td>
      </tr>
      <?php } ?>
      <tr>
        <td width="30%" height="30" align="right">当前时间：</td>
        <td width="70%" height="30"><?php echo date("Y");?>年<?php echo date("m");?>月<?php echo date("d");?>日　<?php echo date("G:i:s");?></td>
      </tr>
      <tr>
        <td height="30" align="right">当前IP地址：</td>
        <td height="30"><?php echo $_SERVER["REMOTE_ADDR"];?></td>
      </tr>
      <tr>
        <td height="30" align="right">服务器名称：</td>
        <td height="30"><?php echo $_SERVER["SERVER_SOFTWARE"];?></td>
      </tr>
      <tr>
        <td height="30" align="right">屏幕分辨率：</td>
        <td height="30">
        <script language="javascript">
        <!--
        document.write(screen.width+"*"+screen.height)
        //-->
        </script>
</td>
      </tr>
    </table>
      <br>
      <br>
      <br>
      <br>
      <br>
</div>
</div>
</body>
</html>