<?php
	$data = "";

	if(!isset($_COOKIE["maufutsal_dat"]) AND !isset($_COOKIE['maufutsal_cat_dat']))
	{
?>
		<script type="text/javascript">
			document.location="./";
		</script>
<?php
	}

	if(isset($_COOKIE["maufutsal_dat"]))
	{
		if(isset($_COOKIE['maufutsal_cat_dat']))
		{
			$data = $util->decode($_COOKIE['maufutsal_cat_dat']);
			//setcookie("maufutsal_cat_dat", $data, time()-3600, "/");
		}

	}

	if(isset($_COOKIE['maufutsal_cat_dat']))
	{
		if(!isset($_COOKIE["maufutsal_dat"]))
		{
			$data = $util->decode($_COOKIE['maufutsal_cat_dat']);
			//setcookie("maufutsal_cat_dat", $data, time()-3600, "/");
		}
	}
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2 class="mb-none">Prosess Reservasi Lapangan Futsal</h2>
			<input type="hidden" value="<?php echo $_SESSION['court_reg'] ?>" autocomplete="off" readonly id="court_reg">
			<input type="hidden" value="<?php echo $data ?>" autocomplete="off" readonly id="cat_data">
		</div>
	</div>
	<br>

	<div class="panel-body">
			<div class="panel-body panel-body-nopadding">
				<form class="form-horizontal" novalidate="novalidate">
					<div class="tab-content">
						<div id="w3-account" class="tab-pane active">
							<div class="col-md-5">
								<div class="form-group">
									<label>Tanggal Pemakaian</label>
									<input type="text" class="form-control" id="reserv_date">
								</div>

								<div class="form-group">
									<label>Nama Arena</label>
									<select class="form-control" required id="arena_name">
									</select>
								</div>

								<div class="form-group">
									<label>Jam Mulai</label>
									<select class="form-control" required id="reserv_time">
									</select>
								</div>

								<div class="form-group">
									<label>Lama Pemakaian</label>
									<select class="form-control" required id="timeusage">
									</select>
								</div>

								<div class="form-group">
									<label>Kategori Pengguna</label>
									<select class="form-control" required id="category">
									</select>
								</div>
							</div>

							<div class="col-md-1"></div>

							<div class="col-md-6 ">

								<h6>Lapangan futsal yang akan direservasi</h6>
								<h4 id="court_name"></h4>
								<a id="see_cost">Lihat info tarif</a>
								<span><hr></span>

								<h6>Ringkasan Transaksi</h6>
								<div class="col-md-6 ">
									<h6>Tarif</h6>
									<h4 id="cost">Rp. 0,-</h4>
								</div>

								<div class="col-md-6 ">
									<h6>Status Pemakaian</h6>
									<h4 id="state">-</h4>
								</div>

								<small>Untuk menghindari kegagalan reservasi, harap melakukan pembayaran paling lama dalam waktu 1 (satu) jam setelah reservasi</small>
								<span><hr></span>

								<small>Pelajari syarat dan ketentuan dalam bertransaksi melalui Maufutsal di sini</small>
							</div>
						</div>
					</div>
				</form>
			</div>
			<br>

			<div class="panel-footer">
				<!-- <ul class="pager">
					<li class="next"> -->
						<button type="button" class="mb-xs mt-xs mr-xs btn btn-warning" id="continue_payment" >
							Lanjutkan pembayaran
						</button>
				<!-- 	</li>
				</ul> -->
			</div>
	</div>
</div>


<!-- <script src="assets/javascripts/ui-elements/examples.modals.js"></script> -->
<script type="text/javascript" src="js/maufutsal_script/script_reservation_process.js"></script>
