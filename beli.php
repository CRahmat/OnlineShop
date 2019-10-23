<?php
session_start();
//Mendapatkan id produk dari url
$id_produk=$_GET['id'];
//Jika sudah ada produk itu dikeranjang maka produk itu jumlahnya di +1
if (isset($_SESSION['keranjang'][$id_produk])) 
{
	$_SESSION['keranjang'][$id_produk]+=1;
}
//Selain itu (belum dikeranjang) , Maka produk dianggap dibeli 1
else 
{
	$_SESSION['keranjang'][$id_produk]=1;
}


//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";

//Larikan Ke halaman keranjang
echo "<script>alert('Produk telah masuk ke keranjang belanja');</script>";
echo "<script>location='index.php';</script>";
  ?>
