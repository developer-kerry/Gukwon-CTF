<?php
    include($_SERVER['DOCUMENT_ROOT']."/function/include.php");
    include($_SERVER['DOCUMENT_ROOT']."/function/problem_list.php");

    include_once($_SERVER['DOCUMENT_ROOT']."/element/set_ctf_table.php");

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
        <link rel="stylesheet" href="/style/problem_list.css">
        <link rel="stylesheet" href="/style/set_ctf.css">
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
                    <h3>인증번호 관련 메뉴</h3>
                    <form action="/function/generate_authcode.php" method="POST"><!-- 파일 생성도 아직 안함 -->
                        <input type="radio" name="code_type" value="manager"> 관리자 인증번호
                        <input type="radio" name="code_type" value="participant"> 참가자 인증번호<br>
                        <input type="number" name="count" placeholder="발급 개수"><br>
                        <input type="submit" value="발급">
                    </form>
                </div>
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
                                <a href="/function/truncate.php?target=problem&mode=all">
                                    문제 전부 초기 상태로 되돌리기
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="button">
                                <a href="/function/truncate.php?target=problem&mode=setted">
                                    문제 출제 상태 초기화
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="button">
                                <a href="/function/truncate.php?target=problem&mode=solvers">
                                    문제 풀이 기록 초기화
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="button">
                                <a href="/function/truncate.php?target=problem&mode=hint_viewers">
                                    힌트 열람 기록 초기화
                                </a>
                            </div>
                        </li>
                    </ul>
                    <br>
                    <strong>&nbsp;&nbsp;대회 시작 준비상태로 되돌리기 - 아래 세 항목이 초기화됩니다.</strong><br>
                    <ul>
                        <li>모든 참가자들의 점수</li>
                        <li>문제 풀이 기록</li>
                        <li>힌트 열람 기록</li>
                        <li>문제 출제 상태</li>
                        <button onclick="location.href='/function/truncate.php?target=reset_ctf&mode=null';">대회 시작 준비상태로 복원</button>
                    </ul>
                </div>
                <div class="row_wrap">
                    <h3>미출제 문제 리스트</h3>
                    <?php
                        UnsettedProblemList($conn);
                    ?>
                </div>
                <div class="row_wrap">
                    <h3>출제 문제 리스트</h3>
                    <?php
                        SettedProblemList($conn);
                    ?>
                </div>
                <div class="row_wrap">
                    <h3>출제 현황</h3>
                    <?php
                        ProblemGrid::Print($conn, 0, "view")
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>