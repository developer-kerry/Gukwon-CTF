<?php
    include($_SERVER['DOCUMENT_ROOT']."/function/include.php");
?>
<html>
    <head>
        <meta charset="utf-8">
        <style>
            <?php
                include($_SERVER['DOCUMENT_ROOT']."/template/dynamic_css.php");

                if(!isset($_GET['idx'])){
                    ShowAlert("잘못된 접근입니다.");
                }
            ?>
        </style>
        <link rel="stylesheet" href="/style/master.css">
        <link rel="stylesheet" href="/style/noticeviewer.css">
        <title>공지 열람중</title>
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
                    <?php
                        $idx = mysqli_real_escape_string($conn, $_GET['idx']);
                        $sql = "SELECT title, author, upload_datetime, description FROM notice WHERE idx=$idx";
                        $content = mysqli_fetch_assoc(mysqli_query($conn, $sql));

                        $title = $content['title'];
                        $author = $content['author'];
                        $datetime = $content['upload_datetime'];
                        $description = $content['description'];
                        
                        echo "<div id=\"header\">";
                        echo "  <h2>$title</h2>";
                        echo "  <strong>작성자: $author</strong><br>";
                        echo "  <strong>작성시: $datetime</strong>";
                        echo "</div>";
                        echo "<p>$description</p>";
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>