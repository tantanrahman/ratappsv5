<?php
session_start();
	$host="localhost";
	$user="root";
	$password="";	
	$koneksi=mysql_connect($host,$user,$password) or 
	die("Tidak konek");
	mysql_select_db("registrasi");
	

if (isset($_POST['login'])) 
	{
$nak = $_POST['nak'];
$password = $_POST['password'];
// query untuk mendapatkan record dari nak
$query = "SELECT * FROM user WHERE nak = '$nak'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);

// cek kesesuaian passwordword
if ($password == $data['password'])
{

echo "sukses";
    // menyimpan nak dan level ke dalam session
    header('location: index.php');
    $_SESSION['nak'] = $data['nak'];
	$_SESSION['nama'] = $data['nama'];
	$_SESSION['level'] = $data['level'];
	$_SESSION['login']= true;
	}
else 
{
?>

<SCRIPT LANGUAGE="JavaScript">
window.alert ("Login Gagal!!!");
window.location.href="index.php";
</SCRIPT>

<?php

}

}
else
{
echo "tidak terambil";
}
?>