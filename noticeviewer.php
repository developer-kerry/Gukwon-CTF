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
        <link rel="stylesheet" href="/style/noticeviewer.css">
        <title>공지 작성</title>
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
                    <h3>공지 작성</h3>
                    <span>
                        <form action="/function/writenotice.php" method="POST">
                            <input type="text" id="title" name="title" placeholder="제목"><br>
                            <br>
                            <strong>내용 작성</strong>
                            <textarea name="description" cols="30" rows="10"></textarea><br>
                            <input type="submit" id="submit" value="등록">
                        </form>
                    </span>
                </div>
            </div>
        </div>
    </body>
</html>