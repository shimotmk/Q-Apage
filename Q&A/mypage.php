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
<h1>マイページ</h1>
<?php
session_start();
if(isset($_SESSION["name"])) {
	$name=$_SESSION["name"];
}
?>
<?php
//データベース接続
require 'database.php';
?>
<a href="http://tt-458b.99sv-coco.com/save.php">アイコン設定</a></p>
<?php
//アイコン表示 
require 'view.php';
?>
<body>
<form method="POST" action="">
	<input type="text" placeholder = "削除対象番号" name="delnum" />
	<input type="submit" value="削除" /><br />
</form>
</body>
<body>
<form method="POST" action="">
	<input type="text" placeholder = "編集対象番号" name="editnum" />
	<input type="submit" value="編集" /><br />
</form>
</body>	
<?php
//編集したい番号の質問を取ってくる
$editnum = $_POST['editnum'];
$sql='SELECT * FROM qtable ORDER BY num';
$results=$pdo->query($sql);
foreach($results as $row){ 
    if($row['num'] == $editnum){ 
	$question = $row['question'];
	$time = $row['time'];
	}
}
?>
<h2>質問・相談編集</h2>
<form method="POST" action="">
編集対象番号
<input type="text" value = "<?php echo $editnum; ?>" name="wanteditnum" /><br />
名前：
<input type="text"  name="editname" value="<?php echo $_SESSION['name']; ?>"/><br />
質問：
<input type="text"  name="editquestion" value="<?php echo $question; ?>" style="width:200px;height:50px;"/><br />
画像・動画送信:
<input type="file" name="upfile">
<input type="submit" value="送信" /><br />
</body>
<?php
$wanteditnum = $_POST['wanteditnum'];
$editname = $_POST['editname'];
$editquestion = $_POST['editquestion'];
//いよいよ編集！
if(!empty($editname)and  !empty($editquestion)  ){
	$value = $wanteditnum;
	$sql="UPDATE  qtable set name='$editname',question='$editquestion'where num = :wanteditnum";
	$stmt = $pdo -> prepare($sql);
	$stmt -> bindParam(':wanteditnum', $value, PDO::PARAM_INT);
	$stmt -> execute();
	$row = $stmt->fetch();
}
?>
<?php
//質問削除機能
$delnum = $_POST['delnum'];
$editnum = $_POST['editnum'];
$value = $delnum;
$sql = 'DELETE FROM qtable where num = :delnum';
$stmt = $pdo -> prepare($sql);
$stmt -> bindParam(':delnum', $value, PDO::PARAM_INT);
$stmt -> execute();
?>
<?php
//質問一覧表示
$sql='SELECT * FROM qtable ORDER BY num';
$results=$pdo->query($sql);
foreach ($results as $row):	
	if($row['name'] == $_SESSION["name"]){
       	    echo "質問番号".($row['num'])."<br>";
            echo ($row['question'])."<br>";}
endforeach;
?>
</p>
</body>
</html>