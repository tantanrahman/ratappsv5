<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
require_once("dompdf/dompdf_config.inc.php");

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','registrasi');
$hapus= $_POST['cetak'];
if(isset($_POST['hapus_bukti']))
{
  
  

  $kueri = "delete from kehadiran where id_kuasa=$hapus";
  $eksekusi = mysqli_query($konek,$kueri);
  $kueri2 = "delete from kuasa where id_kuasa=$hapus";
  $eksekusi2 = mysqli_query($konek,$kueri2);
  
  header('location:index.php?id=12');

}
else 
{
    
$nak= $_POST['cetak'];

    $sqlcek = "SELECT * from kehadiran where nak='$nak'";
              $ambildatacek = mysqli_query( $konek,$sqlcek);
              $rowscek = mysqli_fetch_array($ambildatacek, MYSQL_ASSOC);
              $cek = $rowscek['cetak'];

if (($cek == 1) AND ($_SESSION['level']=='user'))
{
  ?>
              <SCRIPT LANGUAGE="JavaScript">
              window.alert ("Data Sudah Dicetak");
              this.close();
              </SCRIPT>
  <?php
}

else
{
    


$tahun = date("Y");
$bulan = date("n");
switch ($bulan) {
  case '1':
  $bulan2="Januari";
    break;
    case '2':
  $bulan2="Februari";
    break;
    case '3':
  $bulan2="Maret";
    break;
    case '4':
  $bulan2="April";
    break;
    case '5':
  $bulan2="Mei";
    break;
    case '6':
  $bulan2="Juni";
    break;
    case '7':
  $bulan2="Juli";
    break;
    case '8':
  $bulan2="Agustus";
    break;
    case '9':
  $bulan2="September";
    break;
    case '10':
  $bulan2="Oktober";
    break;
    case '11':
  $bulan2="November";
    break;
    case '12':
  $bulan2="Desember";
    break;
  default:
  echo "Bulan salah!!";
    break;
}
$tanggal=date("j");
$waktu = $tanggal." ".$bulan2." ".$tahun;
mysql_select_db("registrasi");
$sqlkuasa2 = "SELECT * from bendahara";
              $ambildatakuasa2 = mysqli_query( $konek,$sqlkuasa2);
              $rowskuasa2 = mysqli_fetch_array($ambildatakuasa2, MYSQL_ASSOC);
              $namabendahara = $rowskuasa2['nama'];
              $nakbendahara = $rowskuasa2['nak'];
              $nikbendahara = $rowskuasa2['nik'];


$sql = "SELECT anggota.id,kehadiran.nak,nama,nik,status,no_kupon,id_kuasa,user from kehadiran join anggota using (nak) where id_kuasa=$nak";

$ambildata = mysql_query( $sql, $koneksi);
$row = mysql_fetch_array($ambildata, MYSQL_ASSOC);


$sqlll = mysql_query("SELECT anggota.id,kuasa.nak,nama,nik,status,no_kupon,id_kuasa,user from kuasa join anggota using (nak) where id_kuasa=$nak order by id");


$data = array();
$data2 = array();
while ($rows = mysql_fetch_assoc($sqlll))
{
    array_push($data, $rows['nama']);
    array_push($data2, $rows['nik']);
}



$sqluang = "SELECT * from bayar";
              $ambildatabayar = mysqli_query( $konek,$sqluang);
              $rowsbayar = mysqli_fetch_array($ambildatabayar, MYSQL_ASSOC);
              $databayar = $rowsbayar['bayar'];



$i=1;
$bayar = $i * $databayar;
$i=2;
$keluar='';
$jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";
$tampildatabayar =  number_format($databayar, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);

// foreach ($data as $val) {
//   foreach ($data2 as $niki) {
//     $keluar .= ' '.$i.'.'.$val .'('.$niki.')';
//     $i++;
//   }
// }

foreach (array_combine($data, $data2) as $val => $niki) {
  $keluar .= ' '.$i++.'.'.$val .'('.$niki.')';
}
 


if ($i>1)
{$bayar=($i-1)*$databayar;} 
$tampil_bayar =  "Rp".number_format($bayar, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);

require ('moneyFormat.php');
$moneyFormat = new moneyFormat();

$terbilang = $moneyFormat->terbilang($bayar);
$tahun = date('Y', strtotime('-1 year'));

    

$html =
  '<html><body>'.
  '<script type=text/javascript>
  try {
    this.print();
  }
  </script>'.
  '<center><b><h3>TANDA TERIMA & REGISTRASI - RAT TAHUN BUKU '.$tahun.'</h2><b></center><br>'.
  '<table>'.
  '<tr><td>No. Registrasi</td><td>:</td><td>'.$row[no_kupon].'</td><td align=center bgcolor=silver>No Kupon :<br><font size=5><b>'.$row[no_kupon].'</b></font></td></tr>'.
  '<tr><td>Telah Terima Dari</td><td>:</td><td>KOPERASI JASA DADALI BANDUNG</td></tr>'.
  '<tr><td>Jumlah</td><td>:</td><td>'.$tampil_bayar.'</td></tr>'.
  '<tr><td></td><td></td><td><font size=1>('.$terbilang.' Rupiah)</font></td></tr>'.
  '<tr><td>Untuk Pembayaran</td><td>:</td><td colspan=2>Uang Kehadiran RAT Tahun Buku '.$tahun.' atas nama :</td></tr>'.
  '<tr><td></td><td></td><td colspan=2 align=left valign=top height=50px><font size=1>1.'.$row[nama].'('.$row[nik].')'.$keluar.'</td></tr>'.
  '<tr><td colspan=3></td><td align=center>Bandung, '.$waktu.'</td></tr>'.
  '<tr><td align=center>Yang Menerima,</td><td colspan=2 align=center>Verifikasi,</td><td align=center>Yang Membayarkan</td></tr>'.
  '<tr><td><br><br><br></td></tr>'.
  '<tr><td align=center><u>'.$row[nama].'</u></td><td colspan=2 align=center><u>'.$row['user'].'</u></td><td  align=center><u>'.$namabendahara.'</u></td></tr>'.
  '<tr><td align=center>'.$row[nak].'/'.$row[nik].'</td><td colspan=2 align=center>Petugas</td><td align=center>'.$nakbendahara.'/'.$nikbendahara.'</td></tr>'.
  '<tr><td>Lembar 1 /<b> ASLI</b></td></table>'.
  '<br>'.
  '<br>'.
  '<br>'.
  '<center><b><h3>TANDA TERIMA & REGISTRASI - RAT TAHUN BUKU '.$tahun.'</h2><b></center><br>'.
  '<table>'.
  '<tr><td>No. Registrasi</td><td>:</td><td>'.$row[no_kupon].'</td><td align=center bgcolor=silver>No Kupon :<br><font size=5><b>'.$row[no_kupon].'</b></font></td></tr>'.
  '<tr><td>Telah Terima Dari</td><td>:</td><td>KOPERASI JASA DADALI BANDUNG</td></tr>'.
  '<tr><td>Jumlah</td><td>:</td><td>'.$tampil_bayar.'</td></tr>'.
  '<tr><td></td><td></td><td><font size=1>('.$terbilang.' Rupiah)</font></td></tr>'.
  '<tr><td>Untuk Pembayaran</td><td>:</td><td colspan=2>Uang Kehadiran RAT Tahun Buku '.$tahun.' atas nama :</td></tr>'.
  '<tr><td></td><td></td><td colspan=2  align=left valign=top height=50px><font size=1>1.'.$row[nama].'('.$row[nik].')'.$keluar.'</td></tr>'.
  '<tr><td colspan=3></td><td align=center>Bandung, '.$waktu.'</td></tr>'.
  '<tr><td align=center>Yang Menerima,</td><td colspan=2 align=center>Verifikasi,</td><td align=center>Yang Membayarkan</td></tr>'.
  '<tr><td><br><br><br></td></tr>'.
  '<tr><td align=center><u>'.$row[nama].'</u></td><td colspan=2 align=center><u>'.$row['user'].'</u></td><td align=center><u>'.$namabendahara.'</u></td></tr>'.
  '<tr><td align=center>'.$row[nak].'/'.$row[nik].'</td><td colspan=2 align=center>Petugas</td><td align=center>'.$nakbendahara.'/'.$nikbendahara.'</td></tr>'.
  '<tr><td>Lembar 2 /<b> Copy</b></td></table>'.
  '</html></body></html>';

$sqlupdate = "update kehadiran set cetak=1 where nak=$row[nak]";
    $update = mysqli_query( $konek,$sqlupdate);

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream('Laporan_'.$row[nama].'.pdf', array("Attachment" => false));
}}
?>