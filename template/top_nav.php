<?php 
    echo file_get_contents($_SERVER['DOCUMENT_ROOT']."/template/top_nav_left.html");

    if($signed){
        echo file_get_contents($_SERVER['DOCUMENT_ROOT']."/template/top_nav_right_signed.html");
    }
    else{
        echo file_get_contents($_SERVER['DOCUMENT_ROOT']."/template/top_nav_right_none_signed.html");
    }
?>