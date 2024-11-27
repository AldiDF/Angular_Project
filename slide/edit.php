<div class="edit-userpg">
    <div class="title-upper">
        <button class="back-page" onclick="closep('userEdit')">
            <i class="fa-solid fa-arrow-left" style="font-size: 30px"></i>
        </button>
        <h1>EDIT AKUN</h1>
    </div>
    <div class="edit-user-container">
        <form action="databases/query.php" method="POST" class="form-container" enctype="multipart/form-data" onsubmit="return closep('userEdit')">
            <div class="profile-pic-container">
                <label for="input-profile" class="input-thumbnail">
                    <img id="title-profile" src="<?php if ($currentSession["foto"] == "") {echo "assets/default.jpg";} else {echo "databases/profile/" . $currentSession["foto"];}?>" alt="Foto Profil" class="thumbnail-review">
                    <img id="profile-preview" alt="Foto Profil" class="thumbnail-preview">
                </label>
                <input type="file" id="input-profile" name="profile-pic" class="input-th" accept="image/*" onchange="limit_size(event, 'editProfile')">
            </div>

            <label for="edit-full-name">Nama Lengkap: <br>
                <input type="text" id="edit-full-name" name="full-name" class="form-pw" placeholder="Nama Lengkap" maxlength="49" value="<?= $currentSession["nama_lengkap"]?>" required>
            </label>

            <label for="edit-desc">Deskripsi Akun: <br>
                <input type="text" id="edit-desc" name="desc" class="form-pw" placeholder="Deskripsi Akun" value="<?= $currentSession["deskripsi"]?>">
            </label>

            <label for="edit-email">Surel: <br>
                <input type="email" id="edit-email" name="email" class="form-pw" placeholder="Surel" maxlength="98" value="<?= $currentSession["email"]?>" required>
            </label>

            <label for="edit-password">Sandi Baru: <br>
                <input type="password" id="edit-password" name="password" placeholder="Kosongkan jika tidak mengubah" class="form-pw">
            </label>
            
            <input type="submit" id="submit-edit" name="edit-account" value="Simpan Perubahan" class="submit-button">

        </form>
    </div>
</div>

<?php
    if (isset($_GET["editMusik"])){
        $LaguCurr = select_lagu_spesifik($conn, $_GET["editMusik"]);
    }
?>
<div class="edit-musicpg">
    <div class="title-upper">
        <button class="back-page" onclick="closep('musicEdit'); open_slide('setting')">
            <i class="fa-solid fa-arrow-left" style="font-size: 30px"></i>
        </button>
        <h1>EDIT MUSIK</h1>
    </div>
    <form action="databases/query.php?lagu=<?= $LaguCurr["lagu"]?>&direktori=<?= $LaguCurr["thumbnail"]?>" method="POST" class="form-container" enctype="multipart/form-data" onsubmit="return closep('musicEdit')">
        <div class="thumbnail-container">
            <label for="input-Thumbnail" class="input-thumbnail">
                <img id="title-Thumbnail" src="<?= "databases/thumbnail/" . $LaguCurr['thumbnail']?>" alt="Foto Profil" class="thumbnail-review">
                <img alt="preview-thumbnail" id="Thumbnail-preview" class="thumbnail-preview">
            </label>
            <input type="file" id="input-Thumbnail" name="input-Thumbnail" class="input-th" onchange="limit_size(event, 'editThumbnail')">
        </div>

        <label for="edit-title">
            Judul: <br>
            <input type="text" id="edit-title" name="edit-title" class="form-pw" maxlength="98" value="<?= $LaguCurr['judul']?>" required>
        </label>

        <label for="edit-lyrics">
            Lirik:
            <?php $fileLirik = file_get_contents("databases/" . $LaguCurr["lirik"]);?>
            <textarea name="edit-lyrics" id="edit-lyrics" cols="30" rows="3" class="text-area"><?= $fileLirik?></textarea>
        </label>

        <label for="edit-description">
            Deskripsi:
            <input type="text" name="edit-description" id="edit-description" value="<?= $LaguCurr["deskripsi"]?>" class="form-pw">
        </label>

        <input type="submit" id="submit-edit-music" name="edit-music" value="Simpan Perubahan" class="submit-button">
    </form>
</div>