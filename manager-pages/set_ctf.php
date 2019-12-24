<?php
    include($_SERVER['DOCUMENT_ROOT']."/function/include.php");

    if(!$is_manager){
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
        </style>
        <link rel="stylesheet" href="/style/master.css">
        <link rel="stylesheet" href="/style/mypage.css">
        <title>문제 출제</title>
    </head>
    <body>
        <div class="top_nav">
            <?php 
                include($_SERVER['DOCUMENT_ROOT']."/template/top_nav.php");
            ?>
        </div>
        <div class="description">
            <div class="plain_description">
                <h3>현재 출제된 문제들</h3>
                <?php
                    ProblemGrid::Print($conn, $stdid, "view");
                ?>
            </div>
        </div>
    </body>
</html>