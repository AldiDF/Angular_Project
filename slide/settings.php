<div class="settingspg">
    <div class="title-login">
        <button class="back-page" onclick="closep(3)"><i class="fa-solid fa-arrow-left" style="font-size: 30px"></i></button>
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
    
            <button class="li-btn">KELOLA LAGU</button>
            <button class="li-btn">UBAH AKUN</button>
            <button class="li-btn">HAPUS AKUN</button>
            <a href="../databases/query.php?logout=true" onclick="closep(3)"><button class="li-btn">KELUAR AKUN</button></a>
        </div>
    </div>
</div>