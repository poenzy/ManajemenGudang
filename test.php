<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tabel Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    /* Body tetap putih */
    body {
        background-color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 40px 0;
    }

    /* Container tetap rapi */
    /* .container {
        max-width: 900px;
        margin: auto;
    } */

    h4 {
        color: #cc6600;
        font-weight: 600;
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
    }

    .table-rounded-wrapper {
        border-radius: 12px;
        overflow: hidden;
        border: 2px solid #f3d1a7;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.05);
    }
    </style>
</head>

<body>

    <div class="container">
        <h4 class="mb-4">Daftar Produk</h4>
        <div class="table-rounded-wrapper">
            <table class="table table-bordered table-hover table-warm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Lampu Meja Kayu</td>
                        <td>Elektronik</td>
                        <td>Rp 150.000</td>
                        <td>12</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Kemeja Linen Pria</td>
                        <td>Pakaian</td>
                        <td>Rp 220.000</td>
                        <td>25</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Coklat Dark 85%</td>
                        <td>Makanan</td>
                        <td>Rp 35.000</td>
                        <td>48</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Speaker Bluetooth Mini</td>
                        <td>Elektronik</td>
                        <td>Rp 175.000</td>
                        <td>9</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Kaos Polos Oversize</td>
                        <td>Pakaian</td>
                        <td>Rp 95.000</td>
                        <td>33</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>