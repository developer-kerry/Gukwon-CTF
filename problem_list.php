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
                    $cells = [];
                    $cnt_row_cells = 1;

                    while(($inner_row = mysqli_fetch_assoc($inner_result))){
                        $title = htmlspecialchars($inner_row['title']);
                        $score = $inner_row['score'];
                        $solvers = $inner_row['solvers'];

                        $solvers = explode(",", $solvers);
                        $cnt_solvers = count($solvers);

                        if(array_search((string)$stdid, $solvers) == false){
                            array_push($cells, "
                            <div class=\"cell\">
                                <strong class=\"prob_title\">$title</strong><br>
                                <br>
                                <span class=\"score\">배점: ".$score."점</span><br>
                                <span class=\"solvers\">성공한 사람: ".$cnt_solvers."명</span>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <a href=\"#\">[풀기]</a>
                            </div>
                            ");
                        }
                    }
                    
                    $str_cell = "";
                    $category = htmlspecialchars($category); 

                    for($i = 0; $i < count($cells); $i++){
                        if($i % 3 == 0 && $i > 0){
                            $data = "
                            <div class=\"subject\">
                                <h4>$category</h4>
                                <div class=\"row_cell\">
                                    $str_cell
                                </div>
                            </div>
                            ";

                            array_push($subjects, $data);
                        }

                        $str_cell .= $cells[$i];
                    }

                    $data = "
                    <div class=\"subject\">
                        <h4>$category</h4>
                        <div class=\"row_cell\">
                            $str_cell
                        </div>
                    </div>
                    ";

                    array_push($subjects, $data);
                }
            ?>
            <div class="function">
                <br>
                <form id="auth_form" action="/function/auth_problem.php" method="POST">
                    <input type="text" id="flag_input" placeholder="&nbsp;Flag 입력">
                    <input type="submit" id="submit" value="Auth">
                </form>
            </div>
            <div class="plain_description">
                <h3>문제 리스트</h3>
                <?php
                    if(count($subjects) == 0){
                        echo "&nbsp;&nbsp;아직 문제가 등록되지 않았습니다.";
                    }
                    else{
                        for($i = 0; $i < count($subjects); $i++){
                            echo $subjects[$i];
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>