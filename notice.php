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
                        <table>
                            <thead>
                                <th>번호</th>
                                <th>제목</th>
                                <th>작성자</th>
                                <th>작성 시각</th>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT idx, title, author, upload_datetime FROM notice";
                                    $result = mysqli_query($conn, $sql);

                                    while(($row = mysqli_fetch_assoc($result))){
                                        $idx = $row['idx'];
                                        $title = null;
                                        $author = $row['author'];
                                        $upload_datetime = $row['upload_datetime'];

                                        if(strlen($row['title']) >= 30){
                                            $title = iconv_substr($row['title'], 0, 24, "utf-8")."......";
                                        }
                                        else{
                                            $title = $row['title'];
                                        }

                                        echo "
                                        <a href=\"/noticeViewer.php?idx=$idx\">
                                            <tr>
                                                <td>$idx</td>
                                                <a href=\"/noticeviewer.php?idx=$idx\">
                                                    <td class=\"title\">$title</td>
                                                </a>
                                                <td>$author</td>
                                                <td>$upload_datetime</td>
                                            </tr>
                                        </a>
                                        ";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <?php
                            if($is_manager | true){
                                echo "<div class=\"button\"><a href=\"/manager-pages/writenotice.php\"><img src=\"https://unicons.iconscout.com/release/v2.0.1/svg/line/edit.svg\" alt=\"Pencil-on-Square\"> 공지 작성</a></div>";
                            }
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>