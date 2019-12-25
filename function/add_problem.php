<?php
    include("include.php");

    function AddProblem_Process($conn, $title, $author, $description, $score, $flag, $answer, $category, $hint1, $hint2){
        $sql = "INSERT INTO problem(title, author, upload_datetime, description, score, flag, solvers, category, setted)
                VALUES($title, $author, NOW(), $description, $score, $flag, '', $category, FALSE)";
        mysqli_query($conn, $sql);

        $sql = "SELECT idx FROM problem ORDER BY idx DESC LIMIT 1";
        $prob_idx = mysqli_fetch_array(mysqli_query($conn, $sql))[0];
        
        if($answer != null){
            $description .= "
                <br><br><br><br><br>
                <form action=\"/function/\" method=\"POST\">
                    <input type=\"text\" name=\"answer\" id=\"answer\" placeholder=\"&nbsp;정답 입력\">
                    <input type=\"hidden\" name=\"prob_title\" value=\"$title\">
                    <input type=\"submit\" id=\"submit\" value=\"제출\">
                </form>
            ";

            $sql = "UPDATE problem SET description = '$description' WHERE idx=$prob_idx";
            mysqli_query($conn, $sql);
        }
        
        $sql = "INSERT INTO answer_flag VALUES($prob_idx, '$answer')";
        mysqli_query($conn, $sql);

        

        if($hint1 != ""){
            $sql = "INSERT INTO hint VALUES($prob_idx, '$hint1', 0, '')";
            
            if($hint2 != ""){
                $sql .= ", ($prob_idx, '$hint2', 1, '')";
            }
            mysqli_query($conn, $sql);
        }

        ShowAlertWithMoveLocation("문제 등록 완료!", "/manager-pages/add_problem.php");
    }

    function AddProblem($conn, $title, $author, $description, $score, $flag_type, $checkedValue, $textInput, $categoryValue, $hint1Value, $hint2Value){
        $title = SecureStringProcess($conn, $title);
        $description = SecureStringProcess($conn, $description);
        $flag = null;
        $answer = null;
        $category = null;
        $hint1 = "";
        $hint2 = "";

        if($flag_type == "auto"){
            $flag = md5((string)rand().GetDatetime().(string)rand());
            
            if($checkedValue == "true"){
                $answer = SecureStringProcess($conn, $textInput);
            }
        }
        else{
            if(strlen($textInput) > 8){
                $flag = SecureStringProcess($conn, $textInput);
            }
            else{
                ShowAlertWithHistoryBack("Flag는 9자 이상이어야 합니다.");
                return;
            }
        }

        if($categoryValue == "manual_input"){
            $category = SecureStringProcess($conn, $textInput);
        }
        else{
            $category = SecureStringProcess($conn, $categoryValue);
        }

        if(strlen($hint1Value) > 0 && strlen($hint2Value) == 0){
            $hint1 = SecureStringProcess($conn, $hint1Value);
        }
        else if(strlen($hint1Value) > 0 && strlen($hint2Value) > 0){
            $hint1 = SecureStringProcess($conn, $hint1Value);
            $hint2 = SecureStringProcess($conn, $hint2Value);
        }
        else{
            ShowAlertWithHistoryBack("입력값 확인 바랍니다.");
            return;
        }

        AddProblem_Process($conn, $title, $author, $description, $score, $flag, $answer, $category, $hint1, $hint2);
    }

    AddProblem(
        $conn,
        $_POST['title'], 
        $nickname, 
        $_POST['description'], 
        $_POST['score'], 
        $_POST['flag_type'], 
        $_POST['input2flag'], 
        $_POST['textInput'],
        $_POST['category'],
        $_POST['hint1'], 
        $_POST['hint2']
    );
?>