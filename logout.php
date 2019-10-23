<?php
session_start();
//menghancurkan $_SESSION['pelanggan']
unset($_SESSION["pelanggan"]);
echo "<script>alert('Anda Telah Logout');</script>";
echo "<script>location='index.php';</script>";
  ?>