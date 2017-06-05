<?php
	ob_start();
	session_start();
?>

<?php
	require_once('library/database.php');
	require_once('library/utility.php');
	require_once('library/maufutsal.php');

	$db 		= new Database();
	$util 	= new Utility();
	$mfsal 	= new Maufutsal();
?>


<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title>Maufutsal</title>

		<!-- Page Description and Author -->
		<meta name="description" content="MauFutsal.com Start Up Booking Lapangan Termurah">
		<meta name="copyright" content="PT.Jadi Mandiri Lamtama" />
		<meta name="keywords" content="maufutsal, futsalku, futsal, diskon, lapangan, jersey futsal, maufutsal indonesia, lapangan futsal murah, maufutsal website, mau futsal, futsalan yuk, futsal ku, mau  futsal, mau_futsal, start up, Start Up, Medan, Jakarta, Bandung, Bekasi" />
		<meta name="robot" content="index,follow" />
		<meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
		<meta HTTP-EQUIV="Expires" CONTENT="-1">

		<!-- Favicon -->
		<link rel="shortcut icon" href="maufutsal_ico.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="maufutsal_ico.ico">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Theme CSS -->
		<!-- <link rel="stylesheet" href="assets/stylesheets/theme.css" /> -->

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">


		<!-- Vendor CSS -->
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="vendor/simple-line-icons/css/simple-line-icons.css">
		<link rel="stylesheet" href="vendor/owl.carousel/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="vendor/owl.carousel/assets/owl.theme.default.min.css">
		<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.css">
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="css/theme.css">
		<link rel="stylesheet" href="css/theme-elements.css">
		<link rel="stylesheet" href="css/theme-blog.css">
		<link rel="stylesheet" href="css/theme-shop.css">
		<link rel="stylesheet" href="css/theme-animate.css">

		<!-- Current Page CSS -->
		<link rel="stylesheet" href="vendor/rs-plugin/css/settings.css" media="screen">
		<link rel="stylesheet" href="vendor/rs-plugin/css/layers.css" media="screen">
		<link rel="stylesheet" href="vendor/rs-plugin/css/navigation.css" media="screen">
		<link rel="stylesheet" href="vendor/circle-flip-slideshow/css/component.css" media="screen">

		<!-- Skin CSS -->
		<link rel="stylesheet" href="css/skins/default.css">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="css/custom.css">

		<!--Sweet Alert-->
			<link rel="stylesheet" type="text/css" href="sweetalert/dist/sweetalert.css">

			<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />

			<!-- Sweet Alert -->
		<script src="sweetalert/dist/sweetalert.min.js"></script>

		<script src="js/jquery.js"></script>

		<!-- Head Libs -->
		<script src="vendor/modernizr/modernizr.js"></script>

		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Accounting format -->
		<script src="js/maufutsal_plugin/accounting.min.js"></script>

	</head>

	<body>
		<?php include ('web_components/header.php'); ?>

		<div role="main" class="main">
			<?php
				if(isset($_GET['mov']))
				{
					$page = $_GET['mov'];
					if($page=="reservprocesspayment" || $page=="reservconfirm")
					{

					}
					else
					{
						setcookie("maufutsal_page", $util->encode($page), time() + (3600), "/");
					}

					include('web_contents/'.$_GET['mov'].'.php');
				}

				else
				{
					include ('web_components/slider.php');
					include('home.php');
				}
			?>


							<footer class="short" id="footer">
					<div class="container">
						<div class="row">
							<!-- <div class="col-md-6"> -->
								<div class="row">
									<div class="col-md-3">
										<ul class="list list-icons list-icons-sm">
											<li><i class="fa fa-caret-right"></i>
												<a href="userguide">
													Panduan Penggunaan
												</a>
											</li>
											<li><i class="fa fa-caret-right"></i>
												<a href="faq">
													Frequently Ask Question
												</a>
											</li>
											<li><i class="fa fa-caret-right"></i>
												<a href="#">
													Reedeem Point Reward
												</a>
											</li>
											<li><i class="fa fa-caret-right"></i>
												<a href="partnership">
													Kemitraan
												</a>
											</li>
											<li><i class="fa fa-caret-right"></i>
												<a href="career">
													Karir
												</a>
											</li>
											<li><i class="fa fa-caret-right"></i>
												<a href="#">
													Maufutsal Developer
												</a>
											</li>

										</ul>
									</div>

									<div class="col-md-3">
										<h1 class="mb-sm">Hubungi Kami</h1>
										<ul class="list list-icons mt-xl">
											<li><i class="fa fa-phone"></i>
												<span style="color:#fff;">
													<strong>Telepon :</strong>
													<br>&nbsp; 0898-8000-700
													<br>&nbsp; 0853-598-9999-8
												</span>
											</li>
										</ul>
									</div>

									<div class="col-md-3">
										<h1 class="mb-sm">&nbsp;</h1>
										<ul class="list list-icons mt-xl">
											<li><i class="fa fa-map-marker"></i>
												<span style="color:#fff;">
													<strong>Alamat :</strong>
													<br>&nbsp; PT. Global Makmur Mas</a>
													<br>&nbsp; Jalan T. Amir Hamzah No.46A Medan</a>
												</span>
											</li>
										</ul>
									</div>

									<div class="col-md-3">
										<h1 class="mb-sm">&nbsp;</h1>
										<ul class="list list-icons mt-xl">
											<li><i class="fa fa-envelope"></i>
												<span style="color:#fff;">
													<strong>Email :</strong>
												</a>
												<span style="color:#fff;">
													<br>&nbsp;info@maufutsal.com
												</span>
											</li>
										</ul>
									</div>

								</div>
							<!-- </div> -->

							<!-- <div class="col-md-3">
								<h1 class="mb-sm">Hubungi Kami</h1>
								<ul class="list list-icons mt-xl">
									<li><i class="fa fa-phone"></i>
										<a href="#"><strong>Telepon :</strong>
											<br>&nbsp; 0898-8000-700
											<br>&nbsp; 0853-598-9999-8
										</a>
									</li>
								</ul>

								<ul class="list list-icons mt-xl">
									<li><i class="fa fa-map-marker"></i>
										<a href="#"><strong>Alamat :</strong>
										<br>&nbsp; Jalan Danau Singkarak No.2 Medan</a>
									</li>
									<li><i class="fa fa-envelope"></i>
										<a href="#"><strong>Email :</strong></a><a href="info@maufutsal.com">
										<br>&nbsp;info@maufutsal.com</a>
									</li>
								</ul>
							</div> -->
						</div>
					</div>
					<div class="footer-copyright">
						<div class="container">
							<div class="row">
								<div class="col-md-1">
									<a href="index.html" class="logo">
										<img alt="Porto Website Template" class="img-responsive" src="img/logo/logo_maufutsal.png">
									</a>
								</div>
								<div class="col-md-11">
									<p>© Copyright 2016. All Rights Reserved | Maufutsal Developer Team (MDT)</p>
								</div>
							</div>
						</div>
					</div>
				</footer>




			</div>
		</div>
	</body>
</html>


<div class="modal fade" id="modalReg" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="defaultModalLabel">Pendaftaran Akun</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<h6>Nama Anda</h6>
							<input type="username" class="form-control" required id="username" autocomplete="off">
						</div>

						<div class="form-group">
							<h6>Alamat Email</h6>
							<input type="mail" class="form-control" required id="mail" autocomplete="off">
						</div>

						<div class="form-group">
							<h6>Kata Sandi</h6>
							<input type="password" class="form-control" required id="pass" autocomplete="off">
						</div>

						<div class="form-group">
							<h6>Kategori Pengguna</h6>
							<input type="radio" name="genre" value="1">
							<span>Pelajar</span>&nbsp;&nbsp;&nbsp;&nbsp;

							<input type="radio" name="genre" value="2">
							<span>Mahasiswa</span>&nbsp;&nbsp;&nbsp;&nbsp;

							<input type="radio" name="genre" value="3">
							<span>Pekerja/Umum</span>&nbsp;&nbsp;&nbsp;&nbsp;
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="mb-xs mt-xs mr-xs btn btn-default" id="registration">Daftar Sekarang</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modalRegPayment" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="defaultModalLabel">Pendaftaran Akun</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<h6>Nama Anda</h6>
							<input type="username" class="form-control" required id="username_payment" autocomplete="off">
						</div>

						<div class="form-group">
							<h6>Alamat Email</h6>
							<input type="mail" class="form-control" required id="mail_payment" autocomplete="off">
						</div>

						<div class="form-group">
							<h6>Kata Sandi</h6>
							<input type="password" class="form-control" required id="pass_payment" autocomplete="off">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="mb-xs mt-xs mr-xs btn btn-default" id="registration_payment">Daftar Sekarang</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="defaultModalLabel">Login Akun</h4>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<h6 class="mb-none"><strong>Login Melalui Akun Maufutsal</strong></h6>
						<br>
					</div>
				</div>

				<div class="row">
					<div class="form-group">
						<div class="col-md-6">
							<span>Alamat email *</span>
							<input type="text" maxlength="100" class="form-control" required id="mail_home" autocomplete="off">
						</div>
						<div class="col-md-6">
							<span>Kata sandi *</span>
							<input type="password" maxlength="100" class="form-control"  id="pass_home" required autocomplete="off">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<button type="button" class="mb-xs mt-xs mr-xs btn btn-default" id="login_home">Masuk</button>
						&nbsp; atau &nbsp;
						<button type="button" class="mb-xs mt-xs mr-xs btn btn-default" id="facebook" ><i class="fa fa-facebook"></i> | Login dari Facebook</button>
					</div>
				</div>

					<br>
					<p> Lupa kata sandi Anda ?
						<strong> <a href="#" id="forgot_pass">Klik di sini</a></strong>
					</p>

<!--
				<div class="row">
					<div class="col-md-6">
						<h6><strong>Login Melalui Akun Maufutsal</strong></h6>

						<div class="form-group">
							<h6>Alamat Email</h6>
							<input type="mail" class="form-control" required id="mail_login" autocomplete="off">
						</div>

						<div class="form-group">
							<h6>Kata Sandi</h6>
							<input type="password" class="form-control" required id="pass_login" autocomplete="off">
						</div>

						<button type="button" class="mb-xs mt-xs mr-xs btn btn-default" id="login_home">Masuk</button> &nbsp; atau &nbsp;

						<button type="button" class="mb-xs mt-xs mr-xs btn btn-default" id="facebook"><i class="fa fa-facebook"></i> | Login dari Facebook</button>

						<button type="button" class="mb-xs mt-xs mr-xs btn btn-default" id="forgot_pass">Lupa kata sandi</button>
					</div>

					<div class="col-md-6">
						<h6><strong>Login Akun Sosial Media</strong></h6>
						<button type="button" class="mb-xs mt-xs mr-xs btn btn-default" id="facebook" ><i class="fa fa-facebook"></i> | Facebook</button>
						<br><br>
						<span>Tiap transaksi akan mendapatkan Point Reward yang dapat ditukarkan. Semakin sering bertransaksi, semakin besar peluang mendapatkan Point Reward. </span>
						<br><br>
						<p><strong>Belum jadi Member ? <a href="#" id="registration_now">Daftar Sekarang</a></strong></p>
					</div>
				</div> -->
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="modalLoginPayment" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="defaultModalLabel">Login Akun</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<h6><strong>Login Akun Maufutsal</strong></h6>

						<div class="form-group">
							<h6>Alamat Email</h6>
							<input type="mail" class="form-control" required id="mail_login_payment" autocomplete="off">
						</div>

						<div class="form-group">
							<h6>Kata Sandi</h6>
							<input type="password" class="form-control" required id="pass_login_payment" autocomplete="off">
						</div>

						<button type="button" class="mb-xs mt-xs mr-xs btn btn-default" id="login_payment">
							Masuk
						</button>

						<button type="button" class="mb-xs mt-xs mr-xs btn btn-default" id="forgot">
							Lupa kata sandi
						</button>

						<br><br>
						<small>
							<strong>Belum jadi Member ? <a href="#" id="registration_now_payment">Daftar Sekarang</a></strong>
						</small>
					</div>

					<div class="col-md-6">
						<h6><strong>Login Akun Sosial Media</strong></h6>
						<button type="button" class="btn btn-default" id="facebook_intern" >
							<i class="fa fa-facebook"></i> | Facebook
						</button>

						<div class="divider divider-solid">
							<i class="fa"> atau </i>
						</div>

						<h6><strong>Lanjutkan Pembayaran Tanpa Akun</strong></h6>
						<div class="form-group">
							<h6>Nomor Telepon</h6>
							<input type="text" class="form-control" required id="phnumber_login_payment" autocomplete="off">
						</div>

						<button type="button" class="mb-xs mt-xs mr-xs btn btn-default" id="go_to_phnumber_payment">
							Lanjutkan
						</button>

					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="modalForgot" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="defaultModalLabel">Reset Kata Sandi</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<h6>Alamat Email</h6>
							<input type="mail" class="form-control" required id="mail_forgot" autocomplete="off">
						</div>

						<br>
						<small>
							System akan mereset kata sandi anda berdasarkan email yang terdaftar.
						</small>
					</div>

				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="mb-xs mt-xs mr-xs btn btn-default" id="reset_pass">Reset</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modalTeam" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="defaultModalLabel">Nama Team</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<h6>Nama Team</h6>
							<input type="text" class="form-control" required id="team_name" autocomplete="off">
						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="mb-xs mt-xs mr-xs btn btn-default" id="go_to_payment_comp">Lanjut</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modalCost" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="defaultModalLabel">Tarif Harga Lapangan</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class='col-md-12'>
						<table border=1 width=100% style="border-color: #e0dada;border: #e0dada;">
							<thead>
								<tr>
									<td style="text-align:center;height: 50px;background: rgba(203, 206, 202, 0.21);color: #565454;">Nama Arena</td>
									<td style="text-align:center;height: 50px;background: rgba(203, 206, 202, 0.21);color: #565454;">Tarif (per jam)</td>
									<td style="text-align:center;height: 50px;background: rgba(203, 206, 202, 0.21);color: #565454;">Waktu Berlaku Tarif</td>
								</tr>
							</thead>
							<tbody id="data">

							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modalReservConf" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="defaultModalLabel">Konfirmasi Reservation</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<h6>Tanggal Transfer</h6>
							<input type="text" data-plugin-datepicker class="form-control" id="date_transfer_reserv">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<h6>Jam Transfer</h6>
							<input type="text" class="form-control" required id="time_transfer_reserv" autocomplete="off">
						</div>
					</div>

					<div class="col-md-12">
						<div class="form-group">
							<h6>Bank Asal</h6>
							<select class="form-control" required id="bank_name_reserv">
								<option value="">Pilihan</option>
								<?php
									$query = "SELECT * FROM tbl_bank ORDER BY nama_bank";
									$result_bank_info = $db->getAllValue($query);

									foreach($result_bank_info as $data)
									{
										echo "<option value=\"".$data['id_bank']."\">".$data['nama_bank']."</option>";
									}
								?>
							</select>
						</div>

						<div class="form-group">
							<h6>Nama Pemilik Rekening</h6>
							<input type="text" class="form-control" required id="account_name_reserv" autocomplete="off">
						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="mb-xs mt-xs mr-xs btn btn-default" id="save_resconfirm">
					Simpan
				</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="modalRegistrationConf" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="defaultModalLabel">Konfirmasi Pendaftaran</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<h6>Tanggal Transfer</h6>
							<input type="text" data-plugin-datepicker class="form-control" id="date_transfer_comp">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<h6>Jam Transfer</h6>
							<input type="text" class="form-control" required id="time_transfer_comp" autocomplete="off">
						</div>
					</div>

					<div class="col-md-12">
						<div class="form-group">
							<h6>Bank Asal</h6>
							<select class="form-control" required id="bank_name_comp">
								<option value="">Pilihan</option>
								<?php
									$query = "SELECT * FROM tbl_bank ORDER BY nama_bank";
									$result_bank_info = $db->getAllValue($query);

									foreach($result_bank_info as $data)
									{
										echo "<option value=\"".$data['id_bank']."\">".$data['nama_bank']."</option>";
									}
								?>
							</select>
						</div>

						<div class="form-group">
							<h6>Nama Pemilik Rekening</h6>
							<input type="text" class="form-control" required id="account_name_comp" autocomplete="off">
						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="mb-xs mt-xs mr-xs btn btn-default" id="save_regconfirm">
					Simpan
				</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="modalGenre" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="defaultModalLabel">Pilihan Kategori Pengguna</h4>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<h4>Silahkan pilih kategori sesuai pilihan Anda</h4>
							<div class="form-group">
								<h6>Kategori Pengguna Lapangan Futsal</h6>
								<input type="radio" name="genre_first" value="1">
								<span>Pelajar</span>&nbsp;&nbsp;&nbsp;&nbsp;

								<input type="radio" name="genre_first" value="2">
								<span>Mahasiswa</span>&nbsp;&nbsp;&nbsp;&nbsp;

								<input type="radio" name="genre_first" value="3">
								<span>Pekerja/Umum</span>&nbsp;&nbsp;&nbsp;&nbsp;
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="mb-xs mt-xs mr-xs btn btn-default" id="save_cat_temp">
					Simpan
				</button>

				<button type="button" class="btn btn-default" data-dismiss="modal">
					Tutup
				</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modalGenreFacebook" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<!--
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				-->
				<h4 class="modal-title" id="defaultModalLabel">Pilihan Kategori Pengguna</h4>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<div class="form-group">
								<h6>Silahkan pilih kategori pengguna lapangan futsal sesuai kriteria Anda</h6>
								<input type="radio" name="genre_fb" value="1">
								<span>Pelajar</span>&nbsp;&nbsp;&nbsp;&nbsp;

								<input type="radio" name="genre_fb" value="2">
								<span>Mahasiswa</span>&nbsp;&nbsp;&nbsp;&nbsp;

								<input type="radio" name="genre_fb" value="3">
								<span>Pekerja/Umum</span>&nbsp;&nbsp;&nbsp;&nbsp;
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="mb-xs mt-xs mr-xs btn btn-default" id="save_cat_fb">
					Simpan
				</button>
				<!--
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Tutup
				</button>
				-->
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modalFieldMaps" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="defaultModalLabel">Peta Lokasi</h4>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div id="map" style="width:100%;height:400px;"></div>
						<!-- <div class="form-group">
							<div class="form-group">
								<h6>Silahkan pilih kategori pengguna lapangan futsal sesuai kriteria Anda</h6>
								<input type="radio" name="genre_fb" value="1">
								<span>Pelajar</span>&nbsp;&nbsp;&nbsp;&nbsp;

								<input type="radio" name="genre_fb" value="2">
								<span>Mahasiswa</span>&nbsp;&nbsp;&nbsp;&nbsp;

								<input type="radio" name="genre_fb" value="3">
								<span>Pekerja/Umum</span>&nbsp;&nbsp;&nbsp;&nbsp;
							</div>
						</div> -->
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Tutup
				</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalSlam" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" id="modalSlamContent">

		</div>
	</div>
</div>


<!-- Vendor -->
<script src="vendor/jquery/jquery.js"></script>
<script src="vendor/jquery.appear/jquery.appear.js"></script>
<script src="vendor/jquery.easing/jquery.easing.js"></script>
<script src="vendor/jquery-cookie/jquery-cookie.js"></script>
<script src="vendor/bootstrap/js/bootstrap.js"></script>
<script src="vendor/common/common.js"></script>
<script src="vendor/jquery.validation/jquery.validation.js"></script>
<script src="vendor/jquery.stellar/jquery.stellar.js"></script>
<script src="vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="vendor/jquery.gmap/jquery.gmap.js"></script>
<script src="vendor/jquery.lazyload/jquery.lazyload.js"></script>
<script src="vendor/isotope/jquery.isotope.js"></script>
<script src="vendor/owl.carousel/owl.carousel.js"></script>
<script src="vendor/magnific-popup/jquery.magnific-popup.js"></script>
<script src="vendor/vide/vide.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="js/theme.js"></script>

<!-- Current Page Vendor and Views -->
<script src="vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="vendor/circle-flip-slideshow/js/jquery.flipshow.js"></script>
<script src="js/views/view.home.js"></script>

<!-- Theme Custom -->
<script src="js/custom.js"></script>

<!-- Theme Initialization Files -->
<script src="js/theme.init.js"></script>

<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!-- Examples -->
<!-- <script src="assets/javascripts/forms/examples.advanced.form.js"></script> -->

<!-- Vendor -->
<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="assets/javascripts/theme.js"></script>

<!-- Theme Custom -->
<script src="assets/javascripts/theme.custom.js"></script>

<!-- Theme Initialization Files -->
<script src="assets/javascripts/theme.init.js"></script>
<script src="assets/vendor/pnotify/pnotify.custom.js"></script>
<script src="assets/javascripts/ui-elements/examples.lightbox.js"></script>


<!-- Examples -->
<!-- <script src="assets/javascripts/forms/examples.advanced.form.js"></script> -->

<script type="text/javascript" src="js/maufutsal_script/script_log_reg.js"></script>
<script type="text/javascript" src="js/maufutsal_script/script_log_payment.js"></script>
<script type="text/javascript" src="js/maufutsal_script/script_forgot_pass.js"></script>
<script type="text/javascript" src="js/maufutsal_script/script_comp_list.js"></script>
<script type="text/javascript" src="js/maufutsal_script/script_save_genre.js"></script>
<script type="text/javascript" src="js/maufutsal_script/script_save_genre_for_fb.js"></script>

<!-- TEMPORARY DISACTIVATED -->
<!-- <script type="text/javascript" src="js/maufutsal_script/script_google_analytics.js"></script>-->

<script type="text/javascript" src="js/maufutsal_script/script_facebook.js"></script> 
<script type="text/javascript" src="js/maufutsal_plugin/jquery.mfancytitle-0.4.1.min.js"></script>
<script type="text/javascript" src="js/maufutsal_script/script_fancy_title_favicon.js"></script>

<!-- <script type="text/javascript" src="js/maufutsal_script/script_zopim_live_chat.js"></script> -->
<!-- <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC0Bnj42K9FdpTtyL7bS3Naczvd_5MPgVE&sensor=FALSE"></script> -->

<!-- <script src="http://maps.googleapis.com/maps/api/js?callback=myMap&key=AIzaSyC0Bnj42K9FdpTtyL7bS3Naczvd_5MPgVE" async defer></script> -->

<!-- TEMPORARY DISACTIVATED -->

<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyC0Bnj42K9FdpTtyL7bS3Naczvd_5MPgVE&language=en"></script>
<script type="text/javascript" src="js/maufutsal_script/script_tawk.js"></script>
