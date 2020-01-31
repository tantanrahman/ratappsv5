<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','registrasi');
isset($_POST['hapus']);  
  $kueri = "delete from kehadiran";
  $eksekusi = mysqli_query($konek,$kueri);
  $kueri2 = "delete from kuasa";
  $eksekusi2 = mysqli_query($konek,$kueri2);

  include "kehadiran.php";

?>
