<?php
session_start();
include 'koneksi.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Nota Pembelian</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php include 'menu.php';  ?>

		<section class="konten">
			<div class="container">
				<!-- Nota disini tinggal kita copas dari yang ada di admin -->
				<h2 class="header-name" align="center">Nota Pembelian</h2><br>
				<?php
				$ambil=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
				$detail = $ambil->fetch_assoc();  
				?>
				<!-- <pre><?php print_r($detail);  ?></pre> -->

				<!-- jika pelanggan yg beli tidak sama dengan yg login, maka dialihkan ke riwayat -->
				<!-- pelanggan yang beli harus pelanggan yang login -->

				<?php 

				//mendapatkan id  pelanggan yang beli
				$idpelangganyangbeli = $detail['id_pelanggan'];
				//mendapatkan id pelangggan yang login
				$idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

				if ($idpelangganyangbeli!==$idpelangganyanglogin) 
				{
					echo "<script>alert('Jangan Nakal');</script>";
					echo "<script>location='riwayat.php';</script>";
				}

				 ?>

				<div class="row">
					<div class="col-md-4">
						<h3 class="header-name">Pembelian</h3>
						<strong>No. Pembelian : <?php echo $detail['id_pembelian'] ?></strong> <br>
						Tanggal : <?php echo $detail['tanggal_pembelian']; ?> <br>
						Total : <?php echo number_format($detail['total_pembelian']); ?>
					</div>
					<div class="col-md-4">
						<h3 class="header-name">Pelanggan</h3>
						<strong>Nama Pembeli : <?php echo $detail['nama_pelanggan']; ?></strong> <br>
						<p>
							<?php
							echo $detail['telepon_pelanggan']; 
							?> <br>
							<?php
							echo $detail['email_pelanggan'];
							?>
						</p>
					</div>
					<div class="col-md-4">
						<h3 class="header-name">Pengiriman</h3>
						<strong>Kota Tujuan : <?php echo $detail['nama_kota'] ?></strong> <br>
						Ongkos Kirim : Rp. <?php echo number_format($detail['tarif']);  ?> <br>
						Alamat : <?php echo $detail['alamat_pengiriman']; ?>
					</div>
				</div>

				<table class="table table-bordered">
					<thead>
						<tr>
							<th>NO</th>
							<th>NAMA PRODUK</th>
							<th>HARGA</th>
							<th>JUMLAH</th>
							<th>SUB-TOTAL</th>
						</tr>	
					</thead>
					<tbody>
						<tr>
							<?php
							$nomor=1;
							$ambil=$koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'");
							while ($pecah=$ambil->fetch_assoc()) {
								?>
								<td><?php echo $nomor; ?></td>
								<td><?php echo $pecah['nama']; ?></td>
								<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
								<td><?php echo $pecah['jumlah']; ?></td>
								<td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
							</tr>
							<?php
							$nomor++;
						} 
						?>
					</tbody>
				</table> 

				<div class="row">
					<div class="col-md-7">
						<div class="alert alert-info">
								<p>
									Silahkan melakukan pembayaran Rp. <?php echo number_format($detail['total_pembelian']); ?> ke <br>
									<strong>BANK BPD DIY 137-001008-3276 AN. Catur Rahmat</strong>
								</p>
						</div>
					</div>
				</div>

			</div>
		</section>
<!--   FOOTER -->
<div style="margin-top: 171px">
	<?php 
include 'footer.php';
	 ?>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>





	</body>
	</html>