//about.html
$(function(){
	var screenH = $(window).height();
	var headerH = $('.header2').height();
  $('.banner2').height(screenH-headerH);


	//吸顶导航
	var subnavH = $('.subnav').height();
		aboutFloorTop0 = $('#about-floor0').offset().top - subnavH,
		aboutFloorTop1 = $('#about-floor1').offset().top - subnavH,
		aboutFloorTop2 = $('#about-floor2').offset().top - subnavH,
		aboutFloorTop3 = $('#about-floor3').offset().top - subnavH,
		footerTop = $('.footer-wrap').offset().top - subnavH,
		$subnav = $('.subnav')
	;
	function detectAboutFloating(){
		var scrollTop = $(window).scrollTop();
		if(scrollTop>=aboutFloorTop0 && scrollTop<aboutFloorTop1){
			$subnav.addClass('fixed');
			$subnav.find('a').removeClass('current');
			$subnav.find('a').eq(0).addClass('current');
		}else if(scrollTop>=aboutFloorTop1 && scrollTop<aboutFloorTop2){
			$subnav.addClass('fixed');
			$subnav.find('a').removeClass('current');
			$subnav.find('a').eq(1).addClass('current');
		}else if(scrollTop>=aboutFloorTop2 && scrollTop<aboutFloorTop3){
			$subnav.addClass('fixed');
			$subnav.find('a').removeClass('current');
			$subnav.find('a').eq(2).addClass('current');
		}else if(scrollTop>=aboutFloorTop3 && scrollTop<footerTop){
			$subnav.addClass('fixed');
			$subnav.find('a').removeClass('current');
			$subnav.find('a').eq(3).addClass('current');
		}else{
			$subnav.removeClass('fixed');
		}
	}
	$(window).scroll(function(){
		detectAboutFloating()
	})
	$.each($('.subnav a'), function (index,item){
		$(item).click(function(){
			$('body,html').animate({
				'scrollTop': $('#about-floor' + index).offset().top - subnavH
			},400)
			return false;
		})
	})

	//业务板块点击遮罩层
	$.each($('.business-block li img'), function (index,item) {
		$(item).click(function(){
			$(item).siblings('.overlayer').animate({
				'top': '0'
			},300)
		})	
	});
	$.each($('.business-block .overlayer .btn-close'), function (index,item) {
		$(item).click(function(){
			$(item).parent('.overlayer').animate({
				'top': '360px'
			},300)
			return false;
		})
	});

	//旗下品牌点击弹出框
	$.each($('.brand-list a'), function (index,item){
		$(item).click(function(){
			var bigImg = $(item).data('img');
			console.log(bigImg)
			$('.popup-brand').find('img').attr('src', bigImg);
			$('.popup-brand').fadeIn(200);
			return false;
		})
	})
	$('.popup-brand .btn-close').click(function(){
		$('.popup-brand').fadeOut(200);
		return false;
	})

	//品牌与故事插图hover框
	$.each($('.story-box .album'), function (index,item){
		var $bigImg = $(item).siblings('.big-album');
		$bigImg.css({
			'marginTop': -$bigImg.height()/2
		})
		$(item).mouseenter(function(){
			$bigImg.fadeIn(200);
		})
	})
	$.each($('.big-album'), function (index,item){
		$(item).mouseenter(function(){
			$(item).fadeIn(200);
		}).mouseleave(function(){
			$(item).fadeOut(200);
		})
	})


	//证书slide轮播
	var adwardWidth = $('.adwards-list li').width();
	var adwardMarginR = parseInt($('.adwards-list li').css('margin-right'));
	var adwardLen = $('.adwards-list li').length;
	var adwardFlag = 0;
	var $adwarSlider = $('.adwards-list');
	$('.adwards-list').width((adwardWidth+adwardMarginR)*adwardLen);
	if(adwardLen>3){
		var slide = function(){
			adwardFlag++;
			if(adwardFlag>adwardLen-3){
				adwardFlag = 0;
			}
			$adwarSlider.animate({
				'left': -(adwardWidth+adwardMarginR)*adwardFlag
			}, 500, function() {
				
			});
		}
		var slideTimer = window.setInterval(slide, 4000);
	}
})
//end of about.html