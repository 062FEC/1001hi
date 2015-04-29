//union.html
$.each($('.btn-union-popup'), function (index,item){
  $(item).click(function(event) {
    $(item).parent().siblings('.union-popup').fadeIn(200);
    return false;
  });
})
$.each($('.union-popup .btn-close'), function (index,item){
  $(item).click(function(event) {
    $(item).parents('.union-popup').fadeOut(200);
    return false;
  });
})
