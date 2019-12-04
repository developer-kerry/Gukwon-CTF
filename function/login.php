<?php
    include("include.php");

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    $sql = "SELECT COUNT(*) as cnt, nickname FROM user_info WHERE id='$id'";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    $nickname = $result['nickname'];
    $hash_seed = ((string)rand()).$nickname.((string)rand());
    $token = hash("sha512", $hash_seed);

    $sql = "INSERT INTO access_token VALUES('$token', '$nickname', NOW())";
    mysqli_query($conn, $sql);

    if($result['cnt'] == 1 && password_verify($pwd, $result['pwd_hash'])){
        session_destroy();
        session_start();

        $_SESSION['token'] = $result['token'];
        $_SESSION['nickname'] = $result['nickname'];

        $location = $_SERVER['DOCUMENT_ROOT']."/index.php";
        header("Location:$location");
    }
    else{
        session_destroy();
        echo "<script>alert('로그인 정보가 틀립니다.');history.back();</script>";
    }
?>