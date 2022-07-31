<?php
    include "koneksi.php";

    $AKSI=$_GET["Aksi"];
    $ID_PRODUK=$_GET["id"];

    if ($AKSI=="Hapus") {
        $QUERY=mysqli_query($KONEKSI, "DELETE FROM `produk` WHERE ID_produk = $ID_PRODUK");

        if ($QUERY) {
            header ("location: tproduk.php");
        }
    }
?>