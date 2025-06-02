<!DOCTYPE html>
<?php
session_start();
?>


<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Hugo 0.122.0" />
    <title>Dashboard Manajemen Gudang</title>
    <link rel="stylesheet" href="css/dashboard.css" />
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

    /* End CSS Fielnd Input GPT */
    </style>
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet" />
</head>

<body>
    <header class="navbar flex-md-nowrap p-0" data-bs-theme="light"
        style="background-color:#fff ; border-bottom: 1px solid rgba(232, 224, 224, 0.635);">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-dar"
            style="height: 50px; padding-top: 10px; background-color: #fcfcfc;" href="index.html">Ma.Dang</a>
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
                                        <img src="icons/box-solid.svg" style="width: 20px;" width="20px" alt=""
                                            srcset="">
                                        Daftar Produk
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center gap-2 active text-black"
                                        aria-current="page" href="aturStok.php">
                                        <img src="icons/box-solid.svg" style="width: 20px;" width="20px" alt=""
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
                    </div>
                </div>
            </div>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
                    <h2 class="h4">Tambah Produk</h2>
                </div>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            // Ambil data id_produk dan jumlah dari form yang dikirim
                            $id_produk = $_POST['id'];
                            $keterangan = $_POST['keterangan'];
                        }
                        ?>
                        <form action="produkBarang/ubahStok.php" method="POST">
                            <!-- Hidden ID Produk -->
                            <input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>">

                            <!-- Input Keterangan -->
                            <input type="hidden" name="keterangan"
                                value="<?php echo $keterangan == 'masuk' ? 'masuk' : 'keluar'; ?>">

                            <!-- Input Jumlah -->
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" value="10" min="1"
                                    required>
                            </div>

                            <!-- Input Tanggal Transaksi -->
                            <div class="mb-3">
                                <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                                <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi"
                                    required>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>

    </div>
    </div>
    </main>
    </div>

    <script>
    <?php if (isset($_SESSION['toast'])): ?>
    document.addEventListener("DOMContentLoaded", function() {
        <?php
                $toastMessage = $_SESSION['toast'];
                $isSuccess = strpos($toastMessage, '✅') !== false;
                $isError = strpos($toastMessage, '❌') !== false;
                ?>
        <?php if ($isSuccess): ?>
        toastr.success("<?= str_replace('✅ ', '', $toastMessage); ?>");
        <?php elseif ($isError): ?>
        toastr.error("<?= str_replace('❌ ', '', $toastMessage); ?>");
        <?php else: ?>
        toastr.info("<?= $toastMessage; ?>");
        <?php endif; ?>
        <?php unset($_SESSION['toast']); ?>
    });
    <?php endif; ?>
    </script>
    <script src="js/chart.js-4.4.8/package/dist/chart.umd.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- <script src="js/dashboard.js"></script> -->
    <script src="js/script.js"></script>
</body>

</html>