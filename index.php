<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beranda</title>
    <link rel="stylesheet" href="styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>
    <div class="off-screen-menu">
        <ul>
            <li>Profil</li>
            <li>Home</li>
            <li>Upload</li>
        </ul>
    </div>
    
    <nav>
        <div class="nav-left">
            <i class="fa-solid fa-circle-user" style="font-size: 36px"></i>
            <i class="fa-regular fa-bell" style="font-size: 36px"></i>
        </div>
        <search>
            <form action="" class="nav-search-bar" method="get">
                <input type="text" placeholder="Cari konten atau user" name="search-account" class="nav-input-search">
                <button type="submit" class="nav-search-button">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </search>
        <div class="sidebar-menu">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
    
    <main class="main-container" id="main">
        <div class="main-content-container">
            <div class="paragraph-content">
                <p>Selamat Datang di HexaSync</p>
                <p>Komunitas untuk berkarya</p>
                <p></p>
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
                                    <figcaption class='owner-name'>aldi</figcaption>
                                </figure>
                                <p>Judul</p>
                                <p>deskripsi</p>
                            </figcaption>
                        </figure>
                    ";
                }
            ?>
        </div>
    </main>

    <footer>
        <p>Angular</p>
    </footer>

    <script src="scripts/scripts.js?v=<?php echo time(); ?>"></script>
</body>
</html>
