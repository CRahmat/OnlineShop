<?php 
session_start();
unset($_SESSION['pelanggan']);
echo "<script>alert('Anda Telah Keluar');</script>";
echo "<script>location='../admin/login.php';</script>";
 ?>