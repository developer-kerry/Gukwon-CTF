<?php
    if($is_on_contest){
        echo ".top_nav{ background-color:#C7FFE3; }";
        echo ".button a:hover{ background-color:#ABE1C6; }";
        echo ".button a:active{ background-color:#89B7A0; }";
    }
    else{
        echo ".top_nav{ background-color:#F0F0F0; }";
        echo ".button a:hover{ background-color:#D4D4D4; }";
        echo ".button a:active{ background-color:#9E9E9E; }";
    }
?>