<?php

include 'connect.php';

$id = $_GET['id'];

$sql = "DELETE FROM GiangVien
WHERE IDGV='$id'";

mysqli_query($conn,$sql);

header("Location:index.php");

?>