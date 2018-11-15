<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="menu.css" />
</head>
<body>
 <h2><a href="http://tt-458b.99sv-coco.com/toppage.php"><img src="logo.png" ,width="300" height="50"></a></h2>
 <?php
 session_start();
 if(isset($_SESSION["name"])) {
	$name=$_SESSION["name"];
	//アイコン表示 
	require 'view.php';
 }
 ?>
<ul>
	<li><a href="http://tt-458b.99sv-coco.com/toppage.php">TOPページ</a></li>
	<li><a href="http://tt-458b.99sv-coco.com/question.php">質問</a></li>
	<li><a href="http://tt-458b.99sv-coco.com/mypage.php">マイページへ</a></li>
	<li><a href="http://tt-458b.99sv-coco.com/login.php">ログイン</a></li>
	<li><a href="http://tt-458b.99sv-coco.com/logout.php">ログアウト</a></li>
	<li><a href="http://tt-458b.99sv-coco.com/registration_mail_form.php">新規登録</a></li>
	<li><a href="http://twitter.com/share?url=http://tt-458b.99sv-coco.com/<?php echo $_SERVER["REQUEST_URI"]; ?>">Twitter</a></li>
</ul>
<h1>質問</h1>
<?php
session_start();
if(isset($_SESSION["name"])) {
	$name=$_SESSION["name"];
}else{
	header("Location:login.php");
}
?>
<?php echo "ログインしました。".$name."さん";?>
<?php
//データベース接続
require 'database.php';
//質問テキスト投稿
require 'question_textpost.php';
//画像・動画投稿
require 'question_imagepost.php';
?>
<form method="POST" action="question.php" enctype="multipart/form-data">
<h2>質問・相談</h2>
名前：
<input type="text"  name="name" value="<?php echo $_SESSION['name']; ?>"/><br />
質問：
<input type="text"  name="question" style="width:200px;height:50px;"/><br />
画像・動画送信:
<input type="file" name="upfile">
<input type="submit" value="送信" /><br />
<br>
</form>
</body>
