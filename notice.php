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
        <link rel="stylesheet" href="/style/notice.css">
        <title>공지사항</title>
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
                    <h3>공지사항</h3>
                    <p>
                        <?php
                            include_once($_SERVER['DOCUMENT_ROOT']."/element/notice_table.php");

                            if($is_manager){
                                echo "<div class=\"button\"><a href=\"/manager-pages/writenotice.php\"><img src=\"https://unicons.iconscout.com/release/v2.0.1/svg/line/edit.svg\" alt=\"Pencil-on-Square\"> 공지 작성</a></div>";
                            }
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>