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
                    ShowAlertWithHistoryBack("잘못된 접근입니다.");
                }
            ?>
        </style>
        <link rel="stylesheet" href="/style/master.css">
        <link rel="stylesheet" href="/style/solve_problem.css">
        <title>문제 풀기</title>
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
                        $idx = SecureStringProcess($conn, $_GET['idx']);

                        $sql = "SELECT
                                    prob.idx,
                                    prob.title,
                                    prob.author,
                                    prob.upload_datetime as up,
                                    prob.score,
                                    prob.description,
                                    tmp.hint1,
                                    tmp.hint2,
                                    tmp.viewers
                                FROM
                                    (
                                        SELECT 
                                            hint.prob_idx, 
                                            hint.hint1, 
                                            hint.hint2, 
                                            logs.viewers 
                                        FROM hint 
                                        LEFT JOIN logs 
                                        ON hint.prob_idx = logs.prob_idx
                                    )tmp
                                LEFT JOIN tmp
                                ON prob.idx = tmp.prob_idx
                        ";

                        $result = mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) == 0){
                            ShowAlertWithHistoryBack("잘못된 접근입니다.");
                        }
                        else{
                            $row = mysqli_fetch_assoc($result);

                            $title = $row['title'];
                            $author = $row['author'];
                            $uploaded = $row['up'];
                            $score = $row['score'];
                            $description = $row['description'];

                            $hint1 = $_row['hint1'];
                            $hint2 = $_row['hint2'];

                            $is_hint1_opened = substr_count($_row['viewers'], ",$stdid-hint1");
                            $is_hint2_opened = substr_count($_row['viewers'], ",$stdid-hint2");

                            echo "
                                <div id=\"header\">
                                    <h2>$title</h2>
                                    <strong>작성자: $author</strong><br>
                                    <strong>작성시: $uploaded</strong><br>
                                    <strong>배점: $score"."점</strong>
                                </div>
                                <p>$description</p>
                            ";

                            if($is_hint1_opened){
                                echo "<div id=\"hint1\">$hint1</div>";
                            }
                            else{
                                echo "
                                    <form action=\"/function/view_hint.php\" method=\"POST\">
                                        <input type=\"hidden\" name=\"prob_idx\" value=\"$idx\">
                                        <input type=\"hidden\" name=\"hint_type\" value=\"hint1\">
                                        <input type=\"submit\" value=\"힌트1 보기\">
                                    </form>
                                ";
                            }

                            if($is_hint2_opened){
                                echo "<div id=\"hint2\">$hint2</div>";
                            }
                            else{
                                echo "
                                    <form action=\"/function/view_hint.php\" method=\"POST\">
                                        <input type=\"hidden\" name=\"prob_idx\" value=\"$idx\">
                                        <input type=\"hidden\" name=\"hint_type\" value=\"hint2\">
                                        <input type=\"submit\" value=\"힌트2 보기\">
                                    </form>
                                ";
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>