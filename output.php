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
        background-color: rgb(244, 210, 193);
    }
    form{
        border: none;
    }
    #loader-bg {
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0px;
        left: 0px;
        background: #000;
        z-index: 1;
      }
      #loader {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        width: 200px;
        height: 200px;
        margin-top: -100px;
        margin-left: -100px;
        text-align: center;
        color: #fff;
        z-index: 2;
      }
</style>
<body>
<div id="wrap">

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
exec("/Users/yuni/anaconda/bin/python3.6 /Applications/XAMPP/xamppfiles/htdocs/gsac/php10/work/google_api.py 2>&1", $output, $return_var) ;
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
            echo "<img src='".$key."'>";
        }
} else {
    echo "exec error : ".$return_var."<br />" ;
    var_dump($output);
}
}
?>

</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(function() {
  var h = $(window).height();
 
  $('#wrap').css('display','none');
  $('#loader-bg ,#loader').height(h).css('display','block');
});
 
$(window).load(function () { //全ての読み込みが完了したら実行
  $('#loader-bg').delay(900).fadeOut(800);
  $('#loader').delay(600).fadeOut(300);
  $('#wrap').css('display', 'block');
});
</script>
</body>
</html>