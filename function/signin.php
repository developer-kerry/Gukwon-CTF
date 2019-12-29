<?php
    include("include.php");

    $sql = "SELECT is_on_managersigning, is_on_participantsigning FROM contest_status";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) != 1){
        ShowAlertWithMove2Index("오류가 발생하였습니다.");
    }
    else{
        $row = mysqli_fetch_array($result);

        if($row[0] && $row[1]){
            ShowAlertWithMove2Index("가입 가능 기간이 아닙니다.");
        }
        else{
            $id = SecureStringProcess($conn, $_POST['id']);
            $nickname = SecureStringProcess($conn, $_POST['nickname']);
            
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
                    $pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);
                    $name = SecureStringProcess($conn, $_POST['name']);
                    $is_manager = $row[0];
        
                    $sql = "INSERT INTO user_info VALUES('$id', '$pwd_hash', '$name', '$nickname', 0, $is_manager, FALSE, NULL)";
                    mysqli_query($conn, $sql);
        
                    ShowAlert("가입 성공!");
                    MoveLocation("/login.php");
                }
            }
        }
    }
?>