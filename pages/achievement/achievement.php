<?php 
  session_start();
  include("../connectDB.php");
?>

<!DOCTYPE html>
<html lang="zh">
<head>
  <?php include("../head.php"); ?>
  <link rel="stylesheet" href="../../css/achievement.css">
</head>
<body>
  <?php
  include("../nav.php");
  include("../menu.php");
  ?>

  <div class="container">
    <h1 id="issue-title">成就達成</h1>
    <div id="green-bar"></div>
    <main>
      <?php
      
      $year = date('Y');
      $month = date('m');
      $sql = "SELECT * FROM `achievement` WHERE MONTH(act_date) = $month AND YEAR(act_date) = $year";
      
      for($i = 0; $i < 6; $i++){
        if($result = $conn->query($sql)){
          echo '
          <section id="'.$year.'-'.$month.'">
            <div class="year-month">'.$year.'年'.$month.'月</div>
            <div class="grid">';
              
              $sql_events = "SELECT `location`,`act_date` FROM `achievement` 
                             WHERE MONTH(act_date) = $month
                             AND YEAR(act_date) = $year";
              if($result_events = $conn->query($sql_events)){
                while($row_events = $result_events->fetch_assoc()){
                  echo '
                  <div class="content_box grid-item">
                    <div class="content_boxWhite">
                      <div class="text">'.$row_events['location'].'
                        <div class="text2">'.$row_events['act_date'].'</div>
                      </div>
                    </div>
                  </div>';
                }
              }
              
          echo '
            </div>
          </section>';
          if($month > 1){
            $month--;
          }else{
            $month = 12;
            $year--;
          }
        }
      }
      
      ?>
    </main>
  </div>
  
  <?php include("../footer.php"); ?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="../../js/menu.js"></script>
  <script src="js/jquery-2.2.1.min.js"></script>
  <script src="js/masonry.pkgd.min.js"></script>
  <script src="js/script.js"></script>
  <script>
    var n = 1;
    $(window).scroll(function() {
      if($(window).scrollTop() + $(window).height() >= $(document).height()) {
        loadPage();
      }
    });

    function loadPage(){
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if(xhttp.readyState == 4 && xhttp.status == 200) {
          if(xhttp.responseText == '<i class="end">end</i>')
            $(".end").html(xhttp.responseText);
          else
            $(".issues>ul").append(xhttp.responseText);
          $(".loading").css("display","none");
        }else{
          $(".loading").css("display","block");
        }
      };
      console.log(n);
      xhttp.open("GET","load.php?o="+n,true);
      xhttp.send();
      n++;
    }
  </script>
  <script src="../../js/gotoTop.js"></script>
</body>
</html>
