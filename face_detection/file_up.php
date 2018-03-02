<?php
$image_path = $_FILES["upfile"];

include("functions.php");

//****************************************************
//Start:Fileアップロードチェック
//****************************************************
if (isset($_FILES["upfile"] ) && $_FILES["upfile"]["error"] ==0 ) {
    //情報取得
    $file_name = $_FILES["upfile"]["name"];         //"1.jpg"ファイル名取得
    $tmp_path  = $_FILES["upfile"]["tmp_name"]; //"/usr/www/tmp/1.jpg"アップロード先のTempフォルダ
    $file_dir_path = "upload/";  //画像ファイル保管先
  
    //***File名の変更***
    $extension = pathinfo($file_name, PATHINFO_EXTENSION); //拡張子取得(jpg, png, gif)
    $uniq_name = date("YmdHis").md5(session_id()) . "." . $extension;  //ユニークファイル名作成
    $file_name = $file_dir_path.$uniq_name; //ユニークファイル名とパス
   
    $img="";  //画像表示orError文字を保持する変数
    // FileUpload [--Start--]
    if ( is_uploaded_file( $tmp_path ) ) {
        if ( move_uploaded_file( $tmp_path, $file_name ) ) {
            chmod( $file_name, 0644 );
        } else {
            exit("Error:アップロードできませんでした。"); //Error文字
        }
    }
    // FileUpload [--End--]
  }else{
    exit("画像が送信されていません"); //Error文字
  }
  //****************************************************
  //End:Fileアップロードチェック
  //****************************************************
  
  
  
  
  //2. DB接続します(エラー処理追加)
  $pdo = db_con();
  
  //３．データ登録SQL作成
  $stmt = $pdo->prepare("INSERT INTO face_upfile(id, image  )VALUES(NULL, :image)");
  $stmt->bindValue(':image', $file_name, PDO::PARAM_STR);
  $status = $stmt->execute();
  
  //４．データ登録処理後
  if($status==false){
    queryError($stmt);
  
  }else{
    //５．index.phpへリダイレクト
    // header("Location: face.php");
    // exit;
  


//APIキー
    $api_key = "AIzaSyA9MfZLrauaU-T9MYpJrIl46tNOVQtRJ7g";

    //リファラー
    //$referer = "各自設定してください";

    //画像へのパス
    $image_path = $file_name;

	
    //リクエスト用のJSON生成
    $json = json_encode(array(
        "requests" => array(
            array(
                "image" => array(
                    "content" => base64_encode(file_get_contents($image_path)),
                ) ,
                "features" => array(
                    array(
                        "type" => "FACE_DETECTION",
                        "maxResults" => 5,
                    ),
                ),
            ),
        ),
    ));

	
    //APIアクセス
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://vision.googleapis.com/v1/images:annotate?key=" . $api_key);
    curl_setopt($curl, CURLOPT_HEADER, true); 
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 15);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
    $res1 = curl_exec($curl);
	$res2 = curl_getinfo($curl);
    curl_close($curl);

    //データ取得
    $json = substr($res1, $res2["header_size"]);// 取得したJSON
    $header = substr($res1, 0, $res2["header_size"]);// レスポンスヘッダー

    //データ確認
    $arr = json_decode($json,true);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>FACE DETECTION</title>
</head>
<style>
body{
    margin:0;
}
.point{
    width: 3px;
    height: 3px;
    display: block;
    position: absolute;
    background-color: #f44336;
    border-radius: 3px;
}
</style>
<body>
<img src="<?php echo $image_path; ?>" alt="" sizes="" srcset="">

<?php
    foreach ($arr["responses"][0]["faceAnnotations"][0]["landmarks"] as $key => $value) {
        $x = $value["position"]["y"];
        $y = $value["position"]["x"];
        echo <<<EOF
    <div class="point" style="top:{$x}px; left: {$y}px;"></div>
EOF;
    }
?>

</body>
</html>