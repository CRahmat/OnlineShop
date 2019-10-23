<?php  
$semuadata=array();
$tgl_mulai="-";
$tgl_selesai="-";
if (isset($_POST['kirim']))
{
	$tgl_mulai=$_POST['tglm'];
	$tgl_selesai=$_POST['tgls'];
	$ambil = $koneksi->query("SELECT * FROM pembelian pm LEFT JOIN pelanggan pl ON pm.id_pelanggan=pl.id_pelanggan
		WHERE tanggal_pembelian BETWEEN 'tgl_mulai' AND '$tgl_selesai'");
	while ($pecah = $ambil->fetch_assoc() )
	{
		$semuadata[]=$pecah;
	}	
}

?>

<h2>Laporan Pembelian <?php echo $tgl_mulai ?> Hingga <?php echo $tgl_selesai ?></h2>
<br>

<form method="POST">
	<div class="row">
		<div class="col-md-5">
			<div class="form-group">
				<label>TANGGAL MULAI</label>
				<input type="date" class="form-control" name="tglm" value="<?php echo $tgl_mulai?>">
			</div>
		</div>
		<div class="col-md-5">
			<div class="form-group">
				<label>TANGGAL SELESAI</label>
				<input type="date" class="form-control" name="tgls" value="<?php echo $tgl_selesai?>">
			</div>
		</div>
		<div class="col-md-2">
			<label>&nbsp;</label><br>
			<button class="btn btn-primary" name="kirim">Lihat</button>
		</div>
	</div>
</form>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>NO</th>
			<th>PELANGGAN</th>
			<th>TANGGAL</th>
			<th>JUMLAH</th>
			<th>STATUS</th>
		</tr>
	</thead>
	<tbody>
		<?php $total=0; ?>
		<?php foreach ($semuadata as $key => $value): ?>
		<?php $total+=$value['total_pembelian'] ?>			
		<tr>
			<td><?php echo $key+1 ?></td>
			<td><?php echo $value['nama_pelanggan'] ?></td>
			<td><?php echo $value['tanggal_pembelian'] ?></td>
			<td>Rp. <?php echo number_format($value['total_pembelian']) ?></td>
			<td><?php echo $value['status_pembelian'] ?></td>
		</tr>
		<?php endforeach ?>
	</tbody>
	<tfoot>
		<th colspan="3">Total</th>
		<th>Rp. <?php echo number_format($total) ?></th>
		<th></th>
	</tfoot>
</table>