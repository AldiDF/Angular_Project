<?php 
    $lagu = select_lagu($conn, "ACCEPT", $_SESSION["username"]);
    $direktori = "databases/thumbnail/";
?>

<div class="manage-musicpg">
    <div class="wrapper">
        <div class="round"></div>
        <div class="round"></div>
        <div class="round"></div>
        <div class="round"></div>
        <div class="round"></div>
        <div class="round"></div>
        <div class="round"></div>
        <div class="round"></div>
        <div class="round"></div>
        <div class="round"></div>
        <div class="round"></div>
        <div class="round"></div>
        <div class="round"></div>
        <div class="round"></div>
    </div>

    <div class="title-upper">
        <button class="back-page" onclick="closep('music'); open_slide('setting')">
            <i class="fa-solid fa-arrow-left" style="font-size: 30px"></i>
        </button>
        <h1>Kelola Lagu</h1>
    </div>
    <div class="underline"></div>
    
    <search>
        <div action="" class="chat-search-bar" method="get">
            <input type="text" placeholder="Cari Lagu" name="search-music" class="chat-input-search" id="keyword-content">
        </div>
    </search>
        
    <div class="music-list" id="music-list">
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

<script>
    var keywordContent = document.getElementById('keyword-content');
    var container_content = document.getElementById('music-list');
    console.log(keywordContent);

    function searchDataContent(url, queryParam) {
        var xhr = new XMLHttpRequest();
    
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // console.log(xhr.responseText);
                container_content.innerHTML = xhr.responseText;
            }
        }
    
        xhr.open('GET', url + '?' + queryParam + '=' + keywordContent.value, true);
        xhr.send();
    }
    
    keywordContent.addEventListener('keyup', function() {
        var currentPage = window.location.pathname;
        console.log(currentPage);
    
        searchDataContent('databases/liveSearch.php', 'userContent');
        
    });
</script>