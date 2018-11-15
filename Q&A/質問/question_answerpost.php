<?php
//回答投稿
$sql="CREATE TABLE atable"
."("."num int(5),"
."name char(32),"
."answer TEXT,"
."time char(50)"
.");";
$stmt = $pdo->query($sql);
$name = $_POST['name'];
$answer = $_POST['answer'];
if(!empty($answer) and !empty($name)){
		$time=date("Y/m/d H:i:s");
		$sql = $pdo-> prepare("INSERT INTO atable(num,name,answer,time)VALUES(:num,:name,:answer,:time)");
		$sql->bindParam(':num',$id,PDO::PARAM_INT);
	     	$sql->bindParam(':name',$name,PDO::PARAM_STR);
		$sql->bindParam(':answer',$answer,PDO::PARAM_STR);
		$sql->bindParam(':time',$time,PDO::PARAM_STR);
		$sql->execute();
		$sql="SELECT * FROM atable ORDER BY num";
	     	$result=$pdo->query($sql);		
}
?>