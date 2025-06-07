<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">
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
?>

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
        border-bottom: none !important;
    }

    .nav-item a {
        color: black;
    }

    .aktif {
        color: rgb(86, 88, 202) !important;
        font-size: 15px !important;
        font-weight: 500 !important;
        /* text-shadow: 1px 1px 1px black; */
        /* margin-left: 5px; */
    }

    .sidebar {
        min-height: 150vh;
    }

    /* Warna hangat pada tabel */
    .table-warm {
        background-color: #fff8e7;
        /* krem terang */
        border: 1px solid #f3d1a7;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.03);
    }

    .table-warm thead {
        background-color: #ffd59a;
        /* oranye muda */
    }

    .table-warm thead th {
        color: #5a3200;
    }

    .table-warm tbody tr:hover {
        background-color: #ffd59a !important;
        cursor: pointer;
    }

    .table-warm td,
    .table-warm th {
        vertical-align: middle;
        padding: 12px;
        /* border-width: 2px; */
    }

    .table-rounded-wrapper {
        border-radius: 12px;
        overflow: hidden;
        border: 2px solid #f3d1a7;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.05);
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
        <div class="row">
            <div class="sidebar border border-right col-md-3 col-lg-2 p-0 "
                style="background-color: #fcfcfc; border-top:none !important;">
                <div class="offcanvas-md offcanvas-end" tabindex="-1" id="sidebarMenu"
                    aria-labelledby="sidebarMenuLabel" style="background-color: #fff;">
                    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2  " aria-current="page"
                                    href="index.php">
                                    <img src="icons/house-solid.svg" width="20px" alt="" srcset="">
                                    Home
                                </a>
                            </li>
                        </ul>

                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2  " aria-current="page"
                                    href="tentang.php">
                                    <img src="icons/file-person-fill.svg" width="20px" alt="" srcset="">
                                    Tentang kami
                                </a>
                            </li>
                        </ul>

                        <div class="produk mt-4">
                            <h6
                                class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-body-secondary text-uppercase">
                                <span>Produk</span>
                                <a class="link-secondary" href="" aria-label="Add a new report">
                                    <svg class="bi">
                                        <use xlink:href="#plus-circle"></use>
                                    </svg>
                                </a>
                            </h6>
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center gap-2  " aria-current="page"
                                        href="tambahProduk.php">
                                        <img src="icons/box-solid.svg" style="width: 20px;" width="20px" alt=""
                                            srcset="">
                                        Tambah Produk
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center gap-2  " aria-current="page"
                                        href="produk.php">
                                        <img src="icons/box-seam-fill.svg" style="width: 20px;" width="20px" alt=""
                                            srcset="">
                                        Daftar Produk
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center gap-2  " aria-current="page"
                                        href="aturStok.php">
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
                                    <a class="nav-link d-flex align-items-center gap-2  text-black" aria-current="page"
                                        href="profilPengguna.php">
                                        <img src="icons/person-fill.svg" style="width: 20px;" width="20px" alt=""
                                            srcset="">
                                        Profil
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center gap-2  text-black" aria-current="page"
                                        href="user_management.php">
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
                <div class=" d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3
                border-bottom">
                    <h2>Manajemen Produk</h2>
                    <button id="toggleMode" class="btn toggle-mode-btn">
                        <img src="icons/moon-fill.svg" alt="" id="modeIcon"> Dark Mode
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalHapusLabel">Konfirmasi Hapus</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Yakin ingin menghapus data</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger"
                                        onclick="submitFormHapus()">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                </div>
                <!-- Search && filter -->
                <div class="row">
                    <div class="col-md-6">
                        <form action="" method="get">
                            <div class="row">

                                <div class="col-md-10">
                                    <select name="kategori" class="form-select">
                                        <option value="semua" disabled selected>Pilih berdasarkan kategori</option>
                                        <option value=""
                                            <?= (isset($_GET['kategori']) && $_GET['kategori'] === '') ? 'selected' : '' ?>>
                                            Semua Kategori</option>
                                        <option value="Kebutuhan Pribadi"
                                            <?= (isset($_GET['kategori']) && $_GET['kategori'] === 'Kebutuhan Pribadi') ? 'selected' : '' ?>>
                                            Kebutuhan Pribadi</option>
                                        <option value="Sembako"
                                            <?= (isset($_GET['kategori']) && $_GET['kategori'] === 'Sembako') ? 'selected' : '' ?>>
                                            Sembako</option>
                                        <option value="Minuman"
                                            <?= (isset($_GET['kategori']) && $_GET['kategori'] === 'Minuman') ? 'selected' : '' ?>>
                                            Minuman</option>
                                        <option value="Kebutuhan Rumah Tangga"
                                            <?= (isset($_GET['kategori']) && $_GET['kategori'] === 'Kebutuhan Rumah Tangga') ? 'selected' : '' ?>>
                                            Kebutuhan Rumah Tangga</option>
                                    </select>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group" class="me-5">
                            <input type="text" name="cari" id="cari" placeholder="Cari berdasarkan nama produk"
                                class="form-control"
                                value="<?php echo isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : '' ?>">
                            <button class="btn btn-success" type="submit">Cari</button>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- End Search -->
                <!-- Table Barang -->

                <table class="table table-hover mt-4  ">
                    <thead>
                        <tr>
                            <th scope="col">Kode Produk</th>
                            <th scope="col">Foto Produk</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Merek</th>
                            <th scope="col">Lokasi Gudang</th>
                            <th scope="col">Harga Beli</th>
                            <th scope="col">Harga Jual</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('produkBarang/FungsiPagination.php');
                        $barang = getBarangLimit();
                        if ($barang->num_rows > 0) {
                            while ($row = mysqli_fetch_assoc($barang)) {
                                echo "<tr>";
                                echo "<th>" . $row['kode_produk'] . "</th>";
                                echo "<td> <img src='img/" . basename($row['foto_produk']) . "'  class='img-fluid' style='width:80px;'> </td>";
                                echo "<td>" . $row['nama_produk'] . "</td>";
                                echo "<td>" . $row['kategori'] . "</td>";
                                echo "<td>" . $row['merek'] . "</td>";
                                echo "<td>" . $row['lokasi_gudang'] . "</td>";
                                echo "<td>" . $row['harga_beli'] . "</td>";
                                echo "<td>" . $row['harga_jual'] . "</td>";
                                echo "<td>";
                                // Button Ubah
                                echo "<form method='POST' action='produkBarang/FungsiGetProduk.php'>
                                     <input type='hidden' name='id' value='{$row['id_produk']}'>
                                     <button type='submit' class='btn btn-primary'>Ubah</button>
                                     </form>";
                                echo "<form id='formHapus{$row['id_produk']}' action='produkBarang/FungsiHapusProduk.php' method='POST'>
                                     <input type='hidden' name='id' value='{$row['id_produk']}'>
                                     <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#modalHapus' onclick='setIdFormDelete(\"formHapus{$row['id_produk']}\")'>Hapus</button>
                                     </form>";
                                echo "</td>";
                            }
                        } else {
                            echo "Produk tidak ditemukan";
                        }
                        ?>

                    </tbody>
                </table>
                <!-- End Table barang -->
                <nav>
                    <ul class="pagination">
                        <?php for ($i = 1; $i <= $_SESSION['totalHalaman']; $i++): ?>
                        <li class="page-item <?= ($i == $_SESSION['halamanSekarang']) ? 'active' : '' ?>">
                            <a class="page-link"
                                href="?page=<?= $i ?>&cari=<?php echo isset($_GET['cari']) ? urlencode($_GET['cari']) : '' ?>&kategori=<?php echo isset($_GET['kategori']) ? urlencode($_GET['kategori']) : '' ?>"><?= $i ?></a>
                        </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </main>
        </div>

    </div>
    <script src="js/dark-mode.js"></script>
    <!-- Toggle nav link -->
    <script>
    const links = document.querySelectorAll('.sidebar  a.nav-link');
    const currentURl = window.location.pathname.split('/').pop()
    links.forEach(link => {
        const linkHref = link.getAttribute('href').split('/').pop()
        if (linkHref === currentURl) {
            link.classList.add('aktif')
        }
    })
    </script>
    <!-- End nav link -->
    <!-- Modal hapus -->
    <script>
    let idForm = "";

    function setIdFormDelete(id) {
        idForm = id
    }

    function submitFormHapus() {
        if (idForm) {
            document.getElementById(idForm).submit()
        }
    }
    </script>
    <!-- Toast Notification -->
    <script>
    <?php if (isset($_SESSION['toast'])): ?>
    document.addEventListener("DOMContentLoaded", function() {
        <?php
                $toastMessage = $_SESSION['toast'];
                $isSuccess = strpos($toastMessage, 'success') !== false;
                $isError = strpos($toastMessage, 'failed') !== false;
                ?>

        <?php if ($isSuccess): ?>
        toastr.success("<?= str_replace('success', '', $toastMessage); ?>");
        <?php elseif ($isError): ?>
        toastr.error("<?= str_replace('failed', '', $toastMessage); ?>");
        <?php else: ?>
        toastr.info("<?= $toastMessage; ?>");
        <?php endif; ?>
        <?php unset($_SESSION['toast']); ?>
    })
    <?php endif; ?>
    </script>
    <script src="js/chart.js-4.4.8/package/dist/chart.umd.js">
    </script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- <script src="js/dashboard.js"></script> -->
    <script src="js/script.js"></script>
</body>

</html>