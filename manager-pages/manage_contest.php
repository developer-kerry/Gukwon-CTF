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
        <title>대회 진행상황 관리</title>
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
                        <h3>대회 상태 관리</h3>
                        <p>
                            <?php
                                if($is_on_contest){
                                    echo "<strong>대회가 현재 진행중입니다.<br>시작 시간: $start_datetime</strong><br><br>";
                                    echo "<button onclick=\"location.href='/function/manage_contest.php?handle=stop';\">대회 중지</button>";
                                }
                                else{
                                    echo "<strong>현재 대회 진행중이 아닙니다.</strong>&nbsp;->&nbsp;";
                                    echo "<button onclick=\"location.href='/function/manage_contest.php?handle=start';\">대회 시작</button>";
                                }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>