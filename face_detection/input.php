<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>face detection</title>
</head>
<style>
    body{
        width: 100vw;
        height: 100vh;
        color: #fff;
        font-family: serif;
        background-image: url(img2.jpg);
        background-size:cover;
        margin: 0;
        background-color: #b3b3b3;
    }
    #wrapper{
        align-items: center;
        display: inline-flex;
        flex-direction: column;
        justify-content: center;
        width: 100vw;
        height: 100vh;
    }
    form{
        border: none;
        align-items: left;
        justify-content: center;
        resize: none;
        flex-direction: column;
        display: flex;
    }
    textarea{
        border: none;
        resize: none;     
        margin: auto;
        color: #777676;
        width:320px;
        height: 30px;
        font-size: 20px;
    }
    input{
        border-radius: 0;
        -webkit-box-sizing: content-box;
        border: none;
        box-sizing: border-box;
        cursor: pointer;
        color: #929292;
        display: inline-block;
        margin: auto;
    }
    #submit_btn{
        width: 10vw;
        height: 5vh;
        font-family: serif;    
        transition: 1s;
        margin-top: 10px;
        margin-bottom: 50px;
    }
    #submit_btn:hover{
        width: 10vw;
        height: 5vh;
        font-family: serif;
        color: #fff;
        background-color: #565656;
        border-radius: 50px;
    }

    select {
        color: #929292;
        margin-bottom: 10px;
        margin: auto;
        width: 50px;
        height: 25px;
    }
    h1{
        font-family: serif;
        text-align: center;
    }
    #form_name{
        margin: auto;
        display: block;
        width: 320px;
    }
</style>
<body>
<div id="wrapper">
<h1>face detection</h1>
    <form action="file_up.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="upfile" id="">
        <input type="submit" id=submit_btn value="submit">
    </form>
</div>

</body>
</html>
