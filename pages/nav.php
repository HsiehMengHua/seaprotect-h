<?php

$isLoggin = isset($_SESSION["member_id"]);
if($isLoggin){
  $text_left = '<a href="../member/myAccount.php">我的帳號</a>';
  $text_right = '<a href="../member/logout.php">登出</a>';
}else{
  $text_left = '<a href="../member/register.php">註冊</a>';
  $text_right = '<a href="../member/login.php">登入</a>';;
}

?>

<nav>
  <div class="nav-container">
    <div id="nav-left">
      <div><i class="material-icons">menu</i></div>
    </div>
    <div id="nav-right"><?php echo $text_left ?> / <?php echo $text_right ?></div>
  </div>
</nav>