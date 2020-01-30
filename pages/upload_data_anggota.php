<?php 
  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
?>

<br>
  <div class="panel panel-primary">
    <div class="panel-heading">
      <b><center>Upload Data Anggota</center></b>
    </div>
  </div>
  
    <h3>Ketentuan Upload Data</h3>
      <ol>  
        <li>Data berupa excel dengan extensi *.xls (1997-2003).</li>
        <li>Baris pertama berisikan header tabel, secara berurutan id,nik,nama,nak.</li>
        <li>Baris Selanjutnya berisikan data yang akan diinput.</li>
        <li>Untuk Kolom ke 5 (setelah kolom nak) akan diabaikan.</li>
      </ol>
  
<form name="myForm" id="myForm" onSubmit="return validateForm()" method="post" enctype="multipart/form-data">
    <input type="file" id="filepegawaiall" name="filepegawaiall">
    <br>
    <center>
      <input type="submit" name="submit" value="Import" class="btn btn-primary">
    </center>
    <br>
    <hr>
    <label><input type="checkbox" name="drop" value="1" /> <u>Kosongkan table di database terlebih dahulu.</u> </label>
</form>
<?php 
if (isset($_POST['submit'])) {
?>
<div id="progress" style="width:500px;border:1px solid #ccc;"></div>
<div id="info"></div>
<?php
}
?>

<script type="text/javascript">
//    validasi form (hanya file .xls yang diijinkan)
    function validateForm()
    {
        function hasExtension(inputID, exts) {
            var fileName = document.getElementById(inputID).value;
            return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
        }

        if(!hasExtension('filepegawaiall', ['.xls'])){
            alert("Hanya file XLS (Excel 2003) yang diijinkan.");
            return false;
        }
    }
</script>

<?php
//koneksi ke database, username,password  dan namadatabase menyesuaikan 
mysql_connect('localhost', 'root', '');
mysql_select_db('registrasi');

//memanggil file excel_reader
require "excel_reader.php";

//jika tombol import ditekan
if(isset($_POST['submit'])){

    $target = basename($_FILES['filepegawaiall']['name']) ;
    move_uploaded_file($_FILES['filepegawaiall']['tmp_name'], $target);
    
    $data = new Spreadsheet_Excel_Reader($_FILES['filepegawaiall']['name'],false);
    
//    menghitung jumlah baris file xls
    $baris = $data->rowcount($sheet_index=0);
    
//    jika kosongkan data dicentang jalankan kode berikut
    if($_POST['drop']==1){
//             kosongkan tabel pegawai
             $truncate ="TRUNCATE TABLE anggota";
             mysql_query($truncate);
    };
    
//    import data excel mulai baris ke-2 (karena tabel xls ada header pada baris 1)
    for ($i=4; $i<=$baris; $i++)
    {
//        menghitung jumlah real data. Karena kita mulai pada baris ke-2, maka jumlah baris yang sebenarnya adalah 
//        jumlah baris data dikurangi 1. Demikian juga untuk awal dari pengulangan yaitu i juga dikurangi 1
        $barisreal = $baris-21;
        $k = $i-21;
        
// menghitung persentase progress
        $percent = intval($k/$barisreal * 100)."%";

// mengupdate progress
        echo '<script language="javascript">
        document.getElementById("progress").innerHTML="<div style=\"width:'.$percent.'; background-color:lightblue\">&nbsp;</div>";
        document.getElementById("info").innerHTML="'.$k.' data berhasil diinsert ('.$percent.' selesai).";
        </script>';

//       membaca data (kolom ke-1 sd terakhir)
      $id            = $data->val($i, 1);
      $nak           = $data->val($i, 2);
      $nama          = $data->val($i, 3);
      $nik           = $data->val($i, 4);

      $pecah = explode("'", $nama);


$tampil = implode("",$pecah);


//      setelah data dibaca, masukkan ke tabel pegawai sql
      $query = "INSERT into anggota (id,nak,nama,nik)values($id,$nak,'$tampil','$nik')";
      $hasil = mysql_query($query);
      
      flush();



    }
        
//    hapus file xls yang udah dibaca
    unlink($_FILES['filepegawaiall']['name']);
}

?>