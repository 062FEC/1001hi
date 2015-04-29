<?php
  include("php_conn.php");
  include("check.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>top</title>
<link href="css/qbt.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.js"></script>
</head>

<body style="background:#333 url(images/texturebg.png) repeat-x;height:88px;">
<div class="qbt_qidai">
  <div class="qbt_logo_juleft"><a href="#"><img src="images/qbt_01.png" width="198" height="56"></a></div>
    <div class="qbt_nav_daohang">
        <ul>
            <li><a href="welcome/index.php" style="border-radius:3px 0 0 0;" target="mainFrame"><img src="images/qbt_07.png" width="16" height="13"><span>后台首页</span></a></li>
            <li><a href="atype/save.php?manage_id=86&t_action=0002&id=10" target="mainFrame"><img src="images/qbt_08.png" width="14" height="13"><span>网站配置</span></a></li>
            <li><a href="data/" target="mainFrame"><img src="images/qbt_09.png" width="17" height="16"><span>数据备份</span></a></li>
            <li style="background:none;"><a href="../" style="border-radius:0 3px 0 0;" target="_blank"><img src="images/qbt_10.png" width="14" height="13"><span>查看网站</span></a></li>
        </ul>
    </div>
    <div class="qbt_qita_right">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td rowspan="2" valign="top"><img src="images/qbt_001.jpg" width="50" height="50"></td>
    <td valign="top">
        <?php if(is_file('cpr.php')) include 'cpr.php'; ?>
        <span><?php echo mysql_result(mysql_query("SELECT `role_name` FROM `web_admin_role` WHERE `id`='{$a_user_id}'"), 0); ?></span>
        <p>
          <script type="text/javascript">
            var strcookie=document.cookie;
            var arrcookie=strcookie.split("; ");
            var userId;
            for(var i=0;i<arrcookie.length;i++){
              var arr=arrcookie[i].split("=");
              if("a_username"==arr[0]){
                document.write(arr[1]);
                break;
              }
            }
          </script>
        </p>
    </td>
  </tr>
  <tr>
    <td><a href="admin/changepass.php?id=<?php echo $_COOKIE['a_user_id']; ?>" target="mainFrame" class="qbt_ggma">更改密码</a><a href="exit.php" class="qbt_tuichu" target="_parent">退出</a></td>
  </tr>
</table>
    </div>
</div>
</body>
</html>