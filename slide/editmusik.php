<?php
    require "../databases/connection.php";
    include "../databases/query.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Musik</title>
    <link rel="stylesheet" href="../styles/edit.css?v=<?php echo time(); ?>">
</head>
<body>
    <!-- Edit Musik -->
    <div class="edit-musicpg">
        <div class="title-upper">
            <button class="back-page" onclick="closep('musicEdit')">
                <i class="fa-solid fa-arrow-left" style="font-size: 30px"></i>
            </button>
            <h1>EDIT MUSIK</h1>
        </div>
        <form action="databases/query.php" method="POST" class="form-container" enctype="multipart/form-data" onsubmit="return closep('musicEdit')">
            <div class="thumbnail-container">
                <p>Tampilan:</p>
                <label for="edit-thumbnail" class="input-thumbnail">
                    <p id="edit-title-thumbnail">Tampilan</p>
                    <img alt="preview-thumbnail" id="edit-thumbnail-preview" class="thumbnail-preview">
                </label>
                <input type="file" id="edit-thumbnail" name="thumbnail" class="input-th" onchange="limit_size(event)">
            </div>
            <label for="edit-music">Ubah Lagu:</label>
            <input type="file" id="edit-music" name="music" class="input-music"><br><br>

            <label for="edit-title">Judul:</label>
            <input type="text" id="edit-title" name="title" value="[Judul Lagu]" required><br><br>

            <label for="edit-lyrics">Lirik:</label>
            <textarea name="lyrics" id="edit-lyrics" cols="30" rows="3" class="text-area">[Lirik]</textarea><br><br>

            <label for="edit-description">Deskripsi:</label>
            <textarea name="description" id="edit-description" cols="30" rows="3" class="text-area">[Deskripsi]</textarea><br><br>

            <input type="submit" id="submit-edit-music" name="edit-music" value="Simpan Perubahan" class="submit-button">
        </form>
    </div>

    <script>
        document.getElementById('edit-music').addEventListener('input', function() {
            const limit = 15 * 1024 * 1024;
            var file = this.files[0];
            var ext = file.name.split(".").pop();

            if (file.size > limit) {
                alert('Maksimal File Adalah 15 MB');
                this.value = "";
            }

            if (ext == "mp3" || ext == "wav" || ext == "mp4" || ext == "mp4a") {
                return;
            } else {
                alert("Ekstensi File Harus mp3, mp4, mp4a, wav");
                this.value = "";
            }
        });
    </script>

</body>
</html>
