
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

function right_slide(src, dst){
    const transition = document.getElementById("R-slide");
    let link;
    transition.classList.add("slide-left");
    
    if (src === 0 && dst === 1){
        link = "login.php";
        
    } else if (src === 0 && dst === 2){
        link = "crud/signup.php"
        
    } else if (src === 1 && dst === 2){
        link = "crud/signup.php";
    }
    
    setTimeout(() => {
        transition.classList.remove("slide-left");
        sidebar.classList.remove("active");
        offScreenMenu.classList.remove("active");
        window.location.href = link;
    }, 1000);
    
}

function left_slide(src, dst){
    const transition = document.getElementById("L-slide");
    let link;
    transition.classList.add("slide-right");
    
    if (src === 1 && dst === 0){
        link = "index.php";
        
        
    } else if (src === 2 && dst === 1){
        link = "../login.php"
        transition.style.background = "lightgray"
    }
    setTimeout(() => {
        transition.classList.remove("slide-right");
        window.location.href = link;
    }, 1000);
}