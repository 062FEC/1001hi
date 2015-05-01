<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="description" content="<?php echo ($site["cn_description"]); ?>">
    <meta name="Keywords" content="<?php echo ($site["cn_keywords"]); ?>">
    <title>1001酒店系统-<?php echo ($site["cn_title"]); ?></title>
    <link type="text/css" href="/Public/style/css/system.css" rel="stylesheet">
  </head>

  <body>
    <div class="header2">
      <div class="header2-wrap">
        <h1 class="logo">
          <a href="<?php echo U('/Home/Index/index');?>" title="1001HOTEL">1001HOTEL</a>
        </h1>
        <ul class="nav">
          <li><a href="<?php echo U('/Home/About/index');?>">关于1001</a></li>
          <li><a class="active" href="<?php echo U('/Home/System/index');?>">1001酒店系统</a></li>
          <li><a href="<?php echo U('/Home/Union/index');?>">1001梦幻联盟</a></li>
          <li><a href="<?php echo U('/Home/Buiding/index');?>">在建 1001酒店</a></li>
          <li><a href="<?php echo U('/Home/Info/index');?>">1001资讯</a></li>
          <li><a href="<?php echo U('/Home/Join/index');?>">联系1001</a></li>
        </ul>
      </div>
    </div>

    <div class="about-video">
      <embed id="system-video" src="http://yuntv.letv.com/bcloud.swf" allowFullScreen="true" quality="high" width="1024" height="768" align="middle" allowScriptAccess="always" flashvars="<?php echo ($video["cn_title"]); ?>" type="application/x-shockwave-flash"></embed>
     
    </div>

    <div class="subnav-placeholder">
      <div class="subnav system-subnav">
        <a class="current" href="#">酒店与业态设计</a>
        <a href="#">T-BOX®房屋系统</a>
        <a href="#">1001环保系统</a>
        <a href="#">智能管家</a>
        <a href="#">运营系统</a>
        <a href="#">顾问管理</a>
      </div>
    </div>
    
    <div id="system-floor0" class="floor design">
      <div class="floor-wrap">
        <h2 class="floor-title">酒店与业态设计</h2>
        <div class="design-banner">
          <ul id="banner-list3" class="banner-list3">
          <?php if(is_array($design)): $i = 0; $__LIST__ = $design;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li class="banner<?php echo ($i-1); ?> <?php if(($i) == "1"): ?>current<?php endif; ?>" data-image="/uploadfiles/<?php echo ($vol["images1"]); ?>">
              <p class="overlayer"><?php echo ($vol["cn_description"]); ?></p>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
          
           
          </ul>
        </div>
        <ol id="banner-ctrl3" class="banner-ctrl3">
        <?php if(is_array($design)): $i = 0; $__LIST__ = $design;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="<?php if(($i) == "1"): ?>current<?php endif; ?>"><?php echo ($vo["cn_name"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
         <!--  
          <li>项目策划与规划</li>
          <li>景观、建筑及业态设计</li>
          <li>酒店系统与运营设施设计</li>
          <li>运营及财务模型设计</li>
          -->
        </ol>
      </div>
    </div>

    <div id="system-floor1" class="floor housing">
      <div class="floor-wrap">
        <h2 class="floor-title">房屋系统</h2>
        <div class="housing-banner">
          <ul id="banner-list2" class="banner-list2">
          <?php if(is_array($tbox)): $i = 0; $__LIST__ = $tbox;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tb): $mod = ($i % 2 );++$i;?><li class="banner<?php echo ($i-1); ?> <?php if(($i) == "1"): ?>current<?php endif; ?>" data-image="/uploadfiles/<?php echo ($tb["images1"]); ?>">
              <p class="overlayer"><?php echo ($tb["cn_name"]); ?></p>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
 
          </ul>
          <ol id="banner-ctrl2" class="banner-ctrl2">
          	<?php if(is_array($tbox)): $i = 0; $__LIST__ = $tbox;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tb): $mod = ($i % 2 );++$i;?><li class="<?php if(($i) == "1"): ?>current<?php endif; ?>"><?php echo ($i-1); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>

          </ol>
          <a id="btn-prev" class="btn-prev" href="#">&lt;</a>
          <a id="btn-nxt" class="btn-nxt" href="#">&gt;</a>
        </div>
      </div>
    </div>

    <div id="system-floor2" class="floor environmental">
      <div class="floor-wrap">
        <h2 class="floor-title">1001环保系统</h2>
        <div class="environmental-box">
          <div class="left-side">
            <div class="environmental-video">
              <embed id="system-video2" src="http://yuntv.letv.com/bcloud.swf" allowFullScreen="true" quality="high" width="1024" height="768" align="middle" allowScriptAccess="always" flashvars="<?php echo ($theory["cn_title"]); ?>" type="application/x-shockwave-flash"></embed>
              
            </div>
            <div class="environmental-unit unit1">
              <!--该unit直接显示overlayer层-->
              <div id="environmental-unit-overlayer-solid" class="overlayer">
              <!-- 水源净化自循环系统原理 -->
                <?php echo ($theory["cn_content"]); ?>
              </div>
            </div>
            <div class="environmental-unit unit2">
              <img src="/uploadfiles/<?php echo ($zhibiao["images1"]); ?>" width="346" height="292">
              <div class="overlayer">
              <!-- 净化系统核心指标 -->
                <?php echo ($zhibiao["cn_content"]); ?>
              </div>
            </div>
          </div>
          <div class="right-side">
            <div class="environmental-unit unit3">
              <img src="/uploadfiles/<?php echo ($system["images1"]); ?>" width="397" height="283">
              <div class="overlayer">
              <!-- 水源净化自循环系统优点 -->
                <?php echo ($system["cn_content"]); ?>
              </div>
            </div>
            <div class="environmental-unit unit4">
              <img src="/uploadfiles/<?php echo ($bucao["images1"]); ?>" width="397" height="414">
              <div class="overlayer">
              <!-- 有机洗涤用品和布草 -->
               <?php echo ($bucao["cn_content"]); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="system-floor3" class="floor housekeeper">
      <div class="floor-wrap">
        <h2 class="floor-title">智能管家</h2>
        <ul class="housekeeper-list">
        <?php if(is_array($housekeeper)): $i = 0; $__LIST__ = $housekeeper;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hk): $mod = ($i % 2 );++$i;?><li>
            <img src="/uploadfiles/<?php echo ($hk["images1"]); ?>" width="277px" height="257px">
            <div class="overlayer">
              <p style="line-height: 32px;color: #c6dcd6;font-size: 18px;"><?php echo ($hk["cn_name"]); ?></p>
            </div>
          </li><?php endforeach; endif; else: echo "" ;endif; ?>  
        
        </ul>
      </div>
    </div>

    <div id="system-floor4" class="floor operation">
      <div class="floor-wrap">
        <h2 class="floor-title">运营系统</h2>
        <ul class="operation-list">
        <?php if(is_array($operation)): $i = 0; $__LIST__ = $operation;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$opa): $mod = ($i % 2 );++$i;?><li>
            <img src="/uploadfiles/<?php echo ($opa["images1"]); ?>" width="376" height="223">
            <div class="overlayer">
              <?php echo ($opa["cn_content"]); ?>
            </div>
          </li><?php endforeach; endif; else: echo "" ;endif; ?>
       
        </ul>
      </div>
    </div>

    <div id="system-floor5" class="floor consulting">
      <div class="floor-wrap">
        <h2 class="floor-title">酒店顾问管理</h2>
        <ul class="consulting-list">
        <?php if(is_array($counselor)): $i = 0; $__LIST__ = $counselor;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cs): $mod = ($i % 2 );++$i;?><li>
            <img src="/uploadfiles/<?php echo ($cs["images1"]); ?>" width="577" height="355">
            <div class="overlayer"><?php echo ($cs["cn_content"]); ?></div>
          </li><?php endforeach; endif; else: echo "" ;endif; ?>

        </ul>
      </div>
    </div>

    <div class="floor joinus">
      <div class="floor-wrap">
        <h2 class="floor-title">加盟1001</h2>
        <dl class="join-steps">
          <dt>1001野奢度假酒店加盟流程</dt>
          <dd>
            <span>参观了解<br>1001 HOTEL</span>
            <i class="icon-arrow"></i>
          </dd>
          <dd>
            <span>有意向者提交<br>加盟申请</span>
            <i class="icon-arrow"></i>
          </dd>
          <dd>
            <span>品牌委员会<br>门槛调查</span>
            <i class="icon-arrow"></i>
          </dd>
          <dd>
            <span>接受规划设计要求<br>愿意加入1001网络</span>
            <i class="icon-arrow"></i>
          </dd>
          <dd class="last">
            <span>项目总体规划<br>酒店业态设计</span>
            <span>低价格购买<br>T-box®系统</span>
            <span>酒店运营设计<br>酒店管理体系</span>
            <span>品牌推广支撑<br>客源服务支持</span>
          </dd>
        </dl>
        <a class="icon-download" href="<?php if(empty($join["images2"])): ?>javascript:void(0)<?php else: ?>/uploadfiles/<?php echo ($join["images2"]); endif; ?>">DOWNLOAD</a>
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
    <script src="/Public/js/system.js"></script>
  </body>
</html>