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