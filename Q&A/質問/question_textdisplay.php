<?php
//質問表示
$sql='SELECT * FROM qtable ORDER BY num';
$results=$pdo->query($sql);
foreach($results as $row){
	if($row['num'] == $id){ ?>
		<?php
		echo "{$row['time']} "."<br>"."<br>";
		echo "{$row['question']} "."<br>"."<br>";
     	}
}
?>
