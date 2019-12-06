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
            <div class="plain_description">
                <?php
                    $sql = "SELECT nickname, score FROM user_info WHERE is_on_contest=1 AND (is_manager=0 OR is_superuser=1) ORDER BY score DESC";
                    $result = mysqli_query($conn, $sql);

                    $table_content = "";
                    $rank = 0;

                    $my_nickname = $_SESSION['nickname'];
                    $my_score = null;
                    $my_rank = null;

                    while(($row = mysqli_fetch_assoc($result))){
                        $nickname = htmlspecialchars($row['nickname']);
                        $score = $row['score'];
                        $rank++;

                        if($row['nickname'] == $my_nickname){
                            $my_score = $row['score'];
                            $my_rank = $rank;
                        }

                        $table_content .= "
                        <tr>
                            <td class=\"rank\">$rank</td>
                            <td class=\"nickname\">$nickname</td>
                            <td class=\"score\">$score</td>
                        </tr>
                        ";
                    }
                    
                    echo "<strong>현재 ".$my_nickname."님의 순위는 ".$my_rank."위(".$my_score."점)입니다.</strong>";
                ?>
                <table>
                    <thead>
                        <th>순위</th>
                        <th>닉네임</th>
                        <th>현재 점수</th>
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