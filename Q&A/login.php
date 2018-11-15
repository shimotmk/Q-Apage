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
<h1>ログインページ</h1>


<?php
//データベース接続
require 'database.php';
$namel = $_POST['name'];
$passl = $_POST['pass'];
echo $passl;
echo $namel;	
//ログイン機能
if(!empty($namel) and  !empty($passl)){
	$sql='SELECT * FROM usertable where name = :namel';
	$stmt = $pdo -> prepare($sql);
	$stmt -> bindParam(':namel', $namel, PDO::PARAM_INT);
	$stmt -> execute();
	$row = $stmt->fetch();
	$password = $row['password'];
	$num = $row['num'];
	echo $password;
	echo $num;
	if ($passl == $password){
		session_start();
		$_SESSION['name'] = $namel;
		header('Location: mypage.php');
		exit();
	}
}
?>
ログインが必要です<br>
<font  size="5"color="red">ユーザー登録・ログイン！</font><br>
<form method="POST" action="login.php"><br />
	ログイン<br />
	アカウント名：
	<input type="text"  name="name" /><br />
	パスワード:
	<input type="text"  name="pass" /><br />
	<input type="submit" name="login" value="ログイン" /><br />
</form>	
	<?php echo "登録がまだの方は" ?>
        <a href="http://tt-458b.99sv-coco.com/registration_mail_form.php">新規登録</a></p>
</body>	
