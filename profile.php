<?php
    require "databases/connection.php";
    include "databases/query.php";

    $akun = select_akun($conn, $_GET["user"]);
    $lagu = select_lagu($conn, "ACCEPT", $_GET["user"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - <?php echo $akun["username"];?></title>
    <link rel="stylesheet" href="styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/transition.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/navfooter.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/profile.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
</head>
<body>
    <?php include("slide/settings.php")?>
    <?php include("slide/edit.php")?>
    <?php include("slide/user_music.php")?>
    <?php include("slide/following_follower.php")?>
    <?php include("slide/chat.php")?>
    <?php include("navfooter/sidebar.php")?>
    <?php include("navfooter/navbar.php")?>

    <main>
        <div class="biography-container">
            <div class="biography-upper">
                <div class="profile-picture">
                    <?php if ($akun['foto'] == ""):?>
                        <i class="fa-regular fa-circle-user" style="font-size: 200px"></i>
                    <?php else: ?>
                        <img src="databases/profile_picture/<?php echo $akun['foto']?>" alt="profile-picture" class="picture">
                    <?php endif;?>
                </div>
                <div class="biography">
                    <h2><?php echo $akun['username']?></h2>
                    <h2><?php echo $akun['nama_lengkap']?></h2>
                    <h3><?php echo $akun['deskripsi']?></h3>
                </div>
            </div>
            <div class="biography-lower">
                <div class="follow-container">
                    <button class="button-follow">Diikuti</button>
                    <p></p>
                </div>
                <div class="setting">
                    <button class="button-setting" onclick="open_slide('setting')">Pengaturan</button>
                </div>
                <div class="follow-container">
                    <button class="button-follow">Mengikuti</button>
                    <p></p>
                </div>
            </div>
        </div>
        <div class="line"></div>
        <div class="profile-content-container">
            <div class="total-owned">
                <div class="total-likes">
                    <i class="fa-solid fa-heart"></i>
                    <p>Total Disukai</p>
                </div>
                <div class="total-content">
                    <p>Total Lagu</p>
                    <i class="fa-solid fa-music total-content"></i>
                </div>
            </div>
            <div class="profile-content">
                <p>Lagu yang diunggah</p>
                <?php $i = 0; foreach ($lagu as $lagu):?>
                    <?php $direktori = "databases/thumbnail/" . $lagu['lagu'];?>
                    <figure class="content-container">
                        <img src="<?php echo $direktori?>" alt="gambar-konten" class="thumbnail">
                        <figcaption class="caption-content">
                            <figure class="owner-content">
                                <i class="fa-solid fa-circle-user" style="font-size: 36px"></i>
                                <figcaption class="owner-name"><?php echo $lagu["username"]?></figcaption>
                            </figure>
                            <p><?php echo $lagu["judul"] ?></p>
                            <p><?php echo $lagu["deskripsi"]?></p>
                        </figcaption>
                    </figure>
                <?php $i++; endforeach;?>
                <?php if ($i == 0):?>
                    <div class="empty-content">
                        <h2>Belum ada lagu yang diunggah</h2>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </main>
    <?php include("navfooter/footer.php")?>

    <script src="../scripts/main.js?v=<?php echo time(); ?>"></script>
    <script src="scripts/transition.js?v=<?php echo time(); ?>"></script>
</body>
</html>