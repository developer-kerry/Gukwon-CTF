<?php
    include("include.php");

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    $sql = "SELECT COUNT(*) as cnt, pwd_hash, nickname FROM user_info WHERE id='$id'";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    if($result['cnt'] == 1 && password_verify($pwd, $result['pwd_hash'])){
        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['pwd_hash'] = $result['pwd_hash'];
        $_SESSION['nickname'] = $result['nickname'];

        $location = $_SERVER['DOCUMENT_ROOT']."/index.php";
        header("Location:$location");
    }
    else{
        echo "<script>alert('로그인 정보가 틀립니다.');history.back();</script>";
    }
?>