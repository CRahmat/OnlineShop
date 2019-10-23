<?php 
include '../koneksi.php';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Free Bootstrap Admin Template : Binary Admin</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
    <div class="container">
        <div class="row text-center  ">
            <div class="col-md-12">
                <br /><br />
                <h2> ONLINE SHOP : Daftar Admin Baru </h2>

                <h5>( Daftar Dulu Baru Masuk )</h5>
                <br />
            </div>
        </div>
        <div class="row">

            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form role="form" method="POST">
                            <br/>

                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                <input type="varchar" class="form-control" name="nama" placeholder="Your Name" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                <input type="varchar" class="form-control" name="username" placeholder="Desired Username" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon">@</span>
                                <input type="varchar" class="form-control" name="email" placeholder="Your Email" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                <input type="password" class="form-control" name="password" placeholder="Enter Password" />
                            </div>

                            <button name="daftar" class="btn btn-success">DAFTAR</button> <hr>
                            Sudah Punya Akun ?  <a href="login.php" >Masuk</a>
                        </form>
                        <?php 
                         //Jika tombol register ditekan
                        if (isset($_POST['daftar'])) 
                        {
                                         //diambil dulu isian nama, email, password, alamat, telepon
                            $nama = $_POST['nama'];
                            $username = $_POST['username'];
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                                        //cek apa username udah ada di db apa belum
                            $ambil = $koneksi->query("SELECT * FROM admin WHERE username='$username'");
                            $yangcocok = $ambil->num_rows;
                            if ($yangcocok==1) 
                            {
                                echo "<script>alert('Pendaftaran Gagal, Username Sudah Digunakan');</script>";
                                echo "<script>location='registeration.php';</script>";
                            }

                            else 
                            {
                                         //query insert ke tabel pelanggan
                                $koneksi->query("INSERT INTO admin (nama_admin,username,email_admin,password) VALUES ('$nama','$username','$email','$password')");

                                echo "<script>alert('Pendaftaran Sukses, Silahkan Login');</script>";
                                echo "<script>location='login.php';</script>";
                            }

                        }
                        ?>
                    </div>

                </div>
            </div>


        </div>
    </div>


    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
