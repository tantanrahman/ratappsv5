<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','registrasi');

$tanggal = date("Y-m-d");
$jam = gmdate("H:i:s",time()+60*60*7);
$tanggaljam = $tanggal." ".$jam;

$sql = "SELECT max(no_kupon) as no_kupon from kehadiran ";
mysql_select_db("registrasi");
$ambildata = mysql_query( $sql, $koneksi);
$row = mysql_fetch_array($ambildata, MYSQL_ASSOC);

$kueri = "SELECT max(no_kupon) as no_kupon from kuasa ";
$data = mysql_query( $kueri, $koneksi);
$rows = mysql_fetch_array($data, MYSQL_ASSOC);


$no_kupon = $row['no_kupon'];
$no_kupon2 = $rows['no_kupon'];
if (($row['no_kupon'] == null) && ($rows['no_kupon'] == null))
{$no_kupon=0;}

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




if (isset($_POST['simpan'])) 
	{
		$sql4 = "update kehadiran set jam='$jam', temp=0, waktu='$tanggaljam',no_kupon=$no_kupon3 where temp=1 and user='$_SESSION[nama]'";
		$update = mysqli_query( $konek,$sql4);

		$sql5 = "update kuasa set jam='$jam', temp=0, waktu='$tanggaljam',no_kupon=$no_kupon3 where temp=1 and user='$_SESSION[nama]'";
		$update2 = mysqli_query( $konek,$sql5);

		include "kehadiran.php";
	}

	else  if (isset($_POST['hapus']))
	{
		$hapus = $_POST['hapus_anggota'];

		$sql9 = "SELECT * from kehadiran where nak=$hapus and user='$_SESSION[nama]' and temp=1 ";
		$eksekusi2 = mysqli_query($konek,$sql9);
		$record = mysqli_num_rows($eksekusi2);

		$sql8 = "delete from kehadiran where nak=$hapus and user='$_SESSION[nama]' and temp=1 ";
		$eksekusi = mysqli_query($konek,$sql8);

		if ($record==0)
		{
			$sql7 = "delete from kuasa where nak=$hapus and user='$_SESSION[nama]' and temp=1 ";
		$eksekusi = mysqli_query($konek,$sql7);
		
		}
		else
		{
		$sql7 = "delete from kuasa where user='$_SESSION[nama]' and temp=1 ";
		$eksekusi = mysqli_query($konek,$sql7);	
		}
		
		
		
		include "kehadiran.php";
				
	}
	else if (isset($_POST['hapus_semua']))
	{
		$sql7 = "delete from kuasa where user='$_SESSION[nama]' and temp=1 ";
		$eksekusi = mysqli_query($konek,$sql7);

		$sql8 = "delete from kehadiran where user='$_SESSION[nama]' and temp=1 ";
		$eksekusi2 = mysqli_query($konek,$sql8);

		include "kehadiran.php";
	}
	else
	{

	}

?>