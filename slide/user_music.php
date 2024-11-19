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
    <link rel="stylesheet" href="../styles/user.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>
    <main>
        <h1 class="heading-user-music">KELOLA LAGU</h1>
        <div class="underline"></div> <!-- Garis bawah sesuai kelas .underline -->
        
        <!-- Search Bar -->
        <search>
            <form action="" class="search-bar-user" method="get">
                <input type="text" placeholder="Cari Lagu" name="search-music" class="input-search-user">
                <button type="submit" class="search-button-user">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </search>

        <!-- Music List -->
        <div class="music-list">
            <?php foreach ($lagu as $lagu): ?>
            <?php $thumbnailPath = "../databases/thumbnail/" . $lagu["thumbnail"]; ?>
            <div class="music-card">
                <img src="<?php echo $thumbnailPath; ?>" alt="Thumbnail" class="thumbnail-user">
                <div class="music-info">
                    <h2 class="music-title"><?php echo $lagu["judul"]; ?></h2>
                    <p class="music-description"><?php echo $lagu["deskripsi"]; ?></p>
                </div>
                <div class="action-buttons">
                    <a href="edit_lagu.php?lagu=<?php echo $lagu['lagu']; ?>" class="edit-button">Edit</a>
                    <a href="../databases/query.php?delete_lagu=true&session=user&lagu=<?php echo $lagu['lagu']; ?>" 
                       onclick="return confirm('Yakin ingin menghapus lagu ini?')" class="delete-button">Hapus</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>
