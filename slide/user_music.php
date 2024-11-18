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
    <link rel="stylesheet" href="../styles/user.css?v=<?php echo time(); ?>"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>
<main>
    <div>
        <h1 class="heading-user-music">KELOLA LAGU</h1>
    </div>
    
    <div class="underline"></div>
    <div class="search-bar-user">
        <form action="" method="get">
            <input type="text" placeholder="Cari Lagu" name="search-music" class="input-search-user">
            <button type="submit" class="search-button-user">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>
    <div class="music-list">
        <?php foreach ($lagu as $lagu): ?>
            <?php $direktori = "../databases/thumbnail/" . $lagu["thumbnail"]; ?>
            <div class="music-card">
                <img src="<?php echo $direktori; ?>" alt="Thumbnail Lagu" class="thumbnail-user">
                <div class="music-info">
                    <h3 class="music-title"><?php echo $lagu["judul"]; ?></h3>
                    <p class="music-description"><?php echo $lagu["deskripsi"]; ?></p>
                </div>
                <div class="action-buttons">
                    <a href="edit_lagu.php?lagu=<?php echo $lagu['lagu']; ?>" class="edit-button">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="../databases/query.php?delete_lagu=true&session=user&lagu=<?php echo $lagu['lagu']; ?>" class="delete-button" onclick="return confirm('Yakin ingin menghapus lagu ini?')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
</body>
</html>