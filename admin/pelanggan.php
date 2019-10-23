<center><h2>Data Pelanggan</h2></center>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>NO</th>
			<th>NAMA</th>
			<th>EMAIL</th>
			<th>TELEPHONE</th>
			<th>ALAMAT</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$nomor=1;
		$ambil=$koneksi->query("SELECT * FROM pelanggan");
		while($data=$ambil->fetch_assoc()){
		  ?>
		
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $data['nama_pelanggan']; ?></td>
			<td><?php echo $data['email_pelanggan']; ?></td>
			<td><?php echo $data['telepon_pelanggan']; ?></td>
			<td><?php echo $data['alamat_pelanggan']; ?></td>
		<?php 
		$nomor++;
		} ?>
		</tr>
	</tbody>
</table>