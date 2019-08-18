<br>
<div class="panel panel-primary">
	<div class="panel-heading">
		<center>
			<b>Tambah User</b>
		</center>
	</div>
</div>

 <form action='?id=27' method='POST'>
 <table>
 <tr><td width='100px'>NAK / Username</td><td width='20px'>:</td><td><input type='text' name='nak' class='form-control' autofocus></td><td>*digunakan untuk login*</td></tr>
 <tr><td width='100px'>NAMA</td><td width='20px'>:</td><td><input type='text' name='nama'  class='form-control'></td></tr>
 <tr><td width='100px'>Password</td><td width='20px'>:</td><td><input type='password' name='password' class='form-control'></td><td>*digunakan untuk login*</td></tr>
 <tr><td width="100px">Level</td><td>:</td><td><select class="form-control" name="level">
												<option name="user" value="user">USER</option>
												<option name="admin" value="admin">ADMIN</option>
												</select></td></tr>
 </table>
 <hr>
 <center>
 	<tr><td colspan='3'><input type='submit' value='Simpan' name='simpan' class='btn btn-success'></td></tr>
 </center>
 </form>