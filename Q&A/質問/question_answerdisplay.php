<?php
$sql='SELECT * FROM  atable ORDER BY num';
$ansresult=$pdo->query($sql);
foreach($ansresult as $ansrow){
	if($ansrow['num'] == $id){
		echo "{$ansrow['name']}さん {$ansrow['time']} "."<br>";
		echo "{$ansrow['answer']} "."<br>"."<br>";
     	}
}
?>