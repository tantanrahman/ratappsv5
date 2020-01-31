<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','registrasi');


$hapus = $_POST['hapus'];

		$sql9 = "SELECT * FROM kehadiran WHERE nak=$hapus";
		$eksekusi2 = mysqli_query($konek,$sql9);
		$record = mysqli_num_rows($eksekusi2);

		$sql8 = "DELETE FROM kehadiran WHERE nak=$hapus";
		$eksekusi = mysqli_query($konek,$sql8);

		if ($record==0)
		{
			$sql7 = "DELETE FROM kuasa WHERE nak=$hapus";
		$eksekusi = mysqli_query($konek,$sql7);
		
		}
		else
		{
		$sql7 = "DELETE FROM kuasa WHERE id_kuasa=$hapus";
		$eksekusi = mysqli_query($konek,$sql7);	
		}
		
		if ($hapus){
            ?>
                <script>alert('Berhasil Hapus Data');location.href='index.php?id=7';</script>";
            <?php
		} else {
        }
?>