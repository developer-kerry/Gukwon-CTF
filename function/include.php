<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT']."/function/dbconn.php");

    $signed = false;

    if(isset($_SESSION['id']) && isset($_SESSION['pwd_hash']) && isset($_SESSION['nickname'])){
        $id = mysqli_real_escape_string($conn, $_SESSION['id']);
        $pwd_hash = mysqli_real_escape_string($conn, $_SESSION['pwd_hash']);
        $nickname = mysqli_real_escape_string($conn, $_SESSION['nickname']);

        $sql = "SELECT COUNT(*) FROM user_info WHERE id='$id' AND pwd_hash='$pwd_hash'";
        $num_row = mysqli_fetch_array(mysqli_query($conn, $sql))[0];

        if($num_row == 1){
            $signed = true;
        }
    }
?>