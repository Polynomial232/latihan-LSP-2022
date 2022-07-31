<?php
    session_start();
    include "koneksi.php";

    if($_SESSION["role"]!="admin") {
        header ("location: masuk.php");
    }

    if (isset($_POST["inputproduk"])) {
        $NAMA_PRODUK=$_POST["NamaProduk"];
        $DESKRIPSI=$_POST["DeskripsiProduk"];
        $HARGA=$_POST["HargaProduk"];
        $target_dir = "image/";
        $target_file = $target_dir . basename($_FILES["GambarProduk"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        move_uploaded_file($_FILES["GambarProduk"]["tmp_name"], $target_file);
    
        $QUERY=mysqli_query($KONEKSI, "INSERT INTO `produk`(`ID_produk`, `nama_produk`, `deskripsi_produk`, `harga_produk`, `gambar`) VALUES (NULL,'$NAMA_PRODUK','$DESKRIPSI','$HARGA', '$target_file')") or die(mysqli_error($KONEKSI));
        if ($QUERY) {
        echo "<script> alert('Anda berhasil produk.');</script>";
        }
    }

    if (isset($_POST["Edit"])) {
        $NAMA = $_POST["Nama"];
        $DESKRIPSI = $_POST["Deskripsi"];
        $HARGA = $_POST["Harga"];
        $ID = $_POST["ID"];

        $QUERY=mysqli_query($KONEKSI, "UPDATE `produk` SET `nama_produk`='$NAMA',`deskripsi_produk`='$DESKRIPSI',`harga_produk`='$HARGA' WHERE ID_produk = $ID");
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

<body class="h-100 text-black">

    <div class="d-flex w-100 mx-auto flex-column">
        <header class="mb-auto py-3" style="background:#FFD966">
            <div class="cover-container mx-auto text-white">
                <h3 class="float-md-start mb-0"> <img style="width: auto; height: 1.5em" src="logo.png" alt="">
                    PetshopQu</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link fw-bold" href="index.php">Beranda</a>
                    <a class="nav-link fw-bold active" href="tproduk.php">Produk</a>
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
    </div>
    <div class="container-lg mt-5 text-left">
        <div class="row">
            <div class="col-4">
                <form method="post" enctype="multipart/form-data">
                    <label for="GambarProduk" class="mt-2">Masukkan gambar produk: </label>
                    <input type="file" id="GambarProduk" name="GambarProduk" class="form-control">
                    <label for="NamaProduk" class="mt-2">Masukkan nama produk: </label>
                    <input type="text" id="NamaProduk" name="NamaProduk" class="form-control">
                    <label for="DeskripsiProduk" class="mt-2">Masukkan deskripsi produk: </label>
                    <input type="text" id="DeskripsiProduk" name="DeskripsiProduk" class="form-control">
                    <label for="HargaProduk" class="mt-2">Masukkan harga produk: </label>
                    <input type="number" id="HargaProduk" name="HargaProduk" class="form-control">
                    <input type="submit" value="Submit" name="inputproduk" class="btn btn-success mt-2">
                </form>
            </div>
            <div class="col-8 px-5">
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Produk</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $QUERY=mysqli_query($KONEKSI, "SELECT * FROM `produk`");
                            while ($DATA=mysqli_fetch_assoc($QUERY)) {
                            echo '
                                <tr>
                                <form method="post">
                                    <td>'.$DATA['ID_produk'].'</td>
                                    <td><input type="text" name="Nama" value="'.$DATA['nama_produk'].'" class="form-control"></td>
                                    <td><input type="text" name="Deskripsi" value="'.$DATA['deskripsi_produk'].'" class="form-control"></td>
                                    <td><input type="text" name="Harga" value="'.$DATA['harga_produk'].'" class="form-control"></td>
                                    <td>'.$DATA['gambar'].'</td>
                                    <td class="d-flex">
                                        <input type="text" name="ID" value="'.$DATA["ID_produk"].'" hidden>
                                        <input type="submit" value="Edit" name="Edit" class="btn btn-warning mx-1">
                                        <a href="produk-config.php?Aksi=Hapus&id='.$DATA['ID_produk'].'" class="btn btn-danger">Hapus</a>
                                    </td>
                                    </form>
                                </tr>
                                ';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>