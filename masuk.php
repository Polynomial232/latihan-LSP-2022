<?php
  session_start();
  include "koneksi.php";

  if (isset($_POST["Masuk"])) {
    $USERNAME=$_POST["Username"];
    $PASSWORD=$_POST["Password"];

    $QUERY=mysqli_query($KONEKSI, "SELECT * FROM `pelanggan` WHERE Username='$USERNAME' AND Password='$PASSWORD'") or die();
    if (mysqli_num_rows($QUERY)>0) {
      $DATA=mysqli_fetch_assoc($QUERY);
      $_SESSION["id_login"]=$DATA["ID_pelanggan"];
      
      if($DATA["role"]=="admin") {
        echo "Halo Kamu ADMIN";
        $_SESSION["role"]="admin";
        header("location: dashboard.php");
      }
      else
      {
        echo "Halo Kamu Pelanggan";
        $_SESSION["role"]="pelanggan";
        header("location: index.php");
      }
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Masuk</title>

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
                <a class="nav-link fw-bold" href="daftar.php">Daftar</a>
                <a class="nav-link fw-bold active" href="masuk.php">Masuk</a>
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
  <main class="form-signin w-100 mt-3">
    <form method="post">
      <img style="width: auto; height: 10em" src="logo.png" alt="">
      <h5 class="my-4">Silahkan masukan username dan password anda.</h5>
      <div class="form-floating my-2">
        <input type="text" class="form-control" id="floatingUsername" placeholder="Username" name="Username">
        <label for="floatingUsername">Username</label>
      </div>
      <div class="form-floating my-2">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="Password">
        <label for="floatingPassword">Password</label>
      </div>
  
      <input class="my-4 btn btn-lg btn-primary" type="submit" value="Login" name="Masuk">
    </form>
  </main>
</div>
 
  </body>
</html>
