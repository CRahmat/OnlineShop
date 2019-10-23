<?php
session_start();
$id_produk=$_GET["id"]; 
unset($_SESSION["keranjang"][$id_produk]);

echo "<script>alert('Produk Telah Di Hapus Dari Keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
 ?>