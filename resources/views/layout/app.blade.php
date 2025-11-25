<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kasir AGRI')</title>

    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Rubik', sans-serif;
            background-color: #FAFDF6;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background-color: #C0EBA6;
            padding: 20px;
            display: flex;
            flex-direction: column;
            transition: width 0.3s;
            overflow: hidden;
            flex-shrink: 0;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar img.logo {
            width: 170px;
            height: 170px;
            object-fit: cover;
            border-radius: 50%;
            display: block;
            margin: 0 auto 30px auto;
            transition: width 0.3s, height 0.3s;
        }

        .sidebar.collapsed img.logo {
            width: 50px;
            height: 50px;
            margin-bottom: 20px;
        }

        .sidebar ul {
            padding-left: 0;
            list-style: none;
        }

        .sidebar ul li a {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: black;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: background 0.2s, padding 0.3s;
        }

        .sidebar ul li a i {
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .sidebar ul li a.active,
        .sidebar ul li a:hover {
            background-color: #FCCD2A;
            font-weight: 500;
        }

        .sidebar.collapsed ul li a span {
            display: none;
        }

        /* Konten utama */
        .main-content {
            flex-grow: 1;
            margin-left: 250px;
            padding: 20px 30px;
            min-width: 0; /* penting supaya konten nggak dorong sidebar */
        }

        /* Hamburger */
        .hamburger {
            position: absolute;
            top: 15px;
            left: 15px;
            font-size: 1.5rem;
            cursor: pointer;
            display: none;
        }

        @media (max-width: 992px) {
            .hamburger {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex align-items-stretch">
        <!-- Sidebar -->
        @include('layout.sidebar')

        <!-- Konten utama -->
        <div class="main-content">
            <i class="bi bi-list hamburger" id="hamburgerBtn"></i>
            @yield('content')
        </div>
    </div>

<!-- ICON PROFILE -->
<div onclick="toggleProfileMenu()" style="cursor: pointer;">
    <img src="/img/profile.png" width="40">
</div>

        <!-- DROPDOWN PROFILE -->
        <div id="profileMenu" 
            style="
                display:none; 
                position:absolute; 
                right:20px; 
                top:70px;
                background:#8ccf8c;
                padding:15px 20px;
                border-radius:15px;
                width:150px;
                text-align:center;
            ">
            <div style="font-weight:600; margin-bottom:10px;">role</div>

            <button onclick="openLogoutModal()" 
                    class="btn btn-light w-100">
                <i class="fa-solid fa-right-from-bracket"></i> Log Out
            </button>
        </div>
        <script>
        function toggleProfileMenu() {
            let menu = document.getElementById('profileMenu');
            menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
        }
        </script>



        <!-- LOGOUT MODAL -->
        <div id="logoutModal" 
            style="
                display:none; 
                position:fixed; 
                top:0; left:0; 
                width:100%; 
                height:100%;
                background:rgba(0,0,0,0.4);
                justify-content:center;
                align-items:center;
            ">
            
            <div style="
                background:white; 
                padding:25px; 
                border-radius:20px;
                width:300px;
                text-align:center;
            ">
                <h5>Apakah anda yakin akan Log out</h5>

                <div class="d-flex justify-content-between mt-4">
                    <button class="btn btn-danger w-50 me-2"
                            onclick="closeLogoutModal()">Tidak</button>

                    <form action="{{ route('logout') }}" method="POST" class="w-50">
                        @csrf
                        <button class="btn btn-warning w-100">Ya</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
        function openLogoutModal() {
            document.getElementById('logoutModal').style.display = 'flex';
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').style.display = 'none';
        }
        </script>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const hamburgerBtn = document.getElementById('hamburgerBtn');

        hamburgerBtn.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');

    if (sidebar.classList.contains('collapsed')) {
        document.querySelector('.main-content').style.marginLeft = '70px';
    } else {
        document.querySelector('.main-content').style.marginLeft = '250px';
        }
    });
    </script>
</body>
</html>
