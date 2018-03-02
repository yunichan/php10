<?php
  header('Content-Type: text/css; charset=utf-8');
  include_once( 'face.php' );
?>
.point{
    width: 3px;
    height: 3px;
    display: block;
    position: absolute;
    background-color: #f44336;
    border-radius: 3px;
}
body{
    background-image: url(<?php echo $image_path; ?>);
    position: absolute;
    width:500px;
    height:100%;
    background-size: 500px;
    background-repeat: no-repeat;
    margin:0;
}
