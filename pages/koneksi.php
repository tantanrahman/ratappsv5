<?php

	$mysqli = new mysqli('localhost','root','','registrasi');

	if ($mysqli->connect_errno) {
		echo "Failed".$mysqli->connect_error;
	}

?>