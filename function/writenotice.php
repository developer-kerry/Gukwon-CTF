<?php
    include("./include.php");
    
    if(!$is_manager){
        ShowAlert("잘못된 접근입니다.");
    }
    else if(empty($_POST['title']) || empty($_POST['description'])){
        ShowAlert("빈칸이 있습니다.");
    }
    else{
        $title = mysqli_real_escape_string($conn, htmlspecialchars($_POST['title']));
        $description = mysqli_real_escape_string($conn, nl2br(htmlspecialchars($_POST['description'])));
        $author = $nickname;

        $sql = "INSERT INTO notice(title, author, upload_datetime, description) VALUES('$title', '$author', NOW(), '$description')";
        mysqli_query($conn, $sql);

        MoveLocation("/notice.php");
    }
?>