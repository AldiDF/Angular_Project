function openNav(){
    document.getElementById("sidebar").style.width = "250px";
}


function closeNav(){
    document.getElementById("sidebar").style.width = "0";
}

let button = document.getElementById("mode");
let header = document.getElementById("header");
let footer = document.getElementById("footer")

function mode(){
    let body = document.body;
    body.classList.toggle("dark-mode")
    
    const darkmode = document.body.classList.contains("dark-mode");

    if (darkmode){
        localStorage.setItem("dark-mode", "enabled");
        button.textContent = "Light";
        header.style.background = "linear-gradient(rgba(109, 199, 255), #15292B)"
        footer.style.background = "linear-gradient(#15292B, rgba(109, 199, 255))"
        
    } else {
        localStorage.setItem("dark-mode", "disabled");
        button.textContent = "Dark";
        header.style.background = "linear-gradient(rgba(109, 199, 255), lavender)"
        footer.style.background = "linear-gradient(lavender,rgba(109, 199, 255))" 
    }
}

window.onload = mode;

function checkmode(){
    const modesetting = localStorage.getItem("dark-mode");
    
    if (modesetting === "enabled"){
        document.body.classList.add("dark-mode");
        button.textContent = "Light";
        header.style.background = "linear-gradient(rgba(109, 199, 255), #15292B)"
        footer.style.background = "linear-gradient(#15292B, rgba(109, 199, 255))"
        
    } else {
        button.textContent = "Dark";
        header.style.background = "linear-gradient(rgba(109, 199, 255), lavender)"
        footer.style.background = "linear-gradient(lavender,rgba(109, 199, 255))"
    }

}
window.onload = checkmode;

function mlbb_category(menu){
    document.getElementById("menu1").style.display = "none";
    document.getElementById("menu2").style.display = "none";
    document.getElementById("menu3").style.display = "none";

    if (menu === 1){
        document.getElementById("menu1").style.display = "block";
    } else if (menu === 2){
        document.getElementById("menu2").style.display = "block";
    } else if (menu === 3){
        document.getElementById("menu3").style.display = "block";
    }

}

function methodt(menu){
    document.getElementById("payment").style.display = "none";

    if (menu == 1){
        document.getElementById("payment").style.display = "block";
    }
}

function category(menu){

    if (menu === 1){
        document.getElementById("menu").style.display = "block";
    }
}


function mla_category(menu){

    if (menu === 1){
        document.getElementById("menu").style.display = "block";
    }
}

function method_payment(choose){
    document.getElementById("other").style.display = "none";

    if (choose === 1){
        document.getElementById("other").style.display = "block";
    }
}

function reset_form_mlbb(){
    const payment = document.querySelectorAll('.pay-radio input[type="radio"]');
    payment.forEach(radio => radio.checked = false);

    const category = document.querySelectorAll('.radio-category input[type="radio"]');
    const topUp = document.querySelectorAll('.radio-top-up input[type="radio"]');
    const wdp = document.querySelectorAll('.radio-wdp input[type="radio"]');
    const twilight = document.querySelectorAll('.radio-twilight input[type="radio"]');

    category.forEach(radio => radio.checked = false);
    topUp.forEach(radio => radio.checked = false);
    wdp.forEach(radio => radio.checked = false);
    twilight.forEach(radio => radio.checked = false);

    document.getElementById("other").style.display = "none";
    document.getElementById("menu1").style.display = "none";
    document.getElementById("menu2").style.display = "none";
    document.getElementById("menu3").style.display = "none";
    document.getElementById("payment").style.display = "none";
}

function reset_form_OneCategory(){
    const payment = document.querySelectorAll('.pay-radio input[type="radio"]');
    payment.forEach(radio => radio.checked = false);

    const category = document.querySelectorAll('.radio-category-ff input[type="radio"]');
    const topUp = document.querySelectorAll('.radio-top-up input[type="radio"]');

    category.forEach(radio => radio.checked = false);
    topUp.forEach(radio => radio.checked = false);

    document.getElementById("other").style.display = "none";
    document.getElementById("menu").style.display = "none";
    document.getElementById("payment").style.display = "none";
}


function reset_form_mla(){
    const payment = document.querySelectorAll('.pay-radio input[type="radio"]');
    payment.forEach(radio => radio.checked = false);

    const category = document.querySelectorAll('.radio-category-mla input[type="radio"]');
    const topUp = document.querySelectorAll('.radio-top-up input[type="radio"]');

    category.forEach(radio => radio.checked = false);
    topUp.forEach(radio => radio.checked = false);

    document.getElementById("other").style.display = "none";
    document.getElementById("menu").style.display = "none";
    document.getElementById("payment").style.display = "none";
}

function limit_number_forRegister(){
    const number = document.getElementById("num").value;
    const pattern = /^\d{12}$/;

    if (!pattern.test(number)) {
        alert("Silahkan Masukkan Angka 12 Digit");
        return false;
    }

    return true;
}

function limit_number_forTopupff(){
    const id = document.getElementById("user").value;

    const number = document.getElementById("num").value;

    if (id.length < 8) {
        alert("Silahkan masukkan id dengan angka minimal 8 Digit");
        return false;
    }

    if (number.length < 10) {
        alert("Silahkan masukkan nomor rekening/telepon dengan angka minimal 10 Digit");
        return false;
    }

    return true;
}

function limit_number_forTopupmlbbmla(){
    const id = document.getElementById("user").value;
    const server = document.getElementById("server").value;

    const number = document.getElementById("num").value;

    if (id.length < 8) {
        alert("Silahkan masukkan id dengan angka minimal 8 Digit");
        return false;
    }

    if (server.length < 4) {
        alert("Silahkan masukkan id server dengan angka minimal 4 Digit");
        return false;
    }

    if (number.length < 10) {
        alert("Silahkan masukkan nomor rekening/telepon dengan angka minimal 10 Digit");
        return false;
    }

    return true;
}

function limit_number_forTopuppubg(){
    const id = document.getElementById("user").value;

    const number = document.getElementById("num").value;

    if (id.length < 10) {
        alert("Silahkan masukkan id dengan angka 10 Digit");
        return false;
    }

    if (number.length < 10) {
        alert("Silahkan masukkan nomor rekening/telepon dengan angka minimal 10 Digit");
        return false;
    }

    return true;
}

function hover_button(button) {
    const left = document.getElementById("left-button");
    const right = document.getElementById("right-button");
    const mid = document.getElementById("mid-button");
    const empty = document.getElementById("if-empty");
    const account = document.getElementById("account");
    const buy = document.getElementById("buy");
    const selling = document.getElementById("selling");

    left.classList.remove("active");
    right.classList.remove("active");
    mid.classList.remove("active");

    account.style.display = "none";
    buy.style.display = "none";
    selling.style.display ="none";

    if (button === "left") {
        left.classList.add("active");
        empty.style.display = "none";
        buy.style.display = "block";
        
    } else if (button === "right") {
        right.classList.add("active");
        empty.style.display = "none";
        account.style.display = "block";

    } else if (button === "mid"){
        mid.classList.add("active");
        empty.style.display = "none";
        selling.style.display ="block";
    }
}

function limit_size(event){
    const limit = 3 * 1024 *1024;
    var file = event.target.files[0];
    var path = URL.createObjectURL(event.target.files[0]);
    var photo = document.getElementById("photo").value;
    var title = document.getElementById("title-picture");
    var image = document.getElementById("up-picture");
    var ext = file.name.split(".").pop();

    if (file.size > limit){
        alert("Maksimal File adalah 3 MB");
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