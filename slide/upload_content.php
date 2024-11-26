<div class="uploadpg">
    <div class="title-upper">
        <button class="back-page" onclick="closep('upload')"><i class="fa-solid fa-arrow-left" style="font-size: 30px"></i></button>
        <h1>UNGGAH LAGU</h1>
    </div>
    <form action="databases/query.php?username=<?php echo $_SESSION["username"]?>" method="POST" class="form-container" enctype="multipart/form-data" onsubmit="return closep('upload')">
        <div class="thumbnail-container">
            <label for="input-thumbnail" class="input-thumbnail">
                <p id="title-thumbnail">Tampilan</p>
                <img alt="preview-thumbnail" id="thumbnail-preview" class="thumbnail-preview">
            </label>
            <input type="file" id="input-thumbnail" name="thumbnail" class="input-th" onchange="limit_size(event, 'upThumbnail')" required>
        </div>
        <label for="music">Unggah Lagu:</label>
        <input type="file" id="music" name="music" class="input-music" required><br>
        <label for="title">Judul:</label>
        <input type="text" id="title" name="title" class="form-pw" maxlength="98" required><br>
        <label for="lyrics">Lirik:</label>
        <textarea name="lyrics" id="lyrics" cols="30" rows="1" class="text-area"></textarea><br>
        <label for="description">Deskripsi:</label>
        <input type="text" name="description" id="description" class="form-pw"><br>

        <input type="submit" id="submit-upload" name="upload-music" value="Unggah" class="submit-upload">
        
    </form>
</div>

<script>
    document.getElementById('music').addEventListener('input', function() {
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
    })
</script>