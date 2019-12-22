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
            .function{
                width:100%;
                text-align:center;   
            }

            .function img{
                width:100%;
                height:auto;
                margin-left:auto;
                margin-right:auto;
                padding-bottom:15px;
            }

            table thead th{
                border-bottom:1px solid gray;
            }

            table .title{
                min-width:250px;
            }

            table .upload_datetime{
                min-width:140px;
            }

            table tbody tr td{
                border-bottom:1px solid #C6C6C6;
            }

            table tbody a{
                text-decoration:none;
                color:black;
            }

            table tbody a:hover{
                text-decoration:underline;
                background-color:#D7D7D7;
            }

            table tbody a:active{
                text-decoration:underline;
                background-color:#B0B0B0;
            }
        </style>
        <link rel="stylesheet" href="/style/master.css">
        <link rel="stylesheet" href="/style/index.css">
        <title>Hell World!</title>
    </head>
    <body>
        <div class="top_nav">
            <?php 
                include($_SERVER['DOCUMENT_ROOT']."/template/top_nav.php");
            ?>
        </div>
        <div class="description">
            <div class="function">
                <img src="./media/main-banner.jpg" alt="심영과 상하이조의 짜릿한 한판승부!(두둥)">
            </div>
            <div class="plain_description">
                <div class="row_wrap">
                    <h3>CTF란?</h3>
                    <p>
                        CTF란 Capture-the-Flag의 약어로, Flag를 취득해 점수를 얻고 다른 사람들과 경쟁하는 게임입니다. 
                        크게 Attack-Defense 방식과 Jeopardy방식이 있습니다. 
                        Attack-Defense 방식에서는 각 팀당 하나의 서버를 부여하며, 
                        참가자는 적군의 서버를 해킹해 Flag를 탈취하고 아군의 서버 취약점을 패치하여 Flag를 탈취당하지 않도록 지켜야 합니다. 
                        Jeopardy 방식 CTF에서는 암호학/웹해킹/리버싱/포렌식 등 보안 분야의 문제를 풀어 Flag를 얻어낸 뒤, 
                        그것을 Flag 입력창에 입력하여 점수를 얻는 방식입니다. 본 CTF 시스템은 Jeopardy 방식 시스템입니다.
                    </p>
                </div>
                <div class="row_wrap">
                    <h3>최근 공지사항(5개)</h3>
                    <p>
                        <table>
                            <thead>
                                <th class="title">제목</th>
                                <th class="upload_datetime">작성 시각</th>
                            </thead>
                            <tbody>
                                <?php
                                    $sub_sql = "SELECT idx, title, upload_datetime FROM notice ORDER BY idx DESC LIMIT 5";
                                    $sql = "SELECT * FROM ($sub_sql)sub_notice ORDER BY idx ASC";
                                    $result = mysqli_query($conn, $sql);
                                    
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
                                ?>
                            </tbody>
                        </table>
                    </p>
                </div>   
            </div>
        </div>
    </body>
</html>