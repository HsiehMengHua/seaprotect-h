$(document).ready(function(){
  $('.menu-icon').click(function(){
    openMenu();
  });
  
  $('html, .close').click(function(){
    closeMenu();
  });
  
  $('.menu, .menu-icon').click(function(event){
    event.stopPropagation();
  });
});

function openMenu(){
  $('.menu').animate({left: "0"},200);
}

function closeMenu(){
  $('.menu').animate({left: "-355px"},200);
}