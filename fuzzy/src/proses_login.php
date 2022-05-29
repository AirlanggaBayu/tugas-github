<?php
//mengaktifkan session
session_start();

//menghubungkan dengan koneksi
include 'koneksi.php';

//menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = md5($_POST['password']);

//menyeleksi data admin dengan usrname dan password yang sesuai
$data = mysqli_query($koneksi, "SELECT * FROM user where username='$username' AND password='$password'");

//menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

if($cek > 0){
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	header("location:../admin/index.php");
}else{
	header("location:../index.php?pesan=gagal");
}
?>