<?php
	session_start() ;
	include 'koneksi.php';

  ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Login Pelanggan</title>
 	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
 	<link rel="stylesheet" type="text/css" href="style.css">
 </head>
  	<?php include 'menu.php';  ?>
 <body>
 	<div class="container">
 		<div class="row">
 			<div class="col-md-6 col-md-offset-3">
 				<div class="panel panel-default">
 					<div class="panel-heading">
 						<center><h3 class="header-name">Login Pelanggan</h3></center>
 					</div>
 					<div class="panel-body">
 						<form method="POST">
 							<div class="form-group">
 								<label>Email</label>
 								<input type="email" class="form-control" name="email" placeholder="Email">
 							</div>
 							<div class="form-group">
 								<label>Password</label>
 								<input type="password" class="form-control" name="password" placeholder="Password">
 							</div>

 							<button class="btn btn-primary" name="akses">Login</button>

 						</form>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>

<?php  

//jika tombol (save) ditekan 
if (isset($_POST["akses"]))
{

	$email = $_POST['email'];
	$password = $_POST['password'];
	//lakukan pengecekan query di tabel db pelanggan
	$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password'");

	//ngitung akun yang diambil
	$akunyangcocok = $ambil->num_rows;
	//jika 1 akun ada yang cocok, maka boleh mengakses Login
	if ($akunyangcocok==1) 
	{
		//anda sukses login
		//mendapatkan akun dalam bentuk array
		$akun = $ambil->fetch_assoc();
		//simpan di session pelanggan
		$_SESSION["pelanggan"]=$akun;
		echo "<script>alert('Anda Sukses Login');</script>";
				echo "<script>location='index.php';</script>";

		//jika sudah belanja
		if (isset($_SESSION['keranjang']) OR !empty($_SESSION['keranjang'])) 
		{
			echo "<script>location='checkout.php';</script>";
		}
		else 
		{
			echo "<script>location='riwayat.php';</script>";
		}
		
	}
	else 
	{
		//anda gagal login
		echo "<script>alert('Anda Gagal Login, Periksa Akun Anda');</script>";
		echo "<script>location='login.php';</script>";
	}
}


?>
 <!--   FOOTER -->
 <div class="footer-login">
 	<?php 	include'footer.php' ?>
 </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>




 </body>
 </html>