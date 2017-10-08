<?php

session_start();
include("../connectDB.php");

$sql = "SELECT `location`, `date`, `time` FROM `activity` ORDER BY `date` DESC LIMIT 4 OFFSET 0";
$result = $conn->query($sql);
$x = 0;

?>

<!DOCTYPE html>
<html lang="zh">
<head>
  <?php include("../head.php"); ?>
  <link rel="stylesheet" href="../../css/activities.css" />
</head>
<body>
 
  <?php
  include("../gotoTop.php");
  include("../nav.php");
  include("../menu.php");
  ?>
  
  <main>
    <div class="jumbotron"><h1>「用行動改變世界，為海洋保護盡一份心。」</h1></div>
    <h1>下一場活動，<br>我來號召！</h1>
    <section>
      

      <div class="timeline">
        <div class="line"></div>
        <div class="middle">
          <div class="launch-btn-wrapper animated infinite pulse">
            <div class="launch-btn-outer">
              <a href="launch.php">
              <div class="launch-btn-inner">
                <i class="material-icons">add</i>
              </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include("../footer.php"); ?>
  
  <script src="../../js/activities.js"></script>
  
</body>
</html>
