<?php
session_start();
if(isset($_SESSION["name"])) {
	$name=$_SESSION["name"];
}else{
	header("Location:login.php");
}
?>
<?php echo "ログインしました。".$name."さん";?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<p><a href="http://tt-458b.99sv-coco.com/toppage.php">TOPページ</a>&nbsp;
   <a href="http://tt-458b.99sv-coco.com/question.php">質問</a>&nbsp;
   <a href="http://tt-458b.99sv-coco.com/mypage.php">マイページへ</a>&nbsp;
   <a href="http://tt-458b.99sv-coco.com/logout.php">ログアウトする</a>&nbsp;
   <a href="http://tt-458b.99sv-coco.com/login.php">ログイン</a>&nbsp;
   <a href="http://tt-458b.99sv-coco.com/registration_mail_form.php">新規登録</a></p>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
</head>
<body>
  <form action="save.php" method="post" enctype="multipart/form-data">
    名前：
    <input type="text" name="name" value="<?php echo $_SESSION['name']; ?>"><br />
    アイコン：
　　<input type="file" name="image" size="30">
    <input type="submit" value="送信">
  </form>
</body>
</html>
<?php
$name = $_POST['name'];
//データベース接続
require 'database.php';
//質問画像投稿
$image = file_get_contents($_FILES["image"]["tmp_name"]);
$extension = substr($image, strrpos($image, '.') + 1);
try { 
	$sql = $pdo->prepare('INSERT INTO pictable (name, image, extension) VALUES (:name, :image, :extension)');
     	$sql->bindParam(':name',$name,PDO::PARAM_STR);
	$sql->bindValue(':image', $image, PDO::PARAM_LOB);
	$sql->bindValue(':extension', $extension, PDO::PARAM_STR);
	$sql->execute();
} catch (Exception $e) {
	echo "insert failed: " . $e;
}
?>
