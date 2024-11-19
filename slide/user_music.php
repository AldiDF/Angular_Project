<?php
require "databases/connection.php";
$lagu = select_lagu($conn, "ACCEPT", "");
?>

<div class="user-musicpg">
    <div class="title-upper">
        <a href="setting.php">
            <button class="back-page">
                <i class="fa-solid fa-arrow-left" style="font-size: 30px"></i>
            </button>
        </a>
        <h1>KELOLA LAGU</h1>
    </div>

    <div class="music-list">
        <?php foreach ($lagu as $lagu): ?>
            <?php $direktori = "databases/thumbnail/" . $lagu["thumbnail"]; ?>
            <div class="music-card">
                <img src="<?php echo $direktori; ?>" alt="Thumbnail Lagu" class="thumbnail-user">
                <div class="music-info">
                    <h3 class="music-title"><?php echo $lagu["judul"]; ?></h3>
                    <p class="music-description"><?php echo $lagu["deskripsi"]; ?></p>
                </div>
                <div class="action-buttons">
                    <a href="edit_lagu.php?lagu=<?php echo $lagu['lagu']; ?>" class="edit-button">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="databases/query.php?delete_lagu=true&session=user&lagu=<?php echo $lagu['lagu']; ?>" 
                       class="delete-button" 
                       onclick="return confirm('Yakin ingin menghapus lagu ini?')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
function open_slide(pageId) {
    document.getElementById(pageId).style.display = 'block';
}
function closep(pageId) {
    document.getElementById(pageId).style.display = 'none';
}
</script>
