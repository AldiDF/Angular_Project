const login_page = document.querySelector(".loginpg");
const signup_page = document.querySelector(".signuppg");
const setting_page = document.querySelector(".settingspg");
const userEdit_page = document.querySelector(".edit-userpg");
const listMusic_page = document.querySelector(".manage-musicpg")
const musicEdit_page = document.querySelector(".edit-musicpg")
const following_page = document.querySelector(".followingpg")
const follower_page = document.querySelector(".followerpg")
const history_chat_page = document.querySelector(".history-chatpg")
const chat_page = document.querySelector(".chatpg")
const upload_page = document.querySelector(".uploadpg")

function open_slide(index){
    if (index == "login"){
        login_page.classList.add("slide")
        const login = login_page.classList.contains("slide");
        if (login){
            sessionStorage.setItem("slideL", "enabled");
            sidebar.classList.remove("active");
            offScreenMenu.classList.remove("active");
    
        } else {
            sessionStorage.setItem("slideL", "disabled");
        }

    } else if (index == "signup"){
        login_page.classList.add("slide")
        signup_page.classList.add("slide")
        const signup = signup_page.classList.contains("slide");
        if (signup){
            sessionStorage.setItem("slideS", "enabled");
            sidebar.classList.remove("active");
            offScreenMenu.classList.remove("active");
    
        } else {
            sessionStorage.setItem("slideS", "disabled");
        }

    } else if (index == "setting"){
        setting_page.classList.add("slide")
        const setting = setting_page.classList.contains("slide")
        if (setting){
            sessionStorage.setItem("slideSET", "enabled");
            sidebar.classList.remove("active");
            offScreenMenu.classList.remove("active");

        } else {
            sessionStorage.setItem("slideSET", "disabled");
        }

    } else if (index == "userEdit"){
        userEdit_page.classList.add("slide")
        const edit = userEdit_page.classList.contains("slide")
        if (edit){
            sessionStorage.setItem("slideED", "enabled");
            sidebar.classList.remove("active");
            offScreenMenu.classList.remove("active");

        } else {
            sessionStorage.setItem("slideED", "disabled");
        }

    } else if (index == "music"){
        listMusic_page.classList.add("slide")
        const edit = listMusic_page.classList.contains("slide")
        if (edit){
            sessionStorage.setItem("slideMS", "enabled");
            sidebar.classList.remove("active");
            offScreenMenu.classList.remove("active");

        } else {
            sessionStorage.setItem("slideMS", "disabled");
        }

    } else if (index == "musicEdit"){
        musicEdit_page.classList.add("slide")
        const edit = musicEdit_page.classList.contains("slide")
        if (edit){
            sessionStorage.setItem("slideME", "enabled");
            sidebar.classList.remove("active");
            offScreenMenu.classList.remove("active");

        } else {
            sessionStorage.setItem("slideME", "disabled");
        }
        
    } else if (index == "following"){
        following_page.classList.add("slide")
        const edit = following_page.classList.contains("slide")
        if (edit){
            sessionStorage.setItem("slideFG", "enabled");
            sidebar.classList.remove("active");
            offScreenMenu.classList.remove("active");

        } else {
            sessionStorage.setItem("slideFG", "disabled");
        }

    } else if (index == "follower"){
        follower_page.classList.add("slide")
        const edit = follower_page.classList.contains("slide")
        if (edit){
            sessionStorage.setItem("slideFR", "enabled");
            sidebar.classList.remove("active");
            offScreenMenu.classList.remove("active");

        } else {
            sessionStorage.setItem("slideFR", "disabled");
        }

    } else if (index == "history_chat"){
        history_chat_page.classList.add("slide")
        const edit = history_chat_page.classList.contains("slide")
        if (edit){
            sessionStorage.setItem("slideHC", "enabled");
            sidebar.classList.remove("active");
            offScreenMenu.classList.remove("active");

        } else {
            sessionStorage.setItem("slideHC", "disabled");
        }

    } else if (index == "chat"){
        chat_page.classList.add("slide")
        const edit = chat_page.classList.contains("slide")
        if (edit){
            sessionStorage.setItem("slideCH", "enabled");
            sidebar.classList.remove("active");
            offScreenMenu.classList.remove("active");

        } else {
            sessionStorage.setItem("slideCH", "disabled");
        }

    } else if (index == "upload"){
        upload_page.classList.add("slide")
        const edit = upload_page.classList.contains("slide")
        if (edit){
            sessionStorage.setItem("slideUP", "enabled");
            sidebar.classList.remove("active");
            offScreenMenu.classList.remove("active");

        } else {
            sessionStorage.setItem("slideUP", "disabled");
        }
    }
}
window.onload = open_slide;

function closep(index){
    if (index == "login"){
        login_page.classList.remove("slide")
        sessionStorage.setItem("slideL", "disabled");
        
    } else if (index == "signup"){
        signup_page.classList.remove("slide")
        sessionStorage.setItem("slideS", "disabled");
        
    } else if (index == "setting"){
        setting_page.classList.remove("slide")
        sessionStorage.setItem("slideSET", "disabled")
        
    } else if (index == "userEdit"){
        userEdit_page.classList.remove("slide")
        sessionStorage.setItem("slideED", "disabled")

    } else if (index == "music"){
        listMusic_page.classList.remove("slide");
        sessionStorage.setItem("slideMS", "disabled");

    } else if (index == "musicEdit"){
        musicEdit_page.classList.remove("slide");
        sessionStorage.setItem("slideME", "disabled");

    } else if (index == "following"){
        following_page.classList.remove("slide");
        sessionStorage.setItem("slideFG", "disabled");

    } else if (index == "follower"){
        follower_page.classList.remove("slide");
        sessionStorage.setItem("slideFR", "disabled");

    } else if (index == "history_chat"){
        history_chat_page.classList.remove("slide");
        sessionStorage.setItem("slideHC", "disabled");

    } else if (index == "chat"){
        chat_page.classList.remove("slide");
        sessionStorage.setItem("slideCH", "disabled");

    } else if (index == "upload"){
        upload_page.classList.remove("slide");
        sessionStorage.setItem("slideUP", "disabled");
    }
}

function storage(){
    console.log("chat slide enabled")
    const login = sessionStorage.getItem("slideL");
    const signup = sessionStorage.getItem("slideS");
    const setting = sessionStorage.getItem("slideSET")
    const userEdit = sessionStorage.getItem("slideED")
    const music = sessionStorage.getItem("slideMS")
    const musicEdit = sessionStorage.getItem("slideME")
    const following = sessionStorage.getItem("slideFG")
    const follower = sessionStorage.getItem("slideFR")
    const history_chat = sessionStorage.getItem("slideHC")
    const chat = sessionStorage.getItem("slideCH")
    const upload = sessionStorage.getItem("slideUP")
    
    if (login === "enabled"){
        login_page.classList.add("slide");
        
    } else if (signup === "enabled"){
        login_page.classList.add("slide");
        signup_page.classList.add("slide")

    } else if (setting === "enabled"){
        setting_page.classList.add("slide")
        
    } else if (userEdit === "enabled"){
        userEdit_page.classList.add("slide")
    
    } else if (music === "enabled"){
        listMusic_page.classList.add("slide")
    
    } else if (musicEdit === "enabled"){
        musicEdit_page.classList.add("slide")

    } else if (following === "enabled"){
        following_page.classList.add("slide")

    } else if (follower === "enabled"){
        follower_page.classList.add("slide")

    } else if (history_chat === "enabled"){
        history_chat_page.classList.add("slide")

    } else if (chat === "enabled"){
        console.log("chat slide enabled")
        chat_page.classList.add("slide")

    } else if (upload === "enabled"){
        upload_page.classList.add("slide")
    }
}

window.onload = storage;