<?php
    require "connection.php";

    $id = $_GET["id"];

    $result = mysqli_query($conn, "DELETE FROM pembelian WHERE id = $id");

    if ($result) {
        echo "
            <script>
                alert('Berhasil Menghapus Bukti Pembelian');
                document.location.href = 'history.php';
            </script>
        ";
    }
?>