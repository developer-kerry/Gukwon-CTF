<?php
    include($_SERVER['DOCUMENT_ROOT']."/function/include.php");

    if(!$is_superuser){
        ShowAlertWithMove2Index("최고 권한 관리자만 접근 가능합니다.");
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
                        <h3>가입 허용/비허용 관리</h3>
                        <p>
                            <?php
                                $sql = "SELECT is_on_managersigning, is_on_participantsigning FROM contest_status";
                                $row = mysqli_fetch_array(mysqli_query($conn, $sql));

                                if($row[0]){
                                    echo "
                                        <strong>현재 관리자 회원가입 기간입니다.</strong><br><br>
                                        <button onclick=\"location.href='/function/manage_contest.php?target=signin&handle=start_participant';\">참가자 회원가입 기간으로</button>
                                        <button onclick=\"location.href='/function/manage_contest.php?target=signin&handle=stop';\">회원가입 중단</button>
                                    ";
                                }
                                else if($row[1]){
                                    echo "
                                        <strong>현재 참가자 회원가입 기간입니다.</strong><br><br>
                                        <button onclick=\"location.href='/function/manage_contest.php?target=signin&handle=start_manager';\">관리자 회원가입 기간으로</button>
                                        <button onclick=\"location.href='/function/manage_contest.php?target=signin&handle=stop';\">회원가입 중단</button>
                                    ";
                                }
                                else{
                                    echo "
                                        <strong>현재 회원가입 중단 기간입니다.</strong><br><br>
                                        <button onclick=\"location.href='/function/manage_contest.php?target=signin&handle=start_manager';\">관리자 회원가입 기간으로</button>
                                        <button onclick=\"location.href='/function/manage_contest.php?target=signin&handle=start_participant';\">참가자 회원가입 기간으로</button>
                                    ";
                                }
                            ?>
                        </p>
                    </div>
                    <div class="row_wrap">
                        <h3>대회 시작/종료 관리</h3>
                        <p>
                            <?php
                                if($is_on_contest){
                                    echo "
                                        <strong>대회가 현재 진행중입니다.<br>시작 시간: $start_datetime</strong><br><br>
                                        <button onclick=\"location.href='/function/manage_contest.php?target=contest&handle=stop';\">대회 중지</button>
                                    ";
                                }
                                else{
                                    echo "
                                        <strong>현재 대회 진행중이 아닙니다.</strong>&nbsp;->&nbsp;
                                        <button onclick=\"location.href='/function/manage_contest.php?target=contest&handle=start';\">대회 시작</button>
                                    ";
                                }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>