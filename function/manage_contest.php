<?php
    include("include.php");

    if($is_manager){
        $sql = "TRUNCATE contest_status";
        mysqli_query($conn, $sql);

        $datetime = GetDatetime();

        if($_GET['handle'] == "stop" && $is_on_contest){    
            $sql = "INSERT INTO contest_status VALUES(FALSE, NOW())";
            mysqli_query($conn, $sql);
            ShowAlertWithHistoryBack("대회가 종료되었습니다.\\n시각: $datetime");
        }
        else if($_GET['handle'] == "start" && !$is_on_contest){
            $sql = "INSERT INTO contest_status VALUES(TRUE, NOW())";
            mysqli_query($conn, $sql);
            ShowAlertWithHistoryBack("대회가 시작되었습니다!\\n시각: $datetime");
        }
        else{
            ShowAlertWithHistoryBack("잘못된 접근입니다.");
        }
    }
    else{
        ShowAlertWithMove2Index("잘못된 접근입니다.");
    }
?>