<?php
/************************ YOUR DATABASE CONNECTION START HERE   ****************************/
/*    
define ("DB_HOST", "localhost"); // set database host
define ("DB_USER", "root"); // set database user
define ("DB_PASS",""); // set database password
define ("DB_NAME","kopeg"); // set database name
*/

$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");

$databasetable = "shu_anggota";

/************************ YOUR DATABASE CONNECTION END HERE  ****************************/


set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
//include 'PHPExcel/IOFactory.php';

// This is the file path to be uploaded.
$inputFileName = 'uploads/'.$file;
echo "$inputFileName";

try {
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}


$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet


for($i=6;$i<=$arrayCount;$i++){



            


      $nak              = trim($allDataInSheet[$i]["B"]);
      $nama             = trim($allDataInSheet[$i]["C"]);
      $nik                = trim($allDataInSheet[$i]["D"]);
      $bayaran            = trim($allDataInSheet[$i]["G"]);
      $pecah = explode("'", $nama);
      $tampil = implode("&#39;",$pecah);
   
      


//      setelah data dibaca, masukkan ke tabel pegawai sql
      $query = "INSERT into shu_anggota 
      values('$nak','$tampil','$nik',$bayaran)";

        


mysql_query($query);


$msg = 'Data Anggota SHU Sudah Ditambahkan';
}
echo "<i class='glyphicon glyphicon-ok'></i>".$msg."<br>";


?>