<?php 
    $lagu = select_lagu($conn, "ACCEPT", "");
?>

<div class="manage-musicpg">
    <div class="title-upper">
        <button class="back-page" onclick="closep('music')"><i class="fa-solid fa-arrow-left" style="font-size: 30px"></i></button>
        <h1>KELOLA LAGU</h1>
    </div>
    <search>
        <form action="" class="search-bar-user" method="get">
            <input type="text" placeholder="Cari Lagu" name="search-music" class="input-search-user">
            <button type="submit" class="search-button-user">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </search>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Tampilan</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; foreach($lagu as $lagu): ?>
            <?php $direktori = "databases/thumbnail/" . $lagu["thumbnail"]; ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>
                    <img src="<?php echo $direktori; ?>" alt="Thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                </td>
                <td><?php echo $lagu["judul"]; ?></td>
                <td><?php echo $lagu["deskripsi"]; ?></td>
                <td>
                    <div class="action-button">
                        <button 
                            class="edit-icon" 
                            onclick="open_slide('musicEdit')"
                            data-lagu="<?php echo $lagu['lagu']; ?>">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </button>
                        
                        <a href="../databases/query.php?delete_lagu=true&session=user&lagu=<?php echo $lagu['lagu']?>" onclick="return confirm('Yakin ingin menghapus lagu ini?')">
                            <button class="delete-icon">
                                <i class="fa-light fa-trash-can"></i> Hapus
                            </button>
                        </a>
                    </div>
                </td>
            </tr>
            <?php $i++; endforeach; ?>
        </tbody>
    </table>
</div>
<script>
    document.querySelectorAll('.edit-icon').forEach(button => {
    button.addEventListener('click', function() {
        const lagu = this.getAttribute('data-lagu');

        // Isi form
        document.getElementById('edit-lagu-hidden').value = lagu;
    });
});

</script>