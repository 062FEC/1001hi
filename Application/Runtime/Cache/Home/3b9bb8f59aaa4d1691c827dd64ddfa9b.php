<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="description" content="<?php echo ($site["cn_description"]); ?>">
    <meta name="Keywords" content="<?php echo ($site["cn_keywords"]); ?>">
    <title>关于1001-<?php echo ($site["cn_title"]); ?></title>
    <link type="text/css" href="/Public/style/css/about.css" rel="stylesheet">
  </head>

  <body>
    <div class="header2">
      <div class="header2-wrap">
        <h1 class="logo">
          <a href="<?php echo U('/Home/Index/index');?>" title="1001HOTEL">1001HOTEL</a>
        </h1>
        <ul class="nav">
          <li><a class="active" href="<?php echo U('/Home/About/index');?>">关于1001</a></li>
          <li><a href="<?php echo U('/Home/System/index');?>">1001酒店系统</a></li>
          <li><a href="<?php echo U('/Home/Union/index');?>">1001梦幻联盟</a></li>
          <li><a href="<?php echo U('/Home/Buiding/index');?>">在建 1001酒店</a></li>
          <li><a href="<?php echo U('/Home/Info/index');?>">1001资讯</a></li>
          <li><a href="<?php echo U('/Home/Join/index');?>">联系1001</a></li>
        </ul>
      </div>
    </div>

    <div id="banner2" class="banner">
      <ul id="banner-list" class="banner-list">
        <li class="banner0 current" data-image="/uploadfiles/20150430/201504301002256463.jpg"></li>
        <li class="banner1" data-image="/uploadfiles/20150430/201504301001413478.jpg"></li>
        <li class="banner2" data-image="/uploadfiles/20150430/201504300959324448.jpg"></li>
        <li class="banner3" data-image="/uploadfiles/20150430/201504300959003500.jpg"></li>
        <li class="banner4" data-image="/uploadfiles/20150430/201504300958012986.jpg"></li>
        <li class="banner5" data-image="/uploadfiles/20150430/201504300943232740.jpg"></li>
      </ul>
      <ol id="banner-ctrl" class="banner-ctrl">
        <li class="current">0</li>
        <li>1</li>
        <li>2</li>
        <li>3</li>
        <li>4</li>
        <li>5</li>
      </ol>
    </div>

    <div class="subnav-placeholder">
      <div class="subnav">
        <a class="current" href="#">公司简介</a>
        <a href="#">品牌故事</a>
        <a href="#">获奖与专利</a>
        <a href="#">旗下品牌</a>
      </div>
    </div>

    <div id="about-floor0" class="floor overview">
      <div class="floor-wrap">
        <h2 class="floor-title">公司简介</h2>

        <div class="section">
          <img style="float:left;margin: 0 40px 48px 0;" src="/uploadfiles/<?php echo ($jianjie["images1"]); ?>" width="482" height="305">
          <h3 style="margin-bottom: 20px;font-size: 22px;font-weight: normal;color: #c59a6d;"><?php echo ($jianjie["cn_title"]); ?></h3>
          <?php echo ($jianjie["cn_content"]); ?>
        </div>

        <div class="section">
          <img style="float:right;margin: 0 0 48px 40px;" src="/uploadfiles/<?php echo ($bless["images1"]); ?>" width="511" height="291">
          <h3 style="margin-bottom: 20px;font-size: 22px;font-weight: normal;color: #c59a6d;"><?php echo ($bless["cn_title"]); ?></h3>
          <?php echo ($bless["cn_content"]); ?>
        </div>

        <div class="section">
          <h3 class="section-title">业务板块</h3>
          <ul class="business-block">
            <li>
              <img src="/uploadfiles/<?php echo ($bkone["images1"]); ?>" width="370" height="360" alt="">
              <div class="overlayer">
                <a class="btn-close" href="#">关闭</a>
                <?php echo ($bkone["cn_content"]); ?>
                <p style="position: absolute;bottom: 64px;left: 0;width: 100%;margin: 0;font-size: 18px;text-align: center;">详情点击：</p>
                <p style="position: absolute;bottom: 26px;left: 0;width: 100%;margin: 0;font-size: 18px;text-align: center;"><a style="color: #46aeff;text-decoration: underline;" href="<?php echo ($bkone["cn_keywords"]); ?>" target="_blank"><?php echo ($bkone["cn_keywords"]); ?></a></p>
              </div>
            </li>
            <li>
              <img src="/uploadfiles/<?php echo ($bktwo["images1"]); ?>" width="370" height="360" alt="">
              <div class="overlayer">
                <a class="btn-close" href="#">关闭</a>
                <?php echo ($bktwo["cn_content"]); ?>
                <p style="position: absolute;bottom: 64px;left: 0;width: 100%;margin: 0;font-size: 18px;text-align: center;">详情点击：</p>
                <p style="position: absolute;bottom: 26px;left: 0;width: 100%;margin: 0;font-size: 18px;text-align: center;"><a style="color: #46aeff;text-decoration: underline;" href="<?php echo ($bktwo["cn_keywords"]); ?>" target="_blank"><?php echo ($bktwo["cn_keywords"]); ?></a></p>
              </div>
            </li>
          </div>
        </div>
      </div>
    </div>

    <div id="about-floor1" class="floor story">
      <div class="floor-wrap">
        <h2 class="floor-title">品牌与故事</h2>
        <dl class="story-list">
          <dt><span>1001 HOTEL 的由来</span></dt>
          <dd class="left">
            <p class="date">
              <span class="dot"></span>
              1908年
            </p>
            <div class="story-box">
              <img class="album" src="/uploadfiles/<?php echo ($story_one["images1"]); ?>" width="64" height="64">
              <img class="big-album" src="/uploadfiles/<?php echo ($story_one["images2"]); ?>">
              <p style="float: right;width: 268px;color: #000;line-height: 24px;font-size: 15px;"><?php echo ($story_one["cn_description"]); ?></p>
            </div>
          </dd>
          <dd class="right">
            <p class="date">
              <span class="dot"></span>
              1950年
            </p>
            <div class="story-box">
              <img class="album" data-img="/uploadfiles/<?php echo ($story_two["images1"]); ?>" src="/uploadfiles/<?php echo ($story_two["images1"]); ?>" width="64" height="64">
              <img class="big-album" src="/uploadfiles/<?php echo ($story_two["images2"]); ?>">
              <p style="float: right;width: 268px;color: #000;line-height: 24px;font-size: 15px;"><?php echo ($story_two["cn_description"]); ?></p>
            </div>
          </dd>
          <dt><span>一千零一夜之梦</span></dt>
          <dd class="left">
            <p class="date">
              <span class="dot"></span>
              2006年
            </p>
            <div class="story-box">
              <img class="album" data-img="/uploadfiles/<?php echo ($story_three["images1"]); ?>" src="/uploadfiles/<?php echo ($story_three["images1"]); ?>" width="64" height="64">
              <img class="big-album" src="/uploadfiles/<?php echo ($story_three["images2"]); ?>">
              <p style="float: right;width: 268px;color: #000;line-height: 24px;font-size: 15px;"><?php echo ($story_three["cn_description"]); ?></p>
            </div>
          </dd>
          <dt><span>梦想启航，全新的1001 HOTEL</span></dt>
          <dd class="right">
            <p class="date">
              <span class="dot"></span>
              2008年
            </p>
            <div class="story-box">
              <img class="album" data-img="/uploadfiles/<?php echo ($story_four["images1"]); ?>" src="/uploadfiles/<?php echo ($story_four["images1"]); ?>" width="64" height="64">
              <img class="big-album" src="/uploadfiles/<?php echo ($story_four["images2"]); ?>">
              <p style="float: right;width: 268px;color: #000;line-height: 24px;font-size: 15px;"><?php echo ($story_four["cn_description"]); ?></p>
            </div>
          </dd>
          <dt><span>全新的1001 HOTEL正式进入亚洲</span></dt>
          <dd class="left">
            <p class="date">
              <span class="dot"></span>
              2011年
            </p>
            <div class="story-box">
              <img class="album" data-img="/uploadfiles/<?php echo ($story_five["images1"]); ?>" src="/uploadfiles/<?php echo ($story_five["images1"]); ?>" width="64" height="64">
              <img class="big-album" src="/uploadfiles/<?php echo ($story_five["images2"]); ?>">
              <p style="float: right;width: 268px;color: #000;line-height: 24px;font-size: 15px;"><?php echo ($story_five["cn_description"]); ?></p>
            </div>
          </dd>
          <dt><span>梦想起航</span></dt>
        </dl>
        <div class="summary">
          <div class="summary-wrap">
            <?php echo ($story_go["cn_content"]); ?>
            <p style="color: #191918;">1001 HOTEL</p>
          </div>
        </div>
      </div>
    </div>

    <div id="about-floor2" class="floor adwards">
      <div class="floor-wrap">
        <h2 class="floor-title">获奖与专利</h2>
        <div id="adwards-slider">
          <ul class="adwards-list">
			<?php if(is_array($adword)): foreach($adword as $key=>$v): ?><li>
              <img src="/uploadfiles/<?php echo ($v["images1"]); ?>" width="312" height="435" alt="<?php echo ($v["cn_name"]); ?>">
              <p><?php echo ($v["cn_name"]); ?></p>
              <span><?php echo ($v["cn_keywords"]); ?></span>
            </li><?php endforeach; endif; ?>
          </ul>
        </div>
      </div>
    </div>

    <div id="about-floor3" class="floor brand">
      <div class="floor-wrap">
        <h2 class="floor-title">旗下品牌</h2>
        <ul class="brand-list">
		<!-- <?php if(is_array($brand)): foreach($brand as $k=>$v): ?><li><a class="list<?php echo ($k); ?>" data-img="/uploadfiles/<?php echo ($v["images2"]); ?>" href="javascript:void(0)"><?php echo ($v["cn_name"]); ?></a></li><?php endforeach; endif; ?> -->
          <li><a class="list0" data-img="/uploadfiles/20150430/201504300854379591.jpg" href="#"><img src="/Public/images/brand1.png"></a></li>
          <li><a class="list1" data-img="/uploadfiles/20150430/201504300858378211.jpg" href="#"><img src="/Public/images/brand2.png"></a></li>
          <li><a class="list2" data-img="/uploadfiles/20150430/201504300859074054.jpg" href="#"><img src="/Public/images/brand3.png"></a></li>
          <li><a class="list3" data-img="/uploadfiles/20150430/201504300859522268.jpg" href="#"><img src="/Public/images/brand4.png"></a></li>
          <li><a class="list4" data-img="/uploadfiles/20150430/201504300900525656.jpg" href="#"><img src="/Public/images/brand5.png"></a></li>
        </ul>

        <div class="popup-brand">
          <div class="popup-main">
            <a class="btn-close" href="#">关闭</a>
            <img src="" width="960" height="540">
          </div>
        </div>
      </div>
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
    <script src="/Public/js/jquery-1.9.1.min.js"></script>
    <script src="/Public/js/common.js"></script>
    <script src="/Public/js/about.js"></script>
  </body>
</html>