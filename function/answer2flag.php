<?php
    include("include.php");

    if($is_signed && $is_on_contest){
        $prob_idx = SecureStringProcess($conn, $_POST['prob_idx']);
        $sql = "SELECT prob.flag, ans2flag.answer FROM problem AS prob LEFT JOIN answer_flag AS ans2flag ON prob.idx = ans2flag.prob_idx WHERE idx = $prob_idx";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 0){
            $row = mysqli_fetch_assoc($result);

            if($row['answer'] == $_POST['answer']){
                $flag = $row['flag'];
                echo "
                    $flag<br>
                    <button onclick=\"history.back();\">뒤로가기</button>
                ";
            }
            else{
                ShowAlertWithHistoryBack("정답이 아닙니다.");
            }
        }
        else{
            ShowAlertWithHistoryBack("잘못된 접근입니다.");
        }
    }
    else{
        ShowAlertWithHistoryBack("잘못된 접근입니다.");
    }
?>