<?php
  date_default_timezone_set("Asia/Makassar");
  $waktu = date("Y-m-d H:i:s");
  
  if (isset($profile)){
    if ($profile != $_SESSION["username"]){
      $loadChat = select_chat($conn, "false", $_SESSION["username"], $akun["username"]);
      $jumlah_chat = count($loadChat);
  
    } else {
      $history_chat = select_chat($conn, "", $_SESSION["username"], $_SESSION["username"]);
      $chatcurr;
    }
  }
  ?>

<div class="history-chatpg">
  <div class="title-upper">
    <button class="back-page" onclick="closep('history_chat')"><i class="fa-solid fa-arrow-left" style="font-size: 30px"></i></button>
    <h1>PESAN</h1>
  </div>
  <div>
    <div class="custom-line"></div>
    <search>
      <form action="" class="chat-search-bar" method="get">
          <input type="text" placeholder="Cari konten atau user" name="search-account" class="chat-input-search">
      </form>
    </search>
    <div class="riwayat-pesan">Riwayat Pesan</div>
    <?php foreach($history_chat as $hist):?> 
    <?php $lastChat = select_chat($conn, "false", $_SESSION["username"], $hist["lawan_chat"]); ?>
    <div class="chat-item" onclick="open_slide('chat')">
      <div class="chat-item-profile">
        <img src="assets/join.jpg" alt="Profile">
      </div>
      <div class="chat-item-content">
        <div class="chat-item-name"><?= $hist["lawan_chat"]?></div>
        <div class="chat-item-message">
          <?= $lastChat[count($lastChat) - 1]["isi"]?>
        </div>
        <div class="chat-item-time"><?= $lastChat[count($lastChat) - 1]["waktu"]?></div>
      </div>
    </div>
    <?php $loadChat = select_chat($conn, "false", $_SESSION["username"], $hist["lawan_chat"]);?>
    <?php $jumlah_chat = count($loadChat);?>
    <?php $chatcurr = $hist["lawan_chat"]?>
    <?php endforeach;?>
  </div>
</div>

<div class="chatpg" id="chatpg">
  <div class="title-upper">
      <button class="back-page" onclick="closep('chat')"><i class="fa-solid fa-arrow-left" style="font-size: 30px"></i></button>
      <div class="profile-info">
        <img src="assets/join.jpg" alt="Profile Picture" class="profile-pic">
        <span class="profile-name" id="profile-name"><?= $chatcurr?></span>
      </div>
  </div>

  <div class="chat-container">
    <div class="chat-body" id="chat-body">
      <?php foreach($loadChat as $chat):?>
      <?php if ($_SESSION["username"] == $chat["pengirim"]):?>
        <div class="message right">
          <div class="message-bubble">
            <p><?= $chat["isi"]?></p>
            <span class="message-time"><?= $chat["waktu"]?></span>
          </div>
          <img src="assets/join.jpg" alt="Profile Picture" class="message-pic">
        </div>
      <?php else :?>
        <div class="message left">
          <img src="assets/join.jpg" alt="Profile Picture" class="message-pic">
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
  let old_id = "<?php if ($jumlah_chat == 0) {echo 0;} else {echo $chat["id"];}?>";
  console.log(old_id);
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
                      <span class="message-time"><?= $waktu?></span>
                    </div>
                    <img src="assets/join.jpg" alt="Profile Picture" class="message-pic">
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
        const penerima = "<?= $akun["username"]?>"
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
                  console.log(old_id);
                  if (old_id == loadChat.id) {
                      return;
                  } else {
                      if (loadChat.pengirim === "<?= $_SESSION["username"]?>"){
                          return;
                      }
                      old_id = loadChat.id;
                      const newChat = document.createElement('div');
                      newChat.classList.add('message-left');
                      newChat.innerHTML = `
                          <div class="message left">
                            <img src="assets/join.jpg" alt="Profile Picture" class="message-pic">
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
          const penerima = "<?= $akun["username"]?>"
          const last = "true";
          xhr.send(`session=${sessionCurr}&penerima=${penerima}&last-chat=${last}`);
      }
      // Poll for new comments every 5 seconds
      setInterval(fetchNewComments, 5000);
  })
</script>