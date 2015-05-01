//info.html
$(function(){
	var screenH = $(window).height();
	var headerH = $('.header2').height();
	$('.banner2').height(screenH-headerH);
	
	$.each($('.building-list li'), function (index,item){
		var topVal = '-1px';
		var desH = $(item).find('.des').height() + 2;
		if($(item).hasClass('first')){
			topVal = '-2px';
		}
	  $(item).mouseenter(function() {
	  	$(item).find('.overlayer').animate({
	  		'top': topVal
	  	}, 300);
	  }).mouseleave(function(){
	  	$(item).find('.overlayer').animate({
	  		'top': desH
	  	}, 300);
	  })
	})
	$('.building-list li .pic').click(function(event) {
		$('.popup-erweima').fadeIn(200)
		return false;
	});
	$.each($('.popup-erweima .btn-close'), function (index,item){
	  $(item).click(function(event) {
	    $(item).parents('.popup-erweima').fadeOut(200);
	    return false;
	  });
	})
})

