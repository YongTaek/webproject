<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../public/css/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="../public/css/base.css" type="text/css">
  <script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
  <link rel="stylesheet" type="text/css" href="../public/css/wmd.css" />
  <link rel="stylesheet" type="text/css" href="../public/css/create-post.css" />  
  <link rel="stylesheet" type="text/css" href="../public/css/create-vote.css" />

  <script type="text/javascript" src="../public/js/showdown.js"></script>
  <link rel="stylesheet" href="../public/css/pusher.css" type="text/css">
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="//js.pusher.com/3.2/pusher.min.js"></script>
  <script src="/public/js/create-vote-item.js" type="text/javascript" charset="utf-8" async defer></script>

  <script src="../public/js/push.js"></script>
  <title>글쓰기</title>
</head>
<body>
  <header role = "banner" class="banner-color">
    <nav role="navigation" >
     <div id="logo" class="pull-left"><a href="/view/main.php"><img class="logo" src="../public/img/selab_logo_S.png" /></a></div>
     <ul id="menu" class="inline-list pull-left">
      <li class="pull-left"><a href="/view/noticelist.php" class="menu-item active" >NOTICE</a></li>
      <li class="pull-left"><a href="/view/questionlist.php" class="menu-item">QUESTION</a></li>
      <li class="pull-left"><a href="/view/freelist.php" class="menu-item">FREE BOARD</a></li>
    </ul>
    <div role="login" class="pull-right">
      <a id="login" href="/view/login.php" class='pull-right'>LOGIN</a>
      <div class="pull-right vr"></div>
      <a id="mypage" href="/view/myPage.php" class='pull-right'>천유정 (학생)</a>
    </div>
    <img src="/public/img/search.png" class="pull-right search-icon">
    <input type="text" class="pull-right search" name="search">
  </nav>
  <div class = "jumbotron banner-color">
   <h1 class="align-center">Create Notice</h1>
   <p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
 </div>
</header>
<div class="container">
  <div class="write-answer">
    <form action="notice.php">
      <h2>Title</h2>
      <div class="title">
        <input name="title" type="text">
      </div>
      <h2>Content</h2>
      <div class="content" id="wmd-editor">
        <div id="wmd-button-bar"></div>
        <textarea id="wmd-input"></textarea>
      </div>
      <hr>
      <div id="wmd-preview" class="wmd-preview"></div>
      <hr>
      <h2 class="voteBtn">Register Vote</h2><img src="/public/img/vote-box.png" alt="vote" class= "voteBtn" id = "voteBtn"/>
      <div id = "vote">
        <h3>Vote Subject</h3>
        <div class="subject">
          <input name="subject" type="text">
        </div>
        <h3>Period</h3>
        <div>
          <input type="datetime-local" name="startDate" value="">
          <input type="datetime-local" name="endDate" value="">
        </div>
        <h3>Number of Selection</h3>
        <select name="select_num">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
        <h3>Items   <img class="plusBtn" src="/public/img/plus_icon.png" id="plus"/>
          <img class="minusBtn" src="/public/img/minus_icon.png" id="minus"/></h3>
          <ul>
            <li class = "voteitem"><input type="text" name="item" value=""></li>
          </ul>
        </div>
        <div class='buttons'>
          <input class='btn btn-primary' type='submit' value="submit">
          <button class='btn btn-primary'>cancel</button>
        </div>
      </form>
    </div>
  </div>
  <script type="text/javascript" src="../public/js/wmd.js"></script>
</body>
</html>
