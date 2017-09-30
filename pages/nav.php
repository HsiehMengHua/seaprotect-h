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
    <div class="nav-left">
      <div class="menu-icon"><i class="material-icons">menu</i></div>
      <div class="logo"><a href="../../index.php"><img src="../../img/logo.png" alt=""></a></div>
    </div>
    <div class="nav-right"><?php echo $text_left ?> / <?php echo $text_right ?></div>
  </div>
</nav>