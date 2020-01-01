<?php
    include("include.php");
    
    $des_fname = SecureStringProcess($conn, $_GET['fname']);

    $sql = "SELECT src_name FROM upload_file WHERE des_name = '$des_fname'";
    $src_fname = mysqli_fetch_array(mysqli_query($conn, $sql))[0];

    $fullpath = $_SERVER['DOCUMENT_ROOT']."/files/$des_fname";
    $file_length = filesize($fullpath);

    header("Content-Type:application/octet-stream");
    header("Content-Length:$file_length");
    header("Content-Disposition:attachment;filename=".iconv("utf-8", "euc-kr", $src_fname));
    header("Content-Transfer-Encoding:binary");

    $file_stream = fopen($fullpath, "r");
    fpassthru($file_stream);

    exit;
?>