<?php
    if (isset($_SESSION["admin"])){
        echo'
        <div class="off-screen-menu">
            <img src="assets/LOGO.jpg" alt="LOGO" class="logo-sidebar">
            <ul>
                <li class="list-sidebar"><a href="../index.php">Beranda <i class="fa-solid fa-house" style="color: #ffffff;"></i></a></li>
                <li class="list-sidebar"><a href="">Kelola Permintaan   <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></a></li>
                <li class="list-sidebar"><a href="">Kelola Akun         <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></a></li>
                <li class="list-sidebar"><a href="">Kelola lagu         <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></a></li>
                <li class="list-sidebar"><a href="">Pesan               <i class="fa-solid fa-message" style="color: #ffffff;"></i></a></li>
                <li class="list-sidebar"><a href="">Pengaturan          <i class="fa-solid fa-gear" style="color: #ffffff;"></i></a></li>
            </ul>
            <div class="upload-button">
                <i class="fa-solid fa-arrow-up-from-bracket"></i>
            </div>
        </div>
        ';
        
    } else if (isset($_SESSION["user"])){
        echo'
        <div class="off-screen-menu">
            <img src="assets/LOGO.jpg" alt="LOGO" class="logo-sidebar">
            <ul>
                <li class="list-sidebar"><a href="index.php">Beranda <i class="fa-solid fa-house" style="color: #ffffff;"></i></a></li>
                <li class="list-sidebar"><a href="../login.php">Pesan <i class="fa-solid fa-message" style="color: #ffffff;"></i></a></li>
                <li class="list-sidebar">Layanan Pelanggan <i class="fa-solid fa-headset" style="color: #ffffff;"></i></li>
                <li class="list-sidebar">Pengaturan Akun <i class="fa-solid fa-gear" style="color: #ffffff;"></i></li>
                <li class="list-sidebar"><a href="about_us.php">Tentang Kami <i class="fa-solid fa-circle-info" style="color: #ffffff;"></i></a></li>
            </ul>
            <div class="upload-button">
                <i class="fa-solid fa-arrow-up-from-bracket"></i>
            </div>
        </div>
        ';
        
    } else {
        echo'
        <div class="off-screen-menu">
            <img src="assets/LOGO.jpg" alt="LOGO" class="logo-sidebar">
            <ul>
                <li class="list-sidebar"><a href="../index.php">Beranda <i class="fa-solid fa-house" style="color: #ffffff;"></i></a></li>
                <li class="list-sidebar" onclick="right_slide(0, 1)">Masuk <i class="fa-solid fa-right-to-bracket" style="color: #ffffff;"></i></li>
                <li class="list-sidebar" onclick="right_slide(0, 2)">Buat Akun <i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i></li>
                <li class="list-sidebar"><a href="../about_us.php">Tentang Kami <i class="fa-solid fa-circle-info" style="color: #ffffff;"></i></a></li>
            </ul>
            <div class="upload-button">
                <i class="fa-solid fa-arrow-up-from-bracket"></i>
            </div>
        </div>
        ';
    }
?>