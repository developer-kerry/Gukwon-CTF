<?php
    include("include.php");

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    $sql = "SELECT nickname, stdid, pwd_hash AS hsh, is_manager AS manager FROM user_info WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    $cnt_rows = mysqli_num_rows($result);
    $result = mysqli_fetch_assoc($result);

    if($cnt_rows == 1 && password_verify($pwd, $result['hsh'])){
        $nickname = $result['nickname'];
        $stdid = $result['stdid'];
        $hash_seed = ((string)rand()).$nickname.((string)rand());
        $token = hash("sha512", $hash_seed);
        $is_manager = $result['manager'];
        
        $sql = "INSERT INTO access_token VALUES('$token', $stdid,'$nickname', NOW(), $is_manager)";
        mysqli_query($conn, $sql);

        $_SESSION['token'] = $token;
        $_SESSION['nickname'] = $nickname;

        MoveLocation("/index.php");
    }
    else{
        session_destroy();
        ShowAlertWithHistoryBack("로그인 정보가 잘못되었습니다.");
    }
?>