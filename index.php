<?php
session_start();
    //Koneksi Ke Database
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Online Shop| Belanja Mudah dan Murah</title>
  <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<?php include 'menu.php';  ?>
<body class="body">
<div class="col-9 mx-auto">
  <!-- konten -->
  <section class="konten">
    <div class="container">
      <h1 class="header-name" style="margin-top: 120">Produk Terbaru</h1>
      <hr color="white">
      <div class="row">
        <?php
        $query = $koneksi->query("SELECT * FROM produk");
        while ($products = $query->fetch_array()){
          //Mengambil data dari database produk
          ?>
          <div class="col-md-3">
            <div class="thumbnail">
              <img src="../project_finish/admin/foto_produk/<?php echo $products['foto_produk']; ?>">
              <div class="caption">
                <h3><?php echo $products['nama_produk']; ?></h3>
                <h5>Rp. <?php echo number_format($products['harga_produk']); ?></h5>
                <!-- untuk mengambil data dalam bentuk angka number_format -->

                <a href="beli.php?id=<?php echo $products['id_produk']; ?>" class="btn btn-success">Beli</a>
                <a href="detail.php?id=<?php echo $products['id_produk']; ?>" class="btn btn-info">Detail</a>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>
</div>
<?php   
include 'footer.php';
 ?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>