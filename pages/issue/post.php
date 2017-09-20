
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
      <form action="posting.php" method="post" enctype="multipart/form-data">
        <ul>
          <li><label>報導標題</label><br><input type="text" name="title"></li>
          <li><label>報導來源</label><br><input type="text" name="source"></li>
          <!--<li><label>上傳一張主圖</label><input type="file" name="imageUpload"></li>-->
          <li class="editor"><br><textarea name="editor"></textarea><script>CKEDITOR.replace( 'editor' );</script></li>
          <li class="clear">
            <button type="submit" class="submit">送出</button>
            <button onclick="history.back();" class="cancel">取消</button>
          </li>
        </ul>
      </form>
    </div>
  </main>

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
