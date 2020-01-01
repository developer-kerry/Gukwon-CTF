<?php
    include("include.php");

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    $sql = "SELECT name, nickname, stdid, pwd_hash AS hsh, is_manager AS manager, is_superuser AS superuser FROM user_info WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    $cnt_rows = mysqli_num_rows($result);
    $result = mysqli_fetch_assoc($result);

    if($cnt_rows == 1 && password_verify($pwd, $result['hsh'])){
        $name = $result['name'];
        $nickname = $result['nickname'];
        $stdid = $result['stdid'];
        $hash_seed = ((string)(rand() - $stdid)).$nickname.((string)(rand() + $stdid));
        $token = hash("sha1", $hash_seed);
        $is_manager = $result['manager'];
        $is_superuser = $result['superuser'];
        
        $sql = "INSERT INTO access_token VALUES('$token', '$name', '$nickname', $stdid, NOW(), $is_manager, $is_superuser)";
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