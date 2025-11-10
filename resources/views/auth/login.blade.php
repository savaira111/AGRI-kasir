/* 🌾 Style Halaman Login */
body, html {
    height: 100%;
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: url('../../images/bg-login.jpg') no-repeat center center/cover;
}

/* 🌿 Kotak Form Transparan */
.login-container {
    background: rgba(255, 255, 255, 0.35);
    backdrop-filter: blur(8px);
    padding: 40px 50px;
    border-radius: 20px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    text-align: center;
}

/* Label */
.form-label {
    font-weight: bold;
    color: #222;
    text-align: left;
    display: block;
}

/* Input hijau */
.form-control {
    background-color: #6ca66c;
    color: white;
    border: none;
    border-radius: 10px;
    padding: 12px;
}

.form-control::placeholder {
    color: #e6e6e6;
}

.form-control:focus {
    outline: none;
    background-color: #5a945a;
    box-shadow: none;
}

/* Tombol kuning */
.btn-dark {
    background-color: #f9d43a !important;
    color: #333 !important;
    font-weight: bold;
    border: none;
    border-radius: 30px;
    padding: 10px;
    margin-top: 10px;
    transition: all 0.3s ease;
}

.btn-dark:hover {
    background-color: #f0c933 !important;
    transform: translateY(-2px);
}

/* Tambah logo */
.login-logo {
    width: 80px;
    margin-bottom: 15px;
}

/* Responsif */
@media (max-width: 576px) {
    .login-container {
        padding: 30px 20px;
    }
}
