<?php

session_start();
include("../connectDB.php");

$sql = "SELECT * FROM `issue` WHERE `id` = ".$_GET['id'];
$row = $conn->query($sql)->fetch_assoc();

$issue_id = $row['id'];
$title = $row['title'];
$datetime = $row['release_datetime'];
$source = $row['source'];
$views = $row['views'];
$content = $row['content'];

// 找出內文中的第一個圖片
preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $content, $matches);
$first_image = (isset($matches[1]))?$matches[1]:"../../img/transparent.png";

// 計算文章瀏覽次數
$sql_currentViews = "SELECT `views` FROM `issue` WHERE `id` = $issue_id";
$row_views = $conn->query($sql_currentViews)->fetch_assoc();
$count = $row_views["views"]+1;
$sql_countViews = "UPDATE `issue` SET `views` = '$count' WHERE `id` = $issue_id";
$conn->query($sql_countViews);

// 選60天內瀏覽次數最高的前7個報導，sidebar用
$sql_popular = "SELECT `id`,`title` FROM `issue` WHERE `release_datetime` BETWEEN DATE_SUB(release_datetime,INTERVAL 60 DAY) AND NOW() ORDER BY `views` DESC LIMIT 7";
$result_popular = $conn->query($sql_popular);
//$popularIdList = [];
//$popularTitleList = [];
$popularIdList = array();
$popularTitleList = array();
// 把多項結果存成陣列
while($row_popular = $result_popular->fetch_assoc()){
  array_push($popularIdList,$row_popular['id']);
  array_push($popularTitleList,$row_popular['title']);
}

// 取得上一篇
$sql_prev = 'SELECT id,title,source,content FROM `issue` WHERE `id` <'.$_GET['id'].' ORDER BY `id` DESC LIMIT 1';
$result_prev = $conn->query($sql_prev);
if($result_prev->num_rows){
  $row_prev = $result_prev->fetch_assoc();
  $prev_id = $row_prev['id'];
  $prev_title = $row_prev['title'];
  $prev_source = $row_prev['source'];
  $prev_content = $row_prev['content'];
  preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $prev_content, $prev_matches);
  $prev_image = (isset($prev_matches[1]))?$prev_matches[1]:"";
}

// 取得下一篇
$sql_next = 'SELECT id,title,source,content FROM `issue` WHERE `id` >'.$_GET['id'].' ORDER BY `id` ASC LIMIT 1';
$result_next = $conn->query($sql_next);
if($result_next->num_rows){
  $row_next = $result_next->fetch_assoc();
  $next_id = $row_next['id'];
  $next_title = $row_next['title'];
  $next_source = $row_next['source'];
  $next_content = $row_next['content'];
  preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $next_content, $next_matches);
  $next_image = (isset($next_matches[1]))?$next_matches[1]:"";
}

?>


<!DOCTYPE html>
<html lang="zh">
<head>
  <title><?php echo $title; ?></title>
  <?php include("../head.php"); ?>
  <link rel="stylesheet" href="../../css/article.css" />
</head>

<body>
  <?php
  include("../nav.php");
  include("../menu.php");
  ?>

  <main>
    <div class="container">
      <div class="clear">
        <div class="main-content">

          <div class="heading">
            <h1><?php echo $title; ?></h1>
            <div class="article-info clear">
              <p><i class="material-icons">schedule</i>  <?php echo $datetime; ?>，<?php echo $source; ?></p>
              <p class="pull-right">這裡放分享連結</p>
            </div>
          </div>

          <img src="<?php echo $first_image; ?>" alt="<?php echo $title; ?>">

          <article>
            <?php echo $content; ?>
          </article>

          <div class="other-container">
            <div class="prev-news <?php echo ($result_prev->num_rows)?"":"hide"; ?>">
              <a href="<?php echo "article.php?id=$prev_id"; ?>"><p>上一篇報導</p></a>
              <a href="<?php echo "article.php?id=$prev_id"; ?>">
                <div class="image" style="background-image: url(<?php echo $prev_image; ?>)"></div>
              </a>
              <a href="<?php echo "article.php?id=$prev_id"; ?>">
                <h4><?php echo $prev_title; ?></h4>
              </a>
              <p><?php echo $prev_source; ?></p>
            </div>
            <div class="next-news pull-right <?php echo ($result_next->num_rows)?"":"hide"; ?>">
              <a href="<?php echo "article.php?id=$next_id"; ?>"><p>下一篇報導</p></a>
              <a href="<?php echo "article.php?id=$next_id"; ?>">
                <div class="image" style="background-image: url(<?php echo $next_image; ?>)"></div>
              </a>
              <a href="<?php echo "article.php?id=$next_id"; ?>">
                <h4><?php echo $next_title; ?></h4>
              </a>
              <p><?php echo $next_source; ?></p>
            </div>
          </div>
        </div>
        <div class="sidebar pull-right">
          <h4>大家在關注的報導</h4>
          <ul>
            <?php
            for($i=0; $i<sizeof($popularIdList); $i++){
              echo '<li><a href="article.php?id='.$popularIdList[$i].'">'.$popularTitleList[$i].'</a></li>';
            }
            ?>
          </ul>
        </div>
      </div>
    </div>
  </main>
  
  <?php include("../footer.php"); ?>
  
  <script>
      var animaion = setInterval(update, 5);
      function update(){
        var y = document.querySelector("body").scrollTop-120;
        if(y>0){
          document.querySelector(".sidebar").style.top = y.toString()+"px";
        }
      }
  </script>
</body>
</html>
