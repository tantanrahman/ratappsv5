<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','registrasi');



	if (isset($_POST['tambah'])) 
	{

	$nak= $_POST['nak'];
	$status= $_POST['status'];
	$panjang = strlen($nak);
	if ($panjang <= 4)
	{


		$esqiel = "SELECT nak,nik from anggota where nak=$nak";
		$takedata = mysqli_query( $konek,$esqiel);
		$baris = mysqli_fetch_array($takedata, MYSQL_ASSOC);
		if (($nak <> $baris['nak']))
		{
			
			?>
					<SCRIPT LANGUAGE="JavaScript">
					window.alert ("Data anggota tidak ada !!!");
					window.location.href="?id=1";
					</SCRIPT>
					<?php

		}
		else
		{

			

	if ($status=="HADIR")
	{
		$sql4 = "SELECT status from kehadiran where temp=1 and user='$_SESSION[nama]'";
		$ambildata4 = mysqli_query( $konek,$sql4);
		while($rows = mysqli_fetch_array($ambildata4, MYSQL_ASSOC))
		{
			$statuss=$rows['status'];
		}
			if ($statuss == "HADIR")
				{
					?>
					<SCRIPT LANGUAGE="JavaScript">
					window.alert ("Data Hadir Sudah Ada, Hanya Dapat Memasukan Status Kuasa !!!");
					window.location.href="?id=1";
					</SCRIPT>
					<?php
				}
				else
				{

						$sql5 = "SELECT * from kuasa where nak=$nak";
						$ambildata5 = mysqli_query( $konek,$sql5);
						$rows = mysqli_fetch_array($ambildata5, MYSQL_ASSOC);
						if ($rows == null)
						{	


							if(! $koneksi )
							{
							  die('Gagal Koneksi: ' . mysql_error());
							}
									
							$insert = "INSERT INTO kehadiran (nak,status,temp,user,id_kuasa) values ('$nak','$status',1,'$_SESSION[nama]',$nak)";
							$sql=mysqli_query($konek,$insert);
								if ($sql)
									{
										include "kehadiran.php";
									}
								else
									{
										?>
							<SCRIPT LANGUAGE="JavaScript">
							window.alert ("Anggota sudah melakukan Absen !!!");
							window.location.href="?id=1";
							</SCRIPT>
							<?php
									}
						}
						else
						{
							$sqlkuasa = "SELECT nama from kuasa, anggota where kuasa.nak=$nak and id_kuasa=anggota.nak limit 0,1";
							$ambildatakuasa = mysqli_query( $konek,$sqlkuasa);
							$rowskuasa = mysqli_fetch_array($ambildatakuasa, MYSQL_ASSOC);
							$nama = $rowskuasa['nama'];


							$sqlkuasa2 = "SELECT nama,anggota.nak from kuasa join anggota using (nak) where nak=$nak";
							$ambildatakuasa2 = mysqli_query( $konek,$sqlkuasa2);
							$rowskuasa2 = mysqli_fetch_array($ambildatakuasa2, MYSQL_ASSOC);
							$nama2 = $rowskuasa2['nama'];
							$nak = $rowskuasa2['nak'];

							?>
							<SCRIPT LANGUAGE="JavaScript">
							var nama = <?php echo json_encode($nama); ?>;
							var nama2 = <?php echo json_encode($nama2); ?>;
							var nak = <?php echo json_encode($nak); ?>;
							window.alert ('Anggota dengan nak ='+nak+' ,nama ='+nama2+' sudah dikuasakan oleh '+ nama);
							window.location.href='?id=1';
							</SCRIPT>
							<?php
						}
				}

	}
	else if ($status=="KUASA")
	{
			
			$sql3 = "SELECT id_kuasa from kehadiran where temp=1 and user='$_SESSION[nama]'";
			$ambildata3 = mysqli_query( $konek,$sql3);
			while($row = mysqli_fetch_array($ambildata3, MYSQL_ASSOC))
			{
				$id_kuasa=$row['id_kuasa'];
			} 
			
			$sql6 = "SELECT * from kehadiran where nak=$nak";
			$ambildata6 = mysqli_query( $konek,$sql6);
			$rows = mysqli_fetch_array($ambildata6, MYSQL_ASSOC);
			if ($rows == null)
			{	

				$insert = "INSERT INTO kuasa (nak,status,temp,user,id_kuasa) values ('$nak','$status',1,'$_SESSION[nama]',$id_kuasa)";
				$sql=mysqli_query($konek,$insert);
				if ($sql)
					{
						include "kehadiran.php";	
					}
				else
					{
							
							$sqlkuasa = "SELECT nama from kuasa, anggota where kuasa.nak=$nak and id_kuasa=anggota.nak limit 0,1";
							$ambildatakuasa = mysqli_query( $konek,$sqlkuasa);
							$rowskuasa = mysqli_fetch_array($ambildatakuasa, MYSQL_ASSOC);
							$nama = $rowskuasa['nama'];


							$sqlkuasa2 = "SELECT nama,anggota.nak from kuasa join anggota using (nak) where nak=$nak";
							$ambildatakuasa2 = mysqli_query( $konek,$sqlkuasa2);
							$rowskuasa2 = mysqli_fetch_array($ambildatakuasa2, MYSQL_ASSOC);
							$nama2 = $rowskuasa2['nama'];
							$nak = $rowskuasa2['nak'];

							?>
							<SCRIPT LANGUAGE="JavaScript">
							var nama = <?php echo json_encode($nama); ?>;
							var nama2 = <?php echo json_encode($nama2); ?>;
							var nak = <?php echo json_encode($nak); ?>;
							window.alert ('Anggota dengan nak ='+nak+' ,nama ='+nama2+' sudah dikuasakan oleh '+ nama);
							window.location.href='?id=1';
							</SCRIPT>
							<?php
					}
			}
			else
			{
				$sqlkuasa = "SELECT nama from kuasa, anggota where kuasa.nak=$nak and id_kuasa=anggota.nak limit 0,1";
							$ambildatakuasa = mysqli_query( $konek,$sqlkuasa);
							$rowskuasa = mysqli_fetch_array($ambildatakuasa, MYSQL_ASSOC);
							$nama = $rowskuasa['nama'];


							$sqlkuasa2 = "SELECT nama,anggota.nak from kuasa join anggota using (nak) where nak=$nak";
							$ambildatakuasa2 = mysqli_query( $konek,$sqlkuasa2);
							$rowskuasa2 = mysqli_fetch_array($ambildatakuasa2, MYSQL_ASSOC);
							$nama2 = $rowskuasa2['nama'];
							$nak = $rowskuasa2['nak'];

							?>
							<SCRIPT LANGUAGE="JavaScript">
							var nama = <?php echo json_encode($nama); ?>;
							var nama2 = <?php echo json_encode($nama2); ?>;
							var nak = <?php echo json_encode($nak); ?>;
							window.alert ('Anggota dengan nak ='+nak+' ,nama ='+nama2+' sudah dikuasakan oleh '+ nama);
							window.location.href='?id=1';
							</SCRIPT>
							<?php
			}

	}
	else {

		?>
							<SCRIPT LANGUAGE="JavaScript">
							window.alert ("Anggota sudah melakukan Absen !!!");
							window.location.href="?id=1";
							</SCRIPT>
							<?php
	}


		

	}
}
//nik
else 
{




		$esqiel = "SELECT nak,nik from anggota where nik=$nak";
		$takedata = mysqli_query( $konek,$esqiel);
		$baris = mysqli_fetch_array($takedata, MYSQL_ASSOC);
		if (($nak <> $baris['nik']))
		{
			
			?>
					<SCRIPT LANGUAGE="JavaScript">
					window.alert ("Data anggota tidak ada !!!");
					window.location.href="?id=1";
					</SCRIPT>
					<?php

		}
		else
		{

			$nak2=$baris['nak'];

	if ($status=="HADIR")
	{
		$sql4 = "SELECT status from kehadiran where temp=1 and user='$_SESSION[nama]'";
		$ambildata4 = mysqli_query( $konek,$sql4);
		while($rows = mysqli_fetch_array($ambildata4, MYSQL_ASSOC))
		{
			$statuss=$rows['status'];
		}
			if ($statuss == "HADIR")
				{
					?>
					<SCRIPT LANGUAGE="JavaScript">
					window.alert ("Data Hadir Sudah Ada, Hanya Dapat Memasukan Status Kuasa !!!");
					window.location.href="?id=1";
					</SCRIPT>
					<?php
				}
				else
				{

						$sql5 = "SELECT * from kuasa where nak=$nak2";
						$ambildata5 = mysqli_query( $konek,$sql5);
						$rows = mysqli_fetch_array($ambildata5, MYSQL_ASSOC);
						if ($rows == null)
						{	


							if(! $koneksi )
							{
							  die('Gagal Koneksi: ' . mysql_error());
							}
									
							$insert = "INSERT INTO kehadiran (nak,status,temp,user,id_kuasa) values ('$nak2','$status',1,'$_SESSION[nama]',$nak2)";
							$sql=mysqli_query($konek,$insert);
								if ($sql)
									{
										include "kehadiran.php";
									}
								else
									{
										?>
							<SCRIPT LANGUAGE="JavaScript">
							window.alert ("Anggota sudah melakukan Absen !!!");
							window.location.href="?id=1";
							</SCRIPT>
							<?php
									}
						}
						else
						{
							$sqlkuasa = "SELECT nama from kuasa, anggota where kuasa.nak=$nak2 and id_kuasa=anggota.nak limit 0,1";
							$ambildatakuasa = mysqli_query( $konek,$sqlkuasa);
							$rowskuasa = mysqli_fetch_array($ambildatakuasa, MYSQL_ASSOC);
							$nama = $rowskuasa['nama'];


							$sqlkuasa2 = "SELECT nama,anggota.nak from kuasa join anggota using (nak) where nak=$nak2";
							$ambildatakuasa2 = mysqli_query( $konek,$sqlkuasa2);
							$rowskuasa2 = mysqli_fetch_array($ambildatakuasa2, MYSQL_ASSOC);
							$nama2 = $rowskuasa2['nama'];
							$nak2 = $rowskuasa2['nak'];

							?>
							<SCRIPT LANGUAGE="JavaScript">
							var nama = <?php echo json_encode($nama); ?>;
							var nama2 = <?php echo json_encode($nama2); ?>;
							var nak = <?php echo json_encode($nak2); ?>;
							window.alert ('Anggota dengan nak ='+nak+' ,nama ='+nama2+' sudah dikuasakan oleh '+ nama);
							window.location.href='?id=1';
							</SCRIPT>
							<?php
						}
				}

	}
	else if ($status=="KUASA")
	{
			
			$sql3 = "SELECT id_kuasa from kehadiran where temp=1 and user='$_SESSION[nama]'";
			$ambildata3 = mysqli_query( $konek,$sql3);
			while($row = mysqli_fetch_array($ambildata3, MYSQL_ASSOC))
			{
				$id_kuasa=$row['id_kuasa'];
			} 
			
			$sql6 = "SELECT * from kehadiran where nak=$nak2";
			$ambildata6 = mysqli_query( $konek,$sql6);
			$rows = mysqli_fetch_array($ambildata6, MYSQL_ASSOC);
			if ($rows == null)
			{	

				$insert = "INSERT INTO kuasa (nak,status,temp,user,id_kuasa) values ('$nak2','$status',1,'$_SESSION[nama]',$id_kuasa)";
				$sql=mysqli_query($konek,$insert);
				if ($sql)
					{
						include "kehadiran.php";	
					}
				else
					{
							
							$sqlkuasa = "SELECT nama from kuasa, anggota where kuasa.nak=$nak2 and id_kuasa=anggota.nak limit 0,1";
							$ambildatakuasa = mysqli_query( $konek,$sqlkuasa);
							$rowskuasa = mysqli_fetch_array($ambildatakuasa, MYSQL_ASSOC);
							$nama = $rowskuasa['nama'];


							$sqlkuasa2 = "SELECT nama,anggota.nak from kuasa join anggota using (nak) where nak=$nak2";
							$ambildatakuasa2 = mysqli_query( $konek,$sqlkuasa2);
							$rowskuasa2 = mysqli_fetch_array($ambildatakuasa2, MYSQL_ASSOC);
							$nama2 = $rowskuasa2['nama'];
							$nak2 = $rowskuasa2['nak'];

							?>
							<SCRIPT LANGUAGE="JavaScript">
							var nama = <?php echo json_encode($nama); ?>;
							var nama2 = <?php echo json_encode($nama2); ?>;
							var nak = <?php echo json_encode($nak2); ?>;
							window.alert ('Anggota dengan nak ='+nak+' ,nama ='+nama2+' sudah dikuasakan oleh '+ nama);
							window.location.href='?id=1';
							</SCRIPT>
							<?php
					}
			}
			else
			{
				$sqlkuasa = "SELECT nama from kuasa, anggota where kuasa.nak=$nak2 and id_kuasa=anggota.nak limit 0,1";
							$ambildatakuasa = mysqli_query( $konek,$sqlkuasa);
							$rowskuasa = mysqli_fetch_array($ambildatakuasa, MYSQL_ASSOC);
							$nama = $rowskuasa['nama'];


							$sqlkuasa2 = "SELECT nama,anggota.nak from kuasa join anggota using (nak) where nak=$nak2";
							$ambildatakuasa2 = mysqli_query( $konek,$sqlkuasa2);
							$rowskuasa2 = mysqli_fetch_array($ambildatakuasa2, MYSQL_ASSOC);
							$nama2 = $rowskuasa2['nama'];
							$nak2 = $rowskuasa2['nak'];

							?>
							<SCRIPT LANGUAGE="JavaScript">
							var nama = <?php echo json_encode($nama); ?>;
							var nama2 = <?php echo json_encode($nama2); ?>;
							var nak = <?php echo json_encode($nak2); ?>;
							window.alert ('Anggota dengan nak ='+nak+' ,nama ='+nama2+' sudah dikuasakan oleh '+ nama);
							window.location.href='?id=1';
							</SCRIPT>
							<?php
			}

	}
	else {

		?>
							<SCRIPT LANGUAGE="JavaScript">
							window.alert ("Anggota sudah melakukan Absen !!!");
							window.location.href="?id=1";
							</SCRIPT>
							<?php
	}


	


//akhir nik 
}}
}
	else
	{
		$cari = $_POST['nak'];

		$sql = "SELECT * from anggota where nama like '%$cari%' OR nik like '%$cari%' OR nak like '%$cari%'";
	 	$i=1;
		mysql_select_db('registrasi');
		$ambildata = mysql_query( $sql, $koneksi);


		$sql4 = "SELECT status from kehadiran where temp=1 and user='$_SESSION[nama]'";
		$ambildata4 = mysqli_query( $konek,$sql4);
		while($rows = mysqli_fetch_array($ambildata4, MYSQL_ASSOC))
		{
			$statuss=$rows['status'];
		}

		
		echo "<form action='?id=4' method='post'>";
		if(! $ambildata )
		{
	  		die('Gagal ambil data: ' . mysql_error());
		};
			echo "<table class='table-responsive table-bordered table'><tr><th>ID</th><th>NAK</th><th>NAMA</th><th>NIK</th><th>Pilih</th></tr>";

			while($row = mysql_fetch_array($ambildata, MYSQL_ASSOC))
		{
	    	echo "<tr><td>$i</td><td>{$row['nak']}</td><td>{$row['nama']}</td>
				<td>{$row['nik']}</td><td><input type=radio name='nak' value={$row['nak']}></td></tr>";
				$i++;
		} 
		?>

		<div class="panel panel-primary">
		    <div class="panel-heading">
		      <b><center>Mencari Anggota</center></b>
		    </div>
		</div>
			
				<div class="col-lg-2 col-md-offset-4">
					<select class="form-control" name="status">
														<?php if ($statuss=="HADIR") {} else {?>
														<option name="hadir" value="HADIR">HADIR</option>
														<?php }?>
														<option name="kuasa" value="KUASA">KUASA</option></select>
				</div>
			
				<div class="col-lg-4">
					<input class='btn btn-success' size="20px" type="submit" name="tambah" value="Tambah Absensi" />	
				</div>
				<br>
				<br>
				<br>
			
		</form>
		<?php
	}
	
?>






