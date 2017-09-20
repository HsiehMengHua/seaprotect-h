<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("../head.php"); ?>
  <link rel="stylesheet" href="../../css/myAccount.css">
</head>

<body>
  <?php
  include("../nav.php");
  include("../menu.php");
  ?>

  <div class="big-pic"></div>

  <div class="container">
    <ul class="block-container">
      <li class="myAccountBlock">
        <div class="block-icon">
          <i class="material-icons">face</i>
          <div class="block-data">
            <label>請輸入舊密碼：
              <input type="text" name="location">
            </label>
            <label>輸入新密碼：
              <input type="text" name="location">
            </label>
            <label>輸入新密碼(第二次)：
              <input type="text" name="location">
            </label>
          </div>
        </div>
        <div class="block-title">
          <button class="send-data" type="button" name="button">確認</button>
          <p>修改會員資料</p>
        </div>
      </li>
      <li class="myAccountBlock">
        <div class="block-icon">
          <i class="material-icons">event</i>
          <div class="block-data">Loading...</div>
        </div>
        <div class="block-title">
          <p>我的活動</p>
        </div>
      </li>
      <li class="myAccountBlock">
        <div class="block-icon">
          <i class="material-icons">book</i>
          <div class="block-data">建置中...</div>
        </div>
        <div class="block-title">
          <p>我的文章</p>
        </div>
      </li>
      <li class="myAccountBlock">
        <div class="block-icon">
          <i class="material-icons">list</i>
          <div class="block-data">建置中...</div>
        </div>
        <div class="block-title">
          <p>口袋清單</p>
        </div>
      </li>
      <li class="myAccountBlock">
        <div class="block-icon">
          <i class="material-icons">email</i>
          <div class="block-data">建置中...</div>
        </div>
        <div class="block-title">
          <p>重發驗證信</p>
        </div>
      </li>
      <li class="myAccountBlock">
        <div class="block-icon">
          <i class="material-icons">star</i>
          <div class="block-data">建置中...</div>
        </div>
        <div class="block-title">
          <p>我的積分</p>
        </div>
      </li>
    </ul>
  </div>

  <?php include("../footer.php"); ?>

  <script src="../../js/jquery-3.0.0.min.js"></script>
  <script src="../../js/myAccount.js"></script>
</body>

</html>
