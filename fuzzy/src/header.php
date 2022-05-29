<?php 
session_start();
if($_SESSION['status']!="login"){
  header("location:login.php?pesan=belum_login");
}
include 'koneksi.php';

$ambil = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$_SESSION[username]'");
$data  = mysqli_fetch_array($ambil);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK Status Produktivitas Ayam Petelur dengan Fuzzy Mamdani</title>

    <link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/local.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/pagination.css" />

    <script type="text/javascript" src="../assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../assets/js/highcharts.js"></script>
    <script type="text/javascript" src="../assets/js/exporting.js"></script>
    <script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- you need to include the shieldui css and js assets in order for the charts to work -->
    <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light-bootstrap/all.min.css" />
    <script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
    <script type="text/javascript" src="http://www.prepbootstrap.com/Content/js/gridData.js"></script>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">            
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">SPK STATUS PRODUKTIVITAS AYAM PETELUR dengan Fuzzy Mamdani</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li><a href="index.php"><i class="fa fa-bullseye"></i> Dashboard</a></li>
                    <!-- <li><a href="data_user.php"><i class="fa fa-user" aria-hidden="true"></i> Data User</a></li>                     -->
                    <li><a href="data_aturan.php"><i class="fa fa-file-text-o" aria-hidden="true"></i> Data Aturan</a></li>
                    <li><a href="data_kriteria.php"><i class="fa fa-list-alt" aria-hidden="true"></i> Data Variabel</a></li>
                    <!-- <li><a href="data_hasil.php"><i class="fa fa-table"></i> Hasil Fuzzy</a></li> -->
                    <li><a href="hitung_fuzzy.php"><i class="fa fa-braille" aria-hidden="true"></i> Hitung Fuzzy</a></li>                   
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown user-dropdown">
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $data['nama']; ?><b class="caret"></b></a>
                       <ul class="dropdown-menu">
                           <li><a href="data_user.php"><i class="fa fa-user"></i> Profile</a></li>
                           <li class="divider"></li>
                           <li><a href="../index.php"><i class="fa fa-power-off"></i> Log Out</a></li>
                       </ul>
                   </li>
                </ul>
            </div>
        </nav>