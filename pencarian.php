<?php
include 'koneksi.php';
$keyword = $_GET['keyword'];
$semuadata = array();
$ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%'");
while ($pecah = $ambil->fetch_assoc())
{
	$semuadata[]=$pecah;
}


  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Pencarian</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php include 'menu.php';  ?>
	<div class="container">
		<h3 class="header-name">Hasil Pencarian : <?php echo $keyword ?></h3><br>

		<?php if (empty($semuadata)): ?>

			<div class="alert alert-danger">Produk <strong><?php echo $keyword ?></strong> tidak ditemukan</div>
			

		<?php endif ?>

		<div class="row">

			<?php foreach ($semuadata as $key => $value): ?>

				<div class="col-md-3">
					<div class="thumbnail">
						<img src="Gambar/<?php echo $value['foto_produk'] ?>" alt="" class="img-responsive">
						<div class="caption">
							<h3><?php echo $value['nama_produk'] ?></h3>
							<h5>Rp. <?php echo number_format($value['harga_produk']) ?></h5>
							<a href="beli.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-primary">Beli</a>
							<a href="detail.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-default">Detail</a>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
<div style="margin-top: 37px">
	<?php 
include'footer.php';
	 ?>
</div>
</body>
</html>