<?php

	include ('../components/connection.php');

	$kode = $_GET['kode'];

?>

<!doctype html>
<html lang="en">

<head>

  <!-- Basic -->
  <title>MAUFUTSAL</title>

  <!-- Define Charset -->
  <meta charset="utf-8">

  <!-- Responsive Metatag -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  
  <link rel="icon" type="../image/png" href="images/maufutsal_ico-48x48.png" sizes="48x48">

  <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="../sweetalert/dist/sweetalert.css">
  
  <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>


</head>

<body>

<div class="container">
	
	
	<form method="get">
		<input type="hidden" name="" id="kode" value="<?php echo $kode; ?>">
	</form>	
</div>

</body>

<script src="../js/jquery.js"></script>
<script src="../sweetalert/dist/sweetalert.min.js"></script> 

<script type="text/javascript">
	
	$(document).ready(function(){
		var kode = $("#kode").val();

		$.ajax({
			type  : "GET",
			cache : false,
			url   : "aksi_aktivasi.php",
			data  : "kode=" + kode,
			success : function(data){
				if (data == 1) 
				{
					swal({   
						title: "Your account is active",   
						text: "Welcome to maufutsal",   
						type: "success",   
						showCancelButton: false,   
						confirmButtonColor: "#DD6B55",   
						confirmButtonText: "OK",   
						closeOnConfirm: false 
					}, 
					function(){   
						document.location.href="http://www.kitaaja.maufutsal.com/"; 
					}
					);
				}
				else
				{
					alert("Gagal Aktivasi");
				}
			}
		});
	});

</script>