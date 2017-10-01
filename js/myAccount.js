$(document).ready(function(){
  $('.close-btn, button.cancel').click(function(){
    $('.update-account-form').animate({opacity: "0"}, 300, function(){
      $(this).hide();
    });
  });

  $('.update-account').click(function(){
    $('.update-account-form').show().animate({opacity: "1"}, 300);
  });

  $('.open-change-password').click(function(){
    if($(this).hasClass("open")){
      $(this).removeClass("open");
      $('.change-password').slideUp();
      $("button.submit").attr("disabled", false);
      $('.change-password input').val('');
    }else{
      $(this).addClass("open");
      $('.change-password').slideDown();
      $("button.submit").attr("disabled", true);
    }
  });
});