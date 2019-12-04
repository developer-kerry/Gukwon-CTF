<?php
    include("include.php");

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $nickname = mysqli_real_escape_string($conn, $_POST['nickname']);
    
    $cnt_id = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM user_info WHERE id='$id'"))[0];
    $cnt_nickname = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM user_info WHERE nickname='$nickname'"))[0];

    if($cnt_nickname > 0){
        echo "<script>alert('이미 존재하는 닉네임입니다.');history.back();</script>";
    }
    else if($cnt_id > 0){
        echo "<script>alert('이미 존재하는 아이디입니다.');history.back();</script>";
    }
    else{
        $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
        $pwd_chk = mysqli_real_escape_string($conn, $_POST['pwd_chk']);

        if(strlen($pwd) < 9){
            echo "<script>alert('비밀번호는 9자리 이상이어야 합니다.');history.back();</script>";
        }
        else if($pwd != $pwd_chk){
            echo "<script>alert('비밀번호를 다시 확인해주세요.');history.back();</script>";
        }
        else{
            $stdid = mysqli_real_escape_string($conn, $_POST['stdid']);
            $auth_code = mysqli_real_escape_string($conn, $_POST['auth_code']);

            $sql = "SELECT COUNT(*), is_manager, is_superuser FROM auth_code WHERE code='$auth_code' AND stdid=$stdid";
            $result = mysqli_fetch_array(mysqli_query($conn, $sql));

            if($result[0] == 0){
                echo "<script>alert('인증번호와 학번을 다시 확인해주세요.');history.back();</script>";
            }
            else{
                $pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);
                $is_manager = (int)$result[1];
                $is_superuser = (int)$result[2]; 

                $sql = "DELETE FROM auth_code WHERE stdid=$stdid";
                mysqli_query($conn, $sql);

                $sql = "INSERT INTO user_info VALUES('$id', '$pwd_hash', '$nickname', $stdid, 0, $is_manager, $is_superuser, 0)";
                mysqli_query($conn, $sql);

                echo "<script>alert('가입 성공!');location.href='/login.php';</script>";
            }
        }   
    }
?>