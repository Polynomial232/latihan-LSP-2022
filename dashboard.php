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

<body class="d-flex h-100 text-center text-black bg-kucing" style="background-attachment: fixed;">

    <div class="d-flex w-100 h-100 mx-auto flex-column">
        <header class="mb-auto py-3" style="background:#FFD966">
            <div class="cover-container mx-auto text-white">
                <h3 class="float-md-start mb-0"> <img style="width: auto; height: 1.5em" src="logo.png" alt="">
                    PetshopQu</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link fw-bold active" href="index.php">Beranda</a>
                    <a class="nav-link fw-bold" href="tproduk.php">Produk</a>
                    <a class="nav-link fw-bold" href="tpelanggan.php">Pelanggan</a>
                    <a class="nav-link fw-bold" href="tpembelian.php">Pembelian</a>

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

        <main class="">
            <div class="main-text mx-auto d-flex align-items-center row" style="width: 80%">
                <a href="tproduk.php" style="text-decoration: none;">
                    <div class="button-dashboard text-dark mx-3 px-3">
                        <h1 class="py-4">Produk</h1>
                        <h2 class="py-5">Input, Edit dan Hapus data pada tabel produk.</h2>
                    </div>
                </a>


                <a href="tpelanggan.php" style="text-decoration: none;">
                    <div class="button-dashboard text-dark mx-3 px-3">
                        <h1 class="py-4">Pelanggan</h1>
                        <h2 class="py-5">Input, Edit dan Hapus data pada tabel pelanggan.</h2>
                    </div>
                </a>

                <a href="tpembelian.php" style="text-decoration: none;">
                    <div class="button-dashboard text-dark mx-3 px-3">
                        <h1 class="py-4">Pembelian</h1>
                        <h2 class="py-5">Berisi informasi data pembelian.</h2>
                    </div>
                </a>
            </div>
        </main>

        <footer class="mt-auto text-white-50 bg-dark py-1">
            <label>Silahkan hubungi kami di WhatsApp <a href="#" class="text-white">081292727298</a>.</label>
        </footer>
    </div>

</body>

</html>