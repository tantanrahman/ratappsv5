  <div class="panel panel-primary">
    <div class="panel-heading">
      <b><center>Laporan Kehadiran</center></b>
    </div>
  </div>

<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','shu');
mysql_select_db('shu');

isset($_POST['cari_laporang']); 
	$jam1 = $_POST['jam1'];
	$jam2 = $_POST['jam2'];



$sql = "SELECT * from kehadiran join anggota using (nak) where jam between '$jam1' and '$jam2' order by no_kupon";


 

$ambildata = mysqli_query( $konek,$sql);
$record = mysqli_num_rows($ambildata);

		if ($record>0)
		{
echo "<form method=post action=?id=999><table border='1' class='table-responsive table-bordered table'>
<tr><th>ID</th><th>Nak</th><th>Nama</th><th>NIK</th><th>Status</th><th>No Kupon</th><th>User</th><th>ID Kuasa</th><th>Waktu</th>";

echo "</tr>";
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

	

	
echo "</tr>";

} 

	
echo "</tr>";

} 



?>
</table>