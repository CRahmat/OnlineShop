<h2>Detail Pembelian</h2>
<?php
$ambil=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan 
	WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();  
  ?>
				<div class="row">
					<div class="col-md-4">
						<h3>Pembelian</h3>
						<strong>No. Pembelian : <?php echo $detail['id_pembelian'] ?></strong> <br>
						Tanggal : <?php echo $detail['tanggal_pembelian']; ?> <br>
						Total :Rp. <?php echo number_format($detail['total_pembelian']); ?><br>
						Status : <?php echo $detail['status_pembelian']; ?>
					</div>
					<div class="col-md-4">
						<h3>Pelanggan</h3>
						<strong>Nama Pembeli : <?php echo $detail['nama_pelanggan']; ?></strong> <br>
							No. Telp : <?php echo $detail['telepon_pelanggan']; ?> <br>
							Email : <?php echo $detail['email_pelanggan']; ?>
					</div>
					<div class="col-md-4">
						<h3>Pengiriman</h3>
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
 				$data=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'");
 				while ($pecah=$data->fetch_assoc()) {
 			  ?>
 			<td><?php echo $nomor; ?></td>
 			<td><?php echo $pecah['nama_produk']; ?></td>
 			<td>Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
 			<td><?php echo $pecah['jumlah']; ?></td>
 			<td>Rp. <?php echo number_format($pecah['harga_produk']*$pecah['jumlah']); ?></td>
 		</tr>
 		<?php
 		$nomor++;
 		 } 
 		 ?>
 	</tbody>
 </table> 