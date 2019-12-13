<?php
    include("include.php");

    if(!$signed || !$is_on_contest){
        ShowAlertWithHistoryBack("잘못된 접근입니다.");
    }
    else{
        $flag = mysqli_real_escape_string($conn, $_POST['flag']);

        $sql = "SELECT score FROM problem WHERE flag='$flag'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1){
            $score = mysqli_fetch_array($result)[0];
            $sql = "UPDATE problem SET solvers = CONCAT(solvers, '$stdid,') WHERE flag='$flag' AND solver NOT LIKE '%$stdid%'";
            
            if(mysqli_affected_rows(mysqli_query($conn, $sql)) == 1){
                $sql = "UPDATE user_info SET score = score + $score WHERE stdid=$stdid";
                mysqli_query($conn, $sql);
            }
            else{
                ShowAlertWithHistoryBack("오류가 발생했습니다.");
            }
        }
        else{
            ShowAlertWithHistoryBack("오답입니다.");
        }
    }

?>