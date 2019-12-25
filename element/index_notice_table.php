<?php
    $sub_sql = "SELECT idx, title, upload_datetime FROM notice ORDER BY idx DESC LIMIT 5";
    $sql = "SELECT * FROM ($sub_sql)sub_notice ORDER BY idx ASC";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 0){
        echo "&nbsp;&nbsp;아직 작성된 글이 없습니다.";
    }
    else{
        echo "
            <table>
                <thead>
                    <tr>
                        <th class=\"title\">제목</th>
                        <th class=\"upload_datetime\">작성 시각</th>
                    </tr>
                </thead>
            <tbody>
        ";

        while(($row = mysqli_fetch_assoc($result))){
            $idx = $row['idx'];
            $title = null;
            $upload_datetime = $row['upload_datetime'];
    
            if(strlen($row['title']) >= 30){
                $title = iconv_substr($row['title'], 0, 24, "utf-8")."......";
            }
            else{
                $title = $row['title'];
            }
    
            echo "
                <tr>
                    <td class=\"title\">
                        &nbsp;&nbsp;<a href=\"/noticeviewer.php?idx=$idx\">$title</a>
                    </td>
                    <td class=\"upload_datetime\">$upload_datetime</td>
                </tr>
            ";
        }

        echo "
                </tbody>
            </table>
        ";
    }
?>
                                
                            