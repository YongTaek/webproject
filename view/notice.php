<!DOCTYPE html>
<html>
<head>
	<title>Notice</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="icon/SelabFavicon.png" type="image/png">
	<link rel="stylesheet" href="../public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="../public/css/base.css" type="text/css">
	<link rel="stylesheet" href="../public/css/notice.css" type="text/css">
	<link rel="stylesheet" href="../public/css/pusher.css" type="text/css">
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="/public/css/Nwagon.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="//js.pusher.com/3.2/pusher.min.js"></script>
	<script src="/public/js/push.js"></script>
	<script src="/public/js/Nwagon.js"></script>
	<script src="/public/js/notice-chart.js"></script>
</head>
<body>
	<header role = "banner" class="banner-color">
		<nav role="navigation" >
			<div id="logo" class="pull-left"><a href="/view/main.php"><img class="logo" src="../public/img/selab_logo_S.png" /></a></div>
			<ul id="menu" class="inline-list pull-left">
				<li class="pull-left"><a href="/view/noticelist.php" class="menu-item active" >NOTICE</a></li>
				<li class="pull-left"><a href="/view/questionlist.php" class="menu-item">QUESTION</a></li>
				<li class="pull-left"><a href="/view/freelist.php" class="menu-item">FREE BOARD</a></li>
				<li class="pull-left"><a href="/view/lecture-list.php" class="menu-item">LECTURE</a></li>
			</ul>
			<div role="login" class="pull-right">
				<a id="login" href="/view/login.php" class='pull-right'>LOGIN</a>
				<div class="pull-right vr"></div>
				<a id="mypage" href="/view/myPage.php" class='pull-right'>천유정 (학생)</a>
			</div>
			<a href="/view/notice/search"><img src="/public/img/search.png" class="pull-right search-icon"></a>
			<input type="text" class="pull-right search" name="search">
		</nav>
		<div class = "jumbotron banner-color">
			<h1 class="align-center">Notice</h1>
			<p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
		</div>
	</header>

	<div class="container">
		<div class="notice">
			<div class="title">
				<a class="pin-off" href="#" ></a>

				<h1 id="title_id">
					<span>제목</span>
				</h1>
				<div class="notice_info">
					<span>author</span>
					<span>date</span>
				</div>
				<div class="notice_btn">
					<a class="btn notice_modify" name="notice_modify" href="">수정</a>
					<a class="btn notice_delete" name="notice_delete" href="">삭제</a>
				</div>
			</div>


			<div class="content">
				<p>Content</p>
			</div>
			<form class="vote" action="notice_vote_submit" accept-charset="utf-8">

				<div class="vote-name">펑펑펑</div>
				<div class="vote-period">2016-11-23 ~ 2016-12-2</div>
				<div class="divider"></div>
				<div class="vote-item-single"> <!-- 선택 갯수가 한개일 때! -->
					<ul class="vote-item">
						<li><input type="radio" name="item" checked = "checked"/>펑펑</li>
						<li><input type="radio" name="item"/>펑펑펑</li>
					</ul>
				</div>
				<div class="vote-item-multi"> <!-- 선택 갯수가 여려개일 때 -->
					<ul class="vote-item">
						<li><input type="checkbox" name="item"/>펑펑</li>
						<li><input type="checkbox" name="item"/>펑펑펑</li>
					</ul>
				</div>
				<input class="votebtn formargin" type="submit" name="submitVoteBtn" value="투표">
				<a class="votebtn" id="vote-result">결과 보기</a>
				<div id="chart"></div>
			</form>
		</div>
		<!-- comment iterative-->
		<div class="comment">
			<hr>
			<?php ?>
			<div>
				<span><?=$num ?></spn>
					<span>content</span>
					<span>author</span>
					<span class="">date</span>
					<div class="comment_btn">
						<a class="btn comment_modify" name="comment_modify" href="">수정</a>
						<a class="btn comment_delete" name="comment_delete" href="">삭제</a>
					</div>
				</div>
				<hr>
				<?php ?>
			</div>
			<div class="comment">
				<form>
					<label>Comment:</label>
					<div>
						<input id="comment-write" type="text" name="comment" />
						<input class="btn" id="submit" type="submit" value="등록"/>
					</div>

				</form>
			</div>
		</div>
	</div>
	<script src="../public/js/star_on_off.js" type="text/javascript"></script>
</body>
</html>
