<?php
	error_reporting();
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
	$konek = mysqli_connect('localhost','root','','registrasi');

	$sql4 = "SELECT status from kehadiran where temp=1 and user='$_SESSION[nama]'";
		$ambildata4 = mysqli_query( $konek,$sql4);
		while($rows = mysqli_fetch_array($ambildata4, MYSQL_ASSOC))
		{
			$statuss=$rows['status'];
		}
?>

<br>
<div class="panel panel-primary">
	<div class="panel-heading">
		<center>
			<b>Input Absensi</b>
		</center>
	</div>
</div>

<center>
	<br>
	<form action="?id=4" method="post">
		<table>
			<tr>
                <td>
                    <input  type="text" name="nak" size="40" class="form-control" placeholder="NAK / Nama / NIK" autofocus>
                </td>
                <td class="col-md-2"></td>
                <td></td>
                <td><select class="form-control" name="status">
												<?php if ($statuss=="HADIR") {} else {?>
												<option name="hadir" value="HADIR">HADIR</option>
												<?php }?>
                                                <option name="kuasa" value="KUASA">KUASA</option></select>
                </td>
            </tr>
		</table>
		<br>
		</select></td><td><input class='btn btn-success' size="20px" type="submit" name="tambah" value="Tambah Absensi" />
		<input  class='btn btn-info' type='submit' name='cari' value='Cari Anggota' /></td></tr>
	</form>
</center>
<hr>

<?php
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $koneksi )
    {
        die('Gagal Koneksi: ' . mysql_error());
    }
        $sql = "SELECT * FROM kehadiran JOIN anggota USING (nak) WHERE temp=1 AND user='$_SESSION[nama]'";
        mysql_select_db('registrasi');
        $ambildata = mysql_query( $sql, $koneksi);

if(! $ambildata )
    {
        die('Gagal ambil data: ' . mysql_error());
    }

if ($ambildata==null)
    {}
else
    {
	    $record = mysql_num_rows($ambildata);
		if ($record>0)
		{
echo "<form action='?id=6' method='POST'>";
echo "<table border='1' class='table-responsive table-bordered table'><tr><th>No</th><th>NAK</th><th>Nama</th><th>Status</th><th>Hapus</th></tr>";
		}
		else
		{
			echo "<b>Data Belum ditambah</b>";
		}
}
$i=1;
while($row = mysql_fetch_array($ambildata, MYSQL_ASSOC))
{
	
    echo "<tr id=biasa>
    <td>$i</td>
	<td>{$row['nak']}</td>
	<td>{$row['nama']}</td>
	<td>{$row['status']}</td>
	<td><input type='radio' name='hapus_anggota' value='{$row['nak']}'></td>
</tr>";
$i++;
} 

$sql3 = "SELECT id_kuasa FROM kehadiran WHERE temp=1 AND user='$_SESSION[nama]'";
$ambildata3 = mysql_query( $sql3, $koneksi);
while($row = mysql_fetch_array($ambildata3, MYSQL_ASSOC))
{
	$id_kuasa=$row['id_kuasa'];
} 

$sql2 = "SELECT * FROM kuasa JOIN anggota USING (nak) WHERE temp=1 AND user='$_SESSION[nama]' AND id_kuasa='$id_kuasa'";
$ambildata2 = mysql_query( $sql2, $koneksi);
while($row = mysql_fetch_array($ambildata2, MYSQL_ASSOC))
{
	
    echo "<tr id=biasa>
    <td>$i</td>
	<td>{$row['nak']}</td>
	<td>{$row['nama']}</td>
	<td>{$row['status']}</td>
	<td><input type='radio' name='hapus_anggota' value='{$row['nak']}'></td>
</tr>";
$i++;
}  
?>
</table>


<?php 
$record = mysql_num_rows($ambildata);
		if ($record>0)
		{
?>
<center>
<input  class='btn btn-success' type='submit' name='simpan' value='Simpan Absensi' onclick="return confirm('Absensi Selesai?')"/>
<input class='btn btn-danger' type='submit' name='hapus' value='Hapus Kehadiran' onclick="return confirm('Akan dihapus?')"/>
<input class='btn btn-danger' type='submit' name='hapus_semua' value='Hapus Semua Data' onclick="return confirm('Akan dihapus?')"/>

</form>
</center>
<?php
	}
?>