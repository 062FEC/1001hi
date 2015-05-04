//index.html
$(function(){
	function detectScreen(){
    var screenHeight = $(window).height();
    var headerH = $('.header2').height();
    $('.about-video').height(screenHeight - headerH);
  }
  detectScreen();
  $(window).resize(function(){
    detectScreen();
  })

  $.each($('.consulting-list li'), function (index,item){
    $(item).mouseenter(function(){
      $(item).find('.overlayer').animate({
        top: '0'
      }, 300);
    }).mouseleave(function() {
      $(item).find('.overlayer').animate({
        top: '355px'
      }, 300);
    });
  })

  $.each($('.operation-list li'), function (index,item){
    $(item).mouseenter(function(){
      $(item).find('.overlayer').animate({
        top: '0'
      }, 300);
    }).mouseleave(function() {
      $(item).find('.overlayer').animate({
        top: '223px'
      }, 300);
    });
  })

  $.each($('.housekeeper-list li'), function (index,item){
    $(item).mouseenter(function(){
      $(item).find('.overlayer').animate({
        top: '0'
      }, 300);
    }).mouseleave(function() {
      $(item).find('.overlayer').animate({
        top: '257px'
      }, 300);
    });
  })

  $.each($('.environmental-unit'), function (index,item) {
    var h = $(item).height();
     $(item).mouseenter(function(){
      $(item).find('.overlayer').animate({
        top: '0'
      }, 300);
    }).mouseleave(function() {
      $(item).find('.overlayer').animate({
        top: h
      }, 300);
    });
  });

  //吸顶导航
  var subnavH = $('.subnav').height();
    systemFloorTop0 = $('#system-floor0').offset().top - subnavH,
    systemFloorTop1 = $('#system-floor1').offset().top - subnavH,
    systemFloorTop2 = $('#system-floor2').offset().top - subnavH,
    systemFloorTop3 = $('#system-floor3').offset().top - subnavH,
    systemFloorTop4 = $('#system-floor4').offset().top - subnavH,
    systemFloorTop5 = $('#system-floor5').offset().top - subnavH,
    joinusTop = $('.joinus').offset().top - subnavH,
    scrollTop = $('body,html').scrollTop(),
    $subnav = $('.subnav')
  ;
  function detectSystemFloating(){
    var scrollTop = $(window).scrollTop();
    if(scrollTop>=systemFloorTop0 && scrollTop<systemFloorTop1){
      $subnav.addClass('fixed');
      $subnav.find('a').removeClass('current');
      $subnav.find('a').eq(0).addClass('current');
    }else if(scrollTop>=systemFloorTop1 && scrollTop<systemFloorTop2){
      $subnav.addClass('fixed');
      $subnav.find('a').removeClass('current');
      $subnav.find('a').eq(1).addClass('current');
    }else if(scrollTop>=systemFloorTop2 && scrollTop<systemFloorTop3){
      $subnav.addClass('fixed');
      $subnav.find('a').removeClass('current');
      $subnav.find('a').eq(2).addClass('current');
    }else if(scrollTop>=systemFloorTop3 && scrollTop<systemFloorTop4){
      $subnav.addClass('fixed');
      $subnav.find('a').removeClass('current');
      $subnav.find('a').eq(3).addClass('current');
    }else if(scrollTop>=systemFloorTop4 && scrollTop<systemFloorTop5){
      $subnav.addClass('fixed');
      $subnav.find('a').removeClass('current');
      $subnav.find('a').eq(4).addClass('current');
    }else if(scrollTop>=systemFloorTop5 && scrollTop<joinusTop){
      $subnav.addClass('fixed');
      $subnav.find('a').removeClass('current');
      $subnav.find('a').eq(5).addClass('current');
    }else{
      $subnav.removeClass('fixed');
    }
  }
  $(window).scroll(function(){
    detectSystemFloating()
  })
  $.each($('.subnav a'), function (index,item){
    $(item).click(function(){
      $('body,html').animate({
        'scrollTop': $('#system-floor' + index).offset().top - subnavH
      },400)
      return false;
    })
  })


  $.each($('.banner-list2 li'), function (index, item){
    var bgImg = $(item).data('image');
    $(item).css({
      'background': 'url(' + bgImg + ') no-repeat center center',
      'background-size': 'cover'
    })
  })
  //banner切换
  $("#banner-list2").myFade({
    speed: 1000,
    timer: 5000,
    btnCtrl: 'banner-ctrl2',
    btnPrev: 'btn-prev',
    btnNxt: 'btn-nxt'
  });

  $.each($('.banner-list3 li'), function (index, item){
    var bgImg = $(item).data('image');
    $(item).css({
      'background': 'url(' + bgImg + ') no-repeat center center',
      'background-size': 'cover'
    })
  })
  //banner切换
  $("#banner-list3").myFade({
    speed: 1000,
    timer: 5000,
    btnCtrl: 'banner-ctrl3'
  });


  $('#system-video').height($(window).height()-$('.header2').height())
})
