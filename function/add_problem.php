<?php
    include("include.php");

    if($signed && $is_manager){
        $title = mysqli_real_escape_string($conn, htmlspecialchars($_POST['prob_title']));
        $description = mysqli_real_escape_string($conn, htmlspecialchars(nl2br($_POST['prob_description'])));
        $score = $_POST['score'];
        $flag = null;
        $isAnswerRequired = false;

        $not_return = true; 

        if(strlen($title) > 0 || strlen($description) > 0 || is_int($score)){
            if($_POST['radio'] == "auto"){
                $flag = md5((string)rand().GetDatetime().(string)rand());
                
                if($_POST['input2flag'] == "true" && strlen($_POST['textInput']) > 0){
                    $isAnswerRequired = true;
                }
                else{
                    ShowAlertWithHistoryBack("정답 값이 비어있습니다. 확인 바랍니다.");
                    $not_return = false;
                }
            }
            else if($_POST['radio'] == "manual" && strlen($_POST['textInput']) > 8){
                $flag = mysqli_real_escape_string($conn, htmlspecialchars($_POST['textInput']));
            }
            else{
                ShowAlertWithHistoryBack("입력값 재확인 바랍니다.\\nflag의 길이는 9자 이상이어야 합니다.");
                $not_return = false;
            }

            $hint1 = null;
            $hint2 = null;
            
            $hint1_length = strlen($_POST['hint1']);
            $hint2_length = strlen($_POST['hint2']);

            if($not_return && $hint1_length > 0 && $hint2_length == 0){
                $hint1 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['hint1']));
                $hint2 = "";
            }
            else if($not_return && $hint1_length > 0 && $hint2_length > 0){
                $hint1 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['hint1']));
                $hint2 = mysqli_real_escape_string($conn, htmlspecialchars($_POST{'hint2'}));
            }
            else{
                ShowAlertWithHistoryBack("힌트 입력 상태를 다시 확인해 주세요.");
                $not_return = false;
            }

            if($not_return && !$isAnswerRequired){
                $description .= "
                    <br><br><br><br><br>
                    <form action=\"/function/answer2flag.php\" method=\"POST\">
                        <input type=\"text\" name=\"answer\" id=\"answer\" placeholder=\"정답 입력\">
                        <input type=\"submit\" id=\"submit\">
                    </form>
                ";
            }
            
            if($not_return){
                $sql = "INSERT INTO problem(title, author, upload_datetime, description, score, flag, solvers, category, hint1, hint2, setted)
                        VALUES('$title', '$nickname', NOW(), '$description', $score, '$flag', '', '')";
                // 문제 출제 페이지에서 카테고리 선택 가능토록 
            }
        }
        else{
            ShowAlertWithHistoryBack("입력값 재확인 바랍니다.");
        }
    }
    else{
        ShowAlertWithHistoryBack("권한이 없습니다.");
    }
?>