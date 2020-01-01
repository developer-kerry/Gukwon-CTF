<?php
    include("include.php");

    function AddProblem_Process($conn, $file, $title, $author, $description, $score, $flag, $answer, $category, $hint1, $hint2){
        $sql = "";
        $des_fname = null;

        if(isset($file) && $file['name'] != ""){
            $src_fname = $file['name'];
            $des_fname = md5(microtime());
            $des_path = $_SERVER['DOCUMENT_ROOT']."/files/$des_fname";
            
            if(move_uploaded_file($file['tmp_name'], $des_path)){
                $sql = "INSERT INTO upload_file VALUES('$src_fname', '$des_fname')";
                mysqli_query($conn, $sql);
            }
        }

        if($des_fname == null){
            $sql = "INSERT INTO problem(title, author, upload_datetime, description, score, flag, category, setted)
            VALUES('$title', '$author', NOW(), '$description', $score, '$flag', '$category', FALSE)";
        }
        else{
            $sql = "INSERT INTO problem(title, author, upload_datetime, description, score, flag, category, setted, attached_fname)
            VALUES('$title', '$author', NOW(), '$description', $score, '$flag', '$category', FALSE, '$des_fname')";
        }
       
        mysqli_query($conn, $sql);

        $sql = "SELECT idx FROM problem ORDER BY idx DESC LIMIT 1";
        $prob_idx = mysqli_fetch_array(mysqli_query($conn, $sql))[0];
        
        if($answer != null){
            $description .= "
                <br><br><br><br><br>
                <form action=\"/function/answer2flag.php\" method=\"POST\">
                    <input type=\"text\" name=\"answer\" id=\"answer\" placeholder=\"&nbsp;정답 입력\">
                    <input type=\"hidden\" name=\"prob_idx\" value=\"$prob_idx\">
                    <input type=\"submit\" id=\"submit\" value=\"제출\">
                </form>
            ";

            $sql = "UPDATE problem SET description = '$description' WHERE idx = $prob_idx";
            mysqli_query($conn, $sql);

            $sql = "INSERT INTO answer_flag VALUES($prob_idx, '$answer')";
            mysqli_query($conn, $sql);
        }

        $sql = "INSERT INTO hint VALUES($prob_idx, ";
        if($hint1 != ""){
            $sql .= "'$hint1', ";
            
            if($hint2 != ""){
                $sql .= "'$hint2')";
            }
            else{
                $sql .= "'')";
            }
            mysqli_query($conn, $sql);
        }
        else{
            $sql .= "'', '')";
        }

        $sql = "INSERT INTO logs VALUES($prob_idx, '', '')";
        mysqli_query($conn, $sql);

        ShowAlertWithHistoryBack("문제 등록 완료!");
    }

    function AddProblem($conn, $title, $author, $description, $score, $flag_type, $checkedValue, $textInput, $categoryValue, $textCategory, $hint1Value, $hint2Value, $file){
        $title = SecureStringProcess($conn, $title);
        $description = SecureStringProcess($conn, $description);
        $flag = null;
        $answer = null;
        $category = null;
        $hint1 = "";
        $hint2 = "";

        if(strlen($title) == 0 || strlen($description) == 0){
            ShowAlertWithHistoryBack("제목과 본문 확인 바랍니다.");
            return;
        }

        $sql = "SELECT COUNT(*) FROM problem WHERE title = '$title'";
        $num_title = mysqli_fetch_array(mysqli_query($conn, $sql))[0];

        if($num_title == 1){
            ShowAlertWithHistoryBack("제목이 같은 문제가 이미 존재합니다.");
            return;
        }

        if($flag_type == "auto"){
            $flag = "flag{".md5((string)rand().GetDatetime().(string)rand())."}";
            
            if($checkedValue == "true" && strlen($textInput) > 0){
                $answer = SecureStringProcess($conn, $textInput);
            }
            else if($checkedValue == "true"){
                ShowAlertWithHistoryBack("입력값 확인 바랍니다.");
                return;
            }
        }
        else{
            if(strlen($textInput) > 5){
                $flag = "flag{".SecureStringProcess($conn, $textInput)."}";
            }
            else{
                ShowAlertWithHistoryBack("Flag는 6자 이상이어야 합니다.");
                return;
            }
        }

        if($categoryValue == "manual_input"){
            if(strlen($textCategory) == 0){
                ShowAlertWithHistoryBack("카테고리 입력값 확인 바랍니다.");
                return;
            }
            $category = SecureStringProcess($conn, $textCategory);
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
        else if(strlen($hint1Value) == 0 && strlen($hint2Value) > 0){
            ShowAlertWithHistoryBack("입력값 확인 바랍니다.");
            return;
        }

        $flag = strtoupper($flag);
        $answer = strtoupper($answer);

        AddProblem_Process($conn, $file, $title, $author, $description, $score, $flag, $answer, $category, $hint1, $hint2);
    }

    if(!$is_manager){
        ShowAlertWithMove2Index("잘못된 접근입니다.");
    }
    else{
        if($_POST['mode'] == "add"){
            AddProblem(
                $conn,
                $_POST['prob_title'], 
                $nickname, 
                $_POST['prob_description'], 
                $_POST['score'], 
                $_POST['flag_type'], 
                isset($_POST['input2flag']), 
                $_POST['textInput'],
                $_POST['category'],
                $_POST['textCategory'],
                $_POST['hint1'], 
                $_POST['hint2'],
                $_FILES['attach']
            );
        }
        else if($_POST['mode'] == "delete"){
            if(count($_POST['checkbox']) == 0){
                ShowAlertWithHistoryBack("선택된 문제가 없습니다.");
            }
            else{
                $idx = SecureStringProcess($conn, $_POST['checkbox'][0]);
                $sql_select = "SELECT attached_fname AS fname FROM problem WHERE idx = $idx";
                $sql_delete = "DELETE prob, hint, logs, ans2flag FROM problem AS prob LEFT JOIN hint ON hint.prob_idx = prob.idx LEFT JOIN logs ON logs.prob_idx = prob.idx LEFT JOIN answer_flag AS ans2flag ON ans2flag.prob_idx = prob.idx WHERE prob.idx = $idx";
                    
                for($i = 1; $i < count($_POST['checkbox']); $i++){
                    $idx = SecureStringProcess($conn, $_POST['checkbox'][$i]);
                    $sql_select .= " OR idx = $idx";
                    $sql_delete .= " OR prob.idx = $idx";
                }
            
                $result = mysqli_query($conn, $sql_select);
                $fnames_to_delete = [];

                $del_fname = mysqli_fetch_assoc($result)['fname'];
                $sql_delete_from_uploaded = "DELETE FROM upload_file WHERE des_name = '$del_fname'";
                array_push($fnames_to_delete, $del_fname);

                while(($row = mysqli_fetch_assoc($result))){
                    $del_fname = $row['fname'];
                    array_push($fnames_to_delete, $del_fname);
                    $sql_delete_from_uploaded .= " OR des_name = '$del_fname'";
                }

                mysqli_query($conn, $sql_delete_from_prob);
                mysqli_query($conn, $sql_delete_from_uploaded);

                for($i = 0; $i < count($fnames_to_delete); $i++){
                    unlink($_SERVER['DOCUMENT_ROOT']."/files/".$fnames_to_delete[$i]);
                }

                ShowAlertWithHistoryBack("삭제 성공!");
            }
        }
    }
?>