<?php
    include("include.php");

    if(!$is_manager){
        ShowAlertWithMove2Index("잘못된 접근입니다.");
    }
    else{
        $target = $_GET['target'];
        $mode = $_GET['mode'];

        $sql = null;

        switch($target){
            case "auth_code":
                if($mode == "all"){
                    $sql = "TRUNCATE auth_code";
                }
                else if($mode == "participant"){
                    $sql = "DELETE FROM auth_code WHERE is_manager = FALSE";
                }
                else if($mode == "manager"){
                    $sql = "DELETE FROM auth_code WHERE is_manager = TRUE";
                }
                else{
                    ShowAlertWithHistoryBack("잘못된 접근입니다.");
                }
                break;
            case "user_info":
                if($mode == "all"){
                    $sql = "DELETE FROM user_info WHERE is_superuser = FALSE";
                }
                else if($mode == "participant"){
                    $sql = "DELETE FROM user_info WHERE is_manager = FALSE";
                }
                else if($mode == "manager"){
                    $sql = "DELETE FROM user_info WHERE is_manager = TRUE AND is_superuser = FALSE";
                }
                else{
                    ShowAlertWithHistoryBack("잘못된 접근입니다.");
                }
                break;
            case "problem":
                if($mode == "all"){
                    $sql = "UPDATE problem SET setted = FALSE, solvers = ''";
                    mysqli_query($conn, $sql);
                    
                    $sql = "UPDATE hint SET viewers = ''";
                }
                else if($mode == "setted"){
                    $sql = "UPDATE problem SET setted = FALSE";
                }
                else if($mode == "solvers"){
                    $sql = "UPDATE problem SET solvers = ''";
                }
                else if($mode == "hint_viewers"){
                    $sql = "UPDATE hint SET viewers = ''";
                }
                else{
                    ShowAlertWithHistoryBack("잘못된 접근입니다.");
                }
                break;
            case "reset_ctf":
                $sql = "UPDATE user_info SET score = 0";
                mysqli_query($conn, $sql);
                
                $sql = "UPDATE logs SET solvers = '', viewers = ''";
                mysqli_query($conn, $sql);

                $sql = "UPDATE problem SET setted = 0";
                break;
            default:
                ShowAlertWithHistoryBack("잘못된 접근입니다.");
        }

        if($sql != null){
            mysqli_query($conn, $sql);
            ShowAlertWithMoveLocation("성공!", "/manager-pages/set_ctf.php");
        }
    }
?>