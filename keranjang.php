<?php
	session_start()	;
	include 'koneksi.php';
	//jika tidak ada session pembelian (pemasukkan keranjang) maka dialihkan ke index.php(home)

	if (!isset($_SESSION["keranjang"])) 
	{
		echo "<script>alert('Silahkan Membeli Barang Terlebih Dahulu!');</script>";
		echo "<script>location='index.php';</script>";
	}
	//jika keranjang kosong
	elseif (empty($_SESSION["keranjang"])) 
	{
		echo "<script>alert('Silahkan Membeli Barang Terlebih Dahulu!');</script>";
		echo "<script>location='index.php';</script>";
	}


  ?>
  <!DOCTYPE html>
  <html>
  <head>
  	<title>Keranjang Belanja</title>
  	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="style.css">
  </head>

 <?php include 'menu.php';  ?>
  <body>

  <section class="konten">
  	<div class="container">
  		<h1 class="header-name">Keranjang Belanja</h1>
  		<hr>
  		<table class="table table-bordered">
  			<thead>
  				<tr>
  					<th>NO</th>
  					<th>PRODUK</th>
  					<th>HARGA</th>
  					<th>JUMLAH</th>
  					<th>SUB HARGA</th>
  					<th>AKSI</th>
  				</tr>
  			</thead>
  			<tbody>
  				<?php $nomor=1;  ?>
  				<?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
  					<!-- Menampilkan produk di perulangannya -->
  				<?php
  					$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
  					$pecah = $ambil->fetch_assoc();
  					$subharga = $pecah['harga_produk']*$jumlah;
  				  ?>
  				<tr>
  					<td><?php echo $nomor;  ?></td>
  					<td><?php echo $pecah["nama_produk"]; ?></td>
  					<td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
  					<td><?php echo $jumlah ?></td>
  					<td>Rp. <?php echo number_format($subharga); ?></td>
  					<td>
  						<a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs">Hapus</a>
  					</td>
  				</tr>
  			<?php $nomor++; ?>
  			<?php endforeach ?>
  			</tbody>
  		</table>
  		<a href="index.php" class="btn btn-default">Lanjutkan Berbelanja</a>
  		<a href="checkout.php" class="btn btn-primary">Checkout</a>
  	</div>
  </section>
  <!--   FOOTER -->
  <div style="margin-top: 297px"> <?php   include'footer.php' ?></div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>




 
  </body>
  </html>