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
<h1>質問者詳細ページ</h1>
<?php $id = $_GET['id'];?>
<?php
//データベース接続
require 'database.php';
//urlのidの名前を取得
$sql='SELECT * FROM qtable ORDER BY num';
$results=$pdo->query($sql);
foreach($results as $row){ 
    if($row['num'] == $id){ 
		$idname=$row['name'];
	      echo "{$idname}さんのページ "."<br>";	
	}
}
//$idnameの質問の一覧を表示
$sql='SELECT * FROM qtable ORDER BY num';
$results=$pdo->query($sql);
foreach($results as $row){ 
    if($row['name'] == $idname){ 
	      echo "{$row['num']}"."<br>";
	      echo "{$row['question']}"."<br>";	
	      echo "{$row['time']}"."<br>";	
	
	}
}
?>
</p>
</body>
</html>