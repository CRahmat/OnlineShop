<center><h2>Tambah Produk</h2></center>
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama" placeholder="Nama Produk">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control" name="harga" placeholder="Harga (Rp)">
		<label>Stok</label>
		<input type="number" class="form-control" name="stok" placeholder="Stock Tersedia">
		<label>Deskripsi Produk</label>
		<textarea class="form-control" name="deskripsi" rows="10" placeholder="Deskripsi Produk"></textarea>
		<label>Foto</label>
		<input type="file" class="form-control" name="foto" placeholder="Foto Produk">
	</div>
	<button class="btn btn-primary" name="save">Simpan</button>
</form>
	<?php
		if (isset($_POST['save'])) 
		{
		$nama = $_FILES['foto']['name'];
		$lokasi = $_FILES['foto']['tmp_name'];
		$error = $_FILE['foto']['error'];

		if($error===4){
			//===4 error khusus gambar
			echo "<script>alert('Anda Harus Mengupload Gambar Terlebih Dahulu!!!')</script>";
			return flase;
		}
		$extensionGambarValid=['jpg','jpeg','png'];
		$extensionGambar = explode('.', $nama_file);//digunakan untuk memecah string
		$extensionGambar = strtolower(end($extensionGambar));
		if(in_array($extensionGambar, $extensionGambarValid)){
		echo "<script>alert('Sistem Mendeteksi Anda Mengupload Selain Gambar!!!')</script>";
		return flase;
		}
	move_uploaded_file($lokasi,"../admin/foto_produk/".$nama);
		$kirim = mysqli_query($koneksi,"INSERT INTO produk(nama_produk,harga_produk,stok_produk,foto_produk,deskripsi_produk) VALUES('".$_POST['nama']."','".$_POST['harga']."','".$_POST['stok']."','".$nama."','".$_POST['deskripsi']."')");

  		 echo "<div class='alert alert-info'>Data Tersimpan</div>";
    	 echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";

  		}
	  ?>
