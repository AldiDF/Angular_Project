<?php
    $currentSession = select_akun($conn, $_SESSION["username"]);
?>

<div class="settingspg">
    <div class="title-upper">
        <button class="back-page" onclick="closep('setting')"><i class="fa-solid fa-arrow-left" style="font-size: 30px"></i></button>
        <h1 style="text-align: center">PENGATURAN</h1>
    </div>
    <div class="setting-page">
        <?php if ($currentSession["foto"] == "") {echo"<img src='assets/default.jpg' alt='profile' class='setting-profile-picture'>";} else {echo"<img src='databases/profile/" . $currentSession["foto"] . "' alt='profile' class='setting-profile-picture'>";}?>
        <div class="setting-container">
            <div action="databases/query.php?akun=<?= $_SESSION["username"]?>" method="POST" class="pripub-btn">
                <button type="submit" name="private" class="private-btn" id="private" onclick="pripub('private')">PRIVAT</button>
                <button type="submit" name="public" class="public-btn" id="public" onclick="pripub('public')">PUBLIK</button>
            </div>
    
            <button class="li-btn" onclick="open_slide('music'); closep('setting')">KELOLA LAGU</button>
            <button class="li-btn" onclick="open_slide('userEdit')">EDIT AKUN</button>
            <button class="li-btn" onclick="confirm_delete()">HAPUS AKUN</button>
            <a href="databases/query.php?logout=true" onclick="closep('setting')"><button class="li-btn">KELUAR AKUN</button></a>
        </div>
    </div>
</div>

<script>
    function pripub(type){
        private = document.getElementById("private")
        public = document.getElementById("public")

        if (type === "private"){
            public.classList.remove("active")
            private.classList.add("active")
            private.style.color = "#f3f3f3"
            public.style.color = "#303841"


        } else if (type === "public"){
            private.classList.remove("active")
            public.classList.add("active")
            public.style.color = "#f3f3f3"
            private.style.color = "#303841"
        }
    }

    if ("<?= $currentSession["stats"]?>" === "PRIVATE"){
        pripub("private")
    } else {
        pripub("public")
    }

    function confirm_delete(){
        var test = confirm("Apakah anda yakin ingin menghapus akun anda?");
        if (test == true){
            var conf = prompt("Ketik 'HAPUS AKUN SAYA' untuk menghapus akun anda");
            if (conf == "HAPUS AKUN SAYA"){
                document.location.href = "databases/query.php?delete-akun=true&session=user&username=<?=$_SESSION["username"]?>";

            }
            
        } else{
            return;
        }
    }

    document.addEventListener("click", function(event) {
        if (event.target.id.includes("private")){
            var button_target = event.target.id;
            console.log(button_target);
            const xhr = new XMLHttpRequest();
                xhr.open('POST', "databases/query.php?akun=<?= $_SESSION["username"]?>", true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                  if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log('Response from server:', xhr.responseText);
                  }
                }
              
                const data = `private=true`;
                console.log(data);
                xhr.send(data);

        } else if (event.target.id.includes("public")){
            var button_target = event.target.id;
            console.log(button_target);
            const xhr = new XMLHttpRequest();
                xhr.open('POST', "databases/query.php?akun=<?= $_SESSION["username"]?>", true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                  if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log('Response from server:', xhr.responseText);
                  }
                }
              
                const data = `public=true`;
                console.log(data);
                xhr.send(data);
        }
    })
</script>