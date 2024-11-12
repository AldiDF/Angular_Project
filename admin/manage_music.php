<?php
    require "../databases/connection.php";
    include "../databases/query.php";

    $admin = true;
    $lagu = select_lagu($conn, "ACCEPT", "");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Akun</title>
    <link rel="stylesheet" href="../styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/transition.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/navfooter.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
</head>
<body>
    <?php include("../navfooter/sidebar.php")?>
    <?php include("../navfooter/navbar.php")?>
    <main>
        <h1 class="heading-admin-music">KELOLA LAGU</h1>
        <search>
            <form action="" class="search-bar-admin" method="get">
                <input type="text" placeholder="Cari User" name="search-account" class="input-search-admin">
                <button type="submit" class="search-button-admin">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </search>
        <table border=1>
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
                <?php $direktori = "../databases/thumbnail/" . $lagu["lagu"];?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo "<img src='$direktori' alt='profile-picture'>";?></td>
                    <td><?php echo $lagu["judul"]?></td>
                    <td><?php echo $lagu["deskripsi"]?></td>
                    <td><?php echo $lagu["username"]?></td>
                    <td>
                        <i class="fa-solid fa-pen-to-square"></i>
                        <i class="fa-light fa-trash-can"></i>
                    </td>
                </tr>
                <?php $i++; endforeach;?>
            </tbody>
        </table>
    </main>
    <?php include("../navfooter/footer.php")?>

    <script src="../scripts/main.js?v=<?php echo time(); ?>"></script>
</body>
</html>