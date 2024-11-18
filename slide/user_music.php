<?php
    require "../databases/connection.php";
    include "../databases/query.php";

    
    $lagu = select_lagu($conn, "ACCEPT", "");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Musik</title>
    <link rel="stylesheet" href="../styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/transition.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/navfooter.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/user.css?v=<?php echo time(); ?>"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>
    <?php include("../navfooter/sidebar.php")?>
    <?php include("../navfooter/navbar.php")?>
    <main>
        <h1 class="heading-user-music">KELOLA LAGU</h1>
        <search>
            <form action="" class="search-bar-user" method="get">
                <input type="text" placeholder="Cari Lagu" name="search-music" class="input-search-user">
                <button type="submit" class="search-button-user">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </search>
        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tampilan</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach($lagu as $lagu): ?>
                <?php $direktori = "../databases/thumbnail/" . $lagu["thumbnail"]; ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo "<img src='$direktori' alt='thumbnail-picture' class='thumbnail-user'>"; ?></td>
                    <td><?php echo $lagu["judul"]; ?></td>
                    <td><?php echo $lagu["deskripsi"]; ?></td>
                    <td>
                        <div class="action-button">
                            <a href="edit_lagu.php?lagu=<?php echo $lagu['lagu']; ?>">
                                <button class="edit-icon">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>
                            </a>
                            <a href="../databases/query.php?delete_lagu=true&session=user&lagu=<?php echo $lagu['lagu']?>" onclick="return confirm('Yakin ingin menghapus lagu ini?')">
                                <button class="delete-icon">
                                    <i class="fa-light fa-trash-can"></i> Hapus
                                </button>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php $i++; endforeach; ?>
            </tbody>
        </table>
    </main>
    <?php include("../navfooter/footer.php")?>

    <script src="../scripts/main.js?v=<?php echo time(); ?>"></script>
    <script src="scripts/transition.js?v=<?php echo time(); ?>"></script>
</body>
</html>