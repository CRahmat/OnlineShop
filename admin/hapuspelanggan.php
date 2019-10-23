<?php
	$koneksi = new mysqli("localhost","root","","projectpw");

	$nama_pelanggan = $_POST['nama_pelanggan'];
	$telepon_pelanggan = $_POST['telepon_pelanggan'];
	$alamat_pelanggan = $_POST['alamat_pelanggan'];
	$email_pelanggan = $_POST['email_pelanggan'];
	$password_pelanggan = $_POST['password_pelanggan'];

	$query = mysqli_query($koneksi, "DELETE FROM 
		pelanggan (email_pelanggan='$_POST['email_pelanggan'], password_pelanggan=$_POST['password_pelanggan'], nama_pelanggan=$_POST['nama_pelanggan'], telepon_pelanggan=$_POST['$telepon_pelanggan'], alamat_pelanggan=$_POST['alamat_pelanggan']' ) VALUES ('$email_pelanggan', '$password_pelanggan', '$nama_pelanggan','$telepon_pelanggan','$alamat_pelanggan')");

	if ($query!= "") {

		echo "<script>alert('Akun telah terhapus');</script>";
		echo "<script>location='index.php?halaman=pelanggan';</script>";
	}

  ?>