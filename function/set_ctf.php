<?php
    include("include.php");

    if(!$is_manager){
        ShowAlertWithMove2Index("잘못된 접근입니다.");
    }
    else{
        if($_POST['mode'] == "set"){
            if(count($_POST['checkbox']) == 0){
                ShowAlertWithHistoryBack("아무 문제도 선택되지 않았습니다.");
            }
            else{
                $idx = SecureStringProcess($conn, $_POST['checkbox'][0]);
                $sql = "UPDATE problem SET setted = 1 WHERE idx = $idx";
                
                for($i = 1; $i < count($_POST['checkbox']); $i++){
                    $idx = SecureStringProcess($conn, $_POST['checkbox'][$i]);
                    $sql .= " OR idx = $idx";
                }
        
                mysqli_query($conn, $sql);
                ShowAlertWithHistoryBack("처리 성공!");
            }
        }
        else if($_POST['mode'] == "unset"){
            $idx = SecureStringProcess($conn, $_POST['idx']);
            $sql = "UPDATE problem SET setted = FALSE WHERE idx = $idx";
            mysqli_query($conn, $sql);
            ShowAlertWithHistoryBack("처리 성공!");
        }
        else{
            ShowAlertWithMove2Index("잘못된 접근입니다.");
        }
    }
?>