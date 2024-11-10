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

const login_page = document.querySelector(".loginpg");
const signup_page = document.querySelector(".signuppg");
const setting_page = document.querySelector(".settingspg");

function open_slide(index){
    if (index == 1){
        login_page.classList.add("slide")
        const login = login_page.classList.contains("slide");
        if (login){
            localStorage.setItem("slideL", "enabled");
            sidebar.classList.remove("active");
            offScreenMenu.classList.remove("active");
    
        } else {
            localStorage.setItem("slideL", "disabled");
        }

    } else if (index == 2){
        open_slide(1);
        signup_page.classList.add("slide")
        const signup = signup_page.classList.contains("slide");
        if (signup){
            localStorage.setItem("slideS", "enabled");
            sidebar.classList.remove("active");
            offScreenMenu.classList.remove("active");
    
        } else {
            localStorage.setItem("slideS", "disabled");
        }

    } else if (index == 3){
        setting_page.classList.add("slide")
        const setting = setting_page.classList.contains("slide")
        if (setting){
            localStorage.setItem("slideSET", "enabled");
            sidebar.classList.remove("active");
            offScreenMenu.classList.remove("active");

        } else {
            localStorage.setItem("slideSET", "disabled");
        }
    }
}
window.onload = open_slide;

function closep(index){
    if (index == 1){
        login_page.classList.remove("slide")
        localStorage.setItem("slideL", "disabled");
        
    } else if (index == 2){
        signup_page.classList.remove("slide")
        localStorage.setItem("slideS", "disabled");
        
    } else if (index == 3){
        setting_page.classList.remove("slide")
        localStorage.setItem("slideSET", "disabled")
    }
}

function storage(){
    const login = localStorage.getItem("slideL");
    const signup = localStorage.getItem("slideS");
    const setting = localStorage.getItem("slideSET")
    
    if (login === "enabled"){
        login_page.classList.add("slide");
        
    } else if (signup === "enabled"){
        login_page.classList.add("slide");
        signup_page.classList.add("slide")

    } else if (setting === "enabled"){
        setting_page.classList.add("slide")
        
    } else {
        login_page.classList.remove("slide");
        signup_page.classList.remove("slide")
        setting_page.classList.remove("slide")
    }
}
window.onload = storage;

function pripub(type){
    private = document.getElementById("private")
    public = document.getElementById("public")

    if (type === "private"){
        public.classList.remove("pripub-active")
        private.classList.add("pripub-active")
        private.style.color = "#f3f3f3"
        public.style.color = "#303841"
        
        
    } else if (type === "public"){
        private.classList.remove("pripub-active")
        public.classList.add("pripub-active")
        public.style.color = "#f3f3f3"
        private.style.color = "#303841"
    }
}