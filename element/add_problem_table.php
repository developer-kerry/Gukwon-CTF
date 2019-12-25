<?php
    $sql = "SELECT idx, title, category, score as upload FROM problem ";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 0){
        echo "&nbsp;&nbsp;아직 등록된 문제가 없습니다.";
    }
    else{
        echo "
            <table>
                <thead>
                    <tr>
                        <th class=\"idx\">번호</th>
                        <th class=\"title\">제목</th>
                        <th class=\"category\">분류</th>
                        <th class=\"score\">점수</th>
                    </tr>
                </thead>
            <tbody>
        ";

        while(($row = mysqli_fetch_assoc($result))){
            $idx = $row['idx'];
            $title = $row['title'];
            $category = $row['category'];
            $score = $row['score'];

            echo "
                <tr>
                    <td class=\"idx\">$idx</td>
                    <td class=\"title\"><a href=\"/solve_problem.php?mode=view&idx=$idx\">$title</a></td>
                    <td class=\"category\">$category</td>
                    <td class=\"score\">$score</td>
                </tr>
            ";
        }
        echo "
                </tbody>
            </table>
        ";
    }
 ?>


