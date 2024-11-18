<div class="history-chatpg">
  <div class="title-upper">
    <button class="back-page" onclick="closep('history_chat')"><i class="fa-solid fa-arrow-left" style="font-size: 30px"></i></button>
    <h1>PESAN</h1>
  </div>
      <style>
        body {
            margin: 0;
            background-color: #f3f3f3;
            scrollbar-width: none;
            font-family: 'helvetica' !important;
        }

        .custom-line {
          width: 100%; 
          height: 5px; 
          background-color: #2c2c2c; 
          margin: 40px 0; 
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

      .riwayat-pesan {
          text-align: left;
          margin-top: 2rem;
          margin-left: 25%;
          font-size: 20px;
          color: #333;
          text-transform: uppercase;
          font-weight: bold;
          letter-spacing: 1px;
        }

      .chat-item {
          cursor: pointer;
          border: none;
          width: 50%;
          margin: 0 auto;
          box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
          border: 3px solid black;
          border-radius: 15px;
          margin-top: 20px;
          display: flex;
          align-items: center;
          padding: 25px;
          transition: transform 0.4s ease, background-color 0.3s ease, box-shadow 0.3s ease;1
        }

      .chat-item:hover{
          background-color: rgba(0, 0, 0, 0.279);        
          box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
          transform: translateY(-8px);
        }

      .chat-item-profile {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 15px;
        border: 3px solid #333;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
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
        font-size: 16px;
        color: #333;
        margin-bottom: 5px;
      }

      .chat-item-message {
        color: #555;
        font-size: 15px;
      }

      .chat-item-time {
        font-weight: bold;
        font-size: 13px;
        color: #333;
        text-align: right;
        margin-top: 5px;
      }
      </style>
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
        <div class="chat-item-time">10:00 AM</div>
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
</div>

<div class="chatpg">
    <div class="title-upper">
        <button class="back-page" onclick="closep('chat')"><i class="fa-solid fa-arrow-left" style="font-size: 30px"></i></button>
        <h1>NAMA AKUN</h1>
    </div>
</div>