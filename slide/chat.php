<?php
  date_default_timezone_set("Asia/Makassar");
  $waktu = date("Y-m-d H:i:s");
  if (isset($_SESSION["user"])){
    $history_chat = select_chat($conn, "", $_SESSION["username"], "");
  }
  
?>

<div class="history-chatpg">
  <div class="title-upper">
    <button class="back-page" onclick="closep('history_chat');"><i class="fa-solid fa-arrow-left" style="font-size: 30px"></i></button>
    <h1>PESAN</h1>
  </div>
    <div class="custom-line"></div>
    <search>
      <div action="" class="chat-search-bar" method="get">
          <input type="text" placeholder="Cari konten atau user" name="search-account" class="chat-input-search" id="keyword-chat">
      </div>
    </search>
  <div class="riwayat-pesan" id="chat-list">
    <p>Riwayat Pesan</p> <br>
    <?php foreach($history_chat as $hist):?> 
    <?php $lastChat = select_chat($conn, "false", $_SESSION["username"], $hist["lawan_chat"]); ?>
    <div class="chat-item" onclick="open_slide('chat'); closep('history_chat')" id="pchat_<?= $hist['lawan_chat']?>">
      <div class="chat-item-profile" id="pchat_<?= $hist['lawan_chat']?>">
        <?php $akunChat = select_akun($conn, $hist["lawan_chat"]);?>
        <?php if ($akunChat["foto"] == "") {echo"<img src='assets/default.jpg' alt='profile' >";} else {echo"<img src='databases/profile/" . $akunChat["foto"] . "' alt='profile'>";}?>
      </div>
      <div class="chat-item-content" id="pchat_<?= $hist['lawan_chat']?>">
        <div class="chat-item-name" id="pchat_<?= $hist['lawan_chat']?>"><?= $hist["lawan_chat"]?></div>
          <div class="chat-item-message" id="pchat_<?= $hist['lawan_chat']?>">
            <?= $lastChat[count($lastChat) - 1]["isi"]?>
          </div>
        <div class="chat-item-time" id="pchat_<?= $hist['lawan_chat']?>"><?= $lastChat[count($lastChat) - 1]["waktu"]?></div>
      </div>
    </div>
    <?php endforeach;?>
  </div>
</div>

<script>
  document.addEventListener("click", function(event) {
      if (event.target.id.includes("pchat_")){
            var lawanChat = event.target.id.split('_').pop();
            console.log(lawanChat);
            var currentPage = window.location.pathname.split('/').pop();
            if (currentPage == "profile.php"){
              var path = `${currentPage}?user=${"<?php if (isset($profile)){echo $profile;} else {echo"";} ?>"}&lawanChat=${lawanChat}`;
              document.location.href = path;
                    
            } else if (currentPage == "detail.php"){
              var path = `${currentPage}?lagu=${"<?php if (isset($lagu)){echo $lagu['lagu'];} else {echo"";} ?>"}&lawanChat=${lawanChat}`;
              document.location.href = path;
            
            } else if (currentPage == "search.php"){
              var path = `${currentPage}?navbar-search=${"<?php if (isset($_GET["navbar-search"])) {echo $_GET["navbar-search"];} else {echo"";}?>"}&lawanChat=${lawanChat}`;
              document.location.href = path;
              
            } else {
              var path = `${currentPage}?lawanChat=${lawanChat}`;
              document.location.href = path;
            }
    }
  })
</script>

<script>
    var keyword = document.getElementById('keyword-chat');
    var container = document.getElementById('chat-list');

    function searchData(url, queryParam) {
        var xhr = new XMLHttpRequest();
    
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log(xhr.responseText);
                container.innerHTML = xhr.responseText;
            }
        }
    
        xhr.open('GET', url + '?' + queryParam + '=' + keyword.value, true);
        xhr.send();
    }
    
    keyword.addEventListener('keyup', function() {
        var currentPage = window.location.pathname;
        console.log(currentPage);
    
        searchData('databases/liveSearch.php', 'userChat');
        
    });
</script>

<?php
  if (isset($_GET["lawanChat"])){
      $Chat = $_GET["lawanChat"];
      $loadChat = select_chat($conn, "false", $_SESSION["username"], $Chat);
      $jumlah_chat = count($loadChat);
      $sessioncurr = select_akun($conn, $_SESSION["username"]);
  } else {
    if (isset($profile)){
      $Chat = $profile;
      $loadChat = select_chat($conn, "false", $_SESSION["username"], $Chat);
      $jumlah_chat = count($loadChat);
      $sessioncurr = select_akun($conn, $_SESSION["username"]);
    }
  }
  ?>
  <p class="json"><?php $lastChat = select_chat($conn, "true", $_SESSION["username"], $Chat);?></p>
<div class="chatpg" id="chatpg">
  <div class="title-upper">
      <button class="back-page" onclick="closep('chat'); open_slide('history_chat'); clearURL()"><i class="fa-solid fa-arrow-left" style="font-size: 30px"></i></button>
      <div class="profile-info">
        <?php if ($akunChat["foto"] == "") {echo"<img src='assets/default.jpg' alt='profile' class='nav-profile-picture'>";} else {echo"<img src='databases/profile/" . $akunChat["foto"] . "' alt='profile' class='nav-profile-picture'>";}?>
        <span class="profile-name" id="profile-name"><?= $Chat?></span>
      </div>
  </div>

  <div class="chat-container">
    <div class="chat-body" id="chat-body">
      <?php foreach($loadChat as $chat):?>
      <?php if ($_SESSION["username"] == $chat["pengirim"]):?>
        <div class="message right">
          <div class="message-bubble">
            <p><?= $chat["isi"]?></p>
            <span class="message-time-right"><?= $chat["waktu"]?></span>
          </div>
          <?php if ($sessioncurr["foto"] == "") {echo"<img src='assets/default.jpg' alt='profile' class='nav-profile-picture'>";} else {echo"<img src='databases/profile/" . $sessioncurr["foto"] . "' alt='profile' class='nav-profile-picture'>";}?>
        </div>
      <?php else :?>
        <div class="message left">
        <?php if ($akunChat["foto"] == "") {echo"<img src='assets/default.jpg' alt='profile' class='nav-profile-picture'>";} else {echo"<img src='databases/profile/" . $akunChat["foto"] . "' alt='profile' class='nav-profile-picture'>";}?>
          <div class="message-bubble">
            <p><?= $chat["isi"]?></p>
            <span class="message-time"><?= $chat["waktu"]?></span>
          </div>
        </div>
      <?php endif;?>
      <?php endforeach;?>
      <div action="databases/query.php" method="POST" class="send-chat" id="input-chat">
          <textarea name="chat" id="chat" cols="30" rows="1" placeholder=""></textarea>
          <button type="submit" name="send-chat" id="send-chat"><i class="fa-regular fa-paper-plane-top"></i></button>
      </div>
    </div>
  </div>
</div>

<script>
  function clearURL(){
    var currentPage = window.location.pathname.split('/').pop();
    if (currentPage == "profile.php"){
      var path = `${currentPage}?user=${"<?php if (isset($profile)){echo $profile;} else {echo"";} ?>"}`;
      document.location.href = path;

    } else if (currentPage == "detail.php"){
      var path = `${currentPage}?lagu=${"<?php if (isset($_GET["lagu"])){echo $_GET["lagu"];} else {echo"";} ?>"}`;
      document.location.href = path;

    } else if (currentPage == "search.php"){
      var path = `${currentPage}?navbar-search=${"<?php if (isset($_GET["navbar-search"])) {echo $_GET["navbar-search"];} else {echo"";}?>"}`;
      document.location.href = path;
      
    } else {
      var path = `${currentPage}`;
      document.location.href = path;
    }
  }

</script>

<script>
  let old_chatID = "<?php if ($jumlah_chat == 0) {echo 0;} else {echo $lastChat["id"];}?>";
  console.log(old_chatID);
  document.getElementById('send-chat').addEventListener('click', function() {
    const commentInput = document.getElementById('chat');
    const commentText = commentInput.value.trim();
    if (commentText !== '') {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'databases/query.php?chat=true', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            console.log('Response from server:', xhr.responseText);
              const newChat = document.createElement('div');
              newChat.classList.add('message-right');
              newChat.innerHTML = `
                  <div class="message right">
                    <div class="message-bubble">
                      <p>${commentText}</p>
                      <span class="message-time-right"><?= $waktu?></span>
                    </div>
                    <?php if ($sessioncurr["foto"] == "") {echo"<img src='assets/default.jpg' alt='profile' class='nav-profile-picture'>";} else {echo"<img src='databases/profile/" . $sessioncurr["foto"] . "' alt='profile' class='nav-profile-picture'>";}?>
                  </div>
              `;
              // Append the new comment to the comments container
              const commentsContainer = document.getElementById("chat-body");
              const sendCommentDiv = document.querySelector('.send-chat');
              commentsContainer.insertBefore(newChat, sendCommentDiv);
          
              // Clear the input field
              commentInput.value = '';
          }
        }
    
        const pengirim = "<?= $_SESSION["username"] ?>";
        const penerima = "<?= $akunChat["username"]?>"
        const waktu = "<?= $waktu ?>";
        const data = `pengirim=${pengirim}&penerima=${penerima}&waktu=${waktu}&pesan=${encodeURIComponent(commentText.replace(/\n/g, '<br>'))}`;
        console.log(data);
        xhr.send(data);
    }
  });

  document.addEventListener('DOMContentLoaded', (event) => {
      function fetchNewComments() {
          const xhr = new XMLHttpRequest();
          xhr.open('POST', `databases/query.php?last-chat=true`, true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
          xhr.onreadystatechange = function() {
              if (xhr.readyState === 4 && xhr.status === 200) {
                  console.log('Response from server:', xhr.responseText);
                  const loadChat = JSON.parse(xhr.responseText);
                  console.log(loadChat.id);
                  console.log(old_chatID);
                  if (old_chatID == loadChat.id) {
                      return;
                  } else {
                      if (loadChat.pengirim === "<?= $_SESSION["username"]?>"){
                          return;
                      }
                      old_chatID = loadChat.id;
                      const newChat = document.createElement('div');
                      newChat.classList.add('message-left');
                      newChat.innerHTML = `
                          <div class="message left">
                          <?php if ($akunChat["foto"] == "") {echo"<img src='assets/default.jpg' alt='profile' class='nav-profile-picture'>";} else {echo"<img src='databases/profile/" . $akunChat["foto"] . "' alt='profile' class='nav-profile-picture'>";}?>
                            <div class="message-bubble">
                              <p>${loadChat.isi}</p>
                              <span class="message-time"><?= $waktu?></span>
                            </div>
                          </div>
                      `;
                      const commentsContainer = document.getElementById("chat-body");
                      const sendCommentDiv = document.querySelector('.send-chat');
                      commentsContainer.insertBefore(newChat, sendCommentDiv);
                  }
                  
              }
          };
          const sessionCurr = "<?= $_SESSION["username"]?>";
          const penerima = "<?= $akunChat["username"]?>"
          const last = "true";
          xhr.send(`session=${sessionCurr}&penerima=${penerima}&last-chat=${last}`);
      }
      // Poll for new comments every 5 seconds
      setInterval(fetchNewComments, 5000);
  })
</script>