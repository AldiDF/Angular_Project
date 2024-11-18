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

function limit_size(event){
    const limit = 12 * 1024 *1024;
    var file = event.target.files[0];
    var path = URL.createObjectURL(event.target.files[0]);
    var photo = document.getElementById("thumbnail").value;
    var title = document.getElementById("title-thumbnail");
    var image = document.getElementById("thumbnail-preview");
    var ext = file.name.split(".").pop();

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