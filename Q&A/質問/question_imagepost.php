<?php
$file=$_FILES['upfile'];
if(isset($_FILES['upfile']['error'])&&is_int($_FILES['upfile']['error'])&& $_FILES["upfile"]["name"]!==""){
	//エラーチェック
	switch($_FILES['upfile']['error']){
		case UPLOAD_ERR_OK:
			break;
		case UPLOAD_ERR_NO_FILE:
			throw new RuntimeException('ファイルが選択されていません',400);
		case UPLOAD_ERR_SIZE:
			throw new RuntimeException('ファイルサイズが大きすぎます',400);
		default:
			throw new RuntimeException('その他のエラーが発生しました',500);
	}
	//画像をバイナリデータにする
	$raw_data=file_get_contents($_FILES['upfile']['tmp_name']);
	//拡張子を見る
	$tmp=pathinfo($_FILES["upfile"]["name"]);
	$extension=$tmp["extension"];
	if($extension==="jpg" || $extension==="jpeg" || $extension==="JPG"	 || $extension==="JPEG"){
		$extension="jpeg";
	}
	elseif($extension==="png" || $extension==="PNG"){
		$extension="png";
	}
	elseif($extension==="gif" || $extension==="GIF"){
		$extension="gif";
	}
	elseif($extension==="mp4" || $extension==="MP4"){
		$extension="mp4";
	}
	else{
		echo"非対応ファイルです。<br/>";
		exit(1);
		}
}
  		//DBに格納するファイルネーム設定
            //サーバー側の一時的なファイルネームと取得時刻を結合した文字列にsha256をかける．
            $date = getdate();
            $fname = $_FILES["upfile"]["tmp_name"].$date["year"].$date["mon"].$date["mday"].$date["hours"].$date["minutes"].$date["seconds"];
            $fname = hash("sha256", $fname);
            
if(!empty($fname)){
	$sql=$pdo->prepare("INSERT INTO movietable (id,fname,extension,raw_data) VALUES (:id,:fname,:extension,:raw_data)");
	$sql-> bindParam(':id',$num,PDO::PARAM_INT);
	$sql->bindValue(':fname',$fname, PDO::PARAM_STR);
        $sql->bindValue(':extension',$extension, PDO::PARAM_STR);
        $sql->bindValue(':raw_data',$raw_data, PDO::PARAM_STR);
	$sql->execute();
}
?>