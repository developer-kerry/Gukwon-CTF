<?php
    include($_SERVER['DOCUMENT_ROOT']."/function/include.php");
    include($_SERVER['DOCUMENT_ROOT']."/function/problem_list.php");

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
        <link rel="stylesheet" href="/style/manage_problem.css">
        <title>문제 관리</title>
    </head>
    <body>
        <script>
            function comboboxChangeHandler(){
                var combobox = document.getElementById("category");
                var textCategory = document.getElementById("textCategory");

                if(combobox.value == "manual_input"){
                    textCategory.style = "";
                }
                else{
                    textCategory.value = "";
                    textCategory.style = "display:none";
                }
            }

            function changeHandler(){
                var rdoAuto = document.getElementById("rdoAuto");
                var chkInput2flag = document.getElementById("chkInput2flag");

                // Display Control Required
                var textInput = document.getElementById("textInput");
                var input2flag = document.getElementById("input2flag");

                if(rdoAuto.checked){
                    input2flag.style = "";
                    textInput.value = "";

                    if(chkInput2flag.checked){
                        textInput.style = "";
                        textInput.placeholder = " 정답 입력";
                    }
                    else{
                        textInput.style = "display:none;";
                    }
                }
                else{
                    input2flag.style = "display:none;";
                    chkInput2flag.checked = false;
                    textInput.style = "";
                    textInput.value = "";
                    textInput.placeholder = " Flag 입력";
                }
            }
        </script>
        <div class="top_nav">
            <?php 
                include($_SERVER['DOCUMENT_ROOT']."/template/top_nav.php");
            ?>
        </div>
        <div class="description">
            <div class="plain_description">
                <div class="row_wrap">
                    <h3>문제 등록하기</h3>
                    <div class="problem_form">
                        <form action="/function/manage_problem.php" class="problem" method="POST" enctype="multipart/form-data">
                            <?php
                                if(isset($_GET['mode'])){
                                    $mode = $_GET['mode'];
                                    echo "<input type=\"hidden\" name=\"mode\" value=\"$mode\">";
                                }
                                else{
                                    echo "<input type=\"hidden\" name=\"mode\" value=\"add\">";
                                }
                            ?>
                            <h4>문제 제목</h4>
                            <input type="text" name="prob_title" id="title" placeholder="&nbsp;문제 제목"><br>
                            <h4>문제 본문</h4>
                            <textarea name="prob_description" id="description" cols="30" rows="10"></textarea><br>
                            <br>
                            <h4>문제 세부 설정</h4>
                            <span class="combobox">점수:&nbsp;
                                <select name="score">
                                    <option value="50">50점</option>
                                    <option value="100">100점</option>
                                    <option value="150">150점</option>
                                    <option value="200">200점</option>
                                </select>
                            </span>
                            <span class="combobox">분류:&nbsp;
                                <select name="category" id="category" onload="comboboxChangeHandler();" onchange="comboboxChangeHandler();">
                                    <option value="manual_input" selected>직접 입력</option>
                                    <?php
                                        $sql = "SELECT category FROM problem GROUP BY category";
                                        $result = mysqli_query($conn, $sql);

                                        while(($row = mysqli_fetch_assoc($result))){
                                            $category = $row['category'];
                                            echo "<option value=\"$category\">$category</option>";
                                        }
                                    ?>
                                </select>
                            </span>
                            <input type="text" name="textCategory" id="textCategory" placeholder="&nbsp;문제 분류 입력">
                            <br>
                            <br>
                            <input type="radio" name="flag_type" id="rdoAuto" class="radio" value="auto" onload="changeHandler();" onchange="changeHandler();" checked> Flag 자동 설정
                            <input type="radio" name="flag_type" id="rdoManual" class="radio" value="manual" onload="changeHandler();" onchange="changeHandler();"> Flag 직접 설정<br>
                            <span id="input2flag">
                                <input type="checkbox" name="input2flag" id="chkInput2flag" value="true" onload="changeHandler();" onchange="changeHandler();"> 문제 페이지 내 입력창에 정답 입력 시 Flag 반환<br>
                            </span>
                            <input type="text" name="textInput" id="textInput" style="display:none;"><br>
                            <input type="text" name="hint1" id="hint1" placeholder="&nbsp;첫 번째 힌트"><br>
                            <input type="text" name="hint2" id="hint2" placeholder="&nbsp;두 번째 힌트"><br>
                            <br>
                            <h4>첨부파일 업로드</h4> 
                            <input type="file" name="attach" id="attach"></span><br>
                            <br>
                            <br>
                            <input type="submit" id="submit" value="문제 등록">
                        </form>
                    </div>
                </div>
                <div class="row_wrap">
                    <h3>등록된 문제 리스트</h3>
                    <?php
                        include_once($_SERVER['DOCUMENT_ROOT']."/element/manage_problem_table.php");
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>