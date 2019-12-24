<?php
    include($_SERVER['DOCUMENT_ROOT']."/function/include.php");

    if(!$signed){
        ShowAlertWithMove2Index("잘못된 접근입니다.");
    }
?>
<html>
    <head>
        <meta charset="utf-8">
        <style>
            <?php
                include($_SERVER['DOCUMENT_ROOT']."/template/dynamic_css.php");
            ?>

            .menu .menu_link{
                margin-left:15px;
                text-decoration:none;
                color:black;
            }

            .menu .menu_link:hover{
                background-color:#D4D4D4;
            }

            .menu .menu_link:active{
                background-color:#9E9E9E;
            }

            .menu_description{
                margin-left:30px;
            }
        </style>
        <link rel="stylesheet" href="/style/master.css">
        <title>마이페이지</title>
    </head>
    <body>
        <div class="top_nav">
            <?php 
                include($_SERVER['DOCUMENT_ROOT']."/template/top_nav.php");
            ?>
        </div>
        <div class="description">
            <div class="plain_description">
                <div class="row_description">
                    <div class="row_wrap">
                        <h3>기본 정보</h3>
                        <?php
                            $nickname = htmlspecialchars($_SESSION['nickname']);
                            echo "<p>학번: $stdid<br>";
                            echo "닉네임: $nickname</p>";
                        ?>
                    </div>
                    <?php
                        echo file_get_contents($_SERVER['DOCUMENT_ROOT']."/template/manager_menu.html"); 
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>