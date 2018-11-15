<?php
//質問画像・動画表示
$sql='SELECT*FROM movietable';
$results=$pdo->query($sql);
    //DBから取得して表示する．
    $sql = "SELECT * FROM movietable ORDER BY id;";
    $result=$pdo->query($sql);
   foreach($result as $row){
	$target = $id;
	if($row['id'] == $target){
        //動画と画像で場合分け
	        $target = $id;
	        if($row["extension"] == "mp4"){
	            echo ("<video src=\"media.php?target=$target\" width=\"426\" height=\"240\" controls></video>");
	        }
	        elseif($row["extension"] == "jpeg" || $row["extension"] == "png" || $row["extension"] == "gif"){
	            echo ("<img src='media.php?target=$target'>");
	        }
	        echo ("<br/><br/>");
	}
    }
?>