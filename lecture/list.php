<?php include("../common/pusher.php"); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Lecture</title>
  <link rel="stylesheet" href="/public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="/public/css/lecture-list.css" type="text/css">
  <link rel="stylesheet" href="/public/css/base.css" type="text/css">
  <script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
  <script src="/public/js/jquery-ui-1.12.1.min.js"></script>
  <script src="/public/js/base.js"></script>

  <?php include("../common/script.php"); ?>

  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="//js.pusher.com/3.2/pusher.min.js"></script>
  <script src="/public/js/push.js"></script>
  <script src="/public/js/pusher.js"></script>

</head>
<body>
  <?php include("../common/header.php"); ?>
    <div class="container">
      <?php
      $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rows = $db->query("SELECT id, name, url, open FROM lecture");
      ?>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Index</th>
            <th>Chapter Name</th>
            <th>In Class</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $row) { ?>
          <tr>
            <td><?= $row["id"] ?></td>
            <td><a href="/lecture/class.php?id=<?= $row["id"] ?>"><?= $row["name"] ?></a></td>
            <?php if($row["open"] == 1){
                $open = "OPEN";
              }else{
                $open = "CLOSE";
            }?>
            <td><span class="<?= $open?>"><?= $open ?></p></td>
        <?php } ?>
          </tr>
        </tbody>
      </table>
    </div>
  </body>
  </html>
