   <div class="panel panel-primary">
    <div class="panel-heading">
      <b><center>Data Anggota</center></b>
    </div>
  </div>

<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $koneksi )
{
  die('Gagal Koneksi: ' . mysql_error());
}

isset($_POST['cari_anggota']); 
	$cari = $_POST['cari'];

$sql = "SELECT anggota.nak, nama, nik,id_kuasa,no_kupon from kuasa join anggota using(nak) where kuasa.nak like '%$cari%' or anggota.nama like '%$cari%' or anggota.nik like '%$cari%'";
 
mysql_select_db('shu');
$ambildata = mysql_query( $sql, $koneksi);
if(! $ambildata )
{
  die('Gagal ambil data: ' . mysql_error());
}
$i=1;
echo "<form method=post action='?id=19'>";
echo "<table border='1' class='table-responsive table-bordered table'><tr><th>ID</th><th>NAK</th><th>NAMA</th><th>NIK</th><th>ID Kuasa</th><th>No Kupon</th><th>Aksi</th></tr>";
while($row = mysql_fetch_array($ambildata, MYSQL_ASSOC))
{
    echo "<tr><td>$i</td><td>{$row['nak']}</td><td>{$row['nama']}</td>
			<td>{$row['nik']}</td><td>{$row['id_kuasa']}</td><td>{$row['no_kupon']}</td>";
      echo "<td><input type='radio' name='hadir' value={$row['nak']}></td></tr>";
			$i++;
} 

?>
</table>
<center>
  <input type="submit" name="simpan" value="Simpan Absensi" class="btn btn-success"></form>
</center>