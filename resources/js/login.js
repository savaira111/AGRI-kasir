//  Efek fade-in waktu halaman dibuka
document.addEventListener("DOMContentLoaded", () => {
    const loginBox = document.querySelector(".login-box");
    loginBox.style.opacity = 0;
    loginBox.style.transform = "translateY(20px)";

    setTimeout(() => {
        loginBox.style.transition = "all 0.6s ease";
        loginBox.style.opacity = 1;
        loginBox.style.transform = "translateY(0)";
    }, 100);
});

//  Validasi sederhana sebelum submit
const form = document.querySelector("form");
form.addEventListener("submit", (e) => {
    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();

    if (username === "" || password === "") {
        e.preventDefault();
        alert("Username dan password tidak boleh kosong ya 🌿");
    }
});

//  Efek klik tombol login
const button = document.querySelector(".btn-login");
button.addEventListener("mousedown", () => {
    button.style.transform = "scale(0.97)";
});
button.addEventListener("mouseup", () => {
    button.style.transform = "scale(1)";
});
