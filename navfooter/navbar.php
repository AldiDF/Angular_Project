<?php if (isset($_SESSION["admin"])): ?>
        <nav>
            <div class="nav-left">
                <i class="fa-regular fa-circle-user" style="font-size: 36px"></i>
                <i class="fa-solid fa-bell" style="font-size: 36px"></i>
            </div>
            <search>
                <form action="" class="nav-search-bar" method="get">
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
        
<?php elseif (isset($_SESSION["user"])): ?>
        <nav>
            <div class="nav-left">
            <a href="profile.php?user=<?php echo $_SESSION['username']?>"><i class="fa-regular fa-circle-user" style="font-size: 36px"></i></a>
                <i class="fa-solid fa-bell" style="font-size: 36px"></i>
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
        
<?php else : ?>
        <nav>
            <div class="nav-left">
                <button class="login-button" onclick="open_slide('login')">Masuk</button>
            </div>
            <search>
                <form action="" class="nav-search-bar" method="get">
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
<?php endif; ?>

<script src="scripts/liveSearching.js?v=<?php echo time(); ?>"></script>