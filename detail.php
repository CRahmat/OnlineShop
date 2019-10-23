<?php session_start() ?>
<?php include 'koneksi.php';  ?>
<?php

//mendapatkan id produk dari url
$id_produk=$_GET['id'];
//query ambil dari db
$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail=$ambil->fetch_assoc();

?>
<!DOCTYPE html>
<html>
<head>
  <title>Detail Produk</title>
  <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
  <?php include 'menu.php';  ?>

<body>
  <!-- konten -->
  <section class="konten">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="../project_finish/Gambar/<?php echo $detail['foto_produk']; ?>" alt="" class="img-responsive">
        </div>
        <div class="col-md-6">
          <h2><?php echo $detail['nama_produk'] ?></h2>
          <h4>Rp. <?php echo number_format($detail['harga_produk']); ?></h4>
          <h5>Stok : <?php echo $detail['stok_produk']  ?></h5>

          <form method="POST">
            <div class="form-group">
              <div class="input-group">
                <input type="number" min="1" max="<?php echo $detail['stok_produk'] ?>" class="form-control" name="jumlah" >
                <div class="input-group-btn">
                  <button class="btn btn-primary" name="beli">Beli</button>
                </div>
              </div>
            </div>
          </form>

          <?php
          //Jika ada tombol beli
          if (isset($_POST["beli"])) 
          {
              //mendapatkan jumlah yang diinputkan
            $jumlah = $_POST['jumlah'];
              //masukkan di keranjang belanja
            $_SESSION['keranjang'][$id_produk]=$jumlah;

            echo "<script>alert('Produk Telah Masuk Ke Keranjang Belanja')</script>";
            echo "<script>location='keranjang.php';</script>";
          } 

          ?>

          <p><?php echo $detail['deskripsi_produk']; ?></p>
        </div>
      </div>
    </div>
  </section>
<!--   FOOTER -->
<div style="margin-top: 100px">
  <?php 
include 'footer.php';
   ?>
</div>
 
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>