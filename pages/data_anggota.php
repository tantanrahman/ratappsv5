<?php 
	include 'koneksi.php';
?>

<div class="page-wrapper">
	<br>
<div class="panel panel-default">
    <div class="panel-heading">
              <b><center>Data Anggota RAT</center></b>
    </div>
		<div class="panel-body">
			<div class="table-responsive">
            	<table class="table table-striped table-bordered table-hover" id="table-data">
            		<thead>
            			<tr>
	            			<th>No</th>
	            			<th>NAK</th>
	            			<th>Nama</th>
	            			<th>NIK</th>
	            		</tr>
            		</thead>
            		<tfoot>
            			<tr>
	            			<th>No</th>
	            			<th>NAK</th>
	            			<th>Nama</th>
	            			<th>NIK</th>
	            		</tr>
            		</tfoot>
            		<tbody>
            			<?php 
							$query = $mysqli->query("SELECT * FROM anggota");
							$no =1;
							while($row = mysqli_fetch_array($query)){
						?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $row['nak'] ?></td>
							<td><?php echo $row['nama'] ?></td>
							<td><?php echo $row['nik'] ?></td>
						</tr>
						<?php } ?>
            		</tbody>
            	</table>
            </div>
        </div>
</div>
</div>