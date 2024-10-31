<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beranda</title>
    <link rel="stylesheet" href="styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/navfooter.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>
    <?php include("navfooter/sidebar.php")?>
    <?php include("navfooter/navbar.php")?>
    
    <main class="main-container" id="main">
        <div class="main-content-container">
            <div class="paragraph-content"><br>
                <p>Selamat Datang di HexaSync</p>
                <p>Komunitas untuk berkarya</p>
            </div> <br><br>
            
            <a href="" class="create-account-button">Buat Akun</a>
        </div>
        
        
        <div class="list-content-container">
            <?php
                for ($i = 1; $i < 6; $i++){
                    echo "
                        <figure class='content-container'>
                            <img src='assets/bag.png' alt='gambar-konten' class='thumbnail'>
                            <figcaption class='caption-content'>
                                <figure class='owner-content'>
                                    <i class='fa-solid fa-circle-user' style='font-size: 36px'></i>
                                    <figcaption class='owner-name'>Nama Akun</figcaption>
                                </figure>
                                <p>Judul</p>
                                <p>deskripsi</p>
                            </figcaption>
                        </figure>
                    ";
                }
            ?>
        </div>
        <div class="main-content-container">
            <div class="paragraph-content"><br>
                <p>Silahkan Ikut Ramaikan Komunitas</p>
                <p>Dengan Mengupload Lagu</p>
            </div><br><br>

            <a href="" class="create-account-button">Upload Lagu</a>
        </div>
    </main>

    <?php include("navfooter/footer.php")?>

    <script src="scripts/main.js?v=<?php echo time(); ?>"></script>
</body>
</html>
