<?php
  session_start();
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

  <link href="style.css" rel="stylesheet">
</head>

<body class="d-flex h-100 text-center text-black bg-kucing">

  <div class="d-flex w-100 h-100 mx-auto flex-column">
    <header class="mb-auto py-3" style="background:#FFD966">
      <div class="cover-container mx-auto text-white">
        <h3 class="float-md-start mb-0"> <img style="width: auto; height: 1.5em" src="logo.png" alt=""> PetshopQu</h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">
            <a class="nav-link fw-bold active" href="index.php">Beranda</a>
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

    <main class="px-3">
      <div class="main-text" style="position: absolute; top: 30%; left: 3%; width: 40%;">
        <h1 class="py-2">Makanan Hewan Dengan Kualitas Tinggi</h1>
        <p class="lead">Kami memiliki produk-produk yang bagus untuk peliharaan kesayangan anda</p>
        <p class="lead">Ayo kunjungi halaman produk kami dan beli sekarang!</p>
      </div>
    </main>

    <footer class="mt-auto text-white-50 bg-dark py-1">
      <label>Silahkan hubungi kami di WhatsApp <a href="#" class="text-white">081292727298</a>.</label>
    </footer>
  </div>

</body>

</html>