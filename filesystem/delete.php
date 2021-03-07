<?php
    extract($_POST);
    unlink($g);
    // unlink（）刪除文件 
    header("location:index.php");

?>