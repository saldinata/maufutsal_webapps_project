<?php
	$email = "";

	if(isset($_COOKIE['maufutsal_dat']))
	{
		$email = $util->decode($_COOKIE['maufutsal_dat']);
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
<h1>History Pembayaran</h1>
<span><a href="dashboard">Kembali ke halaman dashboard</a></span>
<hr>

	<div class="tabs">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#lapangan" data-toggle="tab">Reservasi Lapangan Futsal</a>
			</li>
			<li>
				<a href="#akom" data-toggle="tab">Ajang Tanding atau Kompetisi</a>
			</li>
		</ul>

		<div class="tab-content">

			<div id="lapangan" class="tab-pane active">
				<br>
				<h4>Reservasi Lapangan Futsal</h4>
				<br>
				<div class="panel-body">
					<table class="table table-bordered table-striped mb-none" id="datatable-editable" style="font-size:14px;table-layout: auto;">
						<thead>
							<tr>
								<th align="center" style="text-align: center;font-size: 13px;"><strong>Tanggal Reservasi</strong></th>
								<th align="center" style="text-align: center;font-size: 13px;"><strong>Nomor Booking</strong></th>
								<th align="center" style="text-align: center;font-size: 13px;"><strong>Tarif Transaksi</strong></th>
								<th align="center" style="text-align: center;font-size: 13px;"><strong>Detail</strong></th>
								<!-- <th align="center" style="text-align: center;font-size: 13px;"><strong>Konfirmasi Pembayaran</strong></th> -->
							</tr>
						</thead>
						<tbody>
							<?php
								$veri = "2";
								$query = "SELECT * FROM tbl_booking_lapangan WHERE id_user_member=? AND verification=?";
								$result_booking_info = $db->getAllValue($query,[$email,$veri]);

								$count = 0;
								foreach ($result_booking_info as $data)
								{
									$count++;
									$court_data = $data['court_reg'];

									$query = "SELECT * FROM tbl_field_information WHERE court_reg=?";
									$result_datas 	= $db->getValue($query,[$court_data]);
									$alamat 			= $result_datas['alamat'];
									$nama_lapangan	= $result_datas['nama_lapangan'];

									echo "<tr>";
									echo "<td align=\"right\" style=\"vertical-align: middle;\">".$util->changeFormatDateFromNumberToString($data['tanggal'])."</td>";

									echo "<td align=\"right\" style=\"vertical-align: middle;\">".$data['nomor_booking']."</br>";
									echo "<span style=\"font-size:10px;\">telah melakukan pembayaran</span>";
									echo "</td>";

									echo "<td align=\"right\" style=\"vertical-align: middle;\">"."Rp.".number_format($data['price'])."</td>";

									echo "<td align=\"right\" style=\"vertical-align: middle;\">";
									echo "<span>".$nama_lapangan."</span><br/>";
									echo "<span style=\"font-size:12px;\">".$alamat."</span><br/>";
									echo "<span style=\"font-size:12px;\">"."waktu pemakaian :  ".$data['jam_mulai']." - ".$data['jam_akhir']."</span>";
									echo "</td>";

									// echo "<td align=\"center\" style=\"vertical-align: middle;\">";
									// echo "<span>telah melakukan pembayaran</span>";
									// echo "</td>";

									echo "</tr>";
								}
							?>

						</tbody>
					</table>
				</div>
			</div>

			<div id="akom" class="tab-pane">
				<br>
				<h4>Ajang Tanding atau Kompetisi</h4>
				<br>
				<div class="panel-body">
					<table class="table table-bordered table-striped mb-none" id="datatable-editable2" style="font-size:14px;table-layout: auto;">
						<thead>
							<tr>
								<th align="center"><strong>Tanggal Reservasi</strong></th>
								<th align="center"><strong>Nomor Pendaftaran</strong></th>
								<th align="center"><strong>Tarif Transaksi</strong></th>
								<th align="center"><strong>Konfirmasi Pembayaran</strong></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$query = "SELECT * FROM tbl_user WHERE username=?";
								$result_user_info = $db->getValue($query,[$email]);

								$id_reg_member = $result_user_info['id_reg'];
								$verification = "2";

								$query = "SELECT * FROM tbl_member_kompetisi WHERE id_reg_member=? AND verification=?";
								$result_reg_competition_info = $db->getAllValue($query,[$id_reg_member,$verification]);

								$count = 0;
								foreach ($result_reg_competition_info as $data)
								{
									$count++;
									$id_competition = $data['id_kompetisi'];

									$query = "SELECT * FROM tbl_kompetisi WHERE id_kompetisi=?";
									$result_competition_info = $db->getValue($query,[$id_competition]);

									echo "<tr>";
									echo "<td align=\"right\">".$util->changeFormatDateFromNumberToString($data['tanggal'])."</td>";
									echo "<td align=\"right\">".$data['code_reg']."</td>";
									echo "<td align=\"right\">"."Rp.".number_format($result_competition_info['biaya'])."</td>";
									echo "<td align=\"center\">";
									echo "<span>telah melakukan pembayaran</span>";
									// echo "<button class=\"btn btn-default\" id=\"regconf$count\">Konfirmasi Sekarang</button>";
									// echo "&nbsp;&nbsp;";
									// echo "<button class=\"btn btn-default\" id=\"prereg$count\">Pratinjau</button>";
									echo "<input type=\"hidden\" value=\"".$data['id_member_kompetisi']."\" id=\"idreg$count\">";
									echo "</td>";
									echo "</tr>";
								}
							?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<br>

<script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
<script src="assets/javascripts/tables/examples.datatables.editable.js"></script>
<script src="assets/javascripts/tables/examples.datatables.editable2.js"></script>

<script type="text/javascript" src="js/maufutsal_script/script_payment_confirmation.js"></script>
