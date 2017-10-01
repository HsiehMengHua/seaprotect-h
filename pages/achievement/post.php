<?php

session_start();
if(!isset($_SESSION["member_id"]))
  echo '<script>alert("登入先唷");window.location.href="../member/login.php";</script>';

?>

<!DOCTYPE html>
<html lang="zh">
<head>
  <?php include("../head.php"); ?>
  <link rel="stylesheet" href="../../css/bootstrap-material-datetimepicker.css" />
  <link rel="stylesheet" href="../../css/formPage.css" />
  <script src="//cdn.ckeditor.com/4.5.9/standard/ckeditor.js"></script><!-- See → http://cdn.ckeditor.com/ -->
</head>
<body>
  <?php
  include("../nav.php");
  include("../menu.php");
  ?>

  <main class="clear">
    <div class="main-image" style="background-image: url(../../img/form_page_image_<?php echo mt_rand(1,4); ?>.jpg)"></div>
    <div class="form pull-right">
      <form action="posting.php" method="post">
        <ul>
          <li class="form-item"><label>哪個海灘？<input type="text" name="location"></label></li>
          <li class="form-item"><label>哪一天？<input type="text" name="date" id="date"></label></li>
          <li class="form-item editor"><br><textarea name="editor"></textarea><script>CKEDITOR.replace( 'editor' );</script></li>
          <li class="form-item clear">
            <button type="submit" class="submit">送出</button>
            <button onclick="history.back();" class="cancel">取消</button>
          </li>
        </ul>
      </form>
    </div>
  </main>

  <script src="http://momentjs.com/downloads/moment-with-locales.min.js"></script> <!-- 有 .min.js 在local資料夾 -->
  <script src="../../js/bootstrap-material-datetimepicker.js"></script>
  <script>
	  $(function() {
        $('#date').bootstrapMaterialDatePicker({ weekStart: 0, time: false, maxDate: new Date() });
        $('#time').bootstrapMaterialDatePicker({ date: false, format: 'HH:mm', switchOnClick: true });
	  });
  </script>
  <script>
    $(function() {
      $('form input').on("focus",function(){
        $(this).parent().css("color","#55bbb5");
        $(this).css("borderBottomColor","#55bbb5");
      });
      $('form input').on("blur",function(){
        $(this).parent().css("color","#313b4f");
        $(this).css("borderBottomColor","#313b4f");
      });
    });
  </script>
</body>
</html>
