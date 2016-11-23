<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Lecture</title>
    <link rel="stylesheet" href="/public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  	<link rel="stylesheet" href="/public/css/lecture-manage.css" type="text/css">
  	<link rel="stylesheet" href="/public/css/base.css" type="text/css">
  	<script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
  </head>
  <body>
    <header role = "banner" class="banner-color">
      <nav role="navigation">
        <div id="logo" class="pull-left"><a href="/view/main.php"><img class="logo" src="/public/img/selab_logo_S.png"/></a></div>
        <ul id="menu" class="inline-list pull-left">
          <li class="pull-left"><a href="/view/noticelist.php" class="menu-item" >NOTICE</a></li>
          <li class="pull-left"><a href="/view/questionlist.php" class="menu-item">QUESTION</a></li>
          <li class="pull-left"><a href="/view/freelist.php" class="menu-item">FREE BOARD</a></li>
        </ul>
        <div role="login" class="pull-right">
          <a id="login" href="login.php" class='pull-right'>LOGIN</a>
          <div class="pull-right vr"></div>
          <a id="mypage" href="#" class='pull-right'>천유정 (학생)</a>
          <div id="setting">
            <ul class="hidden">
              <li>
                <a href="user-setting.php">Setting</a>
              </li>
            </ul>
          </div>
        </div>
        <img src="/public/img/search.png" class="pull-right search-icon">
        <input type="text" class="pull-right search" name="search">
      </nav>
      <div class = "jumbotron banner-color">
        <h1 class="align-center">Lecture</h1>
        <p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
      </div>
    </header>
    <div class="createBtn">
      <a type="button" class="btn btn-primary" href="/questions/create">Create Lecture</a>
    </div>
    <div class="container">
      <ul id="list">
        <li class= "list-item">
          <!-- $id is contents id of notice -->
        <!--title is the content title -->
          <p class="list-wrapper">
            <span class="index">1</span>
            <a class="title" href="/view/lecture-create.php/?id=<?= $id ?>"><span>title</span></a>
          <!-- date is when the content writes -->
            <!-- <span class="date">count</span> -->
            <a class="button" href="#" name="button"><span>open</span></a>
          </p>
        </li>
      </ul>
    </div>

  </body>
</html>
