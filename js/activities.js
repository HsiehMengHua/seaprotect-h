var n = 0;
$(window).scroll(function() {
  if($(window).scrollTop() + $(window).height() > $(document).height() - 350) {
    loadPage();
  }
});

function loadPage(){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState == 4 && xhttp.status == 200) {
      $(".middle").append(xhttp.responseText);
    }
  };
  
  xhttp.open("GET","load.php?o="+n,true);
  xhttp.send();
  n++;
}

function join(id){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState == 4 && xhttp.status == 200) {
      alert(xhttp.responseText);
    }
  };
  xhttp.open("GET","join.php?id="+id,true);
  xhttp.send();
}