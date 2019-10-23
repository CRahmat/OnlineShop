<?php
session_start()	;
	include 'koneksi.php';
	//jika tidak ada session pelanggan belum login), maka di alihkan ke login.php

if (!isset($_SESSION["pelanggan"])) 
{
	echo "<script>alert('Silahkan Login!');</script>";
	echo "<script>location='login.php';</script>";
}
  //jika tidak ada session pembelian (pemasukkan keranjang) maka dialihkan ke index.php(home)  
elseif (!isset($_SESSION["keranjang"])) 
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
	<title>Checkout</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<?php include 'menu.php';  ?>
<body>
  <div class="checkout">
   <section class="konten">
    <div class="container">
            <h1 class="header-name" style="text-align: center;">Keranjang Belanja</h1>
      <hr>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>NO</th>
            <th>PRODUK</th>
            <th>HARGA</th>
            <th>JUMLAH</th>
            <th>SUB HARGA</th>
            
          </tr>
        </thead>
        <tbody>
          <?php $nomor=1;  ?>
          <?php $totalbelanja = 0; ?>
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
            
          </tr>
        <?php $nomor++; ?>
        <?php $totalbelanja += $subharga; ?>
        <?php endforeach ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="4">Total Belanja</th>
            <th>Rp. <?php echo number_format($totalbelanja); ?></th>
          </tr>
        </tfoot>
      </table>
      <form method="POST">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <input type="text" readonly value="<?php echo $_SESSION["pelanggan"]
              ["nama_pelanggan"] ?>" class="form-control" >
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="text" readonly value="<?php echo $_SESSION["pelanggan"]
              ["telepon_pelanggan"] ?>" class="form-control" >
            </div>
          </div>
          <div class="col-md-4">
            <select class="form-control" name="id_ongkir">
              <option value="">Pilih Kurir</option>
              <?php
                $ambil = $koneksi->query("SELECT * FROM ongkir");
                while($perongkir = $ambil->fetch_assoc()){
                ?>
               <option value="<?php echo $perongkir['id_ongkir']?>"> 
                <?php echo $perongkir['nama_kota'] ?>
                Rp. <?php echo number_format($perongkir['tarif']) ?> 
              </option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label>Alamat Lengkap Pengiriman</label>
          <textarea class="form-control" name="alamat_pengiriman" placeholder="Masukkan Alamat Lengkap Pengiriman(termasuk kode pos)"></textarea>
        </div>
        <button class="btn btn-primary" name="checkout">Checkout</button>
      </form> 

      <?php 

      if (isset($_POST["checkout"])) 
      {
        $id_pelanggan=$_SESSION["pelanggan"]["id_pelanggan"];
        $id_ongkir =$_POST["id_ongkir"];
        $tanggal_pembelian =date("Y-m-d");
        $alamat_pengiriman =$_POST['alamat_pengiriman'];

        $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
        $arrayongkir = $ambil->fetch_assoc();
        $nama_kota = $arrayongkir['nama_kota'];
        $tarif = $arrayongkir['tarif'];

        $total_pembelian = $totalbelanja + $tarif;

        //1. menyimpan data ke tabel pembelian
        $koneksi->query("INSERT INTO pembelian (id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian,nama_kota,tarif,alamat_pengiriman)
          VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$nama_kota','$tarif','$alamat_pengiriman')");

        //2. mendapatkan id pembelian barusan terjadi
        $id_pembelian_barusan = $koneksi->insert_id;
        foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) 
        {
          //mendapatkan data produk berdasarkan id produk
          $ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
          $perproduk = $ambil->fetch_assoc();

          $nama = $perproduk['nama_produk'];
          $harga = $perproduk['harga_produk'];

          $subharga = $perproduk['harga_produk']*$jumlah;
          $koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,jumlah,nama,harga,subharga)
            VALUES ('$id_pembelian_barusan','$id_produk','$jumlah','$nama','$harga','$subharga')");

          //Skrip update stok
          $koneksi->query("UPDATE produk SET stok_produk=stok_produk -$jumlah
            WHERE id_produk='$id_produk'");

        }

        //mengkosongkan keranjang belanja
        unset($_SESSION["keranjang"]);

        //tampilan dialihkan ke halaman nota, nota dari pembelian yang barusan
        echo "<script>alert('Pembelian Sukses');</script>";
        echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";

      }

       ?>

    </div>
  </section>
</div>
<!--   FOOTER -->
<div style="margin-top: 167px">
  <?php   
include 'footer.php';
   ?>
</div> 
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>





</body>
</html>