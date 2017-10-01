<?php
session_start();
include("../connectDB.php");

$sql = 'SELECT `password` FROM `member` WHERE `id` = '.$_SESSION['member_id'];
$result = $conn->query($sql);
$row = $result->fetch_assoc();

echo $row['password'];

?>