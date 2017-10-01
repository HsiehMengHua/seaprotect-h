<?php

session_start();
include("../connectDB.php");

if(isset($_SESSION["member_id"]) && $_SESSION["member_id"] != 1){
    echo '<script>
    if (window.confirm("你已經登入，要登出再註冊新帳號嗎？")){
      window.location.href="../member/logout.php";
    }else{
      history.back();
    }
    </script>';
}

$err = "";
$email = (isset($_POST["email"]))?input($_POST["email"]):"";
$password = (isset($_POST["password"]))?md5(input($_POST["password"])):"";

$sql = "SELECT id,email,password FROM `member` WHERE `email` = '$email' AND `password` = '$password'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$id = $row["id"];

// 帳密match
// num_rows return the number of rows in result set
if($result->num_rows){
  $_SESSION["member_id"] = $id;
  echo "Log in successfully"."<br>";
  // Redirect to homepage
  $host  = $_SERVER['HTTP_HOST'];
  $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $extra = '../../index.php';
  header("Location: http://$host$uri/$extra");
  exit();
}else{ // 登入失敗
  $err = (empty($email) && empty($password))?"":"Email或密碼輸入錯誤";
}

function input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

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
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <ul>
          <li class="form-item">
            <label>Email
              <input type="email" name="email" value="<?php echo (isset($_POST["email"]))?$_POST["email"]:""; ?>">
            </label>
          </li>
          <li class="form-item"><label>密碼<input type="password" name="password"></label></li>
          <li class="form-item clear">
            <button type="submit" class="submit">送出</button>
            <button onclick="history.back();" class="cancel">取消</button>
            <span id="err"><?php echo $err."　"; ?></span>
          </li>
        </ul>
      </form>
    </div>
  </main>
  
  <script src="../../js/form.js"></script>
</body>
</html>
