<?php
    if(!$signed){
        ShowAlertWithHistoryBack("뭐하는 거죠? ^^...");
    }
    else{
        $flag = SecureStringProcess($conn, strtoupper($flag));

        $sql = "SELECT prob.idx, prob.score, prob.setted, logs.solvers, logs.viewers FROM problem as prob LEFT JOIN logs ON idx = prob_idx WHERE flag = '$flag'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            $solvers = $row['solvers'];

            if($row['setted'] && substr_count($solvers, $nickname) == 0){
                $prob_idx = $row['idx'];
                $score = $row['score'];
                $hint_viewers = $row['viewers'];

                if(substr_count($hint_viewers, "$nickname-hint1/") == 1){
                    $score /= 2;
                    if(substr_count($hint_viewers, "$nickname-hint2/") == 1){
                        $score /= 2;
                    }
                }

                $sql = "UPDATE user_info SET score = score + $score, last_auth = NOW()";
                mysqli_query($conn, $sql);

                $sql = "UPDATE logs SET solvers=CONCAT(solvers, '$nickname/')";
                mysqli_query($conn, $sql);

                ShowAlertWithHistoryBack("정답입니다!");
            }
            else{
                ShowAlertWithHistoryBack("잘못된 접근입니다.");
            }
        }
        else{
            ShowAlertWithHistoryBack("정답이 아닙니다.");
        }
    }
?>