<?php


	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
	$konek = mysqli_connect('localhost','root','','registrasi');
	mysql_select_db(registrasi);


if(isset($_POST['simpan']))
{
	$nak = $_POST['hadir'];
	$sql = "select max(no_kupon) as no_kupon from kehadiran";
	$pilih = mysqli_query($konek,$sql);
	$row = mysqli_fetch_array($pilih,MYSQL_ASSOC);
	$sql2 = "select max(no_kupon) as no_kupon from kuasa";
	$pilih2 = mysqli_query($konek,$sql2);
	$row2 = mysqli_fetch_array($pilih2,MYSQL_ASSOC);
	$no_kupon = $row['no_kupon'];
	$no_kupon2 = $row2['no_kupon'];
	if($no_kupon > $no_kupon2)
	{
		$no_kupon3 = $no_kupon +1;
	}
	else if ($no_kupon<$no_kupon2)
	{
		$no_kupon3 = $no_kupon2 +1;	
	}
	else
	{
		$no_kupon3 = $no_kupon2 +1;	
	}

	


	$sql3= "update kuasa set no_kupon='$no_kupon3', status2='HADIR' where nak='$nak'";
	$eksekusi = mysqli_query($konek,$sql3);
	include "inputkuasa.php";
	
}
else
{}
?>