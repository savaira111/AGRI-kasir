// Simpan ke cache/local storage
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    
    // Simpan ke local storage
    localStorage.setItem('username', username);
    localStorage.setItem('password', password);
    
    alert('Login data saved to cache!');
    // Lanjutkan proses login ke server...
});

// Load cached data saat page load
document.addEventListener('DOMContentLoaded', function() {
    const savedUsername = localStorage.getItem('username');
    const savedPassword = localStorage.getItem('password');
    
    if (savedUsername) {
        document.getElementById('username').value = savedUsername;
    }
    if (savedPassword) {
        document.getElementById('password').value = savedPassword;
    }
});