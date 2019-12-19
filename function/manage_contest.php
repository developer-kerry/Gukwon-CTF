<?php
    include("include.php");

    if($_GET['handle'] == "stop" && $is_on_contest){

    }
    else if($_GET['handle'] == "start" && !$is_on_contest){
        $sql = "TRUNCATE contest_status";
        mysqli_query($conn, $sql);
        $sql = "INSERT INTO contest_status VALUES(TRUE, NOW())";
        mysqli_query($conn, $sql);
        // HistoryBack();
    }
    else{
        ShowAlertWithHistoryBack("잘못된 접근입니다.");
    }
?>