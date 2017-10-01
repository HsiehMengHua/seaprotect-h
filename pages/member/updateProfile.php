<?php

session_start();
include("../connectDB.php");

$memberId = $_SESSION['member_id'];
$userName = $_POST['userName'];
$phone = $_POST['phone'];
$newPassword = $_POST['password'];

if($newPassword == ''){
  $sql = "UPDATE `member` SET 
          `name` = '$userName', 
          `phone` = '$phone' 
          WHERE `member`.`id` = $memberId";
}else{
  $newPassword = md5($newPassword);
  $sql = "UPDATE `member` SET 
          `name` = '$userName', 
          `phone` = '$phone', 
          `password` = '$newPassword' 
          WHERE `member`.`id` = $memberId";
}

if($conn->query($sql)){
  echo '<script> alert("更新成功"); </script>';
}else{
  echo '<script> alert("發生錯誤!"); </script>';
}

echo '<script> window.location.href="myAccount.php"; </script>';

?>