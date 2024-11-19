<?php
session_start();
require "../databases/connection.php";
$query = "SELECT * FROM content";
$result = $conn->query($query);

$lagu = $result->fetch_all(MYSQLI_ASSOC);
?>

<div id="userMusic" class="user-musicpg" style="display: none;">
    <div class="title-upper">
        <button class="back-page" onclick="closeMusic()">
            <i class="fa-solid fa-arrow-left" style="font-size: 30px"></i>
        </button>
        <h1>KELOLA LAGU</h1>
    </div>
    <div class="music-list">
        <?php if (!empty($lagu)): ?>
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
        <?php else: ?>
            <p>Tidak ada lagu ditemukan.</p>
        <?php endif; ?>
    </div>
</div>

<script>
function closeMusic() {
    document.getElementById('userMusic').style.display = 'none';
}

function showMusic() {
    document.getElementById('userMusic').style.display = 'block';
}
</script>
