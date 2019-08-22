<br>
<div class="panel panel-primary">
    <div class="panel-heading">
		<center><b>Cetak Bukti Pembayaran</b></center>
	</div>
</div>
		
		<br>


		
<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db('registrasi');
$sql = "SELECT * from kehadiran join anggota using (nak) order by waktu DESC";

 

$ambildata = mysql_query( $sql, $koneksi);
echo "<form action='print_bukti.php' method='post' target='_blank'>";
$record = mysql_num_rows($ambildata);

		if ($record>0)
		{
echo "<table border='1' class='table-responsive table-bordered table' id='table-data'>
<thead><tr><th>ID</th><th>Nak</th><th>Nama</th><th>NIK</th><th>Status</th><th>No Kupon</th><th>User</th><th>ID Kuasa</th><th>Waktu</th><th>Cetak</th></tr></thead>";
		}
		else
		{
			echo "<br><br><br><br><br>Data Belum ada";
		}
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
	<td>{$row['waktu']}</td>";
	if (($_SESSION['level']=='user') AND ($row['cetak']==1))
	{

	}
	else
	{
	echo "<td align=center><input type='radio' name='cetak' value='{$row['id_kuasa']}'></td>";
	}
	
echo "</tr>";
$i++;
} 

$sql = "SELECT * from kuasa join anggota using (nak) where status2<>'HADIR' order by waktu DESC";
$ambildata = mysql_query( $sql, $koneksi);


$sql2 = "SELECT kehadiran.cetak from kuasa join kehadiran using (id_kuasa) where status2<>'HADIR'";
$ambildata2 = mysql_query( $sql2, $koneksi);
$rows = mysql_fetch_array($ambildata2, MYSQL_ASSOC);

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
	<td>{$row['waktu']}</td>";
	if (($_SESSION['level']=='user') AND ($row['cetak']==1))
	{

	}
	else
	{
	echo "<td align=center><input type='radio' name='cetak' value='{$row['id_kuasa']}'></td>";
	}
	
echo "</tr>";
$i++;
} 


?>

</table>
<center>
	<?php
	$record = mysql_num_rows($ambildata);

	?>
		<input type="submit" value="Cetak" class="btn btn-success" name="cetak_bukti">
	
</center>

</form>
