<?php
  session_start();
  include 'koneksi.php';

  if(!$_SESSION["role"]) {
    header ("location: masuk.php");
  }

  function totalPerProduk($HARGA, $JUMLAH){
    // fungsi yang menghitung total harga dari produk dengan mengalikan harga dan jumlah
    // input: Harga, Jumlah
    // output: hasil kali

    return $HARGA * $JUMLAH;
  }

  $ID = $_SESSION['id_login'];
  $QUERY_PELANGGAN = mysqli_query($KONEKSI, "SELECT * FROM `pelanggan` WHERE ID_pelanggan = $ID");
  $DATA_PELANGGAN = mysqli_fetch_assoc($QUERY_PELANGGAN);
  $QUERY_PEMBELIAN = mysqli_query($KONEKSI, "SELECT * FROM `pembelian` WHERE ID_pelanggan = $ID");

  if(isset($_POST['beli'])){
    while($DATA_TEST = mysqli_fetch_assoc($QUERY_PEMBELIAN)){
      $ID = $DATA_TEST['ID_produk'];
      $ID_PEMBELIAN = $DATA_TEST['ID_pembelian'];
      $JUMLAH = $_POST['jumlah'.$ID];
      if($JUMLAH < 1){
        $Q = mysqli_query($KONEKSI, "DELETE FROM `pembelian` WHERE ID_pembelian = $ID_PEMBELIAN");
      }else{
        $Q_EDIT = mysqli_query($KONEKSI, "UPDATE `pembelian` SET `jumlah`='$JUMLAH' WHERE ID_pembelian = $ID_PEMBELIAN");
      }
      if($Q_EDIT){
        echo '<script>
          if (window.confirm("Yakin Konfirmasi?"))
          {
              window.location = "./";
          }else{
            window.location = "./checkout.php";
          }
          </script>
        ';
      }
    }
  }
?>

<!doctype html>
<html lang="en">

<head>
  <title>Checkout</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/checkout/">
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
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
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

  <link href="style.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="d-flex w-100 mx-auto flex-column">
    <header class="mb-auto py-3" style="background:#FFD966">
      <div class="cover-container mx-auto text-white">
        <h3 class="float-md-start mb-0"> <img style="width: auto; height: 1.5em" src="logo.png" alt=""> PetshopQu</h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">
          <a class="nav-link fw-bold" href="index.php">Beranda</a>
          <a class="nav-link fw-bold" href="produk.php">Produk</a>

          <?php
              if (isset ($_SESSION["role"])=="pelanggan") {
                echo '
                <a class="nav-link fw-bold" href="keluar.php">Keluar</a>
                <a href="checkout.php" class="nav-link fw-bold"><i class="bi bi-cart"></i></a>
                ';
              }
              else {
                echo '
                <a class="nav-link fw-bold" href="daftar.php">Daftar</a>
                <a class="nav-link fw-bold" href="masuk.php">Masuk</a>
                ';
              }
            ?>

        </nav>
      </div>
    </header>
  </div>
  <div class="container">
    <main>
      <div class="py-5 text-center">
        <h2>Detail Pembelian</h2>
      </div>

      <div class="row g-5">
        <div class="col-md-5 col-lg-6 order-md-last">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-primary">Keranjang Anda</span>
          </h4>
          <form method="post">
            <ul class="list-group mb-3">
              <?php
                $TOTAL = 0;
                while($DATA = mysqli_fetch_assoc($QUERY_PEMBELIAN)){
                  $ID_PRODUK = $DATA['ID_produk'];
                  $DATA_PRODUK = mysqli_fetch_assoc(mysqli_query($KONEKSI, "SELECT * FROM `produk` WHERE ID_produk = $ID_PRODUK"));
                  echo '
                  <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                      <h6 class="my-0">'.$DATA_PRODUK['nama_produk'].'</h6>
                      <small class="text-muted">'.substr($DATA_PRODUK['deskripsi_produk'], 0, 20).'</small>
                    </div>
                      <input type="number" min=0 name="jumlah'.$DATA_PRODUK['ID_produk'].'" class="form-control" value="'.$DATA['jumlah'].'" style="width: 4em">
                    <span class="text-muted">Rp '.number_format(totalPerProduk($DATA_PRODUK['harga_produk'], $DATA['jumlah'])).'</span>
                  </li>
                  ';
                  $TOTAL = $TOTAL + totalPerProduk($DATA_PRODUK['harga_produk'], $DATA['jumlah']);
                }
              ?>
              <li class="list-group-item d-flex justify-content-between">
                <span>Total (Rupiah)</span>
                <strong>Rp <?= number_format($TOTAL) ?></strong>
              </li>
            </ul>
            <input type="submit" class="w-100 btn btn-success btn-lg" value="Beli Sekarang" name="beli">
          </form>
        </div>
        <div class="col-md-7 col-lg-6">
          <form class="needs-validation" novalidate>
            <div class="row g-3">
              <div class="col-sm-12">
                <label for="firstName" class="form-label">Nama</label>
                <input type="text" class="form-control" id="firstName" placeholder=""
                  value="<?= $DATA_PELANGGAN['nama_pelanggan'] ?>" required>
              </div>

              <div class="col-12">
                <label for="username" class="form-label">Username</label>
                <div class="input-group has-validation">
                  <input type="text" class="form-control" id="username" placeholder="Username"
                    value="<?= $DATA_PELANGGAN['username'] ?>" required>
                </div>
              </div>

              <div class="col-12">
                <label for="email" class="form-label">No. HP</label>
                <input type="email" class="form-control" id="email" value="<?= $DATA_PELANGGAN['no_hp'] ?>">
              </div>

              <div class="col-12">
                <label for="address" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="address" value="<?= $DATA_PELANGGAN['alamat_pelanggan'] ?>">
              </div>

              <h4 class="mb-1">Daftar Rekening Pembayaran</h4>

              <div class="my-2">
                <ul>
                  <li>BCA: 57547336</li>
                  <li>BNI: 53454646</li>
                  <li>MANDIRI: 83758274</li>
                </ul>
              </div>

              <div class="col-md-12">
                <label for="cc-expiration" class="form-label fw-bold fs-3">Batas Pembayaran</label>
                <p class="text-danger fw-bold">Batas pembayaran paling lambat 1x24 jam.
                  <br>
                  Setelah anda klik tombol "Beli Sekarang", selanjutnya anda diwajibkan untuk mengunggah bukti
                  pembayaran.
                </p>
              </div>
          </form>
        </div>
      </div>
    </main>
  </div>


  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

  <script src="form-validation.js"></script>
</body>

</html>