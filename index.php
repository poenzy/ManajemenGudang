<?php
session_start();
require 'index/DataChart.php';

$_SESSION['id_admin'] = 1;

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit;
}
// Cegah caching oleh browser
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proksi
$allProduk = getAllDataProduk();
$jumlahProduk = 0;
foreach ($allProduk as $produk) {
    $jumlahProduk += $produk['jumlah'];
}

$dataMasuk = ProdukMasuk();
$jumlahMasuk = 0;
foreach ($dataMasuk as $data) {
    $jumlahMasuk += $data['jumlah'];
}
$dataKeluar = produkKeluar();
$jumlahKeluar = 0;
foreach ($dataKeluar as $data) {
    $jumlahKeluar += $data['jumlah'];
}
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />

    <style>
    .navbar a {
        border-bottom: none !important;
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
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Home</h1>
                    <button id="toggleMode" class="btn toggle-mode-btn">
                        <img src="icons/moon-fill.svg" alt="" id="modeIcon"> Dark Mode
                    </button>
                </div>
                <div class="container py-2">
                    <div class="row mb-4">
                        <!-- Total Produk -->
                        <div class="col-md-4">
                            <div class="card shadow-sm border-0 rounded-4 p-3 bg-white h-100">
                                <div class="d-flex align-items-center">
                                    <div class="me-3" style="line-height: 5px;">
                                        <div class="bg-primary text-white rounded-circle p-3">
                                            <i class="bi bi-box-seam "></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="text-muted mb-1">Total Produk</h6>
                                        <h4 class="mb-0 fw-bold"><?php echo $jumlahProduk; ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Produk Masuk -->
                        <div class="col-md-4">
                            <div class="card shadow-sm border-0 rounded-4 p-3 bg-white h-100">
                                <div class="d-flex align-items-center">
                                    <div class="me-3" style="line-height: 5px;">
                                        <div class="bg-success text-white rounded-circle p-3">
                                            <i class="bi bi-box-arrow-in-down "></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="text-muted mb-1">Produk Masuk (30 Hari)</h6>
                                        <h4 class="mb-0 fw-bold"><?php echo $jumlahMasuk ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Produk Keluar -->
                        <div class="col-md-4">
                            <div class="card shadow-sm border-0 rounded-4 p-3 bg-white h-100">
                                <div class="d-flex align-items-center">
                                    <div class="me-3" style="line-height: 5px;">
                                        <div class="bg-danger text-white rounded-circle p-3">
                                            <i class="bi bi-box-arrow-up"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="text-muted mb-1">Produk Keluar (30 Hari)</h6>
                                        <h4 class="mb-0 fw-bold"><?php echo $jumlahKeluar ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row 3: Grafik Masuk Lebar Penuh -->
                    <div class="row">
                        <div class="col-md-10">
                            <div class="card shadow-lg card-hover">
                                <div class="card-body">
                                    <h5 class="card-title">Tren Total Stok Produk</h5>
                                    <canvas id="productChart" height="80"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row 2: Grafik 1 dan 2 -->
                    <div class="row mt-4 mb-4 justify-content-between">
                        <div class="col-md-7">
                            <div class="card shadow-lg card-hover">
                                <div class="card-body">
                                    <h5 class="card-title">Produk masuk (30 Hari)</h5>
                                    <canvas id="incomingChart" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 ">
                            <div class="card shadow-lg card-hover">
                                <div class="card-body">
                                    <h5 class="card-title">Produk Keluar (30 Hari)</h5>
                                    <canvas id="outgoingChart" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
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
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const isDark = document.body.classList.contains('dark-mode');

        // WARNA UMUM DARK MODE
        const textColor = isDark ? '#555' : '#333';
        const gridColor = isDark ? '#555' : '#ddd';

        // Grafik Tren Total Stok Produk
        const dataProduk = <?php echo json_encode($allProduk); ?>;
        const kategoriProduk = dataProduk.map(data => data.kategori);
        const jumlahProduk = dataProduk.map(data => parseInt(data.jumlah));
        new Chart(document.getElementById("productChart"), {
            type: "line",
            data: {
                labels: kategoriProduk,
                datasets: [{
                    label: "Jumlah Produk",
                    data: jumlahProduk,
                    borderColor: isDark ? "#90caf9" : "#0d6efd",
                    backgroundColor: isDark ? "rgba(144,202,249,0.2)" : "rgba(13,110,253,0.1)",
                    fill: true,
                    tension: 0.4,
                }],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            color: textColor // label teks legend
                        }
                    },
                    tooltip: {
                        titleColor: textColor,
                        bodyColor: textColor
                    },
                    title: {
                        display: false,
                        text: "Jumlah Produk per Kategori",
                        color: textColor
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: textColor
                        },
                        grid: {
                            color: gridColor
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: textColor
                        },
                        grid: {
                            color: gridColor
                        }
                    }
                }
            }
        });


        // Produk Masuk Berdasarkan Kategori
        const dataMasuk = <?php echo json_encode($dataMasuk); ?>;
        const kategoriMasuk = dataMasuk.map(data => data.kategori);
        const jumlahMasuk = dataMasuk.map(data => parseInt(data.jumlah));
        new Chart(document.getElementById("incomingChart"), {
            type: "bar",
            data: {
                labels: kategoriMasuk,
                datasets: [{
                    label: "Jumlah Masuk",
                    data: jumlahMasuk,
                    borderColor: "rgb(0, 117, 41)",
                    backgroundColor: isDark ? "rgba(76,175,80,0.4)" : "rgba(5, 146, 64, 0.3)",
                    fill: true,
                    tension: 0.4,
                    pointRadius: 1,
                    showLine: true
                }],
            },
            options: {
                responsive: true,
                indexAxis: "y",
                plugins: {
                    legend: {
                        labels: {
                            color: textColor
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            color: textColor
                        },
                        grid: {
                            color: gridColor
                        }
                    },
                    y: {
                        ticks: {
                            color: textColor
                        },
                        grid: {
                            color: gridColor
                        }
                    },
                },
            },
        });

        // Produk Keluar Berdasarkan Kategori
        const dataKeluar = <?php echo json_encode($dataKeluar); ?>;
        const kategoriKeluar = dataKeluar.map(data => data.kategori);
        const jumlahKeluar = dataKeluar.map(data => parseInt(data.jumlah));
        new Chart(document.getElementById("outgoingChart"), {
            type: "bar",
            data: {
                labels: kategoriKeluar,
                datasets: [{
                    label: "Jumlah Keluar",
                    data: jumlahKeluar,
                    backgroundColor: isDark ? "rgba(220,53,69,0.5)" : "#dc3545",
                    fill: true,
                    tension: 0.4
                }],
            },
            options: {
                responsive: true,
                indexAxis: "y",
                plugins: {
                    legend: {
                        labels: {
                            color: textColor
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            color: textColor
                        },
                        grid: {
                            color: gridColor
                        }
                    },
                    y: {
                        ticks: {
                            color: textColor
                        },
                        grid: {
                            color: gridColor
                        }
                    },
                },
            },
        });
    });
    </script>

</body>

</html>