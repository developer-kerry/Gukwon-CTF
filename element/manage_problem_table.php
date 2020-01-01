<?php
    $sql = "SELECT idx, title, category, score FROM problem ";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 0){
        echo "&nbsp;&nbsp;아직 등록된 문제가 없습니다.";
    }
    else{
        echo "
            <form action=\"/function/manage_problem.php\" method=\"POST\">
                <input type=\"hidden\" name=\"mode\" value=\"delete\">
                <table>
                    <thead>
                        <tr>
                            <th id=\"idx\">번호</th>
                            <th id=\"title\">제목</th>
                            <th id=\"category\">분류</th>
                            <th id=\"score\">점수</th>
                            <th id=\"delete\">삭제</th>
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
                    <td class=\"title\"><div class=\"button\">&nbsp;<a href=\"/solve_problem.php?idx=$idx\">$title</a></div></td>
                    <td class=\"category\">$category</td>
                    <td class=\"score\">$score"."점</td>
                    <td class=\"delete\">
                        <input type=\"checkbox\" name=\"checkbox[]\" class=\"checkbox\" value=\"$idx\">
                    </td>
                </tr>
            ";
        }
        echo "
                    </tbody>
                </table>
                <br>
                <input type=\"submit\" id=\"submit\" value=\"삭제\">
            </form>
        ";
    }
 ?>


