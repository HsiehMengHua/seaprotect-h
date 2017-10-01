<?php

session_start();
if(!isset($_SESSION["member_id"]))
  echo '<script>alert("登入先唷");window.location.href="../member/login.php";</script>';

?>

<!DOCTYPE html>
<html lang="zh">
<head>
  <?php include("../head.php"); ?>
  <link rel="stylesheet" href="../../css/formPage.css" />
</head>
<body>
  <?php
  include("../nav.php");
  include("../menu.php");
  ?>

  <main class="clear">
    <div class="main-image" style="background-image: url(../../img/form_page_image_<?php echo mt_rand(1,4); ?>.jpg)"></div>
    <div class="form pull-right">
      <form action="launching.php" method="post">
        <ul>
          <li class="form-item"><label>哪個海灘？</label><br><input type="text" name="location"></li>
          <li class="form-item"><label>日期</label><br><input type="text" name="date" id="date"></li>
          <li class="form-item"><label>時間 </label><br><input type="text" name="time" id="time"></li>
          <li class="form-item"><label>要提醒大家什麼？ </label><br><textarea name="description" cols="30" rows="10"></textarea></li>
          <li class="form-item clear">
            <button type="submit" class="submit">送出</button>
            <button onclick="history.back();" class="cancel">取消</button>
          </li>
        </ul>
      </form>
    </div>
  </main>

  <script src="../../js/moment.min.js"></script>
  <script src="../../js/bootstrap-material-datetimepicker.js"></script>
  <script src="../../js/form.js"></script>
  <script>
	  $(function() {
        $('#date').bootstrapMaterialDatePicker({ 
          weekStart: 0, 
          time: false, 
          minDate: new Date() 
        });
        
        $('#time').bootstrapMaterialDatePicker({ 
          date: false, 
          format: 'HH:mm', 
          switchOnClick: true 
        });
	  });
  </script>
</body>
</html>
