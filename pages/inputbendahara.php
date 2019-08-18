<div class="panel panel-primary">
    <div class="panel-heading">
      <b><center>Ubah Data Bendahara</center></b>
    </div>
  </div>
<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db('registrasi');
$sql="Select * from bendahara";
$ambildata = mysql_query( $sql, $koneksi);
$row =mysql_fetch_array($ambildata);

$nak = $row['nak'];
$nama = $row['nama'];
$nik = $row['nik'];

?>


<form action="?id=17" method="post">
		<table>
<tr><td><b>NAK</b></td><td class="col-lg-2"></td><td><input type="text"name="nak" size="25" class="form-control" <?php echo "value='$nak'";?> autofocus></td></tr>
<tr><td><b>Nama</b></td><td class="col-lg-2"></td><td><input type="text"name="nama" size="25" class="form-control" <?php echo "value='$nama'";?>></td></tr>
<tr><td><b>NIK</b></td><td class="col-lg-2"></td><td><input type="text"name="nik" size="25" class="form-control" <?php echo "value='$nik'";?>></td></tr>
</table>
<hr>
<center>
	<input type="submit" name="simpan" value="Simpan" class="btn btn-success">
</center>
</form>

