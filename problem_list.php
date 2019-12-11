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
        <link rel="stylesheet" href="/style/problem_list.css">
        <title>문제 풀기</title>
    </head>
    <body>
        <div class="top_nav">
            <?php 
                include($_SERVER['DOCUMENT_ROOT']."/template/top_nav.php");
            ?>
        </div>
        <div class="description">
            <?php
                $sql = "SELECT category FROM problem GROUP BY category";
                $result = mysqli_query($conn, $sql);

                $subjects = [];

                while(($row = mysqli_fetch_assoc($result))){
                    $category = $row['category'];
                    
                    $sql = "SELECT title, score, solvers FROM problem WHERE category = '$category'";
                    $inner_result = mysqli_query($conn, $sql);

                    $row_cells = "";
                    $cells = "";// Cells를 Array로 변경해 작동하도록 수정
                    $cnt_row_cells = 1;

                    while(($inner_row = mysqli_fetch_assoc($result))){
                        $title = htmlspecialchars($inner_row['title']);
                        $score = $inner_row['score'];
                        $solvers = $inner_row['solvers'];

                        $solvers = explode(",", $solvers);
                        $cnt_solvers = count($solvers);

                        if(array_search((string)$stdid, $solvers) == false){
                            $cells .= "
                            <div class=\"cell\">
                                <strong class=\"prob_title\">$title</strong>
                                <span class=\"score\">$score</span>
                                <span class=\"solvers\">$cnt_solvers</span>
                            </div>
                            ";

                            $cnt_row_cells++;
                        }

                        if($cnt_row_cells % 3 == 0){
                            $row_cells .= "<div class=\"row_cell\">$cesll</div>";
                        }
                    }

                    $category = htmlspecialchars($category);
                    $data = "
                    <div class=\"subject\">
                        <h4>$category</h4>
                        <div class=\"row_cell\">
                            $cells
                        </div>
                    </div>
                    ";

                    array_push($subjects, $data);
                }
            ?>
            <div class="function">
                <br>
                <form id="auth_form" action="/function/auth_problem.php">
                    <input type="text" id="flag_input" placeholder="&nbsp;Flag 입력">
                    <input type="submit" id="submit" value="Auth">
                </form>
            </div>
            <div class="plain_description">
                <h3>문제 리스트</h3>
                <div class="subject">
                    <h4>씨발</h4>
                    <div class="row_cell">
                        <div class="cell">
                            <strong class="prob_title">포너블이다 시발련들아</strong><br>
                            <span class="score">점수</span><br>
                            <span class="solvers">푼 사람</span>
                        </div>
                        <div class="cell">
                            2
                        </div>
                        <div class="cell">
                            3
                        </div>
                        <div class="cell">
                            4
                        </div>
                    </div>
                    <div class="row_cell">
                        <div class="cell">
                            1                        
                        </div>
                        <div class="cell">
                            2
                        </div>
                        <div class="cell">
                            3
                        </div>
                        <div class="cell">
                            4
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>