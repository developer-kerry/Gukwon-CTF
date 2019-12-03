<?php 
    include($_SERVER['DOCUMENT_ROOT']."/function/include.php");
?>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/style/master.css">
        <link rel="stylesheet" href="/style/index.css">
        <title>순위 확인</title>
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
                <img src="./media/main-banner.jpg" alt="심영과 상하이조의 짜릿한 한판승부!(두둥)">
            </div>
            <div class="plain-description">
                <h4>최근 공지사항(5개)</h4>
            </div>
        </div>
    </body>
</html>