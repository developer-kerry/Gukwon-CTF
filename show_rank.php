<?php
    include($_SERVER['DOCUMENT_ROOT']."/function/include.php");
?>
<html>
    <head>
        <meta charset="utf-8">
        <style>
            <?php
                if($is_on_contest){
                    echo ".top_nav{ background-color:#C7FFE3; }";
                }
                else{
                    echo ".top_nav{ background-color:#F0F0F0; }";
                }
            ?>
        </style>
        <link rel="stylesheet" href="/style/master.css">
        <link rel="stylesheet" href="/style/index.css">
        <title>순위 확인</title>
    </head>
    <body>
        <div class="top_nav">
            <?php 
                include($_SERVER['DOCUMENT_ROOT']."/template/top_nav.php");
            ?>
        </div>
        <div class="description">
            <div class="function">
                순위 확인
            </div>
            <div class="plain_description">
                순위 확인
            </div>
        </div>
    </body>
</html>