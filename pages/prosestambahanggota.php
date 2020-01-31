<?php


$konek = mysqli_connect('localhost','root','','registrasi');
$db_select = mysqli_select_db($konek,'registrasi');
if ($db_select)
{
	if (isset($_POST['simpan'])) {
	



	$nak= $_POST['nak'];
	$nama= $_POST['nama'];
	$nik= $_POST['nik'];

	$pilih = "Select max(id) as id from anggota";
	$exe=mysqli_query($konek,$pilih);
	$baris = mysqli_fetch_array($exe, MYSQL_ASSOC);

	$id = $baris['id'] + 1 ;

	$insert = "INSERT INTO anggota (id, nak,nama,nik) VALUES ($id,'$nak','$nama','$nik')";
	$sql=mysqli_query($konek,$insert);


	
			if ($sql){

				echo "<br>Berhasil menambah anggota";
				include "adminarea.php";		
				}
				else
				{
				echo "gagal insert";
				}
	}
	else
	{
	echo "gagal";
	}
}
else
{
	echo "tidak konek";
}

?>