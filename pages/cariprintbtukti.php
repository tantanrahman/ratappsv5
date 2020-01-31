<div class="panel panel-primary">
    <div class="panel-heading">
		<center><b>Cetak Bukti Pembayaran</b></center>
	</div>
</div>


<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db('registrasi');
isset($_POST['cari_anggota']); 
	$cari = $_POST['cari'];


$sql = "SELECT * from kehadiran join anggota using (nak) where nak like '%$cari%' OR nama like '%$cari%' OR nik like '%$cari%' order by no_kupon";

 

$ambildata = mysql_query( $sql, $koneksi);
echo "<form action='print_bukti.php' method='post'>";
echo "<table border='1' class='table-responsive table-bordered table'>
<tr><th>ID</th><th>Nak</th><th>Nama</th><th>NIK</th><th>Status</th><th>No Kupon</th><th>User</th><th>ID Kuasa</th><th>Waktu</th><th>Cetak/Hapus</th></tr>";
$i=1;
while($row = mysql_fetch_array($ambildata, MYSQL_ASSOC))
{
	
    echo "<tr id=biasa>
	<td>$i</td>
	<td>{$row['nak']}</td>
	<td>{$row['nama']}</td>
	<td>{$row['nik']}</td>
	<td>{$row['status']}</td>
	<td>{$row['no_kupon']}</td>
	<td>{$row['user']}</td>
	<td>{$row['id_kuasa']}</td>
	<td>{$row['waktu']}</td>
	<td align=center><input type='radio' name='cetak' value='{$row['id_kuasa']}'></td>
	
	
</tr>";
$i++;
} 

$sql = "SELECT * from kuasa join anggota using (nak) where (status2<>'HADIR') AND (nak like '%$cari%' OR nama like '%$cari%' OR nik like '%$cari%') order by no_kupon";
$ambildata = mysql_query( $sql, $koneksi);
while($row = mysql_fetch_array($ambildata, MYSQL_ASSOC))
{
	
    echo "<tr id=biasa>
	<td>$i</td>
	<td>{$row['nak']}</td>
	<td>{$row['nama']}</td>
	<td>{$row['nik']}</td>
	<td>{$row['status']}</td>
	<td>{$row['no_kupon']}</td>
	<td>{$row['user']}</td>
	<td>{$row['id_kuasa']}</td>
	<td>{$row['waktu']}</td>
	<td align=center><input type='radio' name='cetak' value='{$row['id_kuasa']}'></td>

	
</tr>";
$i++;
} 


?>

</table>
<hr>
<p align="center"><input type="submit" value="Cetak" class="btn btn-success" name="cetak_bukti"><input type="submit" value="Hapus" class="btn btn-success" name="hapus_bukti"  onclick="return confirm('Semua data dengan ID kuasa yang sama akan dihapus?')"></p>

</form>
