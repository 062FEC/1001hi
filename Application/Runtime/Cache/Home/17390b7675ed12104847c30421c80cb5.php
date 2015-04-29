<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="description" content="<?php echo ($site["cn_description"]); ?>">
    <meta name="Keywords" content="<?php echo ($site["cn_keywords"]); ?>">
    <title>联系1001-<?php echo ($site["cn_title"]); ?></title>
    <link type="text/css" href="/1001hotel/Public/style/css/join.css" rel="stylesheet">
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
          <li><a href="<?php echo U('/Home/Buiding/index');?>">在建 1001酒店</a></li>
          <li><a href="<?php echo U('/Home/Info/index');?>">1001资讯</a></li>
          <li><a class="active" href="<?php echo U('/Home/Join/index');?>">联系1001</a></li>
        </ul>
      </div>
    </div>

    <div class="banner2"></div>

    <div class="subnav-placeholder">
      <div class="subnav join-subnav">
        <a class="current" href="#">联系我们</a>
        <a href="#">加入我们</a>
      </div>
    </div>

    <div id="join-floor0" class="floor contact-unit">
      <div class="floor-wrap">
        <h2 class="floor-title">联系我们</h2>
        <form method="post" action="<?php echo U('handle');?>">
          <dl class="contact-form-list">
            <dt><i class="icon-question"></i>想了解我们更多？</dt>
            <dd>
              <label for="">电子邮箱</label>
              <input class="txtfield" type="text" name="cn_title">
            </dd>
            <dd>
              <label for="">资讯内容</label>
              <select class="selectfield" name="cn_name">
				<?php if(is_array($type)): foreach($type as $key=>$zx): ?><option value="<?php echo ($zx["id"]); ?>"><?php echo ($zx["cn_type"]); ?></option><?php endforeach; endif; ?>
                
              </select>
            </dd>
            <dd>
              <label for="">请写下您的留言：</label>
              <textarea class="txtareafield" name="cn_description"></textarea>
            </dd>
            <dd>
              <input class="btn-submit" type="submit" value="提交">
            </dd>
          </dl>
        </form>
        <dl class="office-list">
          <dt><i class="icon-location2"></i></dt>
		  <?php if(is_array($address)): foreach($address as $key=>$add): ?><dd>
            <p><?php echo ($add["cn_title"]); ?></p>
            <p><?php echo ($add["cn_name"]); ?></p>
            <p>Add: <?php echo ($add["cn_description"]); ?></p>
            <p>地址：<?php echo ($add["cn_keywords"]); ?></p>
          </dd><?php endforeach; endif; ?>
          
        </dl>
        <ul class="contact-type">
          <li><i class="icon-tel"></i>400 9935 663<span class="txt1">（24小时全球连通）</span></li>
          <li><i class="icon-email"></i><a href="mailto:info1001hotel@126.com">Info1001Hotel@126.com</a></li>
        </ul>
      </div>
    </div>

    <div id="join-floor1" class="floor join-unit">
      <div class="floor-wrap">
        <div class="join-us">
          <img class="fr" src="/1001hotel/Public/images/join-pic1.png" width="292" height="329">
          <div class="section">
            <h2 class="floor-title">加入我们</h2>
            <p style="line-height: 26px;margin-bottom:32px;">1001 HOTEL目前正在寻找有梦想的人才加入中国大陆团队。</p>
            <p style="line-height: 26px;margin-bottom:32px;">我们为员工提供优厚的发展机会，我们坚信只有个人的成长才能带来我们公司作为一个整体的成长。因此，我们为员工提供持续的职业发展机会以及强有力的支持，让每一位员工在职业道路上发光发热，造就自己的梦想。</p>
            <p style="line-height: 26px;margin-bottom:32px;">我们已经收集这一千个梦想。加上你的一个梦想，我们一起把这1001的梦想变成现实。</p>
          </div>
        </div>
        <div class="to-apply">
          <div class="join-us">
            <img class="fl" src="/1001hotel/Public/images/join-pic2.png" width="288" height="194">
            <div class="section">
              <h2 class="floor-title">如何报名</h2>
              <p style="line-height: 26px;margin-bottom:32px;">请把你的个人简历和自荐信发到以下邮箱：<a href="mailto:info1001hotel@126.com">info1001hotel@126.com</a></p>
            </div>
          </div>
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
    <script src="/1001hotel/Public/js/join.js"></script>
  </body>
</html>