<?php

//APIキー
    $api_key = "AIzaSyA9MfZLrauaU-T9MYpJrIl46tNOVQtRJ7g";

    //リファラー
    //$referer = "各自設定してください";

    //画像へのパス
    $image_path = "image/nana1.jpg";

	
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>FACE DETECTION</title>
    <link rel="stylesheet" type="text/css" href="face_style.php" />
</head>
<style>
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
<div></div>

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
