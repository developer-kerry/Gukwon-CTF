<?php
    $sql = "SELECT idx, title, author, upload_datetime FROM notice";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 0){
        echo "&nbsp;&nbsp;아직 작성된 글이 없습니다.";
    }
    else{
        echo "
            <table>
                <thead>
                    <tr>
                        <th id=\"index\">번호</th>
                        <th id=\"title\">제목</th>
                        <th id=\"author\">작성자</th>
                        <th id=\"datetime\">작성 시각</th>
                    </tr>
                </thead>
            <tbody>
        ";

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
                <tr>
                    <td class=\"index\">$idx</td>
                    <td class=\"title\">
                        &nbsp;&nbsp;<a href=\"/noticeviewer.php?idx=$idx\">$title</a>
                    </td>
                    <td class=\"author\">$author</td>
                    <td class=\"datetime\">$upload_datetime</td>
                </tr>
            ";
        }

        echo "
                </tbody>
            </table>
        ";
    }
?>