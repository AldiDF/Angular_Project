<?php if (isset($_SESSION["admin"])): ?>
    <div class="off-screen-menu">
        <img src="../assets/logo.png" alt="LOGO" class="logo-sidebar">
        <ul>
            <?php if (isset($admin)):?>
                <a href="../index.php">
                    <li class="list-sidebar">
                        Beranda <i class="fa-solid fa-house"></i>
                    </li>
                </a>
                <a href="manage_permission.php">
                    <li class="list-sidebar">
                        Kelola Permintaan <i class="fa-solid fa-pen-to-square"></i>
                    </li>
                </a>
                <a href="manage_account.php">
                    <li class="list-sidebar">
                        Kelola Akun <i class="fa-solid fa-pen-to-square"></i>
                    </li>
                </a>
                <a href="manage_music.php">
                    <li class="list-sidebar">
                        Kelola Lagu <i class="fa-solid fa-pen-to-square"></i>
                    </li>
                </a>
                <li class="list-sidebar">
                    Pesan <i class="fa-solid fa-message"></i>
                </li>
                <a href="../databases/query.php?logout=true">
                    <li class="list-sidebar">
                        Keluar <i class="fa-regular fa-arrow-right-from-bracket"></i>
                    </li>
                </a>
            <?php else :?>
                <a href="index.php">
                    <li class="list-sidebar">
                        Beranda <i class="fa-solid fa-house"></i>
                    </li>
                </a>
                <a href="admin/manage_permission.php">
                    <li class="list-sidebar">
                        Kelola Permintaan <i class="fa-solid fa-pen-to-square"></i>
                    </li>
                </a>
                <a href="admin/manage_account.php">
                    <li class="list-sidebar">
                        Kelola Akun <i class="fa-solid fa-pen-to-square"></i>
                    </li>
                </a>
                <a href="admin/manage_music.php">
                    <li class="list-sidebar">
                        Kelola Lagu <i class="fa-solid fa-pen-to-square"></i>
                    </li>
                </a>
                <li class="list-sidebar">
                    Pesan <i class="fa-solid fa-message"></i>
                </li>
                <a href="databases/query.php?logout=true">
                    <li class="list-sidebar">
                        Keluar <i class="fa-regular fa-arrow-right-from-bracket"></i>
                    </li>
                </a>

            <?php endif;?>
        </ul>
    </div>

<?php elseif (isset($_SESSION["user"])): ?>
    <div class="off-screen-menu">
        <img src="assets/logo.png" alt="LOGO" class="logo-sidebar">
        <ul>
            <a href="index.php">
                <li class="list-sidebar">
                    Beranda <i class="fa-solid fa-house"></i>
                </li>
            </a>
            <li class="list-sidebar">
                Pesan <i class="fa-solid fa-message"></i>
            </li>
            <li class="list-sidebar">
                Layanan Pelanggan <i class="fa-solid fa-headset"></i>
            </li>
            <li class="list-sidebar" onclick="open_slide('setting')">
                Pengaturan Akun <i class="fa-solid fa-gear"></i>
            </li>
            <a href="about_us.php">
                <li class="list-sidebar">
                    Tentang Kami <i class="fa-solid fa-circle-info"></i>
                </li>
            </a>
        </ul>
        <div class="upload-button">
            <i class="fa-light fa-square-plus"></i>
        </div>
    </div>
    
<?php else : ?>
    <div class="off-screen-menu">
        <img src="assets/logo.png" alt="LOGO" class="logo-sidebar">
        <ul>
            <a href="index.php"> 
                <li class="list-sidebar">
                    Beranda <i class="fa-solid fa-house"></i>
                </li>
            </a>
            <li class="list-sidebar" onclick="open_slide('login')">
                Masuk <i class="fa-regular fa-arrow-right-to-bracket"></i>
            </li>
            <li class="list-sidebar" onclick="open_slide('signup')">
                Buat Akun <i class="fa-light fa-square-plus"></i>
            </li>
            <a href="about_us.php">
                <li class="list-sidebar">
                    Tentang Kami <i class="fa-light fa-circle-info"></i>
                </li>
            </a>
        </ul>
        <div class="upload-button">
            <i class="fa-light fa-square-plus"></i>
        </div>
    </div>
<?php endif; ?>
