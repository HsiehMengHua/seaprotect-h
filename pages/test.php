<?php

include("connectDB.php");

$sql = "INSERT INTO `issue` (`id`, `title`, `release_datetime`, `source`, `views`, `content`) VALUES (NULL, 'testTitle', '2017-09-06 00:00:00', 'here', '0', 'ouoihreqllkr')";
if($result = $conn->query($sql)){
  echo "O";
}else{
  echo "X";
}

?>