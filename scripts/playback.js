
let lyricsContent = document.getElementById('lyric-content');
function show_lyric(){
    const mainContentContainer = document.getElementById('main-content');
    const lyric = document.querySelector('.lyric-container');
    lyric.classList.toggle('lyric');
    mainContentContainer.classList.toggle('lyric');
}

async function check_lirik(){
    Lyric = await loadFile(lirik);
    const regex = /^\[\d{2}:\d{2}\.\d{2}\]/;

    for (let i = 0; i < Lyric.length; i++) {
        if (!regex.test(Lyric[i])) {
            console.log("salah");
            tanpalive(Lyric)
            return;
        }
        
    }
    console.log("benar");
    startLirik();
}

let music = document.getElementById('playMusic');
let currentStart = document.getElementById('currentStart');
let currentEnd = document.getElementById('currentEnd');
let seek = document.getElementById('seek');
let bar2 = document.getElementById('bar2');
let dot = document.getElementById('dot');
let playMusic = document.getElementById('play-music');
let pauseMusic = document.getElementById('pause-music');
lirik; // Tentukan path file lirik yang benar

let lirikTimers = []; // Untuk menyimpan timer setTimeout
let lirikIndex = 0; // Untuk melacak posisi lirik yang sedang ditampilkan

let startTime = 0; // Waktu saat audio mulai diputar
let remainingTime = 0; // Sisa waktu saat pause

// Fungsi untuk memulai audio
function playAudio() {
    music.play();
    playMusic.style.display = "none";
    pauseMusic.style.display = "block";
    check_lirik();
    startLirik(); // Mulai lirik saat musik diputar
}

// Fungsi untuk menghentikan audio
function pauseAudio() {
    music.pause();
    playMusic.style.display = "block";
    pauseMusic.style.display = "none";
    stopLirik(); // Hentikan lirik saat musik dijeda
}

// Fungsi untuk menghentikan audio dan reset ke awal
function stopAudio() {
    music.pause();
    music.currentTime = 0;
    playMusic.style.display = "block";
    pauseMusic.style.display = "none";
    lyricsContent.innerText = ''; // Hapus lirik yang sedang ditampilkan
    stopLirik(); // Hentikan lirik saat musik dihentikan
}

// Fungsi untuk mengupdate waktu dan progress bar
music.addEventListener('timeupdate', () => {
    let music_curr = music.currentTime;
    let music_dur = music.duration;

    let min = Math.floor(music_dur / 60);
    let sec = Math.floor(music_dur % 60);
    currentEnd.textContent = `${min}:${sec < 10 ? '0' + sec : sec}`;

    let min1 = Math.floor(music_curr / 60);
    let sec1 = Math.floor(music_curr % 60);
    currentStart.textContent = `${min1}:${sec1 < 10 ? '0' + sec1 : sec1}`;

    let progressbar = (music_curr / music_dur) * 100;
    seek.value = progressbar;
    bar2.style.width = `${progressbar}%`;
    dot.style.left = `${progressbar}%`;

    if (currentStart.textContent === currentEnd.textContent) {
        stopAudio();
    }
});

async function loadlirikbaru(){
    let lyrics_baru = await loadFile(lirik);
    let bef = 0;

    for (let i = 0; i < lyrics_baru.length; i++) {
        let lirikB = lyrics_baru[i].trim();
        let minute = parseInt(lirikB.substr(1, 2));
        let second = parseInt(lirikB.substr(4, 5));

        if (isNaN(minute) || isNaN(second)) return;

        let curr = minute * 60 + second;
        
        // Cek jika waktu sama dengan remainingTime (dalam detik, bukan milidetik)
        if (remainingTime >= bef && remainingTime < curr){
            currindex = i - 1;
            console.log(currindex);
            break; // Berhenti jika ditemukan lirik yang sesuai dengan waktu
        }
        bef = curr;
        
    }
}

// Fungsi untuk menangani seek bar
seek.addEventListener('input', () => {
    let seekTo = music.duration * (seek.value / 100);
    if (seekTo == 0) {
        lyricsContent.innerText = '';
    }
    music.currentTime = seekTo;
    remainingTime = music.currentTime;
    bar2.style.width = `${seek.value}%`;
    dot.style.left = `${seek.value}%`;
    loadlirikbaru();
    startLirik();
    //  Lanjutkan lirik dari waktu yang dipilih
});

// Fungsi untuk memuat file lirik
async function loadFile(fileName) {
    return await fetch(fileName)
        .then(data => data.text())
        .then(data => data.trim().split("\n"))
        .catch(err => console.error(err));
}

function tanpalive(lyrik){
    lyricsContent.innerText = lyrik;
}

// Fungsi untuk memulai lirik
let currindex = 0;
async function startLirik() {
    // Hentikan timer lirik yang sebelumnya
    stopLirik();

    let lyrics = await loadFile(lirik);
    let index = currindex;
    let delay;

    // Setiap baris lirik dijalankan sesuai waktunya
    lyrics.slice(index).forEach(line => {
        line = line.trim();
        let minute = parseInt(line.substr(1, 2));
        let second = parseInt(line.substr(4, 5));
        if (isNaN(minute) || isNaN(second)) return;

        let text = line.substr(line.indexOf(']') + 1).trim();
        
        if (remainingTime == 0){
            delay = (minute * 60 + second) * 1000;

        } else {

            delay = (minute * 60 + second) * 1000 - remainingTime * 1000;
        }

        let timer = setTimeout(() => {
            lyricsContent.innerText = text;
            currindex++;
        }, delay);

        lirikTimers.push(timer); // Simpan timer untuk bisa dihentikan
    });
}

// Fungsi untuk menghentikan lirik
function stopLirik() {
    lirikTimers.forEach(timer => clearTimeout(timer)); // Hentikan semua timer lirik
    lirikTimers = [];
    // lyricsContent.innerText = ''; // Hapus lirik yang sedang ditampilkan
}


// Event listener untuk pause (jeda)
music.addEventListener('pause', () => {
    remainingTime = music.currentTime; // Simpan waktu saat dijeda
    stopLirik(); // Hentikan lirik saat musik dijeda
});

// Event listener untuk ended (berhenti)
music.addEventListener('ended', () => {
    stopLirik(); // Hentikan lirik saat musik selesai
    lyricsContent.innerText = "Lagu selesai."; // Pesan selesai
});


const mainContent = document.querySelector(".main-content");
const mainContentContainer = document.getElementById("main-content");

mainContentContainer.addEventListener("mouseover", function(event) {
    if (mainContentContainer.contains(event.target)) {
        mainContent.classList.add("show");
    }
});

mainContentContainer.addEventListener("mouseout", function(event) {
    if (mainContentContainer.contains(event.target)) {
        mainContent.classList.remove("show");
    }
});