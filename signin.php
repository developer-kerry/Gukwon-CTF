<?php
    include($_SERVER['DOCUMENT_ROOT']."/function/include.php");

    $sql = "SELECT is_on_managersigning, is_on_participantsigning FROM contest_status";
    $row = mysqli_fetch_array(mysqli_query($conn, $sql));
    

    if($row[0] && $row[1]){
        ShowAlertWithHistoryBack("회원가입 가능 기간이 아닙니다.");
    }
?>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/style/master.css">
        <link rel="stylesheet" href="/style/signin.css">
        <title>참가 등록</title>
    </head>
    <body>
        <div class="top_nav">
            <?php 
                echo file_get_contents($_SERVER['DOCUMENT_ROOT']."/template/top_nav_left.html");
                echo file_get_contents($_SERVER['DOCUMENT_ROOT']."/template/top_nav_right_none_signed.html");
            ?>
        </div>
        <div class="description">
            <div class="plain_description">
                <div class="row_wrap">
                    <?php
                        if($row[0]){
                            echo "<h3>관리자 등록</h3>";
                        }
                        else{
                            echo "<h3>참가자 등록</h3>";
                        }
                    ?>
                    <form action="/function/signin.php" class="signin_form" method="POST">
                        <input type="text" name="id" placeholder="아이디"><br>
                        <input type="password" name="pwd" placeholder="비밀번호"><br>
                        <input type="password" name="pwd_chk" placeholder="비밀번호 확인"><br>
                        <br>
                        <input type="text" name="nickname" placeholder="닉네임"><br>
                        <input type="text" name="name" placeholder="실명"><br>
                        <input type="number" name="stdid" placeholder="학번"><br>
                        <input type="submit" value="등록">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>