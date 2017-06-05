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
			<div class="col-md-3">
				&nbsp;
			</div>

			<div class="col-md-6">
				<h4>Ubah Kata Sandi</h4>
				<div class="form-group">
					<h6>Kata sandi lama</h6>
					<input type="password" class="form-control" required id="oldpass" autocomplete="off">
				</div>

				<div class="form-group">
					<h6>Kata sandi baru</h6>
					<input type="password" class="form-control" required id="newpass" autocomplete="off">
				</div>
			</div>

			<div class="col-md-3">
				&nbsp;
			</div>

		</div>

		<div class="row">
			<div class="col-md-3">
				&nbsp;
			</div>

			<div class="col-md-6">
				<button type="button" class="mb-xs mt-xs mr-xs btn btn-default" id="change_pass">
					Ubah Kata Sandi
				</button>
			</div>

			<div class="col-md-3">
				&nbsp;
			</div>

		</div>
	</div>
</div>