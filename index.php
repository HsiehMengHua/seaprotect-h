<?php

session_start();
include("pages/connectDB.php");

$isLoggin = isset($_SESSION["member_id"]);
if($isLoggin){
  $text_left = '<a href="pages/member/myAccount.php">我的帳號</a>';
  $text_right = '<a href="pages/member/logout.php">登出</a>';
  $addClass = 'hide';
}else{
  $text_left = '<a href="pages/member/register.php">註冊</a>';
  $text_right = '<a href="pages/member/login.php">登入</a>';;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("pages/head.php"); ?>
  <link rel="stylesheet" href="css/home.css">
</head>

<body>
  <nav>
    <div class="nav-container">
      <div id="nav-left">
        <div><i class="material-icons">menu</i></div>
      </div>
      <div id="nav-right"><?php echo $text_left ?> / <?php echo $text_right ?></div>
    </div>
  </nav>
  
  <div class="menu">
    <div class="close"><i class="material-icons">close</i></div>
    <ul>
      <li><a href="pages/activities/activities.php">瀏覽所有活動</a></li>
      <li><a href="pages/activities/launch.php">我要發起活動</a></li>
      <li><a href="pages/achievement/achievement.php">歷年成果</a></li>
      <li><a href="pages/achievement/post.php">我要分享成果</a></li>
      <li><a href="pages/issue/issue.php">相關議題報導</a></li>
      <li class="<?php echo $addClass; ?>"><a href="pages/member/myAccount.php">會員中心</a></li>
      <li class="<?php echo $addClass; ?>"><a href="pages/member/logout.php">登出</a></li>
    </ul>
  </div>
  
  <a href="#" id="back-to-top" title="Back to top">&uarr;</a>
  <div class="background"></div>

  <div class="story-1">
    <img src="img/hompage_1.jpg" alt="" class="bg-image">
    <img src="img/homepage_copy.png" alt="" class="copy">
  </div>

  <div class="story-2">
    <div id="doYouKnow">
      <p>你知道嗎</p>
    </div>
    <div>
      <p>每一分鐘，就有一輛垃圾車的塑膠被倒到海裡。</p>

      <p>目前海洋中的塑膠垃圾估計重1億5000萬公噸，</p>
      <p>約為魚類的五分之一。</p>
      <p>報告說，每年有八百萬公噸塑膠進入海洋，</p>
      <p>等於每分鐘倒一垃圾車的塑膠到海裡。</p>
      <p>到了2030年，排入海洋的塑膠量，</p>
      <p>相當於每分鐘倒入兩車量。</p>
      <p>到了2050年，可能增至每分鐘四輛車。</p>
      <p>因此，2050年海洋中的垃圾重量將多過魚類。</p>
      <p>報告說，這項估計還算保守，</p>
      <p>因為研究人員假設魚的數量保持穩定。</p>
    </div>
  </div>

  <div class="story-3">
    <div>
      <p>近三分之一塑膠包裝材料沒有進入回收系統，而是流入大海或散落在環境中。</p>
    </div>
  </div>

  <div class="story-4">
    <div>
      <p>失去家園的魚兒們不是苟且偷生</p>
    </div>
  </div>

  <div class="story-5">
    <div><img src="./img/home_image04.jpg" /></div>
    <div><img src="./img/home_image06.png" /></div>
  </div>

  <div class="story-6">
    <div>
      <p>就是適應不了環境破壞而喪命</p>
    </div>
  </div>

  <div class="story-7">
    <div>
      <p>還給他們一個乾淨的海洋</p>
    </div>
    <div id="letsGo">
      <p>現在就開始行動！</p>
    </div>
  </div>

  <footer>
    <ul>
      <li><a href="pages/activities/activities.php">瀏覽活動</a></li>
      <li><a href="pages/activities/launch.php">發起活動</a></li>
      <li><a href="pages/achievement/achievement.php">歷年成果</a></li>
      <li><a href="pages/issue/issue.php">相關議題報導</a></li>
    </ul>
    <p>Copyright &copy; 2016</p>
  </footer>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="js/menu.js"></script>
  <script src="js/sitemapGenerator.js"></script>
  <script src="js/gotoTop.js"></script>
</body>
</html>
