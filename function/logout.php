<?php
    session_start();
    session_destroy();

    $location = $_SERVER['DOCUMENT_ROOT']."/index.php";
    header("Location:$location");
?>