<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT']."/function/dbconn.php");

    function ShowAlert($msg){
        echo "<script>alert(\"$msg\");</script>";
    }

    function ShowAlertWithHistoryBack($msg){
        ShowAlert($msg);
        echo "<script>history.back();</script>";
    }

    function MoveLocation($location){
        echo "<script>location.href='$location';</script>";
    }

    $stdid = -1;
    $is_manager = false;
    $is_on_contest = false;
    $signed = false;

    $sql = "DELETE FROM access_token WHERE TIMESTAMPDIFF(minute, expire_datetime, NOW()) > 15";
    mysqli_query($conn, $sql);

    if(isset($_SESSION['token']) && isset($_SESSION['nickname'])){
        $token = mysqli_real_escape_string($conn, $_SESSION['token']);
        $nickname = mysqli_real_escape_string($conn, $_SESSION['nickname']);

        $sql = "UPDATE access_token SET expire_datetime=NOW() WHERE token='$token' AND nickname='$nickname'";
        mysqli_query($conn, $sql);
        $num_row = mysqli_affected_rows($conn);

        if($num_row == 1){
            $sql = "SELECT stdid, is_manager, is_on_contest FROM access_token WHERE token='$token' AND nickname='$nickname'";
            $result = mysqli_fetch_array(mysqli_query($conn, $sql));

            $stdid = $result[0];
            $is_manager = $result[1];
            $is_on_contest = $result[2];
            $signed = true;
        }
        else{
            ShowAlert("15분간 활동이 없어 세션이 만료되었습니다. 다시 로그인해주세요.");
            session_destroy();
        }
    }
?>
