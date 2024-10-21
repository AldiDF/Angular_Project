const sidebar = document.querySelector(".sidebar-menu")

const offScreenMenu = document.querySelector(".off-screen-menu")

sidebar.addEventListener("click", () => {
    sidebar.classList.toggle("active");
    offScreenMenu.classList.toggle("active");
})