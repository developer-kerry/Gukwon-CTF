<?php
    include("include.php");

    if($is_superuser){
        $target = $_GET['target'];
        $handle = $_GET['handle'];
        $datetime = GetDatetime();
        $sql = null;
        $message = null;

        switch($target){
            case "signin":
                if($handle == "start_participant"){
                    $sql = "UPDATE contest_status SET is_on_managersigning = FALSE, is_on_participantsigning = TRUE";
                    $message = "처리 성공!";
                }
                else if($handle == "start_manager"){
                    $sql = "UPDATE contest_status SET is_on_managersigning = TRUE, is_on_participantsigning = FALSE";
                    $message = "처리 성공!";
                }
                else if($handle == "stop"){
                    $sql = "UPDATE contest_status SET is_on_managersigning = FALSE, is_on_participantsigning = FALSE";
                    $message = "처리 성공!";
                }
                else{
                    $message = "처리 실패";
                }
                break;
            case "contest":
                if($_GET['handle'] == "stop"){    
                    $sql = "UPDATE contest_status SET is_on_contest = FALSE";
                    $message = "대회가 종료되었습니다.\\n종료 시각: $datetime";
                }
                else if($_GET['handle'] == "start"){
                    $sql = "UPDATE contest_status SET is_on_managersigning = FALSE, is_on_participantsigning = FALSE";
                    mysqli_query($conn, $sql);

                    $sql = "UPDATE contest_status SET is_on_contest = TRUE, start_datetime = '$datetime'";
                    $message = "대회가 시작되었습니다!\\n시작 시각: $datetime";
                }
                else{
                    $message = "처리 실패";
                }
                break;
        }
        
        if($sql != null){
            mysqli_query($conn, $sql);
        }
        ShowAlertWithHistoryBack($message);
    }
    else{
        ShowAlertWithMove2Index("잘못된 접근입니다.");
    }
?>