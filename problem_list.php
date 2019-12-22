<?php
    include($_SERVER['DOCUMENT_ROOT']."/function/include.php");
    include($_SERVER['DOCUMENT_ROOT']."/function/problem_list.php");
    /* On Production
    if(!$is_on_contest){
        ShowAlertWithMove2Index("대회 진행중이 아닙니다.");
    }
    */
?>
<html>
    <head>
        <meta charset="utf-8">
        <style>
            <?php
                include($_SERVER['DOCUMENT_ROOT']."/template/dynamic_css.php");
            ?>

            #flag_input{
                width:400px;
                height:30px;
            }

            #submit{
                width:50px;
                height:30px;
            }

            #auth_form{
                width:460px;
                margin-left:auto;
                margin-right:auto;
                padding-bottom:25px;
            }

            .function{
                border-bottom:1px solid #CECECE;
                margin-bottom:30px;
            }            
        </style>
        <link rel="stylesheet" href="/style/master.css">
        <link rel="stylesheet" href="/style/problem_list.css">
        <title>문제 풀기</title>
    </head>
    <body>
        <div class="top_nav">
            <?php 
                include($_SERVER['DOCUMENT_ROOT']."/template/top_nav.php");
            ?>
        </div>
        <div class="description">
            <div class="function">
                <br>
                <form id="auth_form" action="/function/auth_problem.php" method="POST">
                    <input type="text" id="flag_input" name="flag" placeholder="&nbsp;Flag 입력">
                    <input type="submit" id="submit" value="Auth">
                </form>
            </div>
            <div class="plain_description">
                <h3>문제 리스트</h3>
                <?php
                    ProblemGrid::Print($conn, $stdid);
                ?>
            </div>
        </div>
    </body>
</html>