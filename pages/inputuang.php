<head>
	
<style type="text/css">
	


#angka {
	color: white;
}

#input {

}

input#inputku {
	padding: .4em;
	line-height: 1.4;
	font-size: 16px;
	font-size: 16px;
	width: 80%;
}
input#submit {
border: 1px solid #044062;
background: #396B9E;
font-weight: bold;
color: white;
font-size: 16px;
}

</style>



<script type="text/javascript">
	

	function tandaPemisahTitik(b){
	var _minus = false;
	if (b<0) _minus = true;
	b = b.toString();
	b=b.replace(".","");
	b=b.replace("-","");
	c = "";
	panjang = b.length;
	j = 0;
	for (i = panjang; i > 0; i--){
		 j = j + 1;
		 if (((j % 3) == 1) && (j != 1)){
		   c = b.substr(i-1,1) + "." + c;
		 } else {
		   c = b.substr(i-1,1) + c;
		 }
	}
	if (_minus) c = "-" + c ;
	return c;
}

function numbersonly(ini, e){
	if (e.keyCode>=49){
		if(e.keyCode<=57){
		a = ini.value.toString().replace(".","");
		b = a.replace(/[^\d]/g,"");
		b = (b=="0")?String.fromCharCode(e.keyCode):b + String.fromCharCode(e.keyCode);
		ini.value = tandaPemisahTitik(b);
		return false;
		}
		else if(e.keyCode<=105){
			if(e.keyCode>=96){
				//e.keycode = e.keycode - 47;
				a = ini.value.toString().replace(".","");
				b = a.replace(/[^\d]/g,"");
				b = (b=="0")?String.fromCharCode(e.keyCode-48):b + String.fromCharCode(e.keyCode-48);
				ini.value = tandaPemisahTitik(b);
				//alert(e.keycode);
				return false;
				}
			else {return false;}
		}
		else {
			return false; }
	}else if (e.keyCode==48){
		a = ini.value.replace(".","") + String.fromCharCode(e.keyCode);
		b = a.replace(/[^\d]/g,"");
		if (parseFloat(b)!=0){
			ini.value = tandaPemisahTitik(b);
			return false;
		} else {
			return false;
		}
	}else if (e.keyCode==95){
		a = ini.value.replace(".","") + String.fromCharCode(e.keyCode-48);
		b = a.replace(/[^\d]/g,"");
		if (parseFloat(b)!=0){
			ini.value = tandaPemisahTitik(b);
			return false;
		} else {
			return false;
		}
	}else if (e.keyCode==8 || e.keycode==46){
		a = ini.value.replace(".","");
		b = a.replace(/[^\d]/g,"");
		b = b.substr(0,b.length -1);
		if (tandaPemisahTitik(b)!=""){
			ini.value = tandaPemisahTitik(b);
		} else {
			ini.value = "";
		}
		
		return false;
	} else if (e.keyCode==9){
		return true;
	} else if (e.keyCode==17){
		return true;
	} else {
		//alert (e.keyCode);
		return false;
	}

}

function bersihPemisah(ini){
	a = ini.toString().replace(".","");
	//a = a.replace(".","");
	return a;
}


</script>


<script type="text/javascript" charset="utf-8">
   function fnHitung() {
 var angka = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah(document.getElementById('inputku').value)))); //input ke dalam angka tanpa titik
 if (document.getElementById('inputku').value == "") {
 alert("Jangan Dikosongi");
 document.getElementById('inputku').focus();
 return false;
 }
 else
 if (angka >= 1) {
 alert("angka aslinya : "+angka);
 document.getElementById('inputku').focus();
 document.getElementById('inputku').value = tandaPemisahTitik(angka);
 return false; 
 }
}
  </script>

<script type="text/javascript">
		
		var rupiah = document.getElementById('rupiah');
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value, 'Rp. ');
		});
 
		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
	</script>


</head>
<div class="panel panel-primary">
    <div class="panel-heading">
      <b><center>Ubah Uang Pembayaran</center></b>
    </div>
  </div>






<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db('registrasi');
$sql="Select * from bayar";
$ambildata = mysql_query( $sql, $koneksi);
$row =mysql_fetch_array($ambildata);

$bayar = $row['bayar'];


?>


<form action="?id=102" method="post">
		<table>
<tr><td><b>Uang Pembayaran</b></td><td class="col-lg-2"></td>
<td><div id="angka"><input type="text" name="bayar" size="25" class="form-control" <?php echo "value='$bayar'";?> id="inputku" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" autofocus></div></td></tr>
</table>
<hr>
<center>
	<input type="submit" name="simpan" value="Simpan" class="btn btn-success" id="rupiah">
</center>
</form>

