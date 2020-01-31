<?php


$konek = mysqli_connect('localhost','root','','registrasi');
$db_select = mysqli_select_db($konek,'registrasi');
if ($db_select)
{
	if (isset($_POST['simpan'])) {
	$nak= $_POST['nak'];
	$nama= $_POST['nama'];
	$pass= $_POST['password'];
	$level= $_POST['level'];
	$insert = "INSERT INTO user (nak,nama,password,level) VALUES ('$nak','$nama','$pass','$level')";
	$sql=mysqli_query($konek,$insert);
	
			if ($query) {
				?>
				<div class="alert alert-success alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <strong>Sukses!</strong> Berhasil tambah data.
				</div>
				<?php
				include 'tambahuser.php';
			} else {
				?>
				<div class="alert alert-danger alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <strong>Gagal!</strong> Gagal tambah data.
				</div>
				<?php
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