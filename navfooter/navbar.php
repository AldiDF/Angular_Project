<?php
    if (isset($_SESSION["admin"])){
        echo'
        <nav>
            <div class="nav-left">
                <i class="fa-regular fa-circle-user" style="font-size: 36px"></i>
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
        ';
        
    } else if (isset($_SESSION["user"])){
        echo'
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
        ';
        
    } else {
        echo'
        <nav>
            <div class="nav-left">
                <button class="create-account-button" onclick="right_slide(0, 1)">Masuk</button>
            </div>
            <search>
                <form action="" class="nav-search-bar" method="get">
                    <input type="text" placeholder="Cari konten atau user" name="search-account" class="nav-input-search">
                    <button type="submit" class="nav-search-button">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </search>
            <div class="sidebar-menu" onclick="sideBar()">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
        ';
    }
?>
