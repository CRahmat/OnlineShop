        <!-- navbar -->
<!DOCTYPE html>
<html>
<head>
  <title></title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
     <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <nav class="navbar fixed-top navbar-expand-md navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#"><img src="Gambar/logo.png" width="120"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="navbar-nav mr-auto nav-item active">
        <a class="nav-link" href="index.php">HOME</a>
      </li>
  </ul>
    <form action="pencarian.php" method="get" class="mx-1 my-auto d-inline w-100" style="margin: 10px"> 
      <div class="input-group">
        <input class="form-control border border-right-1" type="search" name="keyword" placeholder="Cari Produk ..." aria-label="Search" lo="80">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="margin-left: 3px ; border-top-left-radius: 0; border-bottom-left-radius: 0" >Search</button>
      </div>
    </form>
  </div>
</div>
    <ul class="navbar-nav mr-auto" type="none">
            <li class="nav-item"><a class="nav-link" href="keranjang.php">Keranjang</a></li>
        <!-- Jika sudah login(ada session pelanggan) -->
        <?php if (isset($_SESSION['pelanggan'])):  ?>
          <li class="nav-item"><a class="nav-link" href="riwayat.php">History</a></li>
          <li class="nav-item"><a class="nav-link" href="checkout.php">Checkout</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php"><b>Logout</b></a></li>
        <!-- Selain itu (belum login) belum ada session pelanggan -->
        <?php else:  ?>
          <li class="nav-item"><a class="nav-link" href="riwayat.php">History</a></li>
          <li class="nav-item"><a class="nav-link" href="checkout.php">Checkout</a></li>
          <li class="nav-item"><a class="nav-link" href="login.php"><b>Login</b></a></li>
          <li class="nav-item"><a class="nav-link" href="daftar.php"><b>Daftar</b></a></li>
        <?php endif ?>
    </ul>
  </div>
</nav>
</body>
</html>
