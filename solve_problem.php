<?php
    include($_SERVER['DOCUMENT_ROOT']."/function/include.php");
?>
<html>
    <head>
        <meta charset="utf-8">
        <style>
            <?php
                include($_SERVER['DOCUMENT_ROOT']."/template/dynamic_css.php");

                if(!isset($_GET['idx']) || (!$is_manager && !$is_on_contest)){
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
                        $sql = null;

                        if($is_manager){
                            $sql = "SELECT
                                        prob.idx,
                                        prob.title,
                                        prob.author,
                                        prob.upload_datetime as up,
                                        prob.score,
                                        prob.description,
                                        prob.flag,
                                        prob.attached_fname as fname,
                                        tmp.hint1,
                                        tmp.hint2,
                                        tmp.viewers
                                    FROM
                                        problem AS prob
                                    LEFT JOIN 
                                    (
                                        SELECT 
                                            hint.prob_idx, 
                                            hint.hint1, 
                                            hint.hint2, 
                                            logs.viewers 
                                        FROM hint 
                                        LEFT JOIN logs 
                                        ON hint.prob_idx = logs.prob_idx
                                    ) AS tmp
                                    ON prob.idx = tmp.prob_idx
                            ";
                        }
                        else{
                            $sql = "SELECT
                                        prob.idx,
                                        prob.title,
                                        prob.author,
                                        prob.upload_datetime as up,
                                        prob.score,
                                        prob.description,
                                        prob.attached_fname as fname,
                                        tmp.hint1,
                                        tmp.hint2,
                                        tmp.viewers
                                    FROM
                                        problem AS prob
                                    LEFT JOIN 
                                    (
                                        SELECT 
                                            hint.prob_idx, 
                                            hint.hint1, 
                                            hint.hint2, 
                                            logs.viewers 
                                        FROM hint 
                                        LEFT JOIN logs 
                                        ON hint.prob_idx = logs.prob_idx
                                    ) AS tmp
                                    ON prob.idx = tmp.prob_idx
                            ";
                        }
                        
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

                            $fname = $row['fname'];

                            $hint1 = $row['hint1'];
                            $hint2 = $row['hint2'];

                            $is_hint1_opened = substr_count($row['viewers'], "$nickname-hint1/");
                            $is_hint2_opened = substr_count($row['viewers'], "$nickname-hint2/");

                            if($is_hint1_opened){
                                $score /= 2;
                                if($is_hint2_opened){
                                    $score /= 2;
                                }
                            }

                            echo "
                                <h2>$title</h2>
                                <div id=\"header\">
                                    <strong>작성자: $author</strong><br>
                                    <strong>작성시: $uploaded</strong><br>
                                    <strong>배점: $score"."점</strong>
                            ".(($is_manager) ? "<br><strong>".strtolower($row['flag'])."</strong>" : "")."<br><br>";

                            if($fname != null){
                                if(file_exists($_SERVER['DOCUMENT_ROOT']."/files/$fname")){
                                    echo "
                                        첨부파일이 있습니다:&nbsp;
                                        <button onclick=\"location.href='/function/download.php?fname=$fname';\">파일 다운로드</button>
                                    ";
                                }
                                else{
                                    echo "첨부파일이 있었으나 삭제되었습니다. 운영진에 문의 바랍니다.";
                                }
                                
                            }

                            echo "
                                </div>
                                <div id=\"description\">$description<strong>
                            ";

                                
                            if($is_hint1_opened || $is_manager){
                                echo "<div id=\"hint1\">첫 번째 힌트: $hint1</div>";
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

                            if($is_hint2_opened || $is_manager){
                                echo "<div id=\"hint2\">두 번째 힌트: $hint2</div>";
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

                            echo "</strong></div>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>