<?php

define ("DB_HOST", "localhost"); // set database host
define ("DB_USER", "root"); // set database user
define ("DB_PASS",""); // set database password
define ("DB_NAME","registrasi"); // set database name
include 'Classes/PHPExcel/IOFactory.php';
    $folder = "uploads/";
    
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $konek = mysqli_connect('localhost','root','','registrasi');
    mysql_select_db('registrasi');
    

    if (is_dir($folder))
    {
            if ($open = opendir($folder))
            {   
                while (($file=readdir($open))!== FALSE) 
                {
                    
                        if($file=='.' || $file=='..')
                        {
                       
                        }
                        else
                        {
                            include('query_upload.php');
                        }
                    
                }
            }
    }
    else
    {
        echo "Folder Tidak ada";
    }
    include ("hapus_file.php");
   

?>
