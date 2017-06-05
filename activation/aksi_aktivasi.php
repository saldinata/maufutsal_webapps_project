<?php

	include ('../components/connection.php');

	$kode = $_GET['kode'];
	//$email = $_GET['email'];

	$sql 		= mysqli_query($con,"SELECT username FROM tbl_user WHERE kode_aktivasi='$kode'");
	
	$cekAkun    = mysqli_num_rows($sql);
	 
	if ($cekAkun > 0)
	{
		$updateAkun = mysqli_query($con,"UPDATE tbl_user SET status_aktivasi = '1' WHERE kode_aktivasi ='$kode'");

		if ($updateAkun) {
			echo "1";
		}
		else
		{
			echo "0";
		}
	} 
	else
	{
		echo "emptyAccount";
	}

?>
