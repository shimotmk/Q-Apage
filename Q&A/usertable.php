<?php
//データベース接続
require 'database.php';
$sql="CREATE TABLE usertable"
."("."num int(5),"
."name char(32),"
."pass char(34)"
.");";
$stmt = $pdo->query($sql);
$name = $_POST['name'];
$pass = $_POST['pass'];
$delname = $_POST['delname'];
$delpass = $_POST['delpass'];
$namel = $_POST['namel'];
$passl = $_POST['passl'];
//新規登録
if(!empty($pass) and !empty($name)){
	$sql = 'SELECT MAX(num) AS num_max FROM usertable';
        $result = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        $num = $result['num_max']+1;
	$sql = $pdo-> prepare("INSERT INTO usertable(num,name,pass)VALUES(:num,:name,:pass)");
	$sql->bindParam(':num',$num,PDO::PARAM_INT);
     	$sql->bindParam(':name',$name,PDO::PARAM_STR);
	// ここで、passワードを暗号化
        $crypass = crypt($pass,'test');
	$sql->bindParam(':pass',$crypass,PDO::PARAM_STR);
	$sql->execute();
}
//削除機能
if(!empty($delname) and  !empty($delpass)){
	$sql='SELECT * FROM usertable where name = :delname';
	$stmt = $pdo -> prepare($sql);
	$stmt -> bindParam(':delname', $delname, PDO::PARAM_INT);
	$stmt -> execute();
	$row = $stmt->fetch();
	$pass = $row['pass'];
	$crydelpass = crypt($delpass,'test');
	if ($crydelpass == $pass){
		$sql = 'DELETE FROM usertable where name = :delname';
		$stmt = $pdo -> prepare($sql);
		$stmt -> bindParam(':delname', $delname, PDO::PARAM_INT);
		$stmt -> execute();
	}
}
//ログイン機能
if(!empty($namel) and  !empty($passl)){
	//$value = $namel;
	$sql='SELECT * FROM usertable where name = :namel';
	$stmt = $pdo -> prepare($sql);
	$stmt -> bindParam(':namel', $namel, PDO::PARAM_INT);
	$stmt -> execute();
	$row = $stmt->fetch();
	$pass = $row['pass'];
	$num = $row['num'];
	// ここで、passlを暗号化
	$crypassl = crypt($passl,'test');
	if ($crypassl == $pass){
		session_start();
		$_SESSION['name'] = $namel;
		header('Location: question.php');
		exit();
	}
}
?>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<p><a href="http://tt-458b.99sv-coco.com/toppage.php">TOPページ</a></p>
<font  size="5"color="red">ユーザー登録・ログイン！</font><br>
<form method="POST" action="usertable.php"><br />
	ログイン：質問を行う<br />
	ユーザー名：
	<input type="text"  name="namel" /><br />
	パスワード:
	<input type="text"  name="passl" /><br />
	<input type="submit" name="login" value="ログイン" /><br />
</form>			
</body>	
<form method="POST" action="usertable.php">
	新規登録<br />
	ユーザー名：
	<input type="text" value = "<?php echo $namae; ?>" name="name" /><br />
	パスワード:
	<input type="text"  name="pass" />
	<input type="submit" value="送信" /><br />
</form>
</body>
<body>
<form method="POST" action="usertable.php">
	ユーザー登録削除<br />
	<input type="text" placeholder = "ユーザー名" name="delname" /><br />
	<input type="text"  placeholder = "パスワード "name="delpass"/>
	<input type="submit" value="削除" /><br />
</form>
</body>	
<?php
//非公開予定部分
$sql='SELECT * FROM usertable ORDER BY num';
$results=$pdo->query($sql);
foreach($results as $row){
	echo "ユーザー名：{$row['name']} パスワード：{$row['pass']} "."<br>";
}
?>
