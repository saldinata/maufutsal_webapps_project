<?php
	$id_comp = "";
	$result_comp_info = "";

	if(isset($_COOKIE['maufutsal_dat']))
	{
		if(isset($_SESSION['id_comp']))
		{
			$id_comp = $_SESSION['id_comp'];

			$query = "SELECT * FROM tbl_kompetisi WHERE id_kompetisi=?";
			$result_comp_info = $db->getValue($query,[$id_comp]);
		}
	}
	else
	{
?>
		<script type="text/javascript">document.location.href="./"</script>";
<?php 
	}
?>

<br>

<div role="main" class="main">
<div class="container">
<h1>Jadwal Kompetisi</h1>
<span><a href="dashcompinfo">Kembali ke halaman Informasi Kompetisi</a></span>
<hr>
	<div class="tabs">
		<ul class="nav nav-tabs">
		<?php
			$firstTime = 0;
			
			if($result_comp_info['jenis_kompetisi']=="setengah")
			{
				$id_eo_detail = $result_comp_info['id_eo_detail'];

				$query = "SELECT * FROM tbl_tab_half_comp WHERE id_eo=? AND id_comp=? ORDER BY name_tab ASC";
				$result_tab = $db->getAllValue($query,[$id_eo_detail,$id_comp]);
				$count = 0;
				foreach ($result_tab as $data_tab) 
				{	
					$count++;

					if($firstTime==0)
					{	
						echo "<li class=\"active\">";
						echo "<a href=\"#"."tab$count"."\" data-toggle=\"tab\">".$data_tab['name_tab']."</a>;";
						echo "</li>";

						$firstTime = 1;
					}
					else if($firstTime==1)
					{
						echo "<li>";
						echo "<a href=\"#"."tab$count"."\" data-toggle=\"tab\">".$data_tab['name_tab']."</a>;";
						echo "</li>";
					}
					else
					{

					}
				}
			}

			else if($result_comp_info['jenis_kompetisi']=="penuh")
			{
				echo "<li class=\"active\">";
				echo "<a href=\"#"."putaran1"."\" data-toggle=\"tab\">"."putaran pertama"."</a>;";
				echo "</li>";

				echo "<li>";
				echo "<a href=\"#"."putaran2"."\" data-toggle=\"tab\">"."putaran kedua"."</a>;";
				echo "</li>";
			}
			else
			{
				//do not show 
			}
		?>
		</ul>

		<div class="tab-content">

		<?php
			$firstTime = 0;
			
			if($result_comp_info['jenis_kompetisi']=="setengah")
			{
				$id_eo_detail = $result_comp_info['id_eo_detail'];

				$query = "SELECT * FROM tbl_tab_half_comp WHERE id_eo=? AND id_comp=? ORDER BY name_tab ASC";
				$result_tab = $db->getAllValue($query,[$id_eo_detail,$id_comp]);

				$count=0;
				foreach ($result_tab as $data_tab) 
				{	
					$count++;

					if($firstTime==0)
					{	
						$id_tab = $data_tab['id_tab'];

						echo "<div id=\""."tab$count"."\" class=\"tab-pane active\">";
						echo "<br>";
						echo "<div class=\"panel-body\">";
						echo "<table class=\"table table-bordered table-striped mb-none\" style=\"font-size:14px;table-layout: auto;\">";
						
						echo "<thead>";
						echo "<tr>";
						echo "<td align=\"center\"><strong>Tanggal</strong></td>";
						echo "<td align=\"center\"><strong>Nama Team 1</strong></td>";
						echo "<td align=\"center\"><strong></strong></td>";
						echo "<td align=\"center\"><strong>Nama Team 2</strong></td>";
						echo "<td align=\"center\"><strong>Waktu Bertanding</strong></td>";
						echo "<td align=\"center\"><strong>Lokasi Bertanding</strong></td>";
						echo "</tr>";
						echo "</thead>";

						echo "<tbody>";

						$query ="SELECT * FROM tbl_jadwal_kompetisi WHERE id_kompetisi=? AND id_tab=? ORDER BY register ASC";
						$result_schedulle = $db->getAllValue($query,[$id_comp,$id_tab]);

						foreach ($result_schedulle as $data_sche) 
						{
							$id_booking = $data_sche['id_booking_lapangan'];

							$query = "SELECT * FROM tbl_booking_lapangan WHERE id_booking=?";
							$result_book_info = $db->getValue($query,[$id_booking]);
							$court_reg = $result_book_info['court_reg'];

							$query = "SELECT * FROM tbl_field_information WHERE court_reg=?";
							$result_court_info = $db->getValue($query,[$court_reg]);
							
							echo "<tr>";
							echo "<td align=\"center\">".$data_sche['tanggal']."</td>";
							echo "<td align=\"center\">".$data_sche['nama_team1']."</td>";
							echo "<td align=\"center\">VS</td>";
							echo "<td align=\"center\">".$data_sche['nama_team2']."</td>";
							echo "<td align=\"center\">".$data_sche['waktu_tanding']."</td>";
							echo "<td align=\"center\">".$result_court_info['nama_lapangan']."</td>";
							echo "</tr>";
						}

						echo "</tbody>";
						echo "</table>";
						echo "</div>";
						echo "</div>";

						$firstTime=1;
					}
					else if($firstTime==1)
					{
						$id_tab = $data_tab['id_tab'];

						echo "<div id=\""."tab$count"."\" class=\"tab-pane\">";
						echo "<br>";
						echo "<div class=\"panel-body\">";
						echo "<table class=\"table table-bordered table-striped mb-none\" style=\"font-size:14px;table-layout: auto;\">";
						
						echo "<thead>";
						echo "<tr>";
						echo "<td align=\"center\"><strong>Tanggal</strong></td>";
						echo "<td align=\"center\"><strong>Nama Team 1</strong></td>";
						echo "<td align=\"center\"><strong></strong></td>";
						echo "<td align=\"center\"><strong>Nama Team 2</strong></td>";
						echo "<td align=\"center\"><strong>Waktu Bertanding</strong></td>";
						echo "<td align=\"center\"><strong>Lokasi Bertanding</strong></td>";
						echo "</tr>";
						echo "</thead>";

						echo "<tbody>";

						$query ="SELECT * FROM tbl_jadwal_kompetisi WHERE id_kompetisi=? AND id_tab=? ORDER BY register ASC";
						$result_schedulle = $db->getAllValue($query,[$id_comp,$id_tab]);

						foreach ($result_schedulle as $data_sche) 
						{
							$id_booking = $data_sche['id_booking_lapangan'];

							$query = "SELECT * FROM tbl_booking_lapangan WHERE id_booking=?";
							$result_book_info = $db->getValue($query,[$id_booking]);
							$court_reg = $result_book_info['court_reg'];

							$query = "SELECT * FROM tbl_field_information WHERE court_reg=?";
							$result_court_info = $db->getValue($query,[$court_reg]);

							echo "<tr>";
							echo "<td align=\"center\">".$data_sche['tanggal']."</td>";
							echo "<td align=\"center\">".$data_sche['nama_team1']."</td>";
							echo "<td align=\"center\">VS</td>";
							echo "<td align=\"center\">".$data_sche['nama_team2']."</td>";
							echo "<td align=\"center\">".$data_sche['waktu_tanding']."</td>";
							echo "<td align=\"center\">".$result_court_info['nama_lapangan']."</td>";
							echo "</tr>";
						}
						
					
						echo "</tbody>";
						echo "</table>";
						echo "</div>";
						echo "</div>";
					}
					else
					{
						
					}
				}
			}

			else if($result_comp_info['jenis_kompetisi']=="penuh")
			{
				echo "<div id=\""."putaran1"."\" class=\"tab-pane active\">";
				echo "<br>";
				echo "<div class=\"panel-body\">";
				echo "<table class=\"table table-bordered table-striped mb-none\" style=\"font-size:14px;table-layout: auto;\">";
				
				echo "<thead>";
				echo "<tr>";
				echo "<td align=\"center\"><strong>Tanggal</strong></td>";
				echo "<td align=\"center\"><strong>Nama Team 1</strong></td>";
				echo "<td align=\"center\"><strong></strong></td>";
				echo "<td align=\"center\"><strong>Nama Team 2</strong></td>";
				echo "<td align=\"center\"><strong>Waktu Bertanding</strong></td>";
				echo "<td align=\"center\"><strong>Lokasi Bertanding</strong></td>";
				echo "</tr>";
				echo "</thead>";

				echo "<tbody>";

				$putaran = "0";
				$query = "SELECT * FROM tbl_jadwal_kompetisi WHERE id_kompetisi=? AND putaran=? ORDER BY register ASC";
				$result_schedulle = $db->getAllValue($query,[$id_comp,$putaran]);

				foreach ($result_schedulle as $data_sche) 
				{
					$id_booking = $data_sche['id_booking_lapangan'];

					$query = "SELECT * FROM tbl_booking_lapangan WHERE id_booking=?";
					$result_book_info = $db->getValue($query,[$id_booking]);
					$court_reg = $result_book_info['court_reg'];

					$query = "SELECT * FROM tbl_field_information WHERE court_reg=?";
					$result_court_info = $db->getValue($query,[$court_reg]);

					echo "<tr>";
					echo "<td align=\"center\">".$data_sche['tanggal']."</td>";
					echo "<td align=\"center\">".$data_sche['nama_team1']."</td>";
					echo "<td align=\"center\">VS</td>";
					echo "<td align=\"center\">".$data_sche['nama_team2']."</td>";
					echo "<td align=\"center\">".$data_sche['waktu_tanding']."</td>";
					echo "<td align=\"center\">".$result_court_info['nama_lapangan']."</td>";
					echo "</tr>";
				}
				

				echo "</tbody>";
				echo "</table>";
				echo "</div>";
				echo "</div>";



				echo "<div id=\""."putaran2"."\" class=\"tab-pane\">";
				echo "<br>";
				echo "<div class=\"panel-body\">";
				echo "<table class=\"table table-bordered table-striped mb-none\" style=\"font-size:14px;table-layout: auto;\">";
				
				echo "<thead>";
				echo "<tr>";
				echo "<td align=\"center\"><strong>Tanggal</strong></td>";
				echo "<td align=\"center\"><strong>Nama Team 1</strong></td>";
				echo "<td align=\"center\"><strong></strong></td>";
				echo "<td align=\"center\"><strong>Nama Team 2</strong></td>";
				echo "<td align=\"center\"><strong>Waktu Bertanding</strong></td>";
				echo "<td align=\"center\"><strong>Lokasi Bertanding</strong></td>";
				echo "</tr>";
				echo "</thead>";

				echo "<tbody>";

				$putaran = "1";
				$query = "SELECT * FROM tbl_jadwal_kompetisi WHERE id_kompetisi=? AND putaran=? ORDER BY register ASC";
				$result_schedulle = $db->getAllValue($query,[$id_comp,$putaran]);

				foreach ($result_schedulle as $data_sche) 
				{
					$id_booking = $data_sche['id_booking_lapangan'];

					$query = "SELECT * FROM tbl_booking_lapangan WHERE id_booking=?";
					$result_book_info = $db->getValue($query,[$id_booking]);
					$court_reg = $result_book_info['court_reg'];

					$query = "SELECT * FROM tbl_field_information WHERE court_reg=?";
					$result_court_info = $db->getValue($query,[$court_reg]);

					echo "<tr>";
					echo "<td align=\"center\">".$data_sche['tanggal']."</td>";
					echo "<td align=\"center\">".$data_sche['nama_team1']."</td>";
					echo "<td align=\"center\">VS</td>";
					echo "<td align=\"center\">".$data_sche['nama_team2']."</td>";
					echo "<td align=\"center\">".$data_sche['waktu_tanding']."</td>";
					echo "<td align=\"center\">".$result_court_info['nama_lapangan']."</td>";
					echo "</tr>";
				}
				

				echo "</tbody>";
				echo "</table>";
				echo "</div>";
				echo "</div>";
			}
			else
			{
				//do not show 
			}
		?>
		</div>
	</div>
</div>

<br>

<script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
<script src="assets/javascripts/tables/examples.datatables.editable.js"></script>
<script src="assets/javascripts/tables/examples.datatables.editable2.js"></script>


