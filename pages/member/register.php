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
$userName = (isset($_POST["userName"]))?input($_POST["userName"]):"";
$phone = (isset($_POST["phone"]))?input($_POST["phone"]):"";
date_default_timezone_set("Asia/Taipei");
$datetime = date("Y-m-d H:i:s");
$act_code = md5($email.$password.$datetime);

if(empty($email) || empty($password) || empty($userName) || empty($phone)){
  $err = (empty($email) && empty($password) && empty($userName) && empty($phone))?"":"輸入資料不完整";
}else{
  $sql = "SELECT * FROM `member` WHERE `email` = '$email'";
  $result = $conn->query($sql);

  if($result->num_rows){
    $err = "Email已被註冊過";
  }else{
    $sql_insert = "INSERT INTO `member` (`id`, `email`, `password`, `name`, `phone`, `register_datetime`, `activated`, `activate_code`) VALUES (NULL, '$email', '$password', '$userName', '$phone', '$datetime', '0', '$act_code')";
    if($conn->query($sql_insert)){

      //id寫入SESSION
      $sql_retrieveId = "SELECT `id` FROM `member` WHERE `email` = '$email'";
      $row = $conn->query($sql_retrieveId)->fetch_assoc();
      $id = $row["id"];
      $_SESSION["member_id"] = $id;

      $header = "Content-type:text/html;charset=UTF-8";
      $header .= "\nFrom: mailnotice3@gmail.com";
      $host  = $_SERVER['HTTP_HOST'];
      $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
      $extra = "activate.php?code=$act_code";
      $act_link = "http://$host$uri/$extra";
      $text = '
      <p>你已註冊成為會員，請點擊以下連結驗證你的電子信箱：</p>
      <a href="'.$act_link.'">'.$act_link.'</a>';

      if(mail($email,"會員帳號啟用信",$text,$header)){
        header("Location: act_sent.php");
      }else{
        echo "Somthing wrong. Email was not sent.";
      }
    }else{
      $err = "Error: ".$conn->error;
    }
  }
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
            <label>Email<span id="emailErr"></span>
              <input type="email" name="email" id="email" value="<?php echo $email; ?>" onkeyup="checkEmail(this.value)">
            </label>
          </li>
          <li class="form-item">
            <label>密碼<input type="password" name="password" id="password"></label>
          </li>
          <li class="form-item">
            <label>確認密碼<span id="passErr"></span>
              <input type="password" id="confirmPassword">
            </label>
          </li>
          <li class="form-item">
            <label>姓名<input type="text" name="userName" value="<?php echo $userName; ?>"></label>
          </li>
          <li class="form-item">
            <label>聯絡電話<input type="text" name="phone" value="<?php echo $phone; ?>"></label>
          </li>
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
  <script>
    function checkEmail(str){
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if(xhttp.readyState == 4 && xhttp.status == 200) {
          console.log(xhttp.responseText);

          if(xhttp.responseText == "false"){
            $("#email").css("borderBottomColor","#75da7a");
            $("#email").parent().css("color","#75da7a");
            $("#emailErr").html("");
          }else{
            $("#email").css("borderBottomColor","#e53a3a");
            $("#email").parent().css("color","#e53a3a");
            $("#emailErr").html("　你已註冊過");
          }
        }
      };
      xhttp.open("GET","checkEmail.php?email="+str,true);
      xhttp.send();
    }
  </script>
</body>
</html>
