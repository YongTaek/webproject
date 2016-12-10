<header role = "banner" class="banner-color">
  <nav role="navigation">
    <div id="logo" class="pull-left"><a href="/php/main.php"><img class="logo" src="/public/img/selab_logo_S.png"/></a></div>
    <ul id="menu" class="inline-list pull-left">
      <li class="pull-left"><a href="/php/noticelist.php" class="menu-item" >NOTICE</a></li>
      <li class="pull-left"><a href="/php/questionlist.php" class="menu-item">QUESTION</a></li>
      <li class="pull-left"><a href="/php/freelist.php" class="menu-item">BOARD</a></li>
      <li class="pull-left"><a href="/php/lecture-list.php" class="menu-item">LECTURE</a></li>
    </ul>

    <div role="login" class="pull-right">
      <div class="pull-right circle side-bar">
        <span id="notification" class="notification-num"><?=$count?></span>
      </div>
      <img id="bell" class="pull-right side-bar" src="/public/img/bell.png"></img>

      <?php if ($logged_in) { ?>

        <a id="login" href="logout.php" class='pull-right'>LOGOUT</a>
        <div class="pull-right vr"></div>
      <?php
        if ($_SESSION["auth"] == "professor" || $_SESSION["auth"] == "assistant") {
          $href = "/php/setting.php";
        } else {
          $href = "/php/changepw.php";
        }
      ?>
        <a id="mypage" href="<?= $href ?>" class='pull-right'><?= $_SESSION["name"] ?> (<?= $_SESSION["auth"] ?>)</a>
      <?php } else { ?>

        <a id="login" href="dologin.php" class='pull-right'>LOGIN</a>
      <?php } ?>

    </div>

    <button class="pull-right">
      <img src="/public/img/search.png" class="search-icon">
    </button>
    <form method="post" id = "search-content" action="/php/search-page.php">
    <input type="text" class="pull-right search" name="search">
    </form>

  </nav>
  <div>
    <?php include("./notification-side.php"); ?>
  </div>
  <div class = "jumbotron banner-color">
    <h1 class="align-center">Home</h1>
    <p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
  </div>
</header>
