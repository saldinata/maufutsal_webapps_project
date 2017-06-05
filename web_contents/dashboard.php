<br>
<?php
	if(isset($_COOKIE['maufutsal_dat']))
	{
		$mail_login = $util->decode($_COOKIE['maufutsal_dat']);
		$query = "SELECT * FROM tbl_user WHERE username=?";

		$result_user_info = $db->getValue($query,[$mail_login]);
	}
	else
	{
?>
		<script type="text/javascript">document.location.href="./"</script>";
<?php
	}
?>
<div class="container">
	<h1>Maufutsal Dashboard</h1>
	<span> Hello, <?php echo $result_user_info['name'] ?>. Senang melihat Anda kembali</span><br>
	<span> <small>Terakhir login : 2016-09-27 09:30</small></span>

	<hr>

	<div class="featured-boxes featured-boxes-style-3 featured-boxes-flat">
		<div class="row">
			<div class="col-md-3 col-sm-6">
				<div class="featured-box featured-box-quaternary featured-box-effect-1">
					<div class="box-content">
						<a href="dashreservconfirm"><i class="icon-featured fa fa-group"></i></a>
						<h1><strong>1</strong></h1>
						<h4> Konfirmasi Pembayaran</h4>
						<p>
							<a href="dashreservconfirm" class="lnk-quaternary learn-more">
							<i class="fa fa-angle-left"></i> Selengkapnya <i class="fa fa-angle-right"></i>
							</a>
						</p>
					</div>
				</div>
			</div>

			<div class="col-md-3 col-sm-6">
				<div class="featured-box featured-box-quaternary featured-box-effect-1">
					<div class="box-content">
						<a href="dashslamevent"><i class="icon-featured fa fa-group"></i></a>
						<h1><strong>3</strong></h1>
						<h4>Informasi Ajang tanding</h4>
						<p>
							<a href="dashslamevent" class="lnk-quaternary learn-more">
								<i class="fa fa-angle-left"></i> Selengkapnya <i class="fa fa-angle-right"></i>
							</a>
						</p>
					</div>
				</div>
			</div>

			<div class="col-md-3 col-sm-6">
				<div class="featured-box featured-box-quaternary featured-box-effect-1">
					<div class="box-content">
						<a href="dashcompinfo"><i class="icon-featured fa fa-trophy"></i></a>
						<h1><strong>2</strong></h1>
						<h4>Informasi Kompetisi</h4>
						<p>
							<a href="dashcompinfo" class="lnk-quaternary learn-more">
								<i class="fa fa-angle-left"></i> Selengkapnya <i class="fa fa-angle-right"></i>
							</a>
						</p>
					</div>
				</div>
			</div>

			<div class="col-md-3 col-sm-6">
				<div class="featured-box featured-box-quaternary featured-box-effect-1">
					<div class="box-content">
						<a href="dashhistory"><i class="icon-featured fa fa-info"></i></a>
						<h1><strong>12</strong></h1>
						<h4>History Transaksi</h4>
						<p>
							<a href="dashhistory" class="lnk-quaternary learn-more">
								<i class="fa fa-angle-left"></i> Selengkapnya <i class="fa fa-angle-right"></i>
							</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
