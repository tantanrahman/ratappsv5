<?php

	$tahun = date('Y', strtotime('-1 year'));

// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=Laporan-UD-RAT-TB-$tahun.xls");
 
// Add data table
include 'laporan2.php';
?>