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
        </style>
        <link rel="stylesheet" href="/style/master.css">
        <link rel="stylesheet" href="/style/login.css">
        <title>로그인</title>
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
                    <h3>로그인</h3>
                    <?php if(isset($_GET['msg'])){ echo $msg; } ?>
                    <br>
                    <form action="/function/login.php" class="login_form" method="POST">
                        <input type="text" name="id" placeholder="아이디"><br>
                        <input type="password" name="pwd" placeholder="비밀번호"><br>
                        <input type="submit" value="로그인">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>