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

?>
<!DOCTYPE html>
<html>
<head>
  <title>Riwayat Pembelian</title>
  <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	  <link rel="stylesheet" type="text/css" href="style.css">
  
</head>
<body>
<?php include 'menu.php';  ?>
<section class="riwayat">
	<div class="container">
		<h1 class="header-name" style="text-align: center;">Riwayat Belanja <?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?></h1><br>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>NO</th>
					<th>TANGGAL</th>
					<th>STATUS</th>
					<th>TOTAL</th>
					<th>OPSI</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$nomor=1;
				//mendapatkan id pelanggan yang login dari session
				$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

				$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
				while ($pecah=$ambil->fetch_assoc()) {

				  ?>
				<tr>
					<td><?php echo $nomor ?></td>
					<td><?php echo $pecah['tanggal_pembelian']  ?></td>
					<td>
						<?php echo $pecah['status_pembelian']  ?><br>
						<?php if (!empty($pecah['resi_pengiriman'])): ?>
						Resi : <?php echo $pecah['resi_pengiriman']; ?>
						<?php endif ?>
							
						</td>
					<td>Rp. <?php echo number_format($pecah['total_pembelian'])  ?></td>
					<td>
						<a href="nota.php?id=<?php echo $pecah['id_pembelian'] ?>" class="btn btn-info">Nota</a>
						
						<?php if ($pecah['status_pembelian']=='pending'): ?>
						<a href="pembayaran.php?id=<?php echo $pecah['id_pembelian'] ?>" class="btn btn-success">Input Pembayaran</a>
						<?php else : ?>
						<a href="lihat_pembayaran.php?id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-warning">Lihat Pembayaran</a>
						<?php endif ?>
					</td>
				</tr>
			<?php  
			$nomor++;
			} ?>
			</tbody>
		</table>
	</div>
</section>
<div style="margin-top: 364px">
<?php 	
include'footer.php'
 ?>	
</div>
</body>
</html>