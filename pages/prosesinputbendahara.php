<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','registrasi');

isset($_POST['simpan']);
$nak=$_POST['nak'];
$nama=$_POST['nama'];
$nik=$_POST['nik'];

mysql_select_db(registrasi);

$sql = "delete from bendahara";
mysqli_query($konek,$sql);

$insert ="insert into bendahara (nak,nama,nik) values ('$nak','$nama','$nik')";
mysql_query($insert);
				if ($insert) {
					?>
					<div class="alert alert-success alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  <strong>Sukses!</strong> mengubah nama bendahara.
					</div>
					<?php
				} else {
					?>
					<div class="alert alert-danger alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  <strong>Gagal!</strong> mengubah nama bendahara.
					</div>
					<?php
				}

include ('inputbendahara.php');

?>