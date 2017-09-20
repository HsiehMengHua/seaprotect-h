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
  include("../nav.php");
  include("../menu.php");
  ?>
  
  <main>
    <div class="jumbotron"><h1>「用行動改變世界，為海洋保護盡一份心。」</h1></div>
    <h1>下一場活動，<br>我來號召！</h1>
    <section>
      <a href="#" id="back-to-top" title="Back to top">&uarr;</a>

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
          <!--
          <div class="node n1 right clear">
            <div class="dot-wrapper"><div class="dot"></div></div>
            <div class="dialog-box">
              <div class="content">
                <h3>新北貢寮龍門沙灘</h3>
                <p>日期：7/16</p>
                <p>時間：16:30-17:30</p>
              </div>
            </div>
          </div>
          -->
        </div>
      </div>
    </section>
  </main>

  <?php include("../footer.php"); ?>
  
  <script>
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
      //console.log(n);
      xhttp.open("GET","load.php?o="+n,true);
      xhttp.send();
      n++;
    }

    function join(id){
      //alert(id);
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if(xhttp.readyState == 4 && xhttp.status == 200) {
          alert(xhttp.responseText);
        }
      };
      xhttp.open("GET","join.php?id="+id,true);
      xhttp.send();
    }
  </script>
  <script src="../../js/gotoTop.js"></script>
</body>
</html>
