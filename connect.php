<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "QLHocPhan",
    3307
);

mysqli_set_charset($conn,"utf8");

if(!$conn){
    die("Kết nối thất bại");
}

?>