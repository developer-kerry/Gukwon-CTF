<?php
    class ProblemGrid{
        // Cell 하나 생성
        private static function GenerateCell(int $stdid, string $title, int $score, int $solvers, int $idx) : string{
            $cnt_solvers = substr_count($solvers, ',');

            if(substr_count($solvers, (string)$idx) == 1){
                return "
                    <div class=\"solved_cell\">
                        <strong class=\"prob_title\">$title</strong>
                        <br>
                        <span class=\"score\">배점: ".$score."점</span><br>
                        <span class=\"solvers\">성공한 사람들: ".$cnt_solvers."명<span>
                    </div>
                ";
            }
            else{
                return "
                    <div class=\"cell\">
                        <strong class=\"prob_title\">$title</strong>
                        <br>
                        <span class=\"score\">배점: ".$score."점</span><br>
                        <span class=\"solvers\">성공한 사람들: ".$cnt_solvers."명<span>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <a href=\"/participant-pages/solve_problem.php?idx=$idx\">[풀기]</a>
                    </div>
                ";
            }
        }

        // $category로 해당 카테고리의 전체 문제들을 얻어와 셀 배열 만듦
        private static function GetProblemCellsByCategory($conn, int $stdid, string $category) : array{
            $cells = [];
            $sql = "SELECT title, score, solvers, idx FROM problem";
            $result = mysqli_query($conn, $sql);

            while(($row = mysqli_fetch_assoc($result))){
                $title = $row['title'];
                $score = $row['score'];
                $solvers = $row['solvers'];
                $idx = $row['idx'];

                $cell = $this->GenerateCell($stdid, $title, $score, $solvers, $idx);
                array_push($cells, $cell);
            }

            return $cells;
        }

        // Cell을 최대 4개씩 엮어 Row들의 리스트를 생성
        private static function GenerateProblemRows($cells) : array{
            $rows = [];

            $count = count($cells);
            $iterate_count = ($count % 4 == 0) ? ($count / 4) : (($count / 4) + 1);

            for($i = 0; $i < $iterate_count; $i++){
                $str_cells = "";

                for($k = 0; $k < 4; $k++){
                    $idx = ($i * 4) + $k;
                    
                    if($idx >= $count){
                        break;
                    }

                    $str_cells .= $cells[$idx];
                }

                $row = "
                    <div class=\"row_cells\">
                        $str_cells
                    </div>
                ";

                array_push($rows, $row);
            }

            return $rows;
        }

        // 한 주제에 대한 Rows들을 엮음
        private static function GenerateSubject(string $category, $rows) : string{
            $str_rows = "";

            for($i = 0; $i < count($rows); $i++){
                $str_rows .= $rows[$i];
            }

            return "
                <div class=\"subject\">
                    <h4>$category</h4>
                    $str_rows
                </div>
            ";
        }

        // ProblemGrid 생성
        public static function Print($conn, int $stdid){
            $sql = "SELECT category FROM problem GROUP BY category";
            $result = mysqli_query($conn, $sql);
            $subjects = [];

            while(($row = mysqli_fetch_assoc($result))){
                $category = $row['category'];
                $cells = $this->GetProblemCellsByCategory($conn, $stdid, $category);
                $rows = $this->GenerateProblemRows($cells);
                $subject = $this->GenerateSubject($category, $rows);
                array_push($subjects, $subject);
            }

            $result = "";

            for($i = 0; $i < count($subjects); $i++){
                $result .= $subjects[$i];
            }

            echo $result;
        }
    }
?>