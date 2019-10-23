<center><h2>Data Produk</h2></center>
<table class="table table-bordered" style="background-color:#F8F8FF">
	<thead>
		<tr>
			<th>NO</th>
			<th>NAMA</th>
			<th>HARGA</th>
			<th>FOTO</th>
			<th>AKSI</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$nomor=1;
		$ambil=$koneksi->query("SELECT * FROM produk");
		while($data=$ambil->fetch_assoc()){
		  ?>
		
		<tr>
			<!-- Untuk Penomeran -->
			<td><?php echo $nomor; ?></td>
			<td><?php echo $data['nama_produk']; ?></td>
			<td><?php echo $data['harga_produk']; ?></td>
			<td>
				<img src="../admin/foto_produk/<?php echo $data['foto_produk']; ?>" width="100">
			</td>
			<td>
				<a href="index.php?halaman=hapusproduk&id=<?php echo $data['id_produk']; ?> " class="btn-danger btn">hapus</a>
				<a href="index.php?halaman=editproduk&id=<?php echo $data['id_produk']; ?> " class="btn btn-warning">edit</a>
			</td>
		<?php 
		$nomor++;
		} ?>
		</tr>
	</tbody>
</table>
<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah Produk</a>