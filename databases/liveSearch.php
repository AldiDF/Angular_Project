<?php
    require "connection.php";

    if (isset($_GET["action"])){
        $action = $_GET["action"];

        if ($action == "navbar-search"){
            $keyword = $_GET["keyword"];
            liveSearch($keyword);
            
        }
    }

    function liveSearch($keyword){
        global $conn;
        $search_account = "SELECT username, nama_lengkap FROM account acc WHERE username LIKE '%$keyword%' OR nama_lengkap LIKE '%$keyword%';";
        $search_content = "SELECT lagu, thumbnail, judul FROM content WHERE judul LIKE '%$keyword%';";

        $result_account = mysqli_query($conn, $search_account);
        $result_content = mysqli_query($conn, $search_content);

        $data = [];
        while ($row = mysqli_fetch_assoc($result_content)) {
            $data[] = $row;
        }

        while ($row = mysqli_fetch_assoc($result_account)) {
            $data[] = $row;
        }

        echo json_encode($data);

    }
?>