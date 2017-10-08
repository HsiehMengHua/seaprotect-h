$(function(){
  var animaion = setInterval(update, 5);
  function update(){
    var y = $(this).scrollTop();
    if(y>120)
      $(".sidebar").css('top', y-120);
  }
});