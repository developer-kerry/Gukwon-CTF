<?php
    include($_SERVER['DOCUMENT_ROOT']."/function/include.php");
?>
<html>
    <head>
        <meta charset="utf-8">
        <style>
            <?php
                include($_SERVER['DOCUMENT_ROOT']."/template/dynamic_css.php");
            ?>
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
                <form id="auth_form" action="/function/auth_problem.php">
                    <input type="text" id="flag_input" placeholder="&nbsp;Flag 입력">
                    <input type="submit" id="submit" value="Auth">
                </form>
            </div>
            <div class="plain_description">
                <h3>문제 리스트</h3>
                <div class="subject">
                    <h4>씨발</h4>
                    <div class="row_cell">
                        <div class="cell">
                            <strong class="prob_title">포너블이다 시발련들아</strong><br>
                            <span>점수</span><br>
                            <span>푼 사람</span>
                        </div>
                        <div class="cell">
                            2
                        </div>
                        <div class="cell">
                            3
                        </div>
                        <div class="cell">
                            4
                        </div>
                    </div>
                    <div class="row_cell">
                        <div class="cell">
                            1                        
                        </div>
                        <div class="cell">
                            2
                        </div>
                        <div class="cell">
                            3
                        </div>
                        <div class="cell">
                            4
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>