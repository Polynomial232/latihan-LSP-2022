<?php
    session_start();
    include "koneksi.php";

    if(!$_SESSION["id_login"]){
        header ("location: masuk.php");
    }
    $ID_PRODUK = $_GET["id"];
    $ID_PELANGGAN = $_SESSION["id_login"];
    $TANGGAL = date("Y-m-d");

    $QUERY_PRODUK=mysqli_query($KONEKSI, "SELECT * FROM `produk` WHERE ID_produk = '$ID_PRODUK'");
    $DATA_PRODUK=mysqli_fetch_assoc($QUERY_PRODUK);
    $HARGA = $DATA_PRODUK["harga_produk"];

    $QUERY_PEMBELIAN=mysqli_query($KONEKSI, "SELECT * FROM `pembelian` WHERE ID_produk = '$ID_PRODUK' AND ID_pelanggan = '$ID_PELANGGAN'");

    if(mysqli_num_rows($QUERY_PEMBELIAN) < 1) {
        $QUERY=mysqli_query($KONEKSI, "INSERT INTO `pembelian`(`ID_pembelian`, `ID_produk`, `ID_pelanggan`, `tgl_pembelian`, `jumlah`, `harga`) VALUES (NULL,'$ID_PRODUK','$ID_PELANGGAN','$TANGGAL','1','$HARGA')") or die(mysqli_error($KONEKSI));
        if($QUERY){
            header ("location: produk.php");
        }
    }
?>