<?php

$isLoggin = isset($_SESSION["member_id"]);
if(!$isLoggin){
  $addClass = 'hide';
}

?> 

<div class="menu">
  <div class="close"><i class="material-icons">close</i></div>
  <ul>
    <li><a href="../activities/activities.php">瀏覽所有活動</a></li>
    <li><a href="../activities/launch.php">我要發起活動</a></li>
    <li><a href="../achievement/achievement.php">成就達成</a></li>
    <li><a href="../achievement/post.php">我要分享成果</a></li>
    <li><a href="../issue/issue.php">相關議題報導</a></li>
    <li class="<?php echo $addClass; ?>"><a href="../member/myAccount.php">會員中心</a></li>
    <li class="<?php echo $addClass; ?>"><a href="../member/logout.php">登出</a></li>
  </ul>
</div>