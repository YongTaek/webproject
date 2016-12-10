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
  <link rel="stylesheet" href="/public/css/lecture-list.css" type="text/css">
  <link rel="stylesheet" href="/public/css/base.css" type="text/css">
  <script type="text/javascript">
		<?php if (isset($_SESSION["id"]) && isset($_SESSION["favQuestion"]) && isset($_SESSION["openLecture"])) { ?>
			var questionArray = <?php echo json_encode($_SESSION["favQuestion"]); ?>;
			var lectureArray = <?php echo json_encode($_SESSION["openLecture"]); ?>;
		<?php } ?>
	</script>
  <script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="//js.pusher.com/3.2/pusher.min.js"></script>
  <script src="/public/js/push.js"></script>
  <script src="/public/js/pusher.js"></script>

</head>
<body>
  <header role = "banner" class="banner-color">
    <nav role="navigation">
      <div id="logo" class="pull-left"><a href="/php/main.php"><img class="logo" src="/public/img/selab_logo_S.png"/></a></div>
      <ul id="menu" class="inline-list pull-left">
      <li class="pull-left"><a href="/php/noticelist.php" class="menu-item" >NOTICE</a></li>
        <li class="pull-left"><a href="/php/questionlist.php" class="menu-item">QUESTION</a></li>
        <li class="pull-left"><a href="/php/freelist.php" class="menu-item">FREE BOARD</a></li>
        <li class="pull-left"><a href="/php/lecture-list.php" class="menu-item active">LECTURE</a></li>
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
      <h1 class="align-center">Lecture</h1>
      <p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
    </div>
  </header>
    <!-- <div class="createBtn">
      <a type="button" class="btn btn-primary" href="/questions/create">Create Lecture</a>
    </div> -->
    <div class="container">
      <!-- <ul id="list">
        <li class= "list-item">


        </li>
      </ul> -->
      <?php
      $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
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
            <td><a href="<?= $row["url"] ?>"><?= $row["name"] ?></a></td>
            <?php if($row["open"] == 1){
                $open = "OPEN";
              }else{ 
                $open = "CLOSE";
            }?>
            <td><p class="<?= $open?>"><?= $open ?></p></td>
        <?php } ?>
            
          </tr>
        </tbody>
      </table>
    </div>
  </body>
  </html>
