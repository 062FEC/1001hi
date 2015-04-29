<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="description" content="<?php echo ($site["cn_description"]); ?>">
    <meta name="Keywords" content="<?php echo ($site["cn_keywords"]); ?>">
    <title>1001梦幻联盟-<?php echo ($site["cn_title"]); ?></title>
    <link type="text/css" href="/1001hotel/Public/style/css/union.css" rel="stylesheet">
  </head>

  <body>
    <div class="header2">
      <div class="header2-wrap">
        <h1 class="logo">
          <a href="<?php echo U('/Home/Index/index');?>" title="1001HOTEL">1001HOTEL</a>
        </h1>
        <ul class="nav">
          <li><a href="<?php echo U('/Home/About/index');?>">关于1001</a></li>
          <li><a href="<?php echo U('/Home/System/index');?>">1001酒店系统</a></li>
          <li><a class="active" href="<?php echo U('/Home/Union/index');?>">1001梦幻联盟</a></li>
          <li><a href="<?php echo U('/Home/Buiding/index');?>">在建 1001酒店</a></li>
          <li><a href="<?php echo U('/Home/Info/index');?>">1001资讯</a></li>
          <li><a href="<?php echo U('/Home/Join/index');?>">联系1001</a></li>
        </ul>
      </div>
    </div>

    <div class="banner2">
      <img src="/1001hotel/Public/images/about_banner.jpg" alt="一千个美丽的风景，一个不变的习惯">
    </div>

    <div class="floor union">
      <div class="floor-wrap">
        <h2 class="floor-title">公司简介</h2>
        <div class="section">
          <img style="float: left;" src="/1001hotel/uploadfiles/<?php echo ($ceo["images1"]); ?>" width="519" height="272">
          <div class="des">
            <p style="font-size:20px;color:#c59a6d;"><?php echo ($ceo["cn_title"]); ?></p>
            <p style="width:136px;height: 4px;margin:22px 0;background-color: #c59a6d;"></p>
            <p style="line-height: 26px;font-size:16px;color: #1b5e5d;"><?php echo ($ceo["cn_description"]); ?></p>
            <div class="viewmore">
              <a class="btn-union-popup" href="#"><?php echo ($ceo["cn_name"]); ?><i class="icon-enter"></i></a>
            </div>
            <div class="union-popup">
              <div class="main">
                <a class="btn-close" href="#">关闭</a>
                <p style="color: #c59a6d;text-align: center;font-size: 22px;margin-bottom: 40px;"><?php echo ($ceo["cn_title"]); ?></p>
                <div class="wrap">
                  <?php echo ($ceo["cn_content"]); ?>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="section">
          <img style="float: left;" src="/1001hotel/uploadfiles/<?php echo ($xuanze["images1"]); ?>" width="519" height="272">
          <div class="des">
            <p style="font-size:20px;color:#c59a6d;"><?php echo ($xuanze["cn_title"]); ?></p>
            <p style="width:136px;height: 4px;margin:22px 0;background-color: #c59a6d;"></p>
            <p style="line-height: 26px;font-size:16px;color: #1b5e5d;"><?php echo ($xuanze["cn_description"]); ?></p>
            <div class="viewmore">
              <a class="btn-union-popup" href="#"><?php echo ($xuanze["cn_name"]); ?><i class="icon-enter"></i></a>
            </div>
            <div class="union-popup">
              <div class="main">
                <a class="btn-close" href="#">关闭</a>
                <p style="color: #c59a6d;text-align: center;font-size: 22px;margin-bottom: 40px;"><?php echo ($xuanze["cn_title"]); ?></p>
                <div class="wrap">
                  <?php echo ($xuanze["cn_content"]); ?>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="section">
          <img style="float: left;" src="/1001hotel/uploadfiles/<?php echo ($join["images1"]); ?>" width="519" height="272">
          <div class="des">
            <p style="font-size:20px;color:#c59a6d;"><?php echo ($join["cn_title"]); ?></p>
            <p style="width:136px;height: 4px;margin:22px 0;background-color: #c59a6d;"></p>
            <p style="line-height: 26px;font-size:16px;color: #1b5e5d;"><?php echo ($join["cn_description"]); ?></p>
            <div class="viewmore">
              <a class="btn-union-popup" href="#"><?php echo ($join["cn_name"]); ?><i class="icon-enter"></i></a>
            </div>
            <div class="union-popup">
              <div class="main">
                <a class="btn-close" href="#">关闭</a>
                <p style="color: #c59a6d;text-align: center;font-size: 22px;margin-bottom: 40px;"><?php echo ($join["cn_title"]); ?></p>
                <div class="wrap">
                  <?php echo ($join["cn_content"]); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="union-news">
        <p>更多资讯，请点击进入 <a href="http://www.1001DHA.com" target="_blank">1001DHA.com</a></p>
      </div>
    </div>

    <!-- 包含底部文件 -->
      <div class="footer">
<div class="footer-wrap">
  <p class="copyright"><?php echo ($site["cn_content"]); ?></p>
  <ul class="footer-links">

	<?php if(is_array($link)): $i = 0; $__LIST__ = $link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a class="link<?php echo ($i); ?>" href="<?php echo ($vo["cn_title"]); ?>" title="<?php echo ($vo["cn_keywords"]); ?>"></a></li><?php endforeach; endif; else: echo "" ;endif; ?>

  </ul>
</div>
</div>
    <script src="/1001hotel/Public/js/jquery-1.9.1.min.js"></script>
    <script src="/1001hotel/Public/js/union.js"></script>
  </body>
</html>