<?php
    include("include.php");

    $id = mysqli_real_escape_string($conn, htmlspecialchars($_POST['id']));
    $nickname = mysqli_real_escape_string($conn, htmlspecialchars($_POST['nickname']));
    
    $cnt_id = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM user_info WHERE id='$id'"))[0];
    $cnt_nickname = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM user_info WHERE nickname='$nickname'"))[0];

    if($cnt_nickname > 0){
        ShowAlertWithHistoryBack('이미 존재하는 닉네임입니다.');
    }
    else if($cnt_id > 0){
        ShowAlertWithHistoryBack('이미 존재하는 아이디입니다.');
    }
    else{
        $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
        $pwd_chk = mysqli_real_escape_string($conn, $_POST['pwd_chk']);

        if(strlen($pwd) < 9){
            ShowAlertWithHistoryBack('비밀번호는 9자리 이상이어야 합니다.');
        }
        else if($pwd != $pwd_chk){
            ShowAlertWithHistoryBack('비밀번호를 다시 확인해주세요.');
        }
        else{
            $stdid = mysqli_real_escape_string($conn, htmlspecialchars($_POST['stdid']));
            $auth_code = mysqli_real_escape_string($conn, $_POST['auth_code']);

            $sql = "SELECT COUNT(*), is_manager, is_superuser FROM auth_code WHERE code='$auth_code' AND stdid=$stdid";
            $result = mysqli_fetch_array(mysqli_query($conn, $sql));

            if($result[0] == 0){
                ShowAlertWithHistoryBack('인증번호와 학번을 다시 확인해주세요.');
            }
            else{
                $pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);
                $is_manager = (int)$result[1];
                $is_superuser = (int)$result[2]; 

                $sql = "DELETE FROM auth_code WHERE stdid=$stdid";
                mysqli_query($conn, $sql);

                $sql = "INSERT INTO user_info VALUES('$id', '$pwd_hash', '$nickname', $stdid, 0, $is_manager, $is_superuser, NULL)";
                mysqli_query($conn, $sql);

                ShowAlert("가입 성공!");
                MoveLocation("/login.php");
            }
        }
    }
?>