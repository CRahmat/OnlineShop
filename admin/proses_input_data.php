<?php
	$koneksi = new mysqli("localhost","root","","projectpw");

	$nama_admin = $_POST['nama_admin'];
	$username = $_POST['username'];
	$email_admin = $_POST['email_admin'];
	$password = $_POST['password'];

	$query = mysqli_query($koneksi, "INSERT INTO 
		admin (nama_admin='$_POST['nama_admin'], username='$_POST['username'], email_admin=$_POST['email_admin'], password='$_POST['$password']' ) VALUES ('$nama_admin', '$username', '$email_admin','$password')");

	if ($query!= "") {

		echo "<script>alert('Anda Telah Terdaftar');</script>";
		echo "<script>location='login.php';</script>";
	}

  ?>