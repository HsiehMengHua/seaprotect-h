<?php

session_start();
include("../connectDB.php");
$sql = 'SELECT * FROM `member` WHERE `id` = '.$_SESSION['member_id'];
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$member_id = $row['id'];
$userName = $row['name'];
$phone = $row['phone'];

$sql = 'SELECT `url` FROM `profile_photo` WHERE `member_id` = '.$_SESSION['member_id'];

if($result = $conn->query($sql)){
  $row = $result->fetch_assoc();
  if($row > 0){
    $photo_url = $row['url'];
  }else{
    $photo_url = '../../img/profile-photo.png';
  }
}

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

  <div class="profile-banner">
    <div class="profile-wrapper">
      <div class="profile-photo">
        <img src="<?php echo $photo_url; ?>" alt="" />
      </div>
      <div class="profile-welcome">
        <p>嗨，<span class="username"><?php echo $userName; ?></span>!</p>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="pop-up-form upload-photo-form">
      <div class="close-btn"><i class="material-icons">close</i></div>
      <div class="image-wrapper">
        <img src="<?php echo $photo_url; ?>" alt="">
      </div>
      <form action="upload_photo.php" method="post" enctype="multipart/form-data">
        <input type="file" name="imageUpload" id="file">
        <label for="file"><i class="material-icons">file_upload</i> 更新個人照片</label>
        <div class="form-item">
          <button type="button" class="cancel">取消</button>
          <button type="submit" class="submit">送出</button>
        </div>
      </form>
    </div>
    
    <div class="grid clear">
      <div class="grid-item update-account">
        <div class="content-wrapper">
          <div class="icon-wrapper"><i class="material-icons">face</i></div>
          <h3>修改會員資料</h3>
        </div>
        <div class="pop-up-form update-account-form">
          <div class="close-btn"><i class="material-icons">close</i></div>
          <form action="updateProfile.php" method="post">
            <div class="form-item">
              <label>使用者名稱<input type="text" name="userName" value="<?php echo $userName; ?>"></label>
            </div>  
            <div class="form-item">
              <label>聯絡電話<input type="text" name="phone" value="<?php echo $phone; ?>"></label>
            </div>
            <span class="open-change-password"><i class="material-icons">keyboard_arrow_down</i>修改密碼</span>
            <section class="change-password">
              <div class="form-item orig-password">
                <label>輸入原密碼<span id="origPassErr" class="err"></span>
                  <input id="orig-password-input" type="password" data-status="0">
                </label>
              </div>
              <div class="form-item">
                <label>新密碼<input type="password" id="password"></label>
              </div>
              <div class="form-item">
                <label>確認新密碼<span id="passErr" class="err"></span>
                  <input type="password" name="password" id="confirmPassword" data-status="0">
                </label>
              </div>
            </section>
            <div class="form-item clear">
              <button type="submit" class="submit">送出</button>
              <button type="button" class="cancel">取消</button>
            </div>
          </form>
        </div>
      </div>
      
      <div class="grid-item not-open">
        <div class="content-wrapper">
          <div class="icon-wrapper"><i class="material-icons">event</i></div>
          <h3>我的活動</h3>
        </div>
      </div>
      <div class="grid-item not-open">
        <div class="content-wrapper">
          <div class="icon-wrapper"><i class="material-icons">book</i></div>
          <h3>我的文章</h3>
        </div>
      </div>
      <div class="grid-item not-open">
        <div class="content-wrapper">
          <div class="icon-wrapper"><i class="material-icons">list</i></div>
          <h3>口袋清單</h3>
        </div>
      </div>
      <div class="grid-item not-open">
        <div class="content-wrapper">
          <div class="icon-wrapper"><i class="material-icons">email</i></div>
          <h3>重發驗證信</h3>
        </div>
      </div>
      <div class="grid-item not-open">
        <div class="content-wrapper">
          <div class="icon-wrapper"><i class="material-icons">star</i></div>
          <h3>我的積分</h3>
        </div>
      </div>
    </div>
  </div>

  <?php include("../footer.php"); ?>

  <script src="../../js/md5.min.js"></script>
  <script src="../../js/form.js"></script>
  <script src="../../js/myAccount.js"></script>
</body>
</html>
