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
    <h1 id="issue-title">歷年成果</h1>
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
            <div class="grid clear">';
              
              $sql_events = "SELECT `id`, `location`,`act_date` FROM `achievement` 
                             WHERE MONTH(act_date) = $month
                             AND YEAR(act_date) = $year";
              if($result_events = $conn->query($sql_events)){
                while($row_events = $result_events->fetch_assoc()){                  
                  echo '
                  <div class="grid-item" onclick="goToArticle('.$row_events['id'].')">
                    <div class="ach-image">
                      <img src="" alt="" />
                    </div>
                    <div class="ach-info">
                      <h3 class="ach-location">'.$row_events['location'].'</h3>
                      <p class="ach-date">'.$row_events['act_date'].'</p>
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
  <script src="js/script.js"></script>
  <script src="../../js/gotoTop.js"></script>
  <script>
  function goToArticle(id){
    window.location.href = "article.php?id=" + id;
  }
  </script>
</body>
</html>
