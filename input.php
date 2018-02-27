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
        display: flex;
        justify-content: center;
        align-items: center;
    }
    form{
        border: none;
        align-items: center;
        justify-content: center;
        resize: none;     
    }
</style>
<body>
    <form action="test.php" method="POST">
        <div>検索ワード</div><textarea name="name" id="" cols="50" rows="2"></textarea>
        <div>保存フォルダ名</div><textarea name="path" id="" cols="50" rows="2"></textarea>
        <div>検索ページ数</div>
        <select name="page" id="">
            <option value="1">1</option>
            <option value="2">5</option>
            <option value="3">10</option>
        </select>
        <input type="submit">
    </form>

</body>
</html>
