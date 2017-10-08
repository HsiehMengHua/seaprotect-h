$(document).ready(function(){
  $('.close-btn, button.cancel').click(function(){
    closeForm($(this));
  });

  $('.grid-item').click(function(){
    openForm($(this));
  });
  
  $('.profile-photo').click(function(){
    openForm($(".container"));
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

function closeForm(elem) {
  elem.closest(".pop-up-form").animate({ opacity: "0" }, 300, function(){
    $(this).hide();
  });
}

function openForm(elem) {
  console.log(elem.find(".pop-up-form"));
  elem.find(".pop-up-form:first").show().animate({opacity: "1"}, 300);
}