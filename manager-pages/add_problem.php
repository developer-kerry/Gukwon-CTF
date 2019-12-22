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
            
            .problem h4{
                margin-left:15px;
            }

            .problem input, .problem textarea, .problem input, .problem .combobox{
                margin-left:25px;
            }

            .problem .radio{
                margin-top:10px;
            }

            #submit{
                margin-top:3px;
            }

            #textInput{
                margin-top:3px;
            }
        </style>
        <link rel="stylesheet" href="/style/master.css">
        <title>문제 등록</title>
    </head>
    <body>
        <script>
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
                        textInput.placeholder = "정답 입력";
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
                    textInput.placeholder = "Flag 입력";
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
                    <form action="/function/add_problem.php" class="problem" method="POST">
                        <h4>문제 내용</h4>
                        <input type="text" name="prob_title" placeholder="문제 제목"><br>
                        <textarea name="prob_description" cols="30" rows="10"></textarea><br>
                        <br>
                        <h4>문제 세부 설정</h4>
                        <span class="combobox">점수:&nbsp;
                            <select name="score">
                                <option value="50">50점</option>
                                <option value="100">100점</option>
                                <option value="150">150점</option>
                                <option value="200">200점</option>
                            </select><br>
                        </span>
                        <input type="radio" name="flag_type" id="rdoAuto" class="radio" value="auto" onchange="changeHandler();" checked> Flag 자동 설정
                        <input type="radio" name="flag_type" id="rdoManual" class="radio" value="manual" onchange="changeHandler();"> Flag 직접 설정<br>
                        <span id="input2flag">
                            <input type="checkbox" name="input2flag" id="chkInput2flag" value="true" onchange="changeHandler();"> 문제 페이지 내 입력창에 정답 입력 시 Flag 반환<br>
                        </span>
                        <input type="text" name="textInput" id="textInput" style="display:none;"><br>
                        <input type="submit" id="submit" value="문제 등록">
                    </form>
                </div>
                <div class="row_wrap">
                    <h3>현재 등록된 문제 리스트</h3>
                    <?php
                        // 문제 리스트 출력
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>