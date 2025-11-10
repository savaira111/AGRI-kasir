document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value.trim();

        if (username && password) {
            alert(`🌾 Login berhasil!\nSelamat datang, ${username}!`);
            window.location.href = "/dashboard";
        } else {
            alert("⚠️ Harap isi username dan password!");
        }
    });
});
