<?php
	$result_member_info = "";
	$id_reg_member 		= "";

	if(isset($_COOKIE['maufutsal_dat']))
	{
		$email = $util->decode($_COOKIE['maufutsal_dat']);
		$query = "SELECT * FROM tbl_user WHERE username=?";
		$result_member_info = $db->getValue($query,[$email]);

		$id_reg_member = $result_member_info['id_reg'];
	}
	else
	{
?>
		<script type="text/javascript">document.location.href="./"</script>";
<?php 
	}
?>

<div role="main" class="main">
<div class="container">
	<h1>Informasi Ajang Tanding</h1>
	<span><a href="dashboard">Kembali ke halaman dashboard</a></span>
	<hr>

	<br>
	<div class="panel-body">
		<table class="table table-bordered table-striped mb-none" id="datatable-editable" style="font-size:14px;table-layout: auto;">
			<thead>
				<tr>
					<th align="center"><strong>Nama Ajang Tanding</strong></th>
					<th align="center"><strong>Nama Team</strong></th>
					<th align="center"><strong>Lawan Tanding</strong></th>
					<th align="center"><strong>Lokasi Futsal</strong></th>
					<th align="center"><strong>Nama Lapangan</strong></th>
					<th align="center"><strong>Tanggal Tanding</strong></th>
					<th align="center"><strong>Waktu Tanding</strong></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$veri = "2";
					$query = "SELECT * FROM tbl_member_kompetisi WHERE id_reg_member=? AND verification=?";
					$result_comp_info = $db->getAllValue($query,[$id_reg_member,$veri]);
					
					$count = 0;
					foreach ($result_comp_info as $data) 
					{
						$count++;

						$id_kompetisi = $data['id_kompetisi'];
					
						$query = "SELECT * FROM tbl_kompetisi WHERE id_kompetisi=? ORDER BY nama_kompetisi ASC";
						$result_comp_info = $db->getValue($query,[$id_kompetisi]);

						if($result_comp_info['jenis_kompetisi']=="ajang")
						{
							$court_name = $court_reg  = $data['futsal_tanding'];
							$arena_name = $arena_code = $data['lapangan_tanding'];
							$date_slam 	= $data['tanggal_tanding'];
							$time_slam 	= $data['pukul_tanding'];

							if (is_numeric($court_reg) AND is_numeric($arena_code))
							{ 
								$query = "SELECT * FROM tbl_field_information WHERE court_reg=?";
								$result_court_info = $db->getValue($query,[$court_reg]);

								$court_name = $result_court_info['nama_lapangan'];

								$query = "SELECT * FROM tbl_arena_futsal WHERE code_arena=? AND court_reg=?";
								$result_arena_info = $db->getValue($query,[$arena_code,$court_reg]);
								$arena_name = $result_arena_info['nama_arena'];
							}
							echo "<tr>";
							echo "<td align=\"right\">".$result_comp_info['nama_kompetisi']."</td>";
							echo "<td align=\"right\">".$data['nama_team']."</td>";
							echo "<td align=\"right\">".$data['lawan_tanding']."</td>";

							echo "<td align=\"right\">".$court_name."</td>";
							echo "<td align=\"right\">".$arena_name."</td>";
							echo "<td align=\"right\">".$date_slam."</td>";
							echo "<td align=\"right\">".$time_slam."</td>";

							echo "</tr>";
						}
					}
				?>
				
			</tbody>
		</table>
	</div>
</div>

<br><br>

<script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
<script src="assets/javascripts/tables/examples.datatables.editable.js"></script>



