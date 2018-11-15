<?php
session_start();
 
header("Content-type: text/html; charset=utf-8");
 
//クロスサイトリクエストフォージェリ（CSRF）対策のトークン判定
if ($_POST['token'] != $_SESSION['token']){
	echo "不正アクセスの可能性あり";
	exit();
}
 
//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');
 
//データベース接続
require_once '/public_html/mission6/database.php';

//エラーメッセージの初期化
$errors = array();
 
if(empty($_POST)) {
	header("Location: registration_mail_form.php");
	exit();
}
 
$mail = $_SESSION['mail'];
$name = $_SESSION['account'];
 
//パスワードのハッシュ化まだできてない
$password_hash =  $_SESSION['password'];
 
//ここでデータベースに登録する
try{
	//例外処理を投げる（スロー）ようにする
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//トランザクション開始
	$dbh->beginTransaction();
	
	//memberテーブルに本登録する
	$statement = $dbh->prepare("INSERT INTO usertable (name,mail,password) VALUES (:name,:mail,:password_hash)");
	//プレースホルダへ実際の値を設定する
	$statement->bindValue(':name', $name, PDO::PARAM_STR);
	$statement->bindValue(':mail', $mail, PDO::PARAM_STR);
	$statement->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);
	$statement->execute();
		
	//pre_memberのflagを1にする
	$statement = $dbh->prepare("UPDATE pre_member SET flag=1 WHERE mail=(:mail)");
	//プレースホルダへ実際の値を設定する
	$statement->bindValue(':mail', $mail, PDO::PARAM_STR);
	$statement->execute();
	
	// トランザクション完了（コミット）
	$dbh->commit();
		
	//データベース接続切断
	$dbh = null;
	
	//セッション変数を全て解除
	$_SESSION = array();
	
	//セッションクッキーの削除・sessionidとの関係を探れ。つまりはじめのsesssionidを名前でやる
	if (isset($_COOKIE["PHPSESSID"])) {
    		setcookie("PHPSESSID", '', time() - 1800, '/');
	}
	
 	//セッションを破棄する
 	session_destroy();
 	
 	/*
 	登録完了のメールを送信
 	*/
	
}catch (PDOException $e){
	//トランザクション取り消し（ロールバック）
	$dbh->rollBack();
	$errors['error'] = "もう一度やりなおして下さい。";
	print('Error:'.$e->getMessage());
}
 
?>
 
<!DOCTYPE html>
<html>
<head>
<title>会員登録完了画面</title>
<meta charset="utf-8">
</head>
<body>
 <p><a href="http://tt-458b.99sv-coco.com/toppage.php">TOPページ</a>&nbsp;
   <a href="http://tt-458b.99sv-coco.com/question.php">質問</a>&nbsp;
   <a href="http://tt-458b.99sv-coco.com/mypage.php">マイページへ</a>&nbsp;
   <a href="http://tt-458b.99sv-coco.com/logout.php">ログアウトする</a>&nbsp;
   <a href="http://tt-458b.99sv-coco.com/login.php">ログイン</a>&nbsp;
   <a href="http://tt-458b.99sv-coco.com/registration_mail_form.php">新規登録</a></p>
<?php if (count($errors) === 0): ?>
<h1>会員登録完了画面</h1>
 
<p>登録完了いたしました。ログイン画面からどうぞ。</p>
<p><a href="http://tt-458b.99sv-coco.com/login.php">ログイン画面</a></p>
 
<?php elseif(count($errors) > 0): ?>
 
<?php
foreach($errors as $value){
	echo "<p>".$value."</p>";
}
?>
 
<?php endif; ?>
 
</body>
</html>
 