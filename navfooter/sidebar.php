<?php if (isset($_SESSION["admin"])): ?>
    <div class="off-screen-menu">
        <?php if (isset($admin)):?>
            <img src="assets/logoSidebar.png" alt="" class="logo-sidebar">
        <ul>
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
                <li class="list-sidebar" id="pesanAdmin" onclick="open_slide('history_chat')">
                    Pesan <i id="pesanAdmin" class="fa-solid fa-message"></i>
                </li>
                <a href="../databases/query.php?logout=true">
                    <li class="list-sidebar">
                        Keluar <i class="fa-regular fa-arrow-right-from-bracket"></i>
                    </li>
                </a>
        </ul>
            <?php else :?>
                <img src="assets/logoSidebar.png" alt="" class="logo-sidebar">
        <ul>
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
                <li class="list-sidebar" onclick="open_slide('history_chat')">
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
        <img src="assets/logoSidebar.png" alt="" class="logo-sidebar">
        <ul>
            <a href="index.php">
                <li class="list-sidebar">
                    Beranda <i class="fa-solid fa-house"></i>
                </li>
            </a>
            <li class="list-sidebar" onclick="open_slide('history_chat')">
                Pesan <i class="fa-solid fa-message"></i>
            </li>
            <li class="list-sidebar" id="layanan_admin" onclick="open_slide('chat')">
                Layanan Pelanggan <i id="layanan_admin" class="fa-solid fa-headset"></i>
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
        <div class="upload-button"onclick="open_slide('upload')">
            <i class="fa-light fa-square-plus"></i>
        </div>
    </div>
    
<?php else : ?>
    <div class="off-screen-menu">
        <img src="assets/logoSidebar.png" alt="" class="logo-sidebar">
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
        <div class="upload-button" onclick="open_slide('login')">
            <i class="fa-light fa-square-plus"></i>
        </div>
    </div>
<?php endif; ?>

<script>
    document.addEventListener("click", function(event) {
        if (event.target.id.includes("layanan_")){
            var lawanChat = event.target.id.split('_').pop();
            console.log(lawanChat);
            var currentPage = window.location.pathname.split('/').pop();
            if (currentPage == "profile.php"){
              var path = `${currentPage}?user=${"<?php if (isset($profile)){echo $profile;} else {echo"";} ?>"}&lawanChat=${lawanChat}`;
              document.location.href = path;
                    
            } else if (currentPage == "detail.php"){
              var path = `${currentPage}?lagu=${"<?php if (isset($_GET["lagu"])){echo $_GET["lagu"];} else {echo"";} ?>"}&lawanChat=${lawanChat}`;
              document.location.href = path;
            
            } else if (currentPage == "search.php"){
              var path = `${currentPage}?navbar-search=${"<?php if (isset($_GET["navbar-search"])) {echo $_GET["navbar-search"];} else {echo"";}?>"}&lawanChat=${lawanChat}`;
              document.location.href = path;
              
            } else {
              var path = `${currentPage}?lawanChat=${lawanChat}`;
              document.location.href = path;
            }

        } else if (event.target.id.includes("pesanAdmin")){
            var currentPage = window.location.pathname.split('/').pop();
            <?php if (isset($_SESSION["admin"])):?>
                if (currentPage.includes("manage")){
                    var path = `../index.php`;
                    document.location.href = path;
                }
            <?php endif;?>
        }
    })
</script>