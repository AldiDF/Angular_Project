const music = document.getElementById('playMusic');
console.log(music);

function playAudio() {
    const playMusic = document.getElementById('play-music');
    const pauseMusic = document.getElementById('pause-music');
    music.play();
    playMusic.style.display = "none";
    pauseMusic.style.display = "block";
}

function pauseAudio() {
    const playMusic = document.getElementById('play-music');
    const pauseMusic = document.getElementById('pause-music');
    music.pause();
    playMusic.style.display = "block";
    pauseMusic.style.display = "none";
}

function stopAudio() {
    const playMusic = document.getElementById('play-music');
    const pauseMusic = document.getElementById('pause-music');
    music.pause();
    music.currentTime = 0;
    playMusic.style.display = "block";
    pauseMusic.style.display = "none";
}

let currentStart = document.getElementById('currentStart');
let currentEnd = document.getElementById('currentEnd');
let seek = document.getElementById('seek');
let bar2 = document.getElementById('bar2');
let dot = document.getElementById('dot');


music.addEventListener('timeupdate', ()=>{
    let music_curr = music.currentTime;
    let music_dur = music.duration;

    let min = Math.floor(music_dur/60);
    let sec = Math.floor(music_dur%60);
    if (sec<10) {
        sec = `0${sec}`
    }
    currentEnd.textContent = `${min}:${sec}`;
    
    let min1 = Math.floor(music_curr/60);
    let sec1 = Math.floor(music_curr%60);
    if (sec1<10) {
        sec1 = `0${sec1}`
    }
    currentStart.textContent = `${min1}:${sec1}`;

    if (currentStart.textContent === currentEnd.textContent) {
        stopAudio();
    }
    
    let progressbar = parseInt((music.currentTime/music.duration)*100);
    seek.value = progressbar;
    let seekbar = seek.value;
    bar2.style.width = `${seekbar}%`;
    dot.style.left = `${seekbar}%`;
})

seek.addEventListener('input', () => {
    let seekTo = music.duration * (seek.value / 100);
    music.currentTime = seekTo;
    bar2.style.width = `${seek.value}%`;
    dot.style.left = `${seek.value}%`;
});

const mainContent = document.querySelector(".main-content .owner-content");
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