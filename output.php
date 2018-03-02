<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    body{
        width: 100vw;
        height: 100vh;
        background-color: #b3b3b3;
        color: #fff;
        font-family: serif;
        margin: 0;
    }
    #wrapper{
        align-items: center;
        display: inline-flex;
        justify-content: space-evenly;
        width: 100vw;
        height: 100vh;
        flex-wrap: wrap;
    }
</style>
<body>
<div id="wrapper">

<?php
$name = $_POST["name"];
$path = $_POST["path"];
$page = $_POST["page"];

//入力した検索ワードをテキストファイルに書き出し
$fname=@fopen('name.txt', 'w')or die('Error');
fputs($fname,$name);
fclose($fname);

//入力した保存先のパスをテキストファイルに書き出し
$fpath=@fopen('path.txt', 'w')or die('Error');
fputs($fpath,$path);
fclose($fpath);

//入力したページ数をテキストファイルに書き出し
$fpage=@fopen('page.txt', 'w')or die('Error');
fputs($fpage,$page);
fclose($fpage);

/* python 実行 */
exec("/Users/yuni/anaconda/bin/python3.6 ./google_api.py 2>&1", $output, $return_var) ;
if($return_var === 0) {
    // foreach($output as $key => $val) {
    //     echo "return_var : ".$return_var."<br />" ;
    //     var_dump($output);
    // }
    $jsonurl = $path."/corr_table/corr_table.json";
    if(file_exists($jsonurl)){
        $json = file_get_contents($jsonurl);
        $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $obj = json_decode($json,true);
        foreach($obj as $key=>$val){
            echo "<img src='".$key."' width=200>";
        }
} else {
    echo "exec error : ".$return_var."<br />" ;
    var_dump($output);
}
}
?>

</div>
</body>
</html>
