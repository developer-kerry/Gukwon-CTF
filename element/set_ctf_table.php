
<?php
    $sql = "SELECT idx, title, category, score FROM problem WHERE setted = FALSE";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 0){
        echo "&nbsp;&nbsp;아직 등록된 문제가 없습니다.";
    }
    else{
        echo "
            <form action=\"/function/set_ctf.php\" method=\"POST\">
                <input type=\"hidden\" name=\"mode\" value=\"set\">
                <table>
                    <thead>
                        <th id=\"idx\">번호</th>
                        <th id=\"title\">제목</th>
                        <th id=\"category\">분류</th>
                        <th id=\"score\">점수</th>
                        <th id=\"set\">출제</th>
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
                    <td class=\"set\"><input type=\"checkbox\" name=\"checkbox\" value=\"$idx\"></td>
                </tr>
            ";
        }

        echo "    
                    </tbody>
                </table>
                <br>
                <input type=\"submit\" id=\"select_done\" value=\"선택 완료\">
            </form>
        ";
    }
?>
                        