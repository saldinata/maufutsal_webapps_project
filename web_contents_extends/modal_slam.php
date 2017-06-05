<?php
	require_once('../library/database.php');
	$db = new Database();
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title" id="defaultModalLabel">Gabung Ajang Tanding</h4>
</div>
<div class="modal-body">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<h6>Nama Tim</h6>
				<input type="text" class="form-control" required id="team_name_slam" autocomplete="off">
			</div>

			<br>
			<div class="form-group">
				<h6>Pilihan Lapangan Futsal</h6>

				<div id="checkboxlist">
					<?php
						if(isset($_COOKIE["maufutsal_slam_dat"]))
						{
							$id_slam = $_COOKIE["maufutsal_slam_dat"];

							$query = "SELECT * FROM tbl_kompetisi WHERE id_kompetisi=?";
							$result_slam_info = $db->getValue($query,[$id_slam]);

							$id_city = $result_slam_info['kota'];

							$query = "SELECT * FROM tbl_field_information WHERE id_kota=? ORDER BY nama_lapangan ASC ";
							$result_field_info = $db->getAllValue($query,[$id_city]);

							foreach ($result_field_info as $data) 
							{
								echo "<div class=\"checkbox-custom checkbox-default\">";
								echo "<h6><input type=\"checkbox\" value=\"".$data['id_field_information']."\"> ".$data['nama_lapangan']."</h6>";
								echo "</div>";
							}
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal-footer">
	<button type="button" class="mb-xs mt-xs mr-xs btn btn-default" id="go_to_payment_slam">Lanjut</button>
	<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
</div>


<script type="text/javascript" src="js/maufutsal_script/script_slam_list.js"></script>
