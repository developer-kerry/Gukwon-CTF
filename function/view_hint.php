<?php
    include("include.php");

    $prob_idx = SecureStringProcess($conn, $_POST['prob_idx']);
    $hint_type = SecureStringProcess($conn, $_POST['hint_type']);

    $sql = "SELECT viewers FROM logs WHERE prob_idx = $prob_idx";
    $viewers = mysqli_fetch_array(mysqli_query($conn, $sql))[0];
    $viewer_cnt = substr_count($viewers, "$stdid-$hint_type");

    if($viewer_cnt == 0){
        $sql = "UPDATE logs SET viewers = CONCAT(viewers, '$nickname-$hint_type') WHERE prob_idx = $prob_idx";
        mysqli_query($conn, $sql);
        ShowAlertWithHistoryBack("힌트가 열렸습니다!");
    }
    else{
        ShowAlertWithHistoryBack("잘못된 접근입니다.");
    }
?>