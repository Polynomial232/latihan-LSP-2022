<?php
    session_start();
    include "koneksi.php";

    if($_SESSION["role"]!="admin") {
        header ("location: masuk.php");
    }
?>

<!doctype html>
<html lang="en" class="h-100">

<head>
    <title>PetshopQu</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/cover/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link href="./dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
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
            height: 3rem;
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
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
    </style>

    <link href="style.css?<?= time();?>" rel="stylesheet">
</head>

<body class="h-100 text-center text-black">

    <div class="d-flex w-100 mx-auto flex-column">
        <header class="mb-auto py-3" style="background:#FFD966">
            <div class="cover-container mx-auto text-white">
                <h3 class="float-md-start mb-0"> <img style="width: auto; height: 1.5em" src="logo.png" alt="">
                    PetshopQu</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link fw-bold" href="index.php">Beranda</a>
                    <a class="nav-link fw-bold" href="tproduk.php">Produk</a>
                    <a class="nav-link fw-bold" href="tpelanggan.php">Pelanggan</a>
                    <a class="nav-link fw-bold active" href="tpembelian.php">Pembelian</a>

                    <?php
              if (isset ($_SESSION["role"])=="admin") {
                echo '
                <a class="nav-link fw-bold" href="keluar.php">Keluar</a>
                ';
              }
            ?>

                </nav>
            </div>
        </header>
    </div>
    <div class="container">

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $QUERY=mysqli_query($KONEKSI, "SELECT * FROM `pembelian`");
                    while ($DATA=mysqli_fetch_assoc($QUERY)) {
                        $ID_PRODUK = $DATA['ID_produk'];
                        $ID_PELANGGAN = $DATA['ID_pelanggan'];
                        $QUERY_PRODUK=mysqli_query($KONEKSI, "SELECT nama_produk, harga_produk FROM `produk` WHERE ID_produk = $ID_PRODUK");
                        $DATA_PRODUK=mysqli_fetch_assoc($QUERY_PRODUK);
                        $QUERY_PELANGGAN=mysqli_query($KONEKSI, "SELECT nama_pelanggan FROM `pelanggan` WHERE ID_pelanggan = $ID_PELANGGAN");
                        $DATA_PELANGGAN=mysqli_fetch_assoc($QUERY_PELANGGAN);
                        echo "
                        <tr>
                            <td>".$DATA['ID_pembelian']."</td>
                            <td>".$DATA_PELANGGAN['nama_pelanggan']."</td>
                            <td>".$DATA_PRODUK['nama_produk']."</td>
                            <td>".$DATA['jumlah']."</td>
                            <td>Rp ".number_format($DATA['harga'])."</td>
                            <td>Rp ".number_format($DATA['harga']*$DATA['jumlah'])."</td>
                        </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>