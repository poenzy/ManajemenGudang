<?php
session_start();
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit;
}
// Cegah caching oleh browser
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proksi
require_once 'user/FungsiGetOneUser.php';
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Hugo 0.122.0" />
    <title>Dashboard Manajemen Gudang</title>
    <link rel="icon" href="img/logo.png" type="image/png">
    <link rel="stylesheet" href="css/dashboard.css" />
    <link rel="stylesheet" href="css/dark-mode.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <style>
    .navbar a {
        /* border: none !important;
        box-shadow: none !important; */
        /* border-right: 1px solid rgba(232, 224, 224, 0.635); */
        border-bottom: none !important;
    }

    .sidebar {
        min-height: 150vh;
    }

    .formTambahProduk {
        width: 70%;
        margin: 20px auto;
    }

    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, 0.1);
        border: solid rgba(0, 0, 0, 0.15);
        border-width: 1px 0;
        box-shadow: inset 0 0.5em 1.5em rgba(0, 0, 0, 0.1),
            inset 0 0.125em 0.5em rgba(0, 0, 0, 0.15);
    }

    .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
    }

    .bi {
        vertical-align: -0.125em;
        fill: currentColor;
    }

    .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
    }

    .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
    }

    .bd-mode-toggle {
        z-index: 1500;
    }

    .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
    }

    /* CSS Fiel Input GPT */
    input[type="text"],
    input[type="number"],
    input[type="date"],
    input[type="file"],
    textarea,
    select {
        border: 2px solid #ced4da !important;
        border-radius: 6px;
        font-size: 1rem;
        padding: 10px 14px;
        background-color: #fff;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.08);
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    input:focus,
    textarea:focus,
    select:focus {
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        outline: none;
    }

    label.form-label {
        font-weight: 600;
        color: #222;
    }

    .form-control {
        background-color: #fff !important;
    }

    #email_user {
        border-width: 2px !important;
        border-color: rgb(206, 204, 204) !important;
        min-height: 45px;
    }

    /* End CSS Fielnd Input GPT */
    </style>
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet" />
</head>

<body>
    <header class="navbar flex-md-nowrap p-0" data-bs-theme="light"
        style="background-color:#fff ; border-bottom: 1px solid rgba(232, 224, 224, 0.635);">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-dark"
            style="height: 50px; padding-top: 10px; background-color: #fcfcfc;" href="index.php"><img src="img/logo.png"
                width="35px" class="mx-3 img-thumbnail img-fluid" alt="" srcset="">Ma.Dang</a>
    </header>
    <div class="container-fluid">
        <div class="row d-flex align-items-stretch" style="min-height: 100vh;">
            <div class="sidebar h-100 border border-right col-md-3 col-lg-2 p-0 "
                style="background-color: #fcfcfc; border-top:none !important;">
                <div class="offcanvas-md offcanvas-end" tabindex="-1" id="sidebarMenu"
                    aria-labelledby="sidebarMenuLabel" style="background-color: #fff;">
                    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2 active text-black"
                                    aria-current="page" href="index.php">
                                    <img src="icons/house-solid.svg" width="20px" alt="" srcset="">
                                    Home
                                </a>
                            </li>
                        </ul>

                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2 active text-black"
                                    aria-current="page" href="tentang.php">
                                    <img src="icons/file-person-fill.svg" width="20px" alt="" srcset="">
                                    Tentang kami
                                </a>
                            </li>
                        </ul>

                        <div class="produk mt-4">
                            <h6
                                class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-body-secondary text-uppercase">
                                <span>Produk</span>
                                <a class="link-secondary" href="#" aria-label="Add a new report">
                                    <svg class="bi">
                                        <use xlink:href="#plus-circle"></use>
                                    </svg>
                                </a>
                            </h6>
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center gap-2 active text-black"
                                        aria-current="page" href="tambahProduk.php">
                                        <img src="icons/box-solid.svg" style="width: 20px;" width="20px" alt=""
                                            srcset="">
                                        Tambah Produk
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center gap-2 active text-black"
                                        aria-current="page" href="produk.php">
                                        <img src="icons/box-seam-fill.svg" style="width: 20px;" width="20px" alt=""
                                            srcset="">
                                        Daftar Produk
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center gap-2 active text-black"
                                        aria-current="page" href="aturStok.php">
                                        <img src="icons/clipboard-fill.svg" style="width: 20px;" width="20px" alt=""
                                            srcset="">
                                        Atur Stok
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="pengguna mt-4">
                            <h6
                                class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-body-secondary text-uppercase">
                                <span>pengguna</span>
                                <a class="link-secondary" href="#" aria-label="Add a new report">
                                    <svg class="bi">
                                        <use xlink:href="#plus-circle"></use>
                                    </svg>
                                </a>
                            </h6>
                            <ul class="nav flex-column ">
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center gap-2 active text-black"
                                        aria-current="page" href="profilPengguna.php">
                                        <img src="icons/person-fill.svg" style="width: 20px;" width="20px" alt=""
                                            srcset="">
                                        Profil
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center gap-2 active text-black"
                                        aria-current="page" href="user_management.php">
                                        <img src="icons/people-fill.svg" style="width: 20px;" width="20px" alt=""
                                            srcset="">
                                        Manajemen Pengguna
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="logout mt-4">
                            <h6
                                class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-body-secondary text-uppercase">
                                <span>-</span>
                                <a class="link-secondary" href="#" aria-label="Add a new report">
                                    <svg class="bi">
                                        <use xlink:href="#plus-circle"></use>
                                    </svg>
                                </a>
                            </h6>
                            <ul class="nav flex-column ">
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center gap-2 active text-black"
                                        aria-current="page" href="user/proses_logout.php">
                                        <img src="icons/box-arrow-left.svg" style="width: 20px;" width="20px" alt=""
                                            srcset="">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
                    <h2 class="h4">Ubah Profil</h2>
                    <button id="toggleMode" class="btn toggle-mode-btn">
                        <img src="icons/moon-fill.svg" alt="" id="modeIcon"> Dark Mode
                    </button>
                </div>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form method="POST" action="user/FungsiUbahProfil.php" enctype="multipart/form-data"
                            onsubmit="return validasiForm()">
                            <?php $user = getOneUserById($_SESSION['id_admin']) ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" name="id_admin" value="<?php echo $user['id_admin'] ?>">
                                    <div class="mb-3">
                                        <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control form-control-sm" id="namaLengkap"
                                            name="nama_lengkap" value="<?php echo $user['nama_lengkap'] ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="email_user" class="form-label">Email</label>
                                        <input type="email" class="form-control form-control-sm" id="email_user"
                                            name="email_user" value="<?php echo $user['email'] ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="konfirmasiPassword">Password Sekarang</label>
                                        <input type="password" name="konfirmasiPassword" id="konfirmasiPassword"
                                            class="form-control form-control-sm">
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label" for="password1">Password Baru</label>
                                                <input type="password" name="password1" id="password1"
                                                    class="form-control form-control-sm">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="password2">Konfirmasi Password
                                                    Baru</label>
                                                <input type="password" name="password2" id="password2"
                                                    class="form-control form-control-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="no_telepon" class="form-label">No Telepon</label>
                                        <input type="text" class="form-control form-control-sm" id="no_telepon"
                                            name="no_telepon" value="<?php echo $user['no_telepon'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control form-select-sm" id="alamat" name="alamat"
                                            value="<?php echo $user['alamat'] ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="foto_profil" class="form-label">Foto Profil</label>
                                        <input type="file" class="form-control form-control-sm" id="foto_profil"
                                            name="foto_profil">
                                        <p class="small text-muted">Foto saat ini:
                                            <?= htmlspecialchars($user['foto_profil']) ?></p>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary"
                            style="margin-right: 20px; margin-bottom:20px ;">Simpan Perubahan</button>
                    </div>
                    </form>
                </div>
        </div>
    </div>

    </div>
    </div>
    </main>
    </div>
    <script src="js/dark-mode.js"></script>
    <script>
    function validasiForm() {
        const nama = document.querySelector('#namaLengkap').value;
        const email = document.querySelector('#email_user').value;
        const password = document.querySelector("#password1").value;
        const passwordConfirm = document.querySelector("#password2").value;

        if (!nama) {
            alert('Silahkan masukkan nama')
            return false
        }
        if (password.length > 0) {
            if (!password || password.length < 6) {
                alert("Password harus minimal 6 karakter")
                return false;
            }
        }
        if (password !== passwordConfirm) {
            alert('Konfirmasi password tidak sesuai')
            return false
        }

        return true
    }
    </script>
    <script src="js/chart.js-4.4.8/package/dist/chart.umd.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- <script src="js/dashboard.js"></script> -->
    <script src="js/script.js"></script>
</body>

</html>