<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Lecture</title>
  <link rel="stylesheet" href="/public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="/public/css/setting.css" type="text/css">
  <link rel="stylesheet" href="/public/css/base.css" type="text/css">
  <script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="//js.pusher.com/3.2/pusher.min.js"></script>
  <script src="/public/js/push.js"></script>
  <script src="/public/js/lec-open-close.js"></script>
</head>
<body>
  <header role = "banner" class="banner-color">
    <nav role="navigation">
      <div id="logo" class="pull-left"><a href="/php/main.php"><img class="logo" src="/public/img/selab_logo_S.png"/></a></div>
      <ul id="menu" class="inline-list pull-left">
        <li class="pull-left"><a href="/php/noticelist.php" class="menu-item" >NOTICE</a></li>
        <li class="pull-left"><a href="/php/questionlist.php" class="menu-item">QUESTION</a></li>
        <li class="pull-left"><a href="/php/freelist.php" class="menu-item">FREE BOARD</a></li>
        <li class="pull-left"><a href="/php/lecture-list.php" class="menu-item">LECTURE</a></li>
      </ul>
      <div role="login" class="pull-right">
        <?php if (isset($_SESSION["id"]) && isset($_SESSION["name"]) && isset($_SESSION["auth"])) { ?>
        <a id="login" href="logout.php" class='pull-right'>LOGOUT</a>
        <div class="pull-right vr"></div>
        <a id="mypage" href="#" class='pull-right'><?= $_SESSION["name"] ?> (<?= $_SESSION["auth"] ?>)</a>
        <ul class="hidden" id="setting">
          <li><a href="user-setting.php">Setting</a></li>
        </ul>
        <?php } else { ?>
        <a id="login" href="dologin.php" class='pull-right'>LOGIN</a>
        <?php } ?>
      </div>
      <img src="/public/img/search.png" class="pull-right search-icon">
      <input type="text" class="pull-right search" name="search">
    </nav>
    <div class = "jumbotron banner-color">
      <h1 class="align-center">Setting</h1>
      <p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
    </div>
  </header>
  <div class="container">
    <div class = "top-text">
      <h3 class="setting-text">Lecture List</h3>
      <a id="link" href="/view/lecture-upload.php">강의 파일 업로드</a>
    </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Index</th>
          <th>Chapter Name</th>
          <th>Open</th>
          <th>Change</th>
        </tr> 
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Javascript</td>
          <td><a href="#" class="lecture-open">Open</a></td>
          <td><a href="#" class="lecture-change">Change</a></td>
        </tr>
        <tr>
          <td>1</td>
          <td>Javascript</td>
          <td><a href="#" class="lecture-open">Open</a></td>
          <td><a href="#" class="lecture-change">Change</a></td>
        </tr>
        <tr>
          <td>1</td>
          <td>Javascript</td>
          <td><a href="#" class="lecture-open">Open</a></td>
          <td><a href="#" class="lecture-change">Change</a></td>
        </tr>
      </tbody>
    </table>
    <div id = "setting-student">
      <div class = "top-text">
        <h3 class="setting-text">Setting Student</h3>
        <a id="add-student" href="#">파일로 학생 추가</a>
      </div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Index</th>
            <th>SID</th>
            <th>Name</th>
            <th>Remove</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>2014038111</td>
            <td>천유정</td>
            <td><a href="#" class="remove-student">remove</a></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div id="setting-assistant">
      <div class = "top-text">
        <h3 class="setting-text">Setting Assistant</h3>
        <a id="add-assistant" href="">조교 추가</a>
      </div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Index</th>
            <th>SID</th>
            <th>Name</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>2014038111</td>
            <td>천유정</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="top-text">
      <h3 class="setting-text">Change Password</h3>
      <a id="change-password" href="/php/changepw.php">비밀번호 변경</a>
    </div>
  </div>
</body>
</html>