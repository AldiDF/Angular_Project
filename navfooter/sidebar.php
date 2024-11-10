<?php if (isset($_SESSION["admin"])): ?>
    <div class="off-screen-menu">
        <img src="assets/LOGO.jpg" alt="LOGO" class="logo-sidebar">
        <ul>
            <li class="list-sidebar">
                <a href="../index.php">
                    Beranda <i class="fa-solid fa-house"></i>
                </a>
            </li>
            <li class="list-sidebar">
                <a href="../admin/manage_permission.php">
                    Kelola Permintaan <i class="fa-solid fa-pen-to-square"></i>
                </a>
            </li>
            <li class="list-sidebar">
                <a href="../admin/manage_account.php">
                    Kelola Akun <i class="fa-solid fa-pen-to-square"></i>
                </a>
            </li>
            <li class="list-sidebar">
                <a href="../admin/manage_music.php">
                    Kelola Lagu <i class="fa-solid fa-pen-to-square"></i>
                </a>
            </li>
            <li class="list-sidebar">
                Pesan <i class="fa-solid fa-message"></i>
            </li>
            <li class="list-sidebar">
                <a href="../databases/query.php?logout=true">
                    Keluar <i class="fa-regular fa-arrow-right-from-bracket"></i>
                </a>
            </li>
        </ul>
    </div>

<?php elseif (isset($_SESSION["user"])): ?>
    <div class="off-screen-menu">
        <img src="assets/LOGO.jpg" alt="LOGO" class="logo-sidebar">
        <ul>
            <li class="list-sidebar">
                <a href="index.php">
                    Beranda <i class="fa-solid fa-house"></i>
                </a>
            </li>
            <li class="list-sidebar">
                Pesan <i class="fa-solid fa-message"></i>
            </li>
            <li class="list-sidebar">
                Layanan Pelanggan <i class="fa-solid fa-headset"></i>
            </li>
            <li class="list-sidebar" onclick="open_slide(3)">
                Pengaturan Akun <i class="fa-solid fa-gear"></i>
            </li>
            <li class="list-sidebar">
                <a href="about_us.php">
                    Tentang Kami <i class="fa-solid fa-circle-info"></i>
                </a>
            </li>
        </ul>
        <div class="upload-button">
            <i class="fa-light fa-square-plus"></i>
        </div>
    </div>
    
<?php else : ?>
    <div class="off-screen-menu">
        <img src="assets/LOGO.jpg" alt="LOGO" class="logo-sidebar">
        <ul>
            <li class="list-sidebar">
                <a href="../index.php">
                    Beranda <i class="fa-solid fa-house"></i>
                </a>
            </li>
            <li class="list-sidebar" onclick="open_slide(1)">
                Masuk <i class="fa-regular fa-arrow-right-to-bracket"></i>
            </li>
            <li class="list-sidebar" onclick="open_slide(2)">
                Buat Akun <i class="fa-light fa-square-plus"></i>
            </li>
            <li class="list-sidebar">
                <a href="../about_us.php">
                    Tentang Kami <i class="fa-light fa-circle-info"></i>
                </a>
            </li>
        </ul>
        <div class="upload-button">
            <i class="fa-light fa-square-plus"></i>
        </div>
    </div>
<?php endif; ?>
