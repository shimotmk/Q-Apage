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
<h1>TOPページ</h1>
<?php
//データベース接続
require 'database.php';
//質問概要表示
$sql='SELECT * FROM qtable ORDER BY num';
$results=$pdo->query($sql);
?>
    <?php foreach ($results as $row): ?>
       <a href="question_detail.php?id=<?php echo $row['num']; ?>"><?php echo mb_substr($row['question'], 0, 40); ?></a><br>
    <?php endforeach; ?>
</p>
</body>
</html>
