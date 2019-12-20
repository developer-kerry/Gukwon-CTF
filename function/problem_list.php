<?php
    function PrintProblemOnGrid($conn, $stdid, $filter){
        $sql = "SELECT category FROM problem GROUP BY category";
        $result = mysqli_query($conn, $sql);
        $filter = strtoupper($filter);

        $subjects = [];

        while(($row = mysqli_fetch_assoc($result))){
            $category = $row['category'];
                    
            if($filter == "ALL"){
                $sql = "SELECT idx, title, score, solvers as solvers FROM problem WHERE category = '$category' AND solvers NOT LIKE '%$stdid%'";
            }
            else{
                $sql = "SELECT idx, title, score, solvers as solvers FROM problem WHERE category = '$category' AND solvers NOT LIKE '%$stdid%' AND setted = TRUE";
            }

            $inner_result = mysqli_query($conn, $sql);

            $row_cells = "";
            $cells = [];
            $cnt_row_cells = 1;

            while(($inner_row = mysqli_fetch_assoc($inner_result))){
                $idx = $inner_row['idx'];
                $title = htmlspecialchars($inner_row['title']);
                $score = $inner_row['score'];
                $cnt_solvers = substr_count($inner_row['solvers'], ",");

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
                    <a href=\"problemviewer.php?idx=$idx\">[풀기]</a>
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

        if(count($subjects) == 0){
            echo "&nbsp;&nbsp;아직 문제가 등록되지 않았습니다.";
        }
        else{
            for($i = 0; $i < count($subjects); $i++){
                echo $subjects[$i];
            }
        }
    }
?>