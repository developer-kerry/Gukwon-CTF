<?php 
    include($_SERVER['DOCUMENT_ROOT']."/function/session.php");
?>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./style/master.css">
        <link rel="stylesheet" href="./style/index.css">
        <title>Hell World!</title>
    </head>
    <body>
        <div class="top_nav">
            <?php 
                echo file_get_contents($_SERVER['DOCUMENT_ROOT']."/top_nav_left.html");
                echo file_get_contents($_SERVER['DOCUMENT_ROOT']."/top_nav_right_none_signed.html");
            ?>
        </div>
        <div class="description">
            <div class="banner">
                <img src="./media/main-banner.jpg" alt="심영과 상하이조의 짜릿한 한판승부!(두둥)">
            </div>
        </div>
    </body>
</html>