<?php
    require "../databases/connection.php";
    include "../databases/query.php";

    if (!isset($_SESSION["admin"])){
        header('Location: ../index.php');
        exit;
    }


    $admin = true;
    $lagu = select_lagu($conn, "ACCEPT", "");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Akun</title>
    <link rel="icon" href="assets/logo.png">
    <link rel="stylesheet" href="../styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/transition.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/navfooter.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/responsive.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <?php include("../slide/chat.php")?>
    <?php include("../navfooter/sidebar.php")?>
    <?php include("../navfooter/navbar.php")?>
    <main>
        <h1 class="heading-admin-music">KELOLA LAGU</h1>
        <search>
            <form action="" class="search-bar-admin" method="get">
                <input type="text" placeholder="Cari User" name="search-account" class="input-search-admin" id="keyword">
                <button type="submit" class="search-button-admin" id="search-btn">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </search>
        <div class="admin-container">
            <table border=1 id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tampilan</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Nama Pengguna</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach($lagu as $lagu): ?>
                    <?php $direktori = "../databases/thumbnail/" . htmlspecialchars($lagu["thumbnail"]);?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo "<img src='$direktori' alt='thumbnail-picture' class='thumbnail-user'>";?></td>
                        <td><?php echo $lagu["judul"]?></td>
                        <td class="descript-td"><?php echo $lagu["deskripsi"]?></td>
                        <td><?php echo $lagu["user"]?></td>
                        <td>
                            <div class="action-button">
                                <a href="../detail.php?lagu=<?= $lagu["lagu"]?>">
                                    <button class="edit-icon">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </a>
                                <a href="../databases/query.php?delete_lagu=true&session=admin&lagu=<?php echo $lagu['lagu']?>" onclick="return confirm('Yakin ingin menghapus lagu ini?')">
                                    <button class="delete-icon">
                                        <i class="fa-light fa-trash-can"></i>
                                    </button>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php $i++; endforeach;?>
                </tbody>
            </table>
        </div>
    </main>
    <?php include("../navfooter/footer.php")?>
    
    <script>
        var keyword = document.getElementById('keyword');
        var tombolCari = document.getElementById('search-btn');
        var container = document.getElementById('table');
                        
        function searchData(url, queryParam) {
            var xhr = new XMLHttpRequest();
        
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    container.innerHTML = xhr.responseText;
                }
            }
        
            xhr.open('GET', url + '?' + queryParam + '=' + keyword.value, true);
            xhr.send();
        }
        
        keyword.addEventListener('keyup', function() {
            var currentPage = window.location.pathname;
        
            if (currentPage.includes('manage_music')) {
                searchData('../databases/liveSearch.php', 'A-keywordContent');
            }
        });
    </script>
    <script src="../scripts/main.js?v=<?php echo time(); ?>"></script>
    <script src="../scripts/transition.js?v=<?php echo time(); ?>"></script>
</body>
</html>