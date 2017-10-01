$(document).ready(function() {
  $('form input').on("focus",function(){
    inputFocus($(this));
  });
  
  $('form input').on("blur",function(){
    inputBlur($(this));
  });
  
  $('#confirmPassword').keyup(function(){
    if($(this).val() == $('#password').val()){
      inputCorrect($(this));
    }else{
      inputWrong($(this), "密碼不一致");
    }
    
    enableSubmit();
    console.log(submitCheck());
  });
  
  $('#orig-password-input').keyup(function(){
    checkPassword($(this).val());
    enableSubmit();
    console.log(submitCheck());
  });
});


function inputFocus(elem){
  elem.parent().css("color","#55bbb5");
  elem.css("borderBottomColor","#55bbb5");
}

function inputBlur(elem){
  elem.parent().css("color","#313b4f");
  elem.css("borderBottomColor","#313b4f");
}

function inputCorrect(elem){
  elem.css("borderBottomColor","#75da7a");
  elem.parent().css("color","#75da7a");
  elem.parent().children(".err").html("");
  elem.attr("data-status","1");
}

function inputWrong(elem, errorMessage){
  elem.css("borderBottomColor","#e53a3a");
  elem.parent().css("color","#e53a3a");
  elem.parent().children(".err").html(errorMessage);
  elem.attr("data-status","0");
}

function checkPassword(str){
  $.ajax({
    url: "checkPassword.php", 
    success: function(result){
      if(result == md5(str)){
        inputCorrect($('#orig-password-input'));
      }else{
        inputWrong($('#orig-password-input'), "密碼錯誤");
      }
    }
  });
}

function submitCheck(){
  var status = 0;
  var elem1 = $('#orig-password-input');
  var elem2 = $('#confirmPassword');
  
  if($('.open-change-password').hasClass('open')){
    if(elem1.val() != '' && elem1.attr("data-status") == 1){
      if(elem2.val() != '' && elem2.attr("data-status") == 1){
        status = 1;
      }
    }
  }
  
  return status;
}

function enableSubmit(){
  if($('.open-change-password').hasClass("open")){
    if(submitCheck()){
      $("button.submit").attr("disabled", false);
    }else{
      $("button.submit").attr("disabled", true);
    }
  }else{
    $("button.submit").attr("disabled", false);
  }
}