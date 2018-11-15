<?php
session_start();
if(isset($_SESSION["name"])) {
	$name=$_SESSION["name"];
}else{
	header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="aicon.css" />
</head>
<body>
<?php
//データベース接続
require 'database.php';
//質問画像表示
?>
<div class="prof">
<?php echo '<img src="picdata.php?name='.$name.'",width="40" height="40"">';?>
</div>
<?php echo $name."さん"."<br>";?>
  </form>
</body>
</html>
