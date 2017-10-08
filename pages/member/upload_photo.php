<?php

session_start();
include("../connectDB.php");
$member_id = $_SESSION['member_id'];

// 上傳主圖
mkdir("../../file_upload/profile_photo/$member_id/");
$target_image_dir = "../../file_upload/profile_photo/$member_id/";

$target_image = $target_image_dir.basename($_FILES["imageUpload"]["name"]);
$image_uploadOk = 1;
$imageFileType = pathinfo($target_image,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["imageUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - ".$check["mime"].".";
    $image_uploadOk = 1;
  } else {
    echo "File is not an image.";
    $image_uploadOk = 0;
  }
}
if (file_exists($target_image)) {
  echo "檔案路徑衝突，改個檔名看看？";
  $image_uploadOk = 0;
}
if ($_FILES["imageUpload"]["size"] > 500000) {
  echo "檔案過大！";
  $image_uploadOk = 0;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
  echo "請上傳 JPG, JPEG, PNG, GIF";
  $image_uploadOk = 0;
}
if ($image_uploadOk == 0) {
  echo "Sorry, your image was not uploaded.";
} else {
  if (move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $target_image)) {
    echo "The file ". basename( $_FILES["imageUpload"]["name"]). " has been uploaded.";

    // 紀錄file name到DB
    $imagePath = "../../file_upload/profile_photo/$member_id/".basename($_FILES["imageUpload"]["name"]);
    $sql = "SELECT * FROM `profile_photo` WHERE `member_id` = $member_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if($row > 0){
      $sql = "UPDATE `profile_photo` SET `url` = '$imagePath' WHERE `member_id` = $member_id";
    }else{
      $sql = "INSERT INTO `profile_photo` 
              (`member_id`, `url`) 
              VALUES ('1', '../../file_upload/profile_photo/1/photo_2.jpg')";
    }
    
    if($conn->query($sql)){
        echo "Successful";
    }else{
        echo "Error: ".$conn->error;
    }
  } else {
      echo "圖片上傳失敗";
  }
}

?>