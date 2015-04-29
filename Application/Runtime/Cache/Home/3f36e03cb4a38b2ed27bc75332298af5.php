<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="description" content="<?php echo ($site["cn_description"]); ?>">
    <meta name="Keywords" content="<?php echo ($site["cn_keywords"]); ?>">
    <title>1001资讯-<?php echo ($site["cn_title"]); ?></title>
    <link type="text/css" href="/1001hotel/Public/style/css/info.css" rel="stylesheet">
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
          <li><a class="active" href="<?php echo U('/Home/Info/index');?>">1001资讯</a></li>
          <li><a href="<?php echo U('/Home/Join/index');?>">联系1001</a></li>
        </ul>
      </div>
    </div>

    <div class="banner2"></div>

    <div class="floor info">
      <div class="floor-wrap">
        <div class="info-header">
          <h2 class="floor-title">最新资讯</h2>
          <div class="info-nav">
            <ul class="info-nav-list">
              <li><a class="<?php if(empty($_GET['type_id'])): ?>current<?php endif; ?>" href="<?php echo U('Info/index');?>">全部</a></li>
              <li><a class="<?php if(($_GET['type_id']) == "119"): ?>current<?php endif; ?>" href="<?php echo U('Info/index',array('type_id'=>119));?>">资讯</a></li>
              <li><a class="<?php if(($_GET['type_id']) == "118"): ?>current<?php endif; ?>" href="<?php echo U('Info/index',array('type_id'=>118));?>">视频</a></li>
              <li><a class="<?php if(($_GET['type_id']) == "117"): ?>current<?php endif; ?>" href="<?php echo U('Info/index',array('type_id'=>117));?>">报道</a></li>
              <li><a class="<?php if(($_GET['type_id']) == "116"): ?>current<?php endif; ?>" href="<?php echo U('Info/index',array('type_id'=>116));?>">消费者故事</a></li>
              <li><a class="<?php if(($_GET['type_id']) == "115"): ?>current<?php endif; ?>" href="<?php echo U('Info/index',array('type_id'=>115));?>">活动更新</a></li>
            </ul>
            <div class="info-searchBar">
            <form method="post" action="<?php echo U('Info/search');?>">
              <input class="searchfield" type="text" name="keywords" value="<?php if($keyword != null): echo ($keyword); endif; ?>" placeholder="搜索关键字">
              <input class="btn-search" type="submit" value="搜索" title="seach">
            </form>  
            </div>
          </div>
        </div>
        
        <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><div class="section">
          <div class="left-side">
            <p style="height: 60px;color: #989898;font-size: 32px;"><?php echo ($data["month"]); ?></p>
            <?php if($data["type_id"] != 118): ?><img src="/1001hotel/uploadfiles/<?php echo ($data["images1"]); ?>" width="438" height="278">
            <?php else: ?>
            <a href="javascript:void(0)" onclick="openvideo('<?php echo ($data["id"]); ?>')">
            <img src="/1001hotel/uploadfiles/<?php echo ($data["images1"]); ?>" width="438" height="278">
            </a><?php endif; ?>
            
          </div>
          <div class="des">
            <p style="font-size:24px;color:#c59a6d;"><?php echo ($data["cn_name"]); ?></p>
            <p style="width:136px;margin: 8px 0 24px 0;font-size:16px;color: #bababa;"><?php echo ($data["date1"]); ?></p>
            <div style="height:140px;line-height: 28px;font-size:18px;color: #1b5e5d;overflow: hidden;"><?php echo ($data["cn_description"]); ?></div>
            <div class="viewmore">
              <a class="btn-info-popup" href="#">继续阅读<i class="icon-enter"></i></a>
            </div>
            <div class="assortment">
              <span>标签：<a href="<?php echo U('Info/index',array('type_id'=>$data['type_id']));?>"><?php echo ($data["label"]); ?></a></span>
            </div>
            <div class="info-popup">
              <div class="main">
                <a class="btn-close" href="#">关闭</a>
                <p style="color: #c59a6d;text-align: center;font-size: 26px;margin-bottom: 40px;"><?php echo ($data["cn_name"]); ?></p>
                <div class="wrap">
                  <?php echo ($data["cn_content"]); ?>
                </div>
              </div>
            </div>
          </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>

</div>

      <div class="info-more">
        <a href="<?php echo U('Info/index',array('type_id'=>$_GET['type_id'],'more'=>1));?>">显示更多</a>
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
    <script src="/1001hotel/Public/js/info.js"></script>
    <script type="text/javascript">
    	//打开视频播放器
    	function openvideo(id){
    		
    		var sss="<?php echo U('Info/openvideo');?>"+"?id="+id;
    		window.open(sss,'视频播放',"toolbar=no,menubar=no,resizable=yes,top="+(screen.availHeight - parseFloat(300))/2+",left="+(screen.availWidth - parseFloat(500))/2+",width=600pt,height=400pt");
    		
    	}
    </script>
  </body>
</html>