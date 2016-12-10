<?php
  session_start();
  $logged_in = false;
  if (isset($_SESSION["id"]) && isset($_SESSION["name"]) && isset($_SESSION["auth"])) {
    $logged_in = true;
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Lecture</title>
  <link rel="stylesheet" href="/public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="/public/css/setting.css" type="text/css">
  <link rel="stylesheet" href="/public/css/base.css" type="text/css">
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">

  <script type="text/javascript">
    <?php if (isset($_SESSION["id"]) && isset($_SESSION["favQuestion"]) && isset($_SESSION["openLecture"])) { ?>
      var questionArray = <?php echo json_encode($_SESSION["favQuestion"]); ?>;
      var lectureArray = <?php echo json_encode($_SESSION["openLecture"]); ?>;
    <?php } ?>
  </script>
  <script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
  <script src="/public/js/jquery.form.js" type="text/javascript"></script>
  <script src="/public/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="//js.pusher.com/3.2/pusher.min.js"></script>
  <script src="/public/js/push.js"></script>
  <script src="/public/js/lec-open-close.js"></script>
  <script src="/public/js/pusher.js"></script>
  <script src="/public/js/settingDialog.js" type="text/javascript"></script>
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
      <a id="link" href="/php/lecture-upload.php">강의 파일 업로드</a>
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
      <?php
        $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rows = $db->query("SELECT id, name, url, open FROM lecture");
        foreach ($rows as $row) {
        if($row["open"] == 0){
          $status = "Close";
          $class = "lecture-close";
        } 
        else{ 
          $status = "Open";
          $class = "lecture-open";
        }
        ?>
        <tr>
          <td><?= $row["id"] ?></td>
          <td><a href="/php/lecture-page.php?id=<?= $row["id"] ?>"><?= $row["name"] ?></a></td>
          <td><a href="#" class="<?= $class ?>"><?= $status ?></a></td>
          <td><a href="lecture-upload.php?id=<?= $row["id"] ?>" class="lecture-change">Change</a></td>
        </tr>
       <?php } ?>
      </tbody>
    </table>
    <div id = "setting-student">
      <div class = "top-text">
        <h3 class="setting-text">Setting Student</h3>
        <button data-toggle="modal" data-target="#addStudent" id="add-student">파일로 학생 추가</button>
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
        <button data-toggle="modal" data-target="#squarespaceModal" id="add-assistant" href="">조교 추가</button>
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
        <?php
        $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $i = 1;
        $rows = $db->query("SELECT id, name FROM user WHERE $authority = 'assistant'");
        foreach ($rows as $row) { ?>
          <tr>
            <td><?= $i ?></td>
            <td><?= $row["id"] ?></td>
            <td><?= $row["name"] ?></td>
          </tr>
        <?php $i++; } ?>
        </tbody>
      </table>
    </div>
    <div class="top-text">
      <h3 class="setting-text">Change Password</h3>
      <a id="change-password" href="/php/changepw.php">비밀번호 변경</a>
    </div>

    <!-- assistant modal -->
    <div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="lineModalLabel">조교 추가</h3>
          </div>
          <div class="modal-body">
            <form id="saveAss" action="save_assistant.php" enctype="multipart/form-data" method="post">
              <div class="form-group">
                <label for="AssID">Assistant ID</label>
                <input type="text" class="form-control" id="dialogAssID" placeholder="Enter Assistant ID...">
              </div>
              <div class="form-group">
                <label for="AssName">Assistant Name</label>
                <input type="text" class="form-control" id="dialogAssName" placeholder="Enter Assistant Name...">
              </div>
            </form>

          </div>
          <div class="modal-footer">
            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
              <div class="btn-group" role="group">
                <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
              </div>
              <div class="btn-group btn-delete hidden" role="group">
                <button type="button" id="deleteDialogAssistant" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Delete</button>
              </div>
              <div class="btn-group" role="group">
                <button type="button" id="saveDialogAssistant" class="btn btn-default btn-hover-green" data-action="save" role="button">Save</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="addStudent" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="lineModalLabel">학생 추가</h3>
          </div>
          <div class="modal-body">
            <form id="saveStu" action="save_student.php" enctype="multipart/form-data" method="post">
              <div class="form-group">
                <label for="StuID">Student ID</label>
                <input type="text" class="form-control" id="dialogStuID" name="id" placeholder="Enter Assistant ID...">
              </div>
              <div class="form-group">
                <label for="StuName">Student Name</label>
                <input type="text" class="form-control" id="dialogStuName" name="name" placeholder="Enter Assistant Name...">
              </div>
              <div class="form-group">
                <label for="StuFile">File input</label>
                <input type="file" id="dialogStuFile" name="file">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
              <div class="btn-group" role="group">
                <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
              </div>
              <div class="btn-group btn-delete hidden" role="group">
                <button type="button" id="deleteDialogStudent" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Delete</button>
              </div>
              <div class="btn-group" role="group">
                <button type="button" id="saveDialogStudent" class="btn btn-default btn-hover-green" data-action="save" role="button">Save</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</body>
</html>
