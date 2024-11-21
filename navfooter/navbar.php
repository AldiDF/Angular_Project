<?php
if (isset($_SESSION["username"])){
    $currentSession = select_akun($conn, $_SESSION['username']);
    $select_notif = select_notif($conn, $_SESSION['username']);
}

?>

<?php if (isset($_SESSION["admin"])): ?>
    <?php if (isset($admin)): ?>
        <nav>
            <div class="nav-left">
                <i class="fa-regular fa-circle-user" style="font-size: 36px"></i>
                <i class="fa-solid fa-bell" style="font-size: 36px" onclick="toggleNotification()"></i>
            </div>
            <search>
                <form action="search.php" class="nav-search-bar" id="nav-search-bar" method="get">
                    <div>
                        <input type="text" placeholder="Cari konten atau user" name="navbar-search" class="nav-input-search">
                        <button type="submit" class="nav-search-button">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                    <div class="live-search-result">
                        <ul class="search-result">

                        </ul>
                    </div>
                </form>
            </search>
            <div class="sidebar-menu" onclick="sideBar()">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
        <script src="../scripts/liveSearching.js?v=<?php echo time(); ?>"></script>
    <?php else:?>
        <nav>
            <div class="nav-left">
                <i class="fa-regular fa-circle-user" style="font-size: 36px"></i>
                <i class="fa-solid fa-bell" style="font-size: 36px" onclick="toggleNotification()"></i>
            </div>
            <search>
                <form action="search.php" class="nav-search-bar" id="nav-search-bar" method="get">
                    <div>
                        <input type="text" placeholder="Cari konten atau user" name="navbar-search" class="nav-input-search">
                        <button type="submit" class="nav-search-button">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                    <div class="live-search-result">
                        <ul class="search-result">

                        </ul>
                    </div>
                </form>
            </search>
            <div class="sidebar-menu" onclick="sideBar()">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
        <script src="scripts/liveSearching.js?v=<?php echo time(); ?>"></script>
    <?php endif; ?>
<?php elseif (isset($_SESSION["user"])): ?>
        <nav>
            <div class="nav-left">
                <a href="profile.php?user=<?php echo $_SESSION['username']?>"><?php if ($currentSession["foto"] == "") {echo"<img src='assets/default.jpg' alt='profile' class='nav-profile-picture'>";} else {echo"<img src='databases/profile/" . $currentSession["foto"] . "' alt='profile' class='nav-profile-picture'>";}?></a>
                <i class="fa-solid fa-bell" style="font-size: 36px" onclick="toggleNotification()"></i>
            </div>
            <search>
                <form action="search.php" class="nav-search-bar" id="nav-search-bar" method="get">
                    <div>
                        <input type="text" placeholder="Cari konten atau user" name="navbar-search" class="nav-input-search">
                        <button type="submit" class="nav-search-button">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                    <div class="live-search-result">
                        <ul class="search-result">

                        </ul>
                    </div>
                </form>
            </search>
            <div class="sidebar-menu" onclick="sideBar()">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
        <script src="scripts/liveSearching.js?v=<?php echo time(); ?>"></script>
<?php else : ?>
        <nav>
            <div class="nav-left">
                <button class="login-button" onclick="open_slide('login')">Masuk</button>
            </div>
            <search>
                <form action="search.php" class="nav-search-bar" id="nav-search-bar" method="get">
                    <div>
                        <input type="text" placeholder="Cari konten atau user" name="navbar-search" class="nav-input-search">
                        <button type="submit" class="nav-search-button">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                    <div class="live-search-result">
                        <ul class="search-result">

                        </ul>
                    </div>
                </form>
            </search>
            <div class="sidebar-menu" onclick="sideBar()">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
        <script src="scripts/liveSearching.js?v=<?php echo time(); ?>"></script>
<?php endif; ?>


<div class="notification-container" id="notification-container" style="display: none;">
    <div class="header">
        <span>Notifikasi</span>
        <span class="close-btn" onclick="toggleNotification()">&times;</span>
    </div>
    <?php foreach($select_notif as $notif): ?>
    <div class="notification-item"><?= $notif["isi_notif"]?></div>
    <?php endforeach; ?>
</div>