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
                <div class="row_wrap">
                    <h3>현재 출제된 문제들</h3>
                    <?php
                        ProblemGrid::Print($conn, $stdid, "view");
                    ?>
                </div>
                <div class="row_wrap">
                    <h3>문제 리스트</h3>
                    <table>
                        <thead>
                            <th id="idx">idx</th>
                            <th id="title">제목</th>
                            <th id="category">분류</th>
                            <th id="score">점수</th>
                            <th id="success_ratio">정답률</th>
                            <th id="idx">출제하기</th>
                        </thead>
                        <!-- Tbody 그려라... -->
                        <!-- 정답률 삭제,,,,,, -->
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>