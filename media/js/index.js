//index.html
$(function(){
	$('body,html').animate({'scrollTop': 0},1);
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
	
	function detectScreen(){
		var screenHeight = $(window).height();
		$('.banner,.video-area').height(screenHeight);
		$('.video-wrap').height(screenHeight - $('.footer').height());
	}
	detectScreen();
	$(window).resize(function(){
		detectScreen();
	})

	$('.btn-video-arrow a').click(function(){
		$('body,html').animate({
			'scrollTop': $('.video-area').offset().top
		},400)
		return false;
	})

	$('#index-video').height($(window).height()-$('.footer').height())
})
