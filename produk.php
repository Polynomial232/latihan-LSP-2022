<?php
  session_start();
  include "koneksi.php";

  function defaultButton($ID_PRODUK){
    //method yang memunculkan tombol beli sebelum masuk ke keranjang
    //input: ID_PRODUK
    //output: link add keranjang

    echo '<a href="pembelian-config.php?id='.$ID_PRODUK.'" class="btn btn-outline-secondary text-black px-3" style="background: #FFD966;">Beli</a>';
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Produk</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/album/">
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

  <body>
    <div class="d-flex w-100 mx-auto flex-column">
      <header class="mb-auto py-3" style="background:#FFD966">
        <div class="cover-container mx-auto text-white">
          <h3 class="float-md-start mb-0"> <img style="width: auto; height: 1.5em" src="logo.png" alt=""> PetshopQu</h3>
          <nav class="nav nav-masthead justify-content-center float-md-end">
            <a class="nav-link fw-bold" href="index.php">Beranda</a>
            <a class="nav-link fw-bold active" href="produk.php">Produk</a>
            
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
<main>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php
          $QUERY = mysqli_query($KONEKSI, "SELECT * FROM `produk`");
          while ($DATA=mysqli_fetch_assoc($QUERY)) {
            $ID = $DATA['ID_produk'];
            if(isset($_SESSION['id_login'])){
              $ID_PEL = $_SESSION['id_login'];
              $QUERY_PEM = mysqli_query($KONEKSI, "SELECT * FROM `pembelian` WHERE ID_produk = $ID AND ID_pelanggan = $ID_PEL");
            }
            echo '
                <div class="col">
                <div class="card shadow-sm">
                  <img src="'.$DATA["gambar"].'" style="width: 100%; height: 15em; object-fit: cover;">
      
                  <div class="card-body">
                    <h4>'.$DATA["nama_produk"].'</h4>
                    <p class="card-text">'.$DATA["deskripsi_produk"].'</p>
                    <div class="d-flex justify-content-end align-items-center">
                      <label class="mx-4">Rp '.$DATA["harga_produk"].'</label>
                      <div class="btn-group">';

            if(isset($_SESSION['id_login'])){
              if(mysqli_num_rows($QUERY_PEM) < 1){
                defaultButton($DATA['ID_produk']);
              }else{
                echo '
                  <label class="btn btn-success">✓</label>
                ';
              }
            }else{
              defaultButton($DATA['ID_produk']);
            }

            echo '
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            ';
          }
        ?>
      </div>
    </div>
  </div>

</main>

    <script src="./dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
