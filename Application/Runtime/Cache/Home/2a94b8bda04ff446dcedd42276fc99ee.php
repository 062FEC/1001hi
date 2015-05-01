<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="description" content="<?php echo ($site["cn_description"]); ?>">
    <meta name="Keywords" content="<?php echo ($site["cn_keywords"]); ?>">
    <title><?php echo ($site["cn_title"]); ?></title>
    <link type="text/css" href="/Public/style/css/index.css" rel="stylesheet">
  </head>

  <body>
    <div class="header">
      <h1 class="logo">
        <a href="<?php echo U('/Home/Index/index');?>" title="1001HOTEL">1001HOTEL</a>
      </h1>
      <ul class="nav">
        <li><a href="<?php echo U('/Home/About/index');?>">关于1001</a></li>
        <li><a href="<?php echo U('/Home/System/index');?>">1001酒店系统</a></li>
        <li><a href="<?php echo U('/Home/Union/index');?>">1001梦幻联盟</a></li>
        <li><a href="<?php echo U('/Home/Buiding/index');?>">在建 1001酒店</a></li>
        <li><a href="<?php echo U('/Home/Info/index');?>">1001资讯</a></li>
        <li><a href="<?php echo U('/Home/Join/index');?>">联系1001</a></li>
      </ul>
    </div>

    <div id="banner1" class="banner" style="height:421px;">
      <ul id="banner-list" class="banner-list">
		<?php if(is_array($banner)): foreach($banner as $k=>$v): ?><li class="banner<?php echo ($k); ?> <?php if(($k) == "0"): ?>current<?php endif; ?>" data-image="/uploadfiles/<?php echo ($v["images1"]); ?>">
        </li><?php endforeach; endif; ?>
		<!--
        <li class="banner1" data-image="/Public/images/banner2.jpg">

        </li>
        <li class="banner2" data-image="/Public/images/banner3.jpg">

        </li>
        <li class="banner3" data-image="/Public/images/banner4.jpg">

        </li>
		-->
      </ul>
      <ol id="banner-ctrl" class="banner-ctrl">
	  <?php if(is_array($banner)): foreach($banner as $k=>$v): ?><li class="<?php if(($k) == "0"): ?>current<?php endif; ?>">0</li><?php endforeach; endif; ?>
        
      </ol>
      <span class="btn-video-arrow">
        <a href="#"></a>
      </span>
    </div>

    <div class="video-area">
      <div class="video-wrap">
		
		<embed id="index-video" src="http://yuntv.letv.com/bcloud.swf" allowFullScreen="true" quality="high" width="1024" height="768" align="middle" allowScriptAccess="always" flashvars="<?php echo ($video["cn_title"]); ?>" type="application/x-shockwave-flash"></embed>
        
      </div>
		<!-- 包含底部文件 -->
      <div class="footer">
<div class="footer-wrap">
  <p class="copyright">粤ICP备案号12041777</p>
  <ul class="footer-links">

	<?php if(is_array($link)): $i = 0; $__LIST__ = $link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a class="link<?php echo ($i); ?>" href="<?php echo ($vo["cn_title"]); ?>" title="<?php echo ($vo["cn_keywords"]); ?>"></a></li><?php endforeach; endif; else: echo "" ;endif; ?>

  </ul>
</div>
</div>
    </div>

    <script src="/Public/js/jquery-1.9.1.min.js"></script>
    <script src="/Public/js/common.js"></script>
    <script src="/Public/js/index.js"></script>
  </body>
</html>