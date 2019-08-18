<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','registrasi');

isset($_POST['simpan']);
$bayar=$_POST['bayar'];
$tampil = explode('.', $bayar);
foreach ($tampil as $val) 
{
    $keluar .= $val;
}


mysql_select_db(registrasi);

$sql = "delete from bayar";
mysqli_query($konek,$sql);

$insert ="insert into bayar (bayar) values ($keluar)";
mysql_query($insert);




include ('inputuang.php');

?>