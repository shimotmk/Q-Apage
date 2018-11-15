<?php
if (isset($_GET['num'])) {
  $num = $_GET['num'];
}
//データベース接続
require 'database.php';
//idが渡される
$id = $_GET['id'];
// 拡張子によってMIMEタイプを切り替えるための配列
$MIMETypes = array(
   'png'  => 'image/png',
   'jpg'  => 'image/jpeg',
   'jpeg' => 'image/jpeg',
   'gif'  => 'image/gif',
   'bmp'  => 'image/bmp',
);
try {
	$sql='SELECT * FROM ImageData ORDER BY num';
	$results=$pdo->query($sql);
	foreach($results as $row){
		if($row['num'] == $id){
			header('Content-type: ' . $MIMETypes[$row['extension']]);
		 	echo $row['image'];
		}
	}
} catch (Exception $e) {
	echo "load failed: " . $e;
}
?>