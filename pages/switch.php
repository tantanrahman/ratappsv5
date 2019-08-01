<?php
error_reporting();
$link = $_GET['id'];
 
 switch($link) 
 {
 	case 1 :
	include "kehadiran.php";
	break;
	case 2 :
	include "lihatkehadiran.php";
	break;
	case 3 :
	include "data_anggota.php";
	break;
	case 4 :
	include "kehadiran2.php";
	break;
	case 5 :
	include "proseslogin.php";
	break;
	case 6 :
	include "kehadiran3.php";
	break;
	case 7:
	include "laporan.php";
	break;
	case 8:
	include "upload_data_anggota.php";
	break;
	case 9:
	include "ekspor_data_anggota.php";
	break;
	case 10:
	include "profil.php";
	break;
	case 11:
	include "updateprofil.php";
	break;
	case 12:
	include "print_bukti_pembayaran.php";
	break;
	case 13:
	include "print_bukti.php";
	break;
	case 14:
	include "cari_laporan.php";
	break;	
	case 15:
	include "cari_anggota.php";
	break;	
	case 16:
	include "inputbendahara.php";
	break;
	case 17:
	include "prosesinputbendahara.php";
	break;
	case 18:
	include "inputkuasa.php";
	break;
	case 19:
	include "prosesinputkuasa.php";
	break;
	case 20:
	include "cariinputkuasa.php";
	break;
	case 21:
	include "cetakkupon.php";
	break;
	case 22:
	include "prosescetakkupon.php";
	break;
	case 23:
	include "caricetakkupon.php";
	break;
	case 24:
	include "cariprintbtukti.php";
	break;
	case 25:
	include "help.php";
	break;
	case 26:
	include "tambahuser.php";
	break;
	case 27:
	include "prosestambahuser.php";
	break;
	case 28:
	include "prosestambahanggota.php";
	break;
	case 29:
	include "tambahanggota.php";
	break;

	case 30:
	include "uploadanggotashu.php";
	break;
	case 31:
	include "inputshu.php";
	break;
	case 32:
	include "inputshu2.php";
	break;
	case 33:
	include "simpan_shu.php";
	break;
	case 34:
	include "input_kuasa_shu.php";
	break;
	case 35:
	include "input_kuasa_shu2.php";
	break;
	case 36:
	include "input_kuasa_shu3.php";
	break;
	case 37:
	include "simpan_shu2.php";
	break;
	case 38:
	include "laporanshu.php";
	break;

	case 39:
	include "formcetaklaporanshu.php";
	break;
	case 40:
	include "formcetakkwitansi.php";
	break;

	case 99:
	include "hapussemua.php";
	break;
	case 100:
	include "formhapussemua.php";
	break;
	case 101:
	include "inputuang.php";
	break;
	case 102:
	include "prosesinputuang.php";
	break;
	case 999:
	include "hapus.php";
	break;


	default :
	include "kehadiran.php";
	break;

}
?>