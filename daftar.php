<?php
session_start();
include "koneksi.php";

if (isset($_POST["Daftar"])) {
  $NAMA=$_POST["Nama"];
  $ALAMAT=$_POST["Alamat"];
  $NOMOR=$_POST["Nomor"];
  $USERNAME=$_POST["Username"];
  $PASSWORD=$_POST["Password"];

  $QUERY=mysqli_query($KONEKSI, "INSERT INTO `pelanggan`(`ID_pelanggan`, `username`, `password`, `role`, `nama_pelanggan`, `alamat_pelanggan`, `no_hp`) VALUES (NULL,'$USERNAME','$PASSWORD','pelanggan','$NAMA','$ALAMAT','$NOMOR')") or die(mysqli_error($KONEKSI));
  if ($QUERY) {
    echo "<script> alert('Anda berhasil mendaftar.');</script>";
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Daftar</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">

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
  <body class="text-center">
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
                ';
              }
              else {
                echo '
                <a class="nav-link fw-bold active" href="daftar.php">Daftar</a>
                <a class="nav-link fw-bold" href="masuk.php">Masuk</a>
                ';
              }
            ?>

          </nav>
        </div>
      </header>
    </div>
<div class="d-flex h-100">
    <div class="bg-kucing w-100 h-100" style="width: 60%;">
  </div>
  <main class="form-signin w-100 m-auto">
    <form method="post">
      <h1 class="h3 mb-5 fw-bold">Form Daftar</h1>
  
      <div class="form-floating my-2">
        <input type="text" class="form-control" id="floatingNama" placeholder="Nama" name="Nama">
        <label for="floatingNama">Nama</label>
      </div>
      <div class="form-floating my-2">
        <input type="text" class="form-control" id="floatingAlamat" placeholder="Alamat" name="Alamat">
        <label for="floatingAlamat">Alamat</label>
      </div>
      <div class="form-floating my-2">
        <input type="number" class="form-control" id="floatingNomor" placeholder="Nomor" name="Nomor">
        <label for="floatingNomor">Nomor HP</label>
      </div>
      <div class="form-floating my-2">
        <input type="text" class="form-control" id="floatingUsername" placeholder="Username" name="Username">
        <label for="floatingUsername">Username</label>
      </div>
      <div class="form-floating my-2">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="Password">
        <label for="floatingPassword">Password</label>
      </div>
  
      <input class="mx-5 my-4 btn btn-lg btn-primary" type="submit" value="Daftar" name="Daftar">
      <input class="mx-5 my-4 btn btn-lg btn-outline-danger" type="reset" value="Batal" name="Batal">
    </form>
  </main>
</div>
 
  </body>
</html>
