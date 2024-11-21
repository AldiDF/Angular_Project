<?php 
    $lagu = select_lagu($conn, "ACCEPT", $_SESSION["username"]);
    $direktori = "databases/thumbnail/";
?>

<div class="manage-musicpg">
    <div class="title-upper">
        <button class="back-page" onclick="closep('music')">
            <i class="fa-solid fa-arrow-left" style="font-size: 30px"></i>
        </button>
        <h1>Kelola Lagu</h1>
    </div>
    <div class="underline"></div>
    
    <search>
        <form action="" class="chat-search-bar" method="get">
            <input type="text" placeholder="Cari Lagu" name="search-music" class="chat-input-search">
        </form>
    </search>
        
    <div class="music-list">
        <p>Lagu yang diunggah</p>
        <?php foreach($lagu as $lagu):?>
        <div class="music-card">
            <img src="<?= $direktori . $lagu["thumbnail"]?>" alt="Thumbnail" class="thumbnail-user">
            <div class="music-info">
                <h2 class="music-title"><?= $lagu["judul"]?></h2>
                <p class="music-description"><?= $lagu["deskripsi"]?></p>
            </div>
            <div class="action-buttons">
                <div class="edit-button" title="Edit" id="music+<?= $lagu['lagu']?>" onclick="open_slide('musicEdit'); closep('music'); closep('setting')">
                    <i class="fa-solid fa-pen-to-square" id="music+<?= $lagu['lagu']?>" onclick="open_slide('musicEdit'); closep('music'); closep('setting')"></i>
                </div>
                <form action="databases/query.php?delete_lagu=true&lagu=<?= $lagu['lagu']?>" onclick="return confirm('Yakin ingin menghapus lagu ini?')"  title="Hapus">
                    <button type="submit" class="delete-button"><i class="fa-light fa-trash-can"></i></button>
                    
                </form>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>

<script>
  
  document.addEventListener("click", function(event) {
      if (event.target.id.includes("music+")){
            var lagucurr = event.target.id.split('+').pop();
            console.log(lagucurr);
            var currentPage = window.location.pathname;
            var filename = "index.php";
            console.log(`${filename}?editMusik=${lagucurr}&user=${lagucurr}`);
            var path = `${filename}?editMusik=${lagucurr}`;
            document.location.href = path;

    }
  })

</script>