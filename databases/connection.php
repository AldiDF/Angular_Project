<?php
    $server = "localhost";
    $user = "root";
    $password = "root123";
    $db_nama = "db_hexasync";

    $conn = mysqli_connect($server, $user, $password, $db_nama);

    if(!$conn){
        die("Gagal terhubung ke database: " . mysqli_connect_error());
    }
?>