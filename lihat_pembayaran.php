<?php session_start() ?>
<?php include 'koneksi.php';

$id_pembelian = $_GET["id"];

$ambil = $koneksi->query("SELECT * FROM pembayaran 
LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian 
WHERE pembelian.id_pembelian ='$id_pembelian'");

$detbay = $ambil->fetch_assoc();

//jika beluma da pembayaran
if (empty($detbay)) 
{
	echo "<script>alert('Anda belum melakukan pembayaran, silahkan bayar telebih dahulu');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
//jika data pelanggan yang bayar tidak sesuai dengan yang login 
if($_SESSION['pelanggan']['id_pelanggan']!==$detbay['id_pelanggan'])
{
	echo "<script>alert('Anda bukan pemilik data ini');</script>";
	echo "<script>location='riwayat.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Lihat Pembayaran</title>
  <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php include 'menu.php';  ?>

<div class="container">
	<h3 class="header-name">Lihat Pembayaran</h3>
	<div class="row">
		<div class="col-md-6">
			<table class="table">
				<tr>
					<th>NAMA</th>
					<td><?php echo $detbay['nama'] ?></td>
				</tr>
				<tr>
					<th>BANK</th>
					<td><?php echo $detbay['bank'] ?></td>
				</tr>
				<tr>
					<th>TANGGAL</th>
					<td><?php echo $detbay['tanggal'] ?></td>
				</tr>
				<tr>
					<th>JUMLAH</th>
					<td>Rp. <?php echo number_format($detbay['jumlah']) ?></td>
				</tr>
			</table>
		</div>
		<div class="col-md-6">
			<img src="bukti_pembayaran/<?php echo $detbay["bukti"] ?>" alt="" class="img-responsive">
		</div>
	</div>
</div>
<!--   FOOTER -->
<div style="margin-top: 283px">
    <?php 
include 'footer.php'
     ?>
</div> 
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>




</body>
</html>