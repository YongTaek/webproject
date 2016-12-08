<!DOCTYPE html>
<html>
<head>
	<title>Question</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="icon/SelabFavicon.png" type="image/png">
	<script type="text/javascript" src="/public/js/jquery-3.1.1.min.js"></script>
	<link rel="stylesheet" href="/public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="/public/css/base.css" type="text/css">
	<link rel="stylesheet" href="/public/css/question.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="../public/css/wmd.css" />
	<script type="text/javascript" src="/public/js/showdown.js"></script>
	<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
	<link rel="stylesheet" href="../public/css/pusher.css" type="text/css">
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="//js.pusher.com/3.2/pusher.min.js"></script>
	<script src="../public/js/push.js"></script>
</head>
<body>
	<header role = "banner" class="banner-color">
		<nav role="navigation" >
			<div id="logo" class="pull-left"><a href="/view/main.php"><img class="logo" src="../public/img/selab_logo_S.png" /></a></div>
			<ul id="menu" class="inline-list pull-left">
				<li class="pull-left"><a href="/view/noticelist.php" class="menu-item" >NOTICE</a></li>
				<li class="pull-left"><a href="/view/questionlist.php" class="menu-item active">QUESTION</a></li>
				<li class="pull-left"><a href="/view/freelist.php" class="menu-item">FREE BOARD</a></li>
				<li class="pull-left"><a href="/view/lecture-list.php" class="menu-item">LECTURE</a></li>
			</ul>
			<div role="login" class="pull-right">
				<a id="login" href="/view/login.php" class='pull-right'>LOGIN</a>
				<div class="pull-right vr"></div>
				<a id="mypage" href="/view/myPage.php" class='pull-right'>천유정 (학생)</a>
			</div>
			<a href="/view/question/search"><img src="/public/img/search.png" class="pull-right search-icon"></a>
			<input type="text" class="pull-right search" name="search">
		</nav>
		<div class = "jumbotron banner-color">
			<h1 class="align-center">Q & A</h1>
			<p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
		</div>
	</header>

	<!-- parameter id=value 로 가져와서 question 내용 보여주기 -->
	<div class="container">
		<div class="question">
			<!-- qeustion title -->
			<!-- <a class="pin-off" href="#" ></a> -->

			<h1 id="question_title">Title</h1>
			<div class="question_info">
				<span>author</span>
				<span>date</span>
			</div>
			<div class="question_btn">
				<a class="btn question_modify" name="question_modify" href="">수정</a>
				<a class="btn question_delete" name="question_delete" href="">삭제</a>
			</div>
			<hr>
			<div>
				<div class="vote">
					<a class="pin-off"></a>
					<a class="vote-up-off"></a>
					<!-- 추천 수 -->
					<span class="vote-count"></span>
					<a class="vote-down-off"></a>

					<a class="star-off"></a>

				</div>
				<!-- question 내용 -->
				<pre class="prettyprint">
					<code>
						int main() {
						int a;
						return 0;
					}
				</code>
			</pre>
		</div>
	</div>
	<!-- comment iterative -->
	<div class="comment">
		<hr>
		<?php ?>
		<div>
			<span><?=$num ?></span>
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
				<input class="commentBtn" id="submit" type="submit" value="등록"/>
			</div>
		</form>
	</div>
	<!-- question에 대한 answer -->
	<div class="answer">
		<h2 id="answer_title"><?=$num ?> Answer</h2>
		<div class="answer_info">
			<span>author</span>
			<span>date</span>
		</div>
		<div class="answer_btn">
			<a class="btn answer_modify" name="answer_modify" href="">수정</a>
			<a class="btn answer_delete" name="answer_delete" href="">삭제</a>
		</div>
		<hr>
		<div class="overflow">
			<div class="vote">
				<a class="vote-up-off"></a>
				<!-- answer 추천 수 -->
				<span class="vote-count"><?=$test ?></span>
				<a class="vote-down-off"></a>
				<a class="star-off"></a>
			</div>
			<div class="content">
				asf
			</div>
		</div>
		<hr>
	</div>
	<?php ?>
	<div class="comment">
		<span><?=$num ?></span>
		<span>content</span>
		<span>author</span>
		<span class="">date</span>
		<div class="comment_btn">
			<a class="btn comment_modify" name="comment_modify" href="">수정</a>
			<a class="btn comment_delete" name="comment_delete" href="">삭제</a>
		</div>

	</div>
	
	<?php ?>

	<div class="comment">
		<hr>
		<form>
			<label>Comment:</label>
			<div>
				<input id="comment-write" type="text" name="comment" />
				<input class="commentBtn" id="submit" type="submit" value="등록"/>
			</div>

		</form>
	</div>
	<div class="write-answer">
		<h2>Your Answer</h2>
		<form action="question.php">
			<div id="wmd-editor">
				<div id="wmd-button-bar"></div>
				<textarea id="wmd-input"></textarea>
			</div>
			<hr>
			<div id="wmd-preview" class="wmd-preview"></div>
			<hr>
			<input class="btn btn-primary" type="submit" value="submit" />
		</form>
	</div>
</div>
<script type="text/javascript" src="../public/js/wmd.js"></script>
<script src="/public/js/star_on_off.js" type="text/javascript"></script>
</body>
</html>
