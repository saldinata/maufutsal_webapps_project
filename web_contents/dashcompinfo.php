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

<br>

<div role="main" class="main">
<div class="container">
	<h1>Informasi Kompetisi</h1>
	<span><a href="dashboard">Kembali ke halaman dashboard</a></span>
	<hr>

	<br><br>
	<div class="panel-body">
		<table class="table table-bordered table-striped mb-none" id="datatable-editable" style="font-size:14px;table-layout: auto;">
			<thead>
				<tr>
					<th align="center"><strong>Nama Kompetisi</strong></th>
					<th align="center"><strong>Keterangan</strong></th>
					<th align="center"><strong>Jenis Kompetisi</strong></th>
					<th align="center"><strong>Detail Kompetisi</strong></th>
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

						if($result_comp_info['jenis_kompetisi']!="ajang")
						{
							echo "<tr>";
							echo "<td align=\"right\">".$result_comp_info['nama_kompetisi']."</td>";
							echo "<td align=\"right\">".$result_comp_info['tanggal_mulai']." hingga ".$result_comp_info['tanggal_akhir']."</td>";
							echo "<td align=\"right\">".$result_comp_info['jenis_kompetisi']."</td>";
							echo "<td align=\"center\">";
							echo "<button class=\"btn btn-default\" id=\"sche$count\">Jadwal</button>";
							echo "&nbsp;&nbsp;";
							echo "<button class=\"btn btn-default\" id=\"scor$count\">Scoring</button>";
							echo "<input type=\"hidden\" value=\"".$id_kompetisi."\" id=\"idcomp$count\">";
							echo "</td>";
							echo "</tr>";
						}
					}
				?>
				
			</tbody>
		</table>
	</div>
</div>

<br>

<script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
<script src="assets/javascripts/tables/examples.datatables.editable.js"></script>
<script src="assets/javascripts/tables/examples.datatables.editable2.js"></script>

<script type="text/javascript" src="js/maufutsal_script/script_comp_info.js"></script>


