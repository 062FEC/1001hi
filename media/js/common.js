$.fn.extend({
  myFade: function(opt,callback){
    //参数初始化
    if(!opt) var opt={};
    var _btnCtrl = $('#' + opt.btnCtrl),
      timerID,
      _this = $(this),
      speed = opt.speed?parseInt(opt.speed,10):500,
      timer = opt.timer,
      ctrlIndex = 0,
      len = _this.find('li').length,
      $_btnPrev = $('#' + opt.btnPrev),
      $_btnNxt = $('#' + opt.btnNxt)
    ;

    //滚动函数
    var fade = function(){
      _btnCtrl.find('li').unbind("click", fade);
      var $currentObj = _this.find('li').eq(ctrlIndex);
      var $currentCtrl = _btnCtrl.find('li').eq(ctrlIndex);
      ctrlIndex++;
      ctrlIndex = ctrlIndex==len?0:ctrlIndex;
      var $nextObj = _this.find('li').eq(ctrlIndex);
      var $nextCtrl = _btnCtrl.find('li').eq(ctrlIndex);  
      $currentObj.animate({
        'opacity': 0
      }, speed, function(){
        //todo
      });
      $nextObj.animate({
        'opacity': 1
      }, speed, function(){
        //todo
      });
      $currentObj.removeClass('current');
      $currentCtrl.removeClass('current');
      $nextObj.addClass('current');
      $nextCtrl.addClass('current');
    }

    //自动播放
    var autoPlay = function(){
      if(timer){
        timerID = window.setInterval(fade,timer);
      }
    };
    var autoStop = function(){
      if(timer){
        window.clearInterval(timerID);
      }
    };

    //点击向前
    $_btnNxt.click(function(){
      fade();
      return false;
    }).mouseenter(function() {
      autoStop();
    }).mouseleave(function() {
      autoPlay();
    });


    //点击后退
    $_btnPrev.click(function(){
      _btnCtrl.find('li').unbind("click", fade);
      var $currentObj = _this.find('li').eq(ctrlIndex);
      var $currentCtrl = _btnCtrl.find('li').eq(ctrlIndex);
      ctrlIndex--;
      ctrlIndex = ctrlIndex==-1?(len-1):ctrlIndex;
      var $prevObj = _this.find('li').eq(ctrlIndex);
      var $prevCtrl = _btnCtrl.find('li').eq(ctrlIndex);  
      $currentObj.animate({
        'opacity': 0
      }, speed, function(){
        //todo
      });
      $prevObj.animate({
        'opacity': 1
      }, speed, function(){
        //todo
      });
      $currentObj.removeClass('current');
      $currentCtrl.removeClass('current');
      $prevObj.addClass('current');
      $prevCtrl.addClass('current');

      return false;
    }).mouseenter(function() {
      autoStop();
    }).mouseleave(function() {
      autoPlay();
    });

    //鼠标事件绑定
    _btnCtrl.find('li').mouseenter(function(){
    	autoStop();
    }).mouseleave(function() {
    	autoPlay();
    }).click(function() {
    	ctrlIndex = $(this).index();
      _btnCtrl.find('li').eq(ctrlIndex).addClass('current')
        .siblings().removeClass('current');
      var $currentObj = _this.find('li').eq(ctrlIndex);
      $currentObj.animate({
        'opacity': 1
      }, speed, function(){
        //todo
      });
      $currentObj.siblings().animate({
        'opacity': 0
      }, speed, function(){
        //todo
      });
    });

    autoPlay();
    $(window).blur(function(){
      autoStop();
    }).focus(function(){
      autoPlay();
    })
  }
})


$.each($('.banner-list li'), function (index, item){
  var bgImg = $(item).data('image');
  $(item).css({
    'background': 'url(' + bgImg + ') no-repeat center center',
    'background-size': 'cover'
  })
})
$('.banner-ctrl').css({
  'margin-left': -$('.banner-ctrl').width()/2
})

var screenHeight = $(window).height();
$('.banner').height(screenHeight);
$(window).resize(function(){
  var screenHeight = $(window).height();
  $('.banner').height(screenHeight);
})