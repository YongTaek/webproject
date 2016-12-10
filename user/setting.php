<?php include("../common/pusher.php"); 
  session_start();
  $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if(!($_SESSION["auth"] === 'professor' || $_SESSION["auth"] === 'assistant')){ 
    header("Location: /error.php");
  } ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Lecture</title>
  <link rel="stylesheet" href="/public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="/public/css/setting.css" type="text/css">
  <link rel="stylesheet" href="/public/css/base.css" type="text/css">
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
  <script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
  <script src="/public/js/jquery-ui-1.12.1.min.js"></script>
  <script src="/public/js/jquery.form.js" type="text/javascript"></script>
  <script src="/public/js/base.js"></script>

  <?php include("../common/script.php"); ?>
  
  <script src="/public/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="//js.pusher.com/3.2/pusher.min.js"></script>
  <script src="/public/js/push.js"></script>
  <script src="/public/js/lec-open-close.js"></script>
  <script src="/public/js/pusher.js"></script>
  <script src="/public/js/settingDialog.js" type="text/javascript"></script>
</head>
<body>
  <?php include("../common/header.php"); ?>
  <div class="container">
    <div class = "top-text">
      <h3 class="setting-text">Lecture List</h3>
      <a id="link" href="/lecture/upload.php">강의 파일 업로드</a>
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
        $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
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
          <td><a href="/lecture/class.php?id=<?= $row["id"] ?>"><?= $row["name"] ?></a></td>
          <td><a href="#" class="<?= $class ?>"><?= $status ?></a></td>
          <td><a href="/lecture/upload.php?id=<?= $row["id"] ?>" class="lecture-change">Change</a></td>
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
            <th>Password</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $i = 1;
        $rows = $db->query("SELECT id, name FROM user WHERE authority = 'student'");
        foreach ($rows as $row) { ?>
          <tr>
            <td><?= $i ?></td>
            <td><?= $row["id"] ?></td>
            <td><?= $row["name"]?></td>
            <td><a href="/api/user/remove-user.php?id=<?= $row["id"] ?>" class="remove-student">Remove</a></td>
            <td><a href="#" class="reset-student">Reset</a></td>
          </tr>
          <?php $i++; } ?>
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
            <th>Remove</th>
            <th>Password</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $i = 1;
        $rows = $db->query("SELECT id, name FROM user WHERE authority = 'assistant'");
        foreach ($rows as $row) { ?>
          <tr>

            <td><?= $i ?></td>
            <td><?= $row["id"] ?></td>
            <td><?= $row["name"] ?></td>
            <td><a href="/api/user/remove-user.php?id=<?= $row["id"] ?>" class="remove-assistant">Remove</a></td>
            <td><a href="#" class="reset-assistant">Reset</a></td>
          </tr>
        <?php $i++; } ?>
        </tbody>
      </table>
    </div>
    <div class="top-text">
      <h3 class="setting-text">Change Password</h3>
      <a id="change-password" href="/api/user/change-password.php">비밀번호 변경</a>
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
            <form id="saveAss" action="/api/user/save-assistant.php" enctype="multipart/form-data" method="post">
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
            <form id="saveStu" action="/api/user/save-student.php" enctype="multipart/form-data" method="post">
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
