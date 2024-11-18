<?php
    $akun = select_akun($conn, $_SESSION["username"]);
?>

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
            <form action="databases/query.php?akun=<?= $_SESSION["username"]?>" method="POST" class="pripub-btn">
                <button type="submit" name="private" class="private-btn" id="private" onclick="pripub('private')">PRIVAT</button>
                <button type="submit" name="public" class="public-btn" id="public" onclick="pripub('public')">PUBLIK</button>
            </form>
    
            <button class="li-btn" onclick="open_slide('music')">KELOLA LAGU</button>
            <button class="li-btn" onclick="open_slide('userEdit')">UBAH AKUN</button>
            <button class="li-btn">HAPUS AKUN</button>
            <a href="databases/query.php?logout=true" onclick="closep('setting')"><button class="li-btn">KELUAR AKUN</button></a>
        </div>
    </div>
</div>

<script>
    function pripub(type){
        private = document.getElementById("private")
        public = document.getElementById("public")

        if (type === "private"){
            public.classList.remove("pripub-active")
            private.classList.add("pripub-active")
            private.style.color = "#f3f3f3"
            public.style.color = "#303841"


        } else if (type === "public"){
            private.classList.remove("pripub-active")
            public.classList.add("pripub-active")
            public.style.color = "#f3f3f3"
            private.style.color = "#303841"
        }
    }

    if ("<?= $akun["stats"]?>" === "PRIVATE"){
        pripub("private")
    } else {
        pripub("public")
    }
</script>