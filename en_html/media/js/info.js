//info.html
$(function(){
	var screenH = $(window).height();
	var headerH = $('.header2').height();
	$('.banner2').height(screenH-headerH);
	
	$.each($('.btn-info-popup'), function (index,item){
	  $(item).click(function(event) {
	    $(item).parent().siblings('.info-popup').fadeIn(200);
	    return false;
	  });
	})
	$.each($('.info-popup .btn-close'), function (index,item){
	  $(item).click(function(event) {
	    $(item).parents('.info-popup').fadeOut(200);
	    return false;
	  });
	})
})

