<div class="panel panel-primary">
    <div class="panel-heading">
      <b><center>Profil</center></b>
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
$sql = "SELECT user.nak, anggota.nik, anggota.nama, user.password from anggota join user using (nak) where nak='$_SESSION[nak]'";
 
mysql_select_db('registrasi');
$ambildata = mysql_query( $sql, $koneksi);
if(! $ambildata )
{
  die('Gagal ambil data: ' . mysql_error());
}
?>

<form action="index.php?id=11" method="POST">
  <?php
    $row = mysql_fetch_array($ambildata, MYSQL_ASSOC);
  ?>
  <table>
    <tr>
      <td><b>NAK</b></td><td>:</td><td><input type="text" class="form-control" name="nak" value=<?php echo $row['nak'] ?> readonly></td>
    </tr>
    <tr>
      <td><b>NIK</b></td><td>:</td><td><input type="text" class="form-control" name="nak" value=<?php echo $row['nik'] ?> readonly></td>
    </tr>
    <tr>
      <td><b>Nama</b></td><td>:</td><td><input type="text" class="form-control" name="nak" value=<?php echo $row['nama'] ?>></td>
    </tr>
    <tr>
      <td><b>Password</b></td><td>:</td><td><input type="password" class="form-control" name="nak" value=<?php echo $row['password'] ?>></td>
    </tr>
  </table>
  <hr>
  <input type='submit' value='Update' name='ubah'  class='btn btn-success'>
</form>