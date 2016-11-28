<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/base.css" type="text/css">
    <link rel="stylesheet" href="/public/css/lecture.css" type="text/css">
    <script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="/public/js/thread.js" type="text/javascript"></script>
  </head>
  <body>
    <?php
      if (isset($_GET["id"])) {
        $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
        $rows = $db->query("SELECT l.name, l.url from lecture l where l.id = ".$_GET["id"]);

      }
    ?>
    <div class="sidebar">
      <div class="threads">
        <div class="thread">
            feejejek
        </div>
        <div class="thread">
            feejejek
        </div>
      </div>
      <form class="lecture" action="create_comment.php" method="POST">
          <textarea id="input" name="content" cols="23" rows="8"></textarea>
          <input type="hidden" value="<?= rows["id"] ?>"/>
          <input type="hidden" value="lecture" />
          <input type="submit" class="btn btn-primary" id="submit" value="등록"/>
      </form>
    </div>
  </body>
</html>
