<?php
//データベース接続
require 'database.php';
//質問テーブル作成
$sql="CREATE TABLE qtable"
."("."num int(5),"
."name char(32),"
."question TEXT,"
."time char(50)"
.");";
$stmt = $pdo->query($sql);
$name = $_POST['name'];
$question = $_POST['question'];
//質問投稿
if(!empty($question) and !empty($name)){
	//投稿番号の取得画像なし
	$sql = 'SELECT MAX(num) AS num_max FROM qtable';
        $result = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        $num = $result['num_max']+1;
	$time=date("Y/m/d H:i:s");
	$sql = $pdo-> prepare("INSERT INTO qtable(num,name,question,time)VALUES(:num,:name,:question,:time)");
	$sql->bindParam(':num',$num,PDO::PARAM_INT);
     	$sql->bindParam(':name',$name,PDO::PARAM_STR);
	$sql->bindParam(':question',$question,PDO::PARAM_STR);
	$sql->bindParam(':time',$time,PDO::PARAM_STR);
	$sql->execute();
	$sql="SELECT * FROM qtable ORDER BY num";
     	$result=$pdo->query($sql);		
}
?>
