//info.html
$(function(){
	var screenH = $(window).height();
	var headerH = $('.header2').height();
	$('.banner2').height(screenH-headerH);
	
	//吸顶导航
  var subnavH = $('.subnav').height();
    joinFloorTop0 = $('#join-floor0').offset().top - subnavH,
    joinFloorTop1 = $('#join-floor1').offset().top - subnavH,
    scrollTop = $('body,html').scrollTop(),
    $subnav = $('.subnav')
  ;
  function detectSystemFloating(){
    var scrollTop = $(window).scrollTop();
    if(scrollTop>=joinFloorTop0 && scrollTop<joinFloorTop1){
      $subnav.addClass('fixed');
      $subnav.find('a').removeClass('current');
      $subnav.find('a').eq(0).addClass('current');
    }else if(scrollTop>=joinFloorTop1){
      $subnav.addClass('fixed');
      $subnav.find('a').removeClass('current');
      $subnav.find('a').eq(1).addClass('current');
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
        'scrollTop': $('#join-floor' + index).offset().top - subnavH
      },400)
      return false;
    })
  })
})

