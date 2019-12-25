<?php
    class ProblemGrid{
        private static function GenerateCell(int $stdid, string $title, int $score, int $solvers, int $idx, string $mode) : string{
            $cnt_solvers = substr_count($solvers, ',');

            if(substr_count($solvers, (string)$idx) == 1 || $mode == "view"){
                return "
                    <div class=\"solved_cell\">
                        <strong class=\"prob_title\">$title</strong>
                        <br>
                        <span class=\"score\">배점: ".$score."점</span><br>
                        <span class=\"solvers\">성공한 사람들: ".$cnt_solvers."명<span>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <a href=\"/participant-pages/solve_problem.php?mode=$mode&idx=$idx\">[보기]</a>
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
                        <a href=\"/participant-pages/solve_problem.php?mode=$mode&idx=$idx\">[풀기]</a>
                    </div>
                ";
            }
        }

        private static function GetProblemCellsByCategory($conn, int $stdid, string $category, string $mode) : array{
            $cells = [];
            $sql = "SELECT title, score, solvers, idx FROM problem WHERE setted=TRUE";
            $result = mysqli_query($conn, $sql);

            while(($row = mysqli_fetch_assoc($result))){
                $title = $row['title'];
                $score = $row['score'];
                $solvers = $row['solvers'];
                $idx = $row['idx'];

                $cell = self::GenerateCell($stdid, $title, $score, $solvers, $idx, $mode);
                array_push($cells, $cell);
            }

            return $cells;
        }

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

        public static function Print($conn, int $stdid, string $mode){
            $sql = "SELECT category FROM problem GROUP BY category";
            $result = mysqli_query($conn, $sql);
            $subjects = [];

            while(($row = mysqli_fetch_assoc($result))){
                $category = $row['category'];
                $cells = self::GetProblemCellsByCategory($conn, $stdid, $category, $mode);
                $rows = self::GenerateProblemRows($cells);
                $subject = self::GenerateSubject($category, $rows);
                array_push($subjects, $subject);
            }

            $result = "";
            $subject_count = count($subjects);

            if($subject_count == 0){
                $result = "아직 문제가 등록되지 않았습니다.";
            }
            else{
                for($i = 0; $i < count($subjects); $i++){
                    $result .= $subjects[$i];
                }
            }

            echo $result;
        }
    }
?>