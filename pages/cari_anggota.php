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

$sql = "SELECT * from anggota where nak like '%$cari%' or nama like '%$cari%' or nik like '%$cari%'";
 
mysql_select_db('shu');
$ambildata = mysql_query( $sql, $koneksi);
if(! $ambildata )
{
  die('Gagal ambil data: ' . mysql_error());
}
$i=1;
echo "<table border='1' class='table-responsive table-bordered table'><tr><th>ID</th><th>NAK</th><th>NAMA</th><th>NIK</th></tr>";
while($row = mysql_fetch_array($ambildata, MYSQL_ASSOC))
{
    echo "<tr><td>$i</td><td>{$row['nak']}</td><td>{$row['nama']}</td>
			<td>{$row['nik']}</td></tr>";
			$i++;
} 

?>