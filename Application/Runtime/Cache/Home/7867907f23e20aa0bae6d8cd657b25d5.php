<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="description" content="<?php echo ($site["cn_description"]); ?>">
    <meta name="Keywords" content="<?php echo ($site["cn_keywords"]); ?>">
    <title>在建1001酒店-<?php echo ($site["cn_title"]); ?></title>
    <link type="text/css" href="/1001hotel/Public/style/css/building.css" rel="stylesheet">
	
	
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
          <li><a href="<?php echo U('/Home/Union/index');?>">1001梦幻联盟</a></li>
          <li><a class="active" href="<?php echo U('/Home/Buiding/index');?>">在建 1001酒店</a></li>
          <li><a href="<?php echo U('/Home/Info/index');?>">1001资讯</a></li>
          <li><a href="<?php echo U('/Home/Join/index');?>">联系1001</a></li>
        </ul>
      </div>
    </div>

    <div class="banner2"></div>

    <div class="floor building">
      <div class="floor-wrap">
        <ul class="building-list">
		<?php if(is_array($buiding)): foreach($buiding as $k=>$vo): ?><li class="<?php if(($k) == "0"): ?>first<?php endif; ?>">
            <img class="pic" src="/1001hotel/uploadfiles/<?php echo ($vo["images1"]); ?>" >
            <div class="des">
              <p class="name"><?php echo ($vo["cn_name"]); ?></p>
              <span class="location"><i class="icon-location"></i><?php echo ($vo["cn_title"]); ?></span>
              <div class="overlayer">
                <p style="line-height:26px;font-size: 16px;color: #fff;"><?php echo ($vo["cn_description"]); ?></p>
              </div>
            </div>
          </li><?php endforeach; endif; ?>
		
        </ul>
      </div>

      <div class="building-more">
        <a href="<?php echo U('Buiding/index',array('more'=>1));?>">显示更多</a>
      </div>

      <div class="popup-erweima">
        <div class="popup-main">
          <a class="btn-close" href="#">关闭</a>
          <h3 class="title">即将开幕</h3>
          <p class="des">扫二维码，立即了解更多1001梦幻体验！</p>
          <img src="/1001hotel/uploadfiles/<?php echo ($code["images1"]); ?>" width="279" height="279">
        </div>
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
    <script src="/1001hotel/Public/js/building.js"></script>
  </body>
</html>