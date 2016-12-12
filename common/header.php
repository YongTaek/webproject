<header role = "banner" class="banner-color">
  <nav role="navigation">
    <div id="logo" class="pull-left">
      <a href="/index.php">
        <img class="logo" src="/public/img/selab_logo_S.png"/>
      </a>
    </div>
    <ul id="menu" class="inline-list pull-left">
      <li class="pull-left"><a href="/board/notice/list.php" class="menu-item" >NOTICE</a></li>
      <li class="pull-left"><a href="/board/question/list.php" class="menu-item">QUESTION</a></li>
      <li class="pull-left"><a href="/board/free/list.php" class="menu-item">BOARD</a></li>
      <li class="pull-left"><a href="/lecture/list.php" class="menu-item">LECTURE</a></li>
    </ul>

    <div role="login" class="pull-right">
      <?php var_dump($count); ?>
        <div class="pull-right circle side-bar">
          <span id="notification" class="notification-num"><?=$count?></span>
        </div>
      
      <img id="bell" class="pull-right side-bar" src="/public/img/bell.png"></img>

      <?php if ($logged_in) { ?>

        <a id="login" href="/api/user/logout.php" class='pull-right'>LOGOUT</a>
        <div class="pull-right vr"></div>
      <?php
        if ($_SESSION["auth"] == "professor" || $_SESSION["auth"] == "assistant") {
          $href = "/user/setting.php";
        } else {
          $href = "/user/change-password.php";
        }
      ?>
        <a id="mypage" href="<?= $href ?>" class='pull-right'><?= $_SESSION["name"] ?> (<?= $_SESSION["auth"] ?>)</a>
      <?php } else { ?>

        <a id="login" href="/user/login.php" class='pull-right'>LOGIN</a>
      <?php } ?>

    </div>

    <button class="pull-right">
      <img src="/public/img/search.png" class="search-icon">
    </button>
    <form method="post" id = "search-content" action="/common/search.php">
    <?php if (isset($keyword)){ ?>
      <input type="text" class="pull-right search" name="search" value="<?= $keyword ?>">
    <?php }else{ ?>
      <input type="text" class="pull-right search" name="search">
      <?php } ?>
    
    </form>

  </nav>
  <div>
    <?php include("sidebar.php"); ?>
  </div>
  <div class = "jumbotron banner-color">
    <h1 class="align-center">Home</h1>
    <p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
  </div>
</header>
