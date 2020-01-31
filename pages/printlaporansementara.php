<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
set_include_path(get_include_path() . PATH_SEPARATOR . "/path/to/dompdf");
require_once("dompdf/dompdf_config.inc.php");

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db('registrasi');

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
		$jumlahhadir = $semua2 + $semua3;
		$uang = $jumlahhadir*$bayar;

		$jumlah_desimal ="0";
		$pemisah_desimal =",";
		$pemisah_ribuan =".";
		$tampil_bayar =  "Rp".number_format($uang, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);


		$persen = ($jumlahhadir / $semua) * 100;
		$tampil = round($persen,2);
		if ($persen <50)
		{
			
			$html ="<html><body><center><h1>Laporan Kehadiran Sementara</h1>
		Jumlah anggota $semua anggota<br>
		Anggota Hadir $semua2 orang<br>
		Anggota yang menguasakan $semua3 orang<br>
		Total Anggota Hadir $jumlahhadir orang<br>
		Jumlah Quo Room
		$tampil
		%<br>Status = <strong>TIDAK SAH</strong></b><br>
		Total Pembayaran = $tampil_bayar</div></center></body></html>";
		}
		else
		{
			
			$html ="<html><body><center><h1>Laporan Kehadiran Sementara</h1>
		Jumlah anggota $semua anggota<br>
		Anggota Hadir $semua2 orang<br>
		Anggota yang menguasakan $semua3 orang<br>
		Total Anggota Hadir $jumlahhadir orang<br>
		Jumlah Quo Room
		$tampil
		%<br>Status = <strong>SAH</strong></b><br>
		Total Pembayaran = $tampil_bayar</div></center></body></html>";
		}

 
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream('Laporan_Kehadiran_Sementara.pdf', array("Attachment" => false));


	?>
