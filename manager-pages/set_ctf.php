<?php
    include($_SERVER['DOCUMENT_ROOT']."/function/include.php");

    if(!$is_manager){
        ShowAlertWithMove2Index("잘못된 접근입니다.");
    }
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
        <link rel="stylesheet" href="/style/mypage.css">
        <title>대회 준비 메뉴</title>
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
                    <h3>초기화 관련 메뉴</h3>
                    <strong>&nbsp;&nbsp;인증번호 관련</strong>
                    <ul>
                        <li>
                            <div class="button">
                                <a href="/function/truncate.php?target=auth_code&mode=all">
                                    인증번호 전체 삭제
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="button">
                                <a href="/function/truncate.php?target=auth_code&mode=participant">
                                    참가자 인증번호 전체 삭제
                                </a></div></li>
                        <li>
                            <div class="button">
                                <a href="/function/truncate.php?target=auth_code&mode=manager">
                                    관리자 인증번호 전체 삭제
                                </a>
                            </div>
                        </li>
                    </ul>
                    <br>
                    <strong>&nbsp;&nbsp;사용자 관련</strong>
                    <ul>
                        <li>
                            <div class="button">
                                <a href="/function/truncate.php?target=user_info&mode=all">
                                    전체 계정 삭제
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="button">
                                <a href="/function/truncate.php?target=user_info&mode=participant">
                                    참가자 계정 전체 삭제
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="button">
                                <a href="/function/truncate.php?target=user_info&mode=manager">
                                    관리자 계정 전체 삭제
                                </a>
                            </div>
                        </li>
                    </ul>
                    <br>
                    <strong>&nbsp;&nbsp;문제 관련</strong>
                    <ul>
                        <li>
                            <div class="button">
                                <a href="/function/truncate.php?handle=problem&mode=all">
                                    문제 전부 초기 상태로 되돌리기
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="button">
                                <a href="/function/truncate.php?handle=problem&mode=setted">
                                    문제 출제 상태 초기화
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="button">
                                <a href="/function/truncate.php?handle=problem&mode=solvers">
                                    문제 풀이 기록 초기화
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="button">
                                <a href="/function/truncate.php?handle=problem&mode=hint_viewers">
                                    힌트 열람 기록 초기화
                                </a>
                            </div>
                        </li>
                    </ul>
                    <strong>&nbsp;&nbsp;대회 시작 준비상태로 되돌리기</strong>
                    &nbsp;&nbsp;&nbsp;이 버튼을 클릭하면, 다음 내용들이 초기화됩니다.
                    <ul>
                        <li>모든 참가자들의 점수</li>
                        <li>문제 풀이 기록</li>
                        <li>힌트 열람 기록</li>
                        <button onclick="location.href='/function/truncate.php?handle=reset_ctf';">초기화 진행</button>
                    </ul>
                </div>
                <div class="row_wrap">
                    <h3>문제 리스트</h3>
                    <table>
                        <thead>
                            <th id="idx">idx</th>
                            <th id="title">제목</th>
                            <th id="category">분류</th>
                            <th id="score">점수</th>
                            <th id="set">출제</th>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT idx, title, category, score FROM problem WHERE setted = FALSE";
                                $result = mysqli_query($conn, $sql);

                                echo "<form action=\"/function/set_ctf.php\" method=\"POST\">";
                                echo "<input type=\"hidden\" name=\"type\" value=\"set_problem\">";                                
                                while(($row = mysqli_fetch_assoc($result))){
                                    $idx = $row['idx'];
                                    $title = $row['title'];
                                    $category = $row['category'];
                                    $score = $row['score'];

                                    echo "
                                        <tr>
                                            <td class=\"idx\">$idx</td>
                                            <td class=\"title\">$title</td>
                                            <td class=\"category\">$category</td>
                                            <td class=\"score\">$score</td>
                                            <td class=\"set\"><input type=\"checkbox\" name=\"checkbox\" value=\"$idx\"></td>
                                        </tr>
                                    ";
                                }
                                echo "<input type=\"submit\" value=\"선택 완료\">";
                                echo "</form>";
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="row_wrap">
                    <h3>현재 출제된 문제들</h3>
                    <?php
                        ProblemGrid::Print($conn, $stdid, "view");
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>