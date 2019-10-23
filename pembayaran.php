<?php
session_start();
    //Koneksi Ke Database
include 'koneksi.php';

	//jika tidak ada session pelanggan (belum login)

	if (!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan']) ) 
	{
		echo "<script>alert('Silahkan Login Dulu');</script>";
		echo "<script>location='login.php';</script>";
		exit();
	}

	//mendapatkan id pembelian dari url
	$idpem=$_GET['id'];
	$ambil = $koneksi -> query ("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
	$detpem = $ambil->fetch_assoc();

	//mendapatkan id pelanggan yang beli
	$id_pelanggan_beli = $detpem["id_pelanggan"];
	//mendapatkan id pelanggan yang login
	$id_pelanggan_login = $_SESSION['pelanggan']['id_pelanggan'];

	if ($id_pelanggan_login !== $id_pelanggan_beli) 
	{
		echo "<script>alert('Jangan Nakal');</script>";
		echo "<script>location='riwayat.php';</script>";
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Toko Onlen Shop</title>
  <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php include 'menu.php';  ?>

<div class="container">
	<h2 class="header-name" align="center">Konfirmasi Pembayaran</h2>
	<p>Kirim Bukti Pembayaran Anda Disini</p>
	<div class="alert alert-info">Total Tagihan Anda <strong>Rp. <?php echo number_format($detpem["total_pembelian"]); ?></strong>
	</div>

	<form method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label>Nama Penyetor</label>
			<input type="text" class="form-control" name="nama">
		</div>
		<div class=form-group>
			<label>Metode Pembayaran</label>
			<select class="form-control" name="id_metode">
              <option value="">Pilih Metode Pembayaran</option>
              <?php
                $ambil = $koneksi->query("SELECT * FROM metode");
                while($permetode = $ambil->fetch_assoc()){
                ?>
               <option value="<?php echo $permetode['id_metode']?>"> 
                <?php echo $permetode['nama_metode'] ?> 
              </option>
              <?php } ?>
            </select>
		</div>
		<div class="form-group">
			<label>Jumlah</label>
			<div class="form-control" name="jumlah" readonly>
				Rp. <?php echo number_format($detpem["total_pembelian"]); ?>
			</div>
		</div>
		<div class="form-group">
			<label>Foto Bukti</label>
			<input type="file" class="form-control" name="bukti">
			<p class="text-danger">Foto bukti harus berupa .jpg maksimal 2MB </p>
		</div>
		<button class="btn btn-primary" name="kirim">Bayar</button>
	</form>
</div>

<?php

//jika tombol bayar di tekan
if (isset($_POST['kirim'])) 
{
	//upload dulu foto buktinya
	$namabukti = $_FILES["bukti"]["name"];
	$lokasibukti = $_FILES["bukti"]["tmp_name"];
	$namafiks = date("YmdHis").$namabukti;	
	move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

	$nama = $_POST['nama'];
	$id_metode = $_POST['id_metode'];
	$jumlah = $detpem["total_pembelian"];
	$tanggal = date("Y-m-d");

	$ambil = $koneksi->query("SELECT * FROM metode WHERE id_metode='$id_metode'");
    $arraymetode = $ambil->fetch_assoc();
    $nama_metode = $arraymetode['nama_metode'];


	//Simpan pembayaran
	$koneksi->query("INSERT INTO pembayaran (id_pembelian,nama,bank,jumlah,tanggal,bukti)
		VALUES ('$idpem','$nama','$nama_metode','$jumlah','$tanggal','$namafiks')");
	//maka terupdate dong pembeliannya dari pending menjadi sudah kirim pembayaran
	$koneksi->query("UPDATE pembelian SET status_pembelian='sudah kirim pembayaran'
		WHERE id_pembelian = '$idpem'");

		echo "<script>alert('Terimakasih Sudah Melakukan Pembayaran');</script>";
		echo "<script>location='riwayat.php';</script>";
}
  ?>
<div style="padding-top: 97px">	
<?php 	include 'footer.php' ?>
</div>
</body>
</html>