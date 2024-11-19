<div class="settingspg">
    <div class="title-upper">
        <button class="back-page" onclick="closep('setting')"><i class="fa-solid fa-arrow-left" style="font-size: 30px"></i></button>
        <h1 style="text-align: center">PENGATURAN</h1>
    </div>
    <div class="setting-page">
        <div class="profile-container">
            <i class="fa-light fa-circle-user"></i>
        </div>
        <div class="setting-container">
            <div class="pripub-btn">
                <button class="private-btn" id="private" onclick="pripub('private')">PRIVAT</button>
                <button class="public-btn" id="public" onclick="pripub('public')">PUBLIK</button>
            </div>
    
            <button class="li-btn" onclick="showMusic()">KELOLA LAGU</button>
            <button class="li-btn" onclick="open_slide('userEdit')">UBAH AKUN</button>
            <button class="li-btn">HAPUS AKUN</button>
            <a href="databases/query.php?logout=true" onclick="closep('setting')"><button class="li-btn">KELUAR AKUN</button></a>
        </div>
    </div>
</div>