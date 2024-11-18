<div class="history-chatpg">
  <div class="title-upper">
    <button class="back-page" onclick="closep('history_chat')"><i class="fa-solid fa-arrow-left" style="font-size: 30px"></i></button>
    <h1>PESAN</h1>
  </div>
  <div>
    <!DOCTYPE html>
    <html>
    <head>
      <title>Pesan</title>
      <style>
        body {
            margin: 0;
            background-color: #f3f3f3;
            scrollbar-width: none;
            font-family: 'helvetica' !important;
        }

        .custom-line {
          /* margin-top: 150px; */
          width: 100%; 
          height: 5px; 
          background-color: #2c2c2c; 
          margin: 10px 0; 
        }
        
        .nav-input-search{
          border-top-left-radius: 20px;
          border-bottom-left-radius: 20px;
          background-color: #f3f3f3;
          height: 30px;
          width: 400px;
          padding-left: 20px;
          padding-right: 20px;
          font-size: 15px;
          outline: none;
          margin-top: auto;
          margin-bottom: auto;
      }

      .nav-search-bar{
          border: 3px solid black;
          margin-right: auto;
          margin-left: auto;
          display: flex;
          background-color: #f3f3f3;
          width: fit-content;
          border-radius: 25px;
          margin-top: auto;
          margin-bottom: auto;
      }

      .nav-search-button:hover{
          background-color: #f3f3f3;
      }

      .nav-search-button{
          border-top-right-radius: 20px;
          border-bottom-right-radius: 20px;
          background-color: #f3f3f3;
          width: 50px;
          outline: none;
      }

      .riwayat-pesan{
          text-align: left;
          margin-top: 2rem;
          margin-left: 25%;
        }
      .chat-item {
          border-width: 500px;
          width: 50%;
          margin: 0 auto;
          border: 3px solid black;
          border-radius: 7px;
          margin-top: 20px;
          display: flex;
          align-items: center;
          padding: 35px;
      }

      .chat-item:hover{
        background-color: rgba(0, 0, 0, 0.279);
      }

      .chat-item-profile {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 10px;
      }

      .chat-item-profile img {
        width: 100%;
        height : 100%;
        object-fit: cover;
      }

      .chat-item-content {
        flex: 1;
      }

      .chat-item-name {
        font-weight: bold;
      }

      .chat-item-message {
        color: #666;
      }

      .chat-item-time {
        font-size: 12px;
        color: #999;
      }
      </style>
    </head>
    <body>
    <div class="custom-line"></div>
      <search>
        <form action="" class="nav-search-bar" method="get">
            <input type="text" placeholder="Cari konten atau user" name="search-account" class="nav-input-search">
            <button type="submit" class="nav-search-button">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
      </search>
      <div class="riwayat-pesan">Riwayat Pesan</div>
      <div class="chat-item">
        <div class="chat-item-profile">
          <img src="assets/join.jpg" alt="Profile">
        </div>
        <div class="chat-item-content">
          <div class="chat-item-name">User  1</div>

        </div>
      </div>
      <div class="chat-item">
        <div class="chat-item-profile">
          <img src="assets/join.jpg" alt="Profile">
        </div>
        <div class="chat-item-content">
          <div class="chat-item-name">User  2</div>
          <div class="chat-item-message">Hello, how are you?</div>
          <div class="chat-item-time">10:00 AM</div>
        </div>
      </div>
      <div class="chat-item">
        <div class="chat-item-profile">
          <img src="assets/join.jpg" alt="Profile">
        </div>
        <div class="chat-item-content">
          <div class="chat-item-name">User  3</div>
          <div class="chat-item-message">Hello, how are you?</div>
          <div class="chat-item-time">10:00 AM</div>
        </div>
      </div>
      
    </body>
    </html>
  </div>
    
</div>

<div class="chatpg">
    <div class="title-upper">
        <button class="back-page" onclick="closep('chat')"><i class="fa-solid fa-arrow-left" style="font-size: 30px"></i></button>
        <h1>NAMA AKUN</h1>
    </div>
</div>