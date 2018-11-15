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
<h1>質問詳細ページ</h1>
<?php 
	$id = $_GET['id'];
?>
<?php
//データベース接続
require 'database.php';
$sql='SELECT * FROM qtable ORDER BY num';
$results=$pdo->query($sql);
foreach($results as $row){ 
	if($row['num'] == $id){?> 
	<a href="mypage_detail.php?id=<?php echo $row['num']; ?>"><?php echo "{$row['name']}さん ";?></a>	
        <?php } 
} 
?>
<?php
//質問テキスト表示
require 'question_textdisplay.php';
//質問画像・動画表示
require 'question_imagedisplay.php';
//回答表示
echo "回答・お礼"."<br>"."<br>";
require 'question_answerdisplay.php';
//回答投稿
require 'question_answerpost.php';
?>
<?php
	if(!isset($_SESSION["name"])) {
?>
	<a href="http://tt-458b.99sv-coco.com/usertable.php">ログインして回答する</a></p>
<?php
	}else{
?>
	<form method="POST" action="" enctype="multipart/form-data">
<h2>回答する</h2>
	名前：
	<input type="text"  name="name" value="<?php echo $_SESSION['name']; ?>" /><br />
	回答：
	<input type="text"  name="answer" style="width:200px;height:50px;"/><br />
	<input type="submit" name="botan" value="送信">
	</form>
	</body>
<?php } 
?>
