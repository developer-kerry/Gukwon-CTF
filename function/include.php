<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT']."/function/dbconn.php");

    $is_manager = false;
    $is_on_contest = false;
    $signed = false;

    if(isset($_SESSION['token']) && isset($_SESSION['nickname'])){
        $token = mysqli_real_escape_string($conn, $_SESSION['token']);
        $nickname = mysqli_real_escape_string($conn, $_SESSION['nickname']);

        $sql = "UPDATE access_token SET expire_datetime=NOW() WHERE token='$token' AND nickname='$nickname'";
        mysqli_query($conn, $sql);
        $num_row = mysqli_affected_rows($conn);

        if($num_row == 1){
            $sql = "DELETE FROM access_token WHERE TIMESTAMPDIFF(minute, expire_datetime, NOW()) > 15";
            mysqli_query($conn, $sql);
            $sql = "SELECT is_manager, is_on_contest FROM access_token WHERE token='$token' AND nickname='$nickname'";
            $result = mysqli_fetch_array(mysqli_query($conn, $sql));

            $is_manager = $result[0];
            $is_on_contest = $result[1];
            $signed = true;
        }
    }
?>
