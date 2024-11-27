const sidebar = document.querySelector(".sidebar-menu")
const offScreenMenu = document.querySelector(".off-screen-menu")
function sideBar(){
    sidebar.classList.toggle("active");
    offScreenMenu.classList.toggle("active");
}

window.addEventListener("click", (event) => {
    if (!sidebar.contains(event.target) && !offScreenMenu.contains(event.target)) {
        sidebar.classList.remove("active");
        offScreenMenu.classList.remove("active");
        
    }
});

function limit_size(event, img){
    const limit = 12 * 1024 *1024;
    var file = event.target.files[0];
    var path = URL.createObjectURL(event.target.files[0]);

    if (img == "upThumbnail"){
        var photo = document.getElementById("input-thumbnail").value;
        var title = document.getElementById("title-thumbnail");
        var image = document.getElementById("thumbnail-preview");
        var ext = file.name.split(".").pop();
        console.log(img);

    } else if (img == "editProfile"){
        var photo = document.getElementById("input-profile").value;
        var title = document.getElementById("title-profile");
        var image = document.getElementById("profile-preview");
        var ext = file.name.split(".").pop();

    } else {
        var photo = document.getElementById("input-Thumbnail").value;
        var title = document.getElementById("title-Thumbnail");
        var image = document.getElementById("Thumbnail-preview");
        var ext = file.name.split(".").pop();
    }

    if (file.size > limit){
        alert("Maksimal File adalah 12 MB");
        event.target.value = "";
        return;
    }

    if (ext == "png" || ext == "jpg" || ext =="jpeg"){
        if (photo){
            image.style.display = "block";
            title.style.display = "none";
            image.src = path;
            console.log(ext);
            return;
        }
    }

    alert("Ekstensi File Harus png, jpg, jpeg");
}

const open_notif = document.getElementById("open-notif")
const close_notif = document.getElementById("close-notif")
const container_notif = document.getElementById("confirm")


function open_confirm(){
    container_notif.classList.add("open")
}

function close_confirm(){
    container_notif.classList.remove("open")
}

function follow(type){
    const following = document.getElementById("following-btn")
    const follower = document.getElementById("follower-btn")
    const list_following = document.getElementById("list-following")
    const list_follower = document.getElementById("list-follower")

    if (type === "following"){
        localStorage.setItem("following", "true")
        localStorage.setItem("follower", "false")
        follower.classList.remove("follow-active")
        following.classList.add("follow-active")
        list_following.style.display = "flex"
        list_follower.style.display = "none"
        following.style.color = "#f3f3f3"
        follower.style.color = "#303841"
        sessionStorage.setItem("follow", "following")
        
    } else if (type === "follower"){
        localStorage.setItem("follower", "true")
        localStorage.setItem("following", "false")
        following.classList.remove("follow-active")
        follower.classList.add("follow-active")
        list_follower.style.display = "flex"
        list_following.style.display = "none"
        following.style.color = "#303841"
        follower.style.color = "#f3f3f3"
        sessionStorage.setItem("follow", "follower")
    }
}

function scrollToBottom() {
    const container = document.getElementById('chatpg');
    container.scrollTop = container.scrollHeight;
}

document.addEventListener('DOMContentLoaded', scrollToBottom);

// Fungsi untuk toggle (menampilkan/menghilangkan) notifikasi
const notificationContainer = document.getElementById("notification-container");
const notificationButton = document.getElementById("bell");
function toggleNotification() {
    
    if (notificationContainer.style.display === "none" || notificationContainer.style.display === "") {
        notificationContainer.style.display = "block"; // Tampilkan notifikasi
    } else {
        notificationContainer.style.display = "none"; // Sembunyikan notifikasi
    }
}

// window.addEventListener("click", (event) => {
//     if (!notificationContainer.contains(event.target) && !notificationButton.contains(event.target)) {
//         notificationContainer.style.display = "none";
//     }
// });