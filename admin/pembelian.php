<center><h2>Data Pembelian</h2></center>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>NO</th>
			<th>NAMA PELANGGAN</th>
			<th>TANGGAL</th>
			<th>STATUS PEMBELIAN</th>
			<th>TOTAL</th>
			<th>AKSI</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$nomor=1;
		$ambil=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan");
		while($data=$ambil->fetch_assoc()){
		  ?>
		
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $data['nama_pelanggan']; ?></td>
			<td><?php echo $data['tanggal_pembelian']; ?></td>
			<td><?php echo $data['status_pembelian']; ?></td>
			<td>Rp. <?php echo number_format($data['total_pembelian']) ; ?></td>
			<td>
				<a href="index.php?halaman=detail&id=<?php echo $data['id_pembelian']; ?>" class="btn btn-info">detail</a>
				<?php if ($data['status_pembelian']!=='pending'): ?>
				<a href="index.php?halaman=pembayaran&id=<?php echo $data['id_pembelian'] ?>" class="btn btn-success">Pembayaran</a>
				<?php endif ?>
			</td>
		<?php 
		$nomor++;
		} ?>
		</tr>
	</tbody>
</table>