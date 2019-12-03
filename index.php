<?php 
    include($_SERVER['DOCUMENT_ROOT']."/function/include.php");
?>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/style/master.css">
        <link rel="stylesheet" href="/style/index.css">
        <title>Hell World!</title>
    </head>
    <body>
        <div class="top_nav">
            <?php 
                echo file_get_contents($_SERVER['DOCUMENT_ROOT']."/template/top_nav_left.html");

                if($signed){
                    echo file_get_contents($_SERVER['DOCUMENT_ROOT']."/template/top_nav_right_signed.html");
                }
                else{
                    echo file_get_contents($_SERVER['DOCUMENT_ROOT']."/template/top_nav_right_none_signed.html");
                }
            ?>
        </div>
        <div class="description">
            <div class="function">
                <a href="/index.php"><img src="./media/main-banner.jpg" alt="심영과 상하이조의 짜릿한 한판승부!(두둥)"></a>
            </div>
            <div class="plain-description">
                <div class="row-wrap">
                    <h3>CTF란?</h3>
                    <p>
                        CTF란 Capture-the-Flag의 약어로 주어진 상황을 활용, Flag를 얻어내어 점수를 얻고 다른 사람들과 경쟁하는 게임입니다. 
                        크게 Attack-Defense 방식과 Jeopardy방식이 있습니다. 
                        Attack-Defense 방식에서는 각 팀당 하나의 서버를 부여하고, 
                        참가자는 적군의 서버를 해킹해 Flag를 탈취하거나 아군의 서버 취약점을 패치하여 Flag를 탈취당하지 않도록 지켜야 합니다. 
                        Jeopardy 방식 CTF에서는 암호학/웹해킹/리버싱/포렌식 등 보안 분야의 문제를 풀어 Flag를 얻어낸 뒤, 
                        그것을 입력창에 입력하여 점수를 얻는 방식입니다. 본 CTF 시스템은 Jeopardy 방식 시스템입니다.
                    </p>
                </div>
                <div class="row-wrap">
                    <h3>최근 공지사항(5개)</h3>
                    <p>
                        temp
                    </p>
                </div>   
            </div>
        </div>
    </body>
</html>