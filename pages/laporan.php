
<br>
<div class="panel panel-primary">
    <div class="panel-heading">
		<center><b>Laporan Kehadiran</b></center>
	</div>
</div>

	

<br>

<script type="text/javascript" src="1.2.2/ng_all.js"></script>
<script type="text/javascript" src="1.2.2/ng_ui.js"></script>
<script type="text/javascript" src="1.2.2/components/timepicker.js"></script>

<script type="text/javascript">
ng.ready( function() {
    var my_timepicker = new ng.TimePicker({
        input:'timepicker',
        format:'H:i:s',
        server_format:'H:i:s',
        use24:true,
        start:'00:00',
        end:'23:59'
    });
    
});
</script>
<script type="text/javascript">
ng.ready( function() {
    var my_timepicker = new ng.TimePicker({
        input:'timepicker2',
        format:'H:i:s',
        server_format:'H:i:s',
        use24:true,
        start:'00:00',
        end:'23:59'
    });
    
});
</script>

<center>
	<form action="laporan_ekspor.php">
		<input type="submit" value="Cetak Laporan (Excel)" class="btn btn-success">
	</form>
</center>

<br>
<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','registrasi');
mysql_select_db('registrasi');

$sql = "SELECT * from kehadiran join anggota using (nak) order by jam DESC";

 

$ambildata = mysqli_query( $konek,$sql);
$record = mysqli_num_rows($ambildata);

		if ($record>0)
		{
echo "<form method=post action=?id=999><table border='1' class='table table-striped table-bordered table-hover'  id='table-data'>
<thead><tr><th>ID</th><th>Nak</th><th>Nama</th><th>NIK</th><th>Status</th><th>No Kupon</th><th>User</th><th>ID Kuasa</th><th>Waktu</th>";
if ($_SESSION['level']=='admin')
	{
echo "<th>Hapus</th>";
	}
echo "</tr></thead>";
		}
		else 
		{
			echo "Data Belum ada";
		}
$i=1;
while($row = mysqli_fetch_array($ambildata, MYSQL_ASSOC))
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

	if ($_SESSION['level']=='admin')
	{
	echo "<td><input type=radio name=hapus value={$row['nak']}></td>";
	}
	$i++;
	$sql2 = "SELECT * from kuasa join anggota using (nak) where id_kuasa='{$row['nak']}' order by jam";
$ambildata2 = mysql_query( $sql2, $koneksi);
while($row2 = mysql_fetch_array($ambildata2, MYSQL_ASSOC))
{
	
    echo "<tr id=biasa>
	<td>$i</td>
	<td>{$row2['nak']}</td>
	<td>{$row2['nama']}</td>
	<td>{$row2['nik']}</td>
	<td>{$row2['status']}</td>
	<td>{$row2['no_kupon']}</td>
	<td>{$row2['user']}</td>
	<td>{$row2['id_kuasa']}</td>
	<td>{$row2['waktu']}</td>";

	if ($_SESSION['level']=='admin')
	{
	echo "<td><input type=radio name=hapus value={$row2['nak']}></td>";
	}
	$i++;
	
echo "</tr>";

} 

	
echo "</tr>";

} 



?>
</table>
<?php
if ($_SESSION['level']=='admin')
	{
?>
<input type="submit" name="hapuss" value="Hapus Data" onclick="return confirm('Data Akan dihapus?')" class="btn btn-danger">
<?php
}
?>

</form>
<hr>

	<?php
		$sql = "SELECT count(nak) as nak from anggota";
		$ambildata = mysql_query( $sql, $koneksi);
		$row = mysql_fetch_array($ambildata, MYSQL_ASSOC);
		$semua=$row['nak'];

		$sql2 = "SELECT count(nak) as nak from kehadiran";
		$ambildata2 = mysql_query( $sql2, $koneksi);
		$row2 = mysql_fetch_array($ambildata2, MYSQL_ASSOC);
		$semua2=$row2['nak'];

		$sql3 = "SELECT count(nak) as nak from kuasa";
		$ambildata3 = mysql_query( $sql3, $koneksi);
		$row3 = mysql_fetch_array($ambildata3, MYSQL_ASSOC);
		$semua3=$row3['nak'];

		$sql4 = "SELECT * FROM bayar";
		$ambildata4 = mysql_query( $sql4, $koneksi);
		$row4 = mysql_fetch_array($ambildata4, MYSQL_ASSOC);
		$bayar=$row4['bayar'];

		$jumlahhadir = $semua2 + $semua3;
		$uang = $jumlahhadir*$bayar;

		$jumlah_desimal ="0";
		$pemisah_desimal =",";
		$pemisah_ribuan =".";
		$tampil_bayar =  "Rp".number_format($uang, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		$persen = ($jumlahhadir / $semua) * 100;
		if ($persen <50)
		{
			?>
			<div class="alert alert-danger" role="alert">
			<?php
		echo "<b><center>Jumlah anggota $semua anggota<br>";
		echo "<b><center>Anggota Hadir $semua2 orang<br>";
		echo "<b><center>Anggota yang menguasakan $semua3 orang<br>";
		echo "<b><center>Total Anggota Hadir $jumlahhadir orang<br>";
		echo "Jumlah Quo Room ";
		echo round($persen,2);
		echo "%<br>Status = TIDAK SAH</b></center>
		Total Pembayaran = $tampil_bayar</div>";
		}
		else
		{
			?>
			<div class="alert alert-success" role="alert">
			<?php
		echo "<b><center>Jumlah anggota $semua anggota<br>";
		echo "<b><center>Anggota Hadir $semua2 orang<br>";
		echo "<b><center>Anggota yang menguasakan $semua3 orang<br>";
		echo "<b><center>Total Anggota Hadir $jumlahhadir orang<br>";
		echo "Jumlah Quo Room ";
		echo round($persen,2);
		echo "%<br>Status = SAH</b></center>
		Total Pembayaran = $tampil_bayar</div>";
		}
	?>
<form action="printlaporansementara.php" target="_blank">
	<center>
		<input type="submit" value="Cetak Data Hadir" class="btn btn-success">
	</center>
	</form>


     
</div>

