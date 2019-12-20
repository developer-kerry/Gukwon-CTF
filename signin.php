<html>
    <head>
        <meta charset="utf-8">
        <style>
            .top_nav{ 
                background-color:#F0F0F0;
            }
            
            .button a:hover{
                background-color:#D4D4D4;
            }
            
            .button a:active{
                background-color:#9E9E9E;
            }

            .row_wrap .signin_form input{
                width:200px;
                margin-left:30px;
            }
        </style>
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
                    <h3>참가자 등록</h3>
                    <form action="/function/signin.php" class="signin_form" method="POST">
                        <input type="text" name="nickname" placeholder="닉네임"><br>
                        <input type="text" name="id" placeholder="아이디"><br>
                        <input type="password" name="pwd" placeholder="비밀번호"><br>
                        <input type="password" name="pwd_chk" placeholder="비밀번호 확인"><br>
                        <br>
                        <input type="number" name="stdid" placeholder="학번(nnnn)"><br>
                        <input type="password" name="auth_code" placeholder="인증번호(6자리)"><br>
                        <input type="submit" value="등록">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>