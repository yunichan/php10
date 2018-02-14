<?php

//APIキー
    $api_key = "AIzaSyA9MfZLrauaU-T9MYpJrIl46tNOVQtRJ7g";

    //リファラー
    //$referer = "各自設定してください";

    //画像へのパス
    $image_path = "./test.jpg";
	//test
	$img_data = base64_encode(file_get_contents($image_path));
	echo('<pre>');
	var_dump($img_data);
	echo('</pre>');
	
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
	echo('<pre>');
	var_dump($json);
	echo('</pre>');
	
    //APIアクセス
    $curl = curl_init();
    $a=curl_setopt($curl, CURLOPT_URL, "https://vision.googleapis.com/v1/images:annotate?key=" . $api_key);
	echo('<pre>');
	var_dump($a);
	echo('</pre>');
    $b=curl_setopt($curl, CURLOPT_HEADER, true); 
	echo('<pre>');
	var_dump($b);
	echo('</pre>');
    $c=curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
	echo('<pre>');
	var_dump($c);
	echo('</pre>');
    $d=curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
	echo('<pre>');
	var_dump($d);
	echo('</pre>');
    $e=curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	echo('<pre>');
	var_dump($e);
	echo('</pre>');
    $f=curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	echo('<pre>');
	var_dump($f);
	echo('</pre>');
    $g=curl_setopt($curl, CURLOPT_TIMEOUT, 15);
	echo('<pre>');
	var_dump($g);
	echo('</pre>');
    $h=curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
	echo('<pre>');
	var_dump($h);
	echo('</pre>');
    $res1 = curl_exec($curl);
	echo 'curl_exec check';
	echo curl_error($res1);
	$res2=curl_getinfo($curl);
    curl_close($curl);

    //データ取得
    $json = substr($res1, $res2["header_size"]);// 取得したJSON
    $header = substr($res1, 0, $res2["header_size"]);// レスポンスヘッダー

    //データ確認
    $arr = json_decode($json,true);
	var_dump($arr);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>test</title>

<style>
.point {
    width: 6px;
    height: 6px;
    display: block;
    position: absolute;
    background-color: red;
    border-radius: 3px;
}
</style>
</head>

<body>

<div style="background-image:url(./test.jpg); position: absolute; width:356px; height: 380px;">
<a href=""></a>
<?php
    foreach ($arr["responses"][0]["faceAnnotations"][0]["landmarks"] as $key => $value) {
        $x = $value["position"][y]-3;
        $y = $value["position"][x]-3;
        echo <<<EOF
<a href="" class="point" style="top:{$x}px; left: {$y}px;"></a>
EOF;
    }
?>

</div>

</body>
</html>
