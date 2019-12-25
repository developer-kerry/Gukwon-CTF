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
        <link rel="stylesheet" href="/style/show_rank.css">
        <title>순위 확인</title>
    </head>
    <body>
        <div class="top_nav">
            <?php 
                include($_SERVER['DOCUMENT_ROOT']."/template/top_nav.php");
            ?>
        </div>
        <div class="description">
            <div class="plain_description">
                <h3>대회 순위 확인</h3>
                <?php
                    $sql = "SELECT nickname, score, last_auth FROM user_info WHERE (is_manager=0 OR is_superuser=1) ORDER BY score DESC";
                    $result = mysqli_query($conn, $sql);

                    $is_session_setted = isset($_SESSION['nickname']);
                    
                    $table_content = "";
                    $rank = 0;

                    $arr = [];

                    while(($row = mysqli_fetch_assoc($result))){
                        $nickname = htmlspecialchars($row['nickname']);
                        $score = $row['score'];
                        $last_auth = $row['last_auth'];
                        $rank++;

                        array_push($arr, [$nickname, $score]);

                        if($is_session_setted && $row['nickname'] == $_SESSION['nickname']){
                            echo "<strong>&nbsp;&nbsp;현재 ".$nickname."님의 순위는 ".$rank."위(".$row['score']."점)입니다.</strong><br><br>";
                        }

                        $table_content .= "
                        <tr>
                            <td class=\"rank\">$rank</td>
                            <td class=\"nickname\">&nbsp;&nbsp;$nickname</td>
                            <td class=\"score\">$score</td>
                            <td class=\"last_auth\">$last_auth</td>
                        </tr>
                        ";
                    }
                ?>
                <table id="rank">
                    <thead>
                        <th id="rank">순위</th>
                        <th id="nickname">닉네임</th>
                        <th id="score">현재 점수</th>
                        <th id="last_auth">마지막 인증</th>
                    </thead>
                    <tbody>
                        <?php
                            echo $table_content;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>