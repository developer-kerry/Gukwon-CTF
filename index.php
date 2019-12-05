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
        <link rel="stylesheet" href="/style/index.css">
        <title>Hell World!</title>
    </head>
    <body>
        <div class="top_nav">
            <?php 
                include($_SERVER['DOCUMENT_ROOT']."/template/top_nav.php");
            ?>
        </div>
        <div class="description">
            <div class="function">
                <img src="./media/main-banner.jpg" alt="심영과 상하이조의 짜릿한 한판승부!(두둥)">
            </div>
            <div class="plain_description">
                <div class="row_wrap">
                    <h3>CTF란?</h3>
                    <p>
                        CTF란 Capture-the-Flag의 약어로, Flag를 취득해 점수를 얻고 다른 사람들과 경쟁하는 게임입니다. 
                        크게 Attack-Defense 방식과 Jeopardy방식이 있습니다. 
                        Attack-Defense 방식에서는 각 팀당 하나의 서버를 부여하며, 
                        참가자는 적군의 서버를 해킹해 Flag를 탈취하고 아군의 서버 취약점을 패치하여 Flag를 탈취당하지 않도록 지켜야 합니다. 
                        Jeopardy 방식 CTF에서는 암호학/웹해킹/리버싱/포렌식 등 보안 분야의 문제를 풀어 Flag를 얻어낸 뒤, 
                        그것을 Flag 입력창에 입력하여 점수를 얻는 방식입니다. 본 CTF 시스템은 Jeopardy 방식 시스템입니다.
                    </p>
                </div>
                <div class="row_wrap">
                    <h3>최근 공지사항(5개)</h3>
                    <p>
                        <table>
                            <thead>
                                <th>제목</th>
                                <th></th>
                            </thead>
                        </table>
                    </p>
                </div>   
            </div>
        </div>
    </body>
</html>