<?php

//anti spammer
session_start();
error_reporting(0);

//A group of database connection
include ("../components/connection.php");

//Adding library :
require_once("../library/utility.php");

//jika session belum dibuat, maka inisialisasi awal diberi nilai TRUE
if (!isset($_SESSION['submit']))$_SESSION['submit'] = true;

date_default_timezone_set('Asia/Jakarta');

//make object :
$util = new Utility();

//console system
#split the path by '/'
$params = explode("/", $_SERVER['REQUEST_URI']);
// echo $params[1]."-".$params[2]; 

?>

<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title>Daftar - Maufutsal</title>	

		<meta name="keywords" content="HTML5 Template" />
		<meta name="description" content="Porto - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Favicon -->
		<link rel="shortcut icon" href="../maufutsal_ico.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="../maufutsal_ico.ico">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="../vendor/simple-line-icons/css/simple-line-icons.css">
		<link rel="stylesheet" href="../vendor/owl.carousel/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="../vendor/owl.carousel/assets/owl.theme.default.min.css">
		<link rel="stylesheet" href="../vendor/magnific-popup/magnific-popup.css">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="../css/theme.css">
		<link rel="stylesheet" href="../css/theme-elements.css">
		<link rel="stylesheet" href="../css/theme-blog.css">
		<link rel="stylesheet" href="../css/theme-shop.css">
		<link rel="stylesheet" href="../css/theme-animate.css">

		<!-- Current Page CSS -->
		<link rel="stylesheet" href="../vendor/rs-plugin/css/settings.css" media="screen">
		<link rel="stylesheet" href="../vendor/rs-plugin/css/layers.css" media="screen">
		<link rel="stylesheet" href="../vendor/rs-plugin/css/navigation.css" media="screen">
		<link rel="stylesheet" href="../vendor/circle-flip-slideshow/css/component.css" media="screen">

		<!-- Skin CSS -->
		<link rel="stylesheet" href="../css/skins/default.css">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="../css/custom.css">

		<!--Sweet Alert-->
  		<link rel="stylesheet" type="text/css" href="../sweetalert/dist/sweetalert.css">
  		<!-- Sweet Alert -->
		<script src="../sweetalert/dist/sweetalert.min.js"></script>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

		<!-- Head Libs -->
		<script src="../vendor/modernizr/modernizr.js"></script>

	</head>
	<body>

		<div class="body">

			<div role="main" class="main">

				<style type="text/css">
					#content_register h3
					{
						color: #51b451;
						font-weight: 800;
						margin-bottom: 20px;
					}
					#content_register h5
					{
						text-transform: capitalize;
					}
					#top-regis
					{
						/*margin:30px 0;*/
					}
					#side-img
					{
						margin-bottom: 30px;
					}
					#alert_register
					{
						margin-top: 80px;
					}
					.empty-nama, .empty-email, .empty-password, .empty-retypepassword, .empty-role, .empty-role,
					.empty-genre, .email-not-valid, .not-same-pass, .length-password
					{
						color: red;
						font-size: 12px;
						margin-bottom: 0px;
					}
					#control-label
					{
						text-align: left;
					}
					.controls
					{
						padding-left: 10px;
					}
					.control-item
					{
						margin-left: 15px;
						margin-bottom: 0px;
					}
					.featured-boxes h4
					{
						text-transform: uppercase;
						text-align: center;
						font-weight: 600;
						color: #54B46F;
					}
					#btnRegister
					{
						text-transform: uppercase;
						border-radius: 0px;
						transition: .2s ease-in-out;
					}
					#featured-box
					{
						border-radius: 0px;
						border-width: 0px;
						background-color: #FFF;
						box-shadow: 0 0 0 0;
						border-bottom: 0px;
						border-left: 0px;
					}
					#featured-box .box-content
					{
						border-radius: 0px;
						border-width: 0px;
						background-color: #FFF;
					}
					#footer
					{
						background-color: #FFF;
						border-top: 0px;
						margin-top: 0px;
					}
					#footer a
					{
						color: #51b451;
						font-weight: 600;
					}
					#footer.short .footer-copyright
					{
						background-color: #FFF;
					}
					#footer .footer-copyright p
					{
						color: #51b451;
					}
					#empty-form
					{
						margin-bottom: 0px;
					}
				</style>


				<div class="container" id="content_register">
					<div class="row">
						<div class="col-md-12">
							<div id="top-regis">
								<div class="row">
									<div class="col-md-3"></div>
									<div class="col-md-6" style="text-align:center;margin-top:30px;">
										<a href="http://www.maufutsal.com"><img src="../img/logo/logo.png" width=250></a>
										<br><br>
										<h3>Daftar Akun Maufutsal</h3>
										<h5>Sudah punya akun Maufutsal ? <span><a href="http://kitaaja.maufutsal.com">Masuk</a></span></h5>
									</div>
									<div class="col-md-3"></div>
								</div>
							</div>

							<div class="featured-boxes">
								<div class="row">
									<div class="col-sm-7" id="side-img">
										<img src="http://kitaaja.maufutsal.com/img/support/sketch.jpg" width="100%" height="auto">
									</div>
									<div class="col-sm-5">
										<!-- <div class="featured-box featured-box-primary align-left mt-xlg" id="featured-box"> -->
											<div class="box-content">
												<!-- <h4 class="">Daftar Akun Maufutsal</h4>
												<hr> -->

												<form class="form-horizontal form-bordered" method="post">
													<div class="form-group" id="empty-form">
														<div class="col-md-12">
															<span>
																<div class="alert alert-danger">
																	<strong>Maaf, Harap isi semua inputan.</strong>
																</div>
															</span>
														</div>
													</div>
													
													<div class="form-group">
														<!-- <label class="col-md-3 control-label" id="control-label">Nama Anda</label> -->
														<div class="col-md-12">
															<div class="input-group input-group-icon">
																<span class="input-group-addon" style="background:#6ab76a;color:#FFF;border-color:#6ab76a;">
																	<span class="icon"><i class="fa fa-user"></i></span>
																</span>
																<input type="nama" id="nama" class="form-control" placeholder="Nama Anda" autocomplete="off" style="border-color:#6ab76a">
															</div>
															<!-- <span class="empty-nama">Nama wajib diisi.</span> -->
														</div>
													</div>

													<div class="form-group">
														<!-- <label class="col-md-3 control-label" id="control-label">Email Anda</label> -->
														<div class="col-md-12">
															<div class="input-group input-group-icon">
																<span class="input-group-addon" style="padding:6px 11px;background:#6ab76a;color:#FFF;border-color:#6ab76a;">
																	<span class="icon"><i class="fa fa-envelope"></i></span>
																</span>
																<input type="email" id="email" class="form-control" placeholder="Email Anda" autocomplete="off" style="border-color:#6ab76a">
															</div>
															<!-- <span class="empty-email">Email wajib diisi.</span> -->
															<span class="email-not-valid">Email yang anda masukkan tidak valid.</span>
														</div>
													</div>

													<div class="form-group">
														<!-- <label class="col-md-3 control-label" id="control-label">Kata sandi baru</label> -->
														<div class="col-md-12">
															<div class="input-group input-group-icon">
																<span class="input-group-addon" style="padding:6px 14px;background:#6ab76a;color:#FFF;border-color:#6ab76a;">
																	<span class="icon"><i class="fa fa-lock"></i></span>
																</span>
																<input type="password" id="pass1" class="form-control" placeholder="Kata sandi baru" autocomplete="off" style="border-color:#6ab76a">
															</div>
															<!-- <span class="empty-password">Kata sandi wajib diisi.</span> -->
															<span class="length-password">Kata sandi minimal 6 karakter.</span>
															<span class="not-same-pass">Kata sandi tidak cocok.</span>
														</div>
													</div>

													<div class="form-group">
														<!-- <label class="col-md-3 control-label" id="control-label">Ulangi kata sandi</label> -->
														<div class="col-md-12">
															<div class="input-group input-group-icon">
																<span class="input-group-addon" style="padding:6px 14px;background:#6ab76a;color:#FFF;border-color:#6ab76a;">
																	<span class="icon"><i class="fa fa-lock"></i></span>
																</span>
																<input type="password" id="pass2" class="form-control" placeholder="Ulangi Kata Sandi" autocomplete="off" style="border-color:#6ab76a">
															</div>
															<!-- <span class="empty-retypepassword">Ulangi kata sandi wajib diisi.</span> -->
															<span class="not-same-pass">Kata sandi tidak cocok.</span>
														</div>
													</div>
													
													<div class="form-group">
														<div class="col-md-12">
															<div class="controls">
																<input type="radio" value="ownerfield" name="level" id="role1" required autocomplete="off">
																<label>Pemilik Lapangan</label>
															</div>
															<!--<div class="controls">-->
															<!--	<input type="radio" value="member" name="level" id="role2" required autocomplete="off">-->
															<!--	<label>Member</label>-->
															<!--</div>-->
															<div class="controls">
																<input type="radio" value="eo" name="level" id="role3" required autocomplete="off">
																<label>Event Organizer</label>
															</div>
															<span class="empty-role">Role wajib dipilih.</span>
														</div>
													</div>

													<div class="form-group">
														<div class="col-md-12">
															<div class="controls">
																<select name="genre" id="genre" required autocomplete="off">
																	<option value="">Pilih Genre</option>
																	<option value="SD">SD</option>
																	<option value="SMP">SMP</option>
																	<option value="SMA/SMK">SMA/SMK</option>
																	<option value="Mahasiswa">Mahasiswa</option>
																	<option value="Pekerja">Pekerja</option>
																</select>
											                </div>
											                <span class="empty-genre">Genre wajib dipilih.</span>
														</div>
										            </div>

										            <div class="form-group">
														<p class="control-item" style="font-family:cursive;">Dengan mengklik Daftar, berarti saya telah menyetujui Syarat & Ketentuan, serta Kebijakan Privasi Maufutsal.</p>
													</div>

													<div class="form-group">
														<div class="col-md-6">
															<input type="submit" class="btn btn-success col-md-12" 
														id="btnRegister" value="Daftar">
														</div>
													</div>

													<div class="form-group">
														<p class="control-item">Informasi web klik <a href="http://www.maufutsal.com"><strong>disini</strong></a></p>
													</div>
													
												</form>
											</div>
										</div>
									</div> <!-- End col-sm -->
								</div>
							<!-- </div> End featured-boxes -->

						</div>
					</div>
				</div>

			</div>

				
			<footer class="short" id="footer">

				<div class="footer-copyright" id="footer-copyright">
					<div class="container">
						<div class="row">
							<div class="col-md-1">
								<a href="http://www.maufutsal.com" class="logo">
									<!-- <img alt="Porto Website Template" class="img-responsive" src="img/logo-footer.png"> -->
									Maufutsal
								</a>
							</div>
							<div class="col-md-8">
								<p>© Copyright 2016. All Rights Reserved.</p>
							</div>
							<div class="col-md-3">
								<ul class="social-icons">
								<!-- <ul class="social-icons pull-right"> -->
									<li class="social-icons-facebook"><a href="https://www.facebook.com/maufutsal" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
									<li class="social-icons-twitter"><a href="https://www.twitter.com/maufutsalku" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
									<li class="social-icons-instagram"><a href="https://www.instagram.com/maufutsal" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>

			</footer>



		</div>

		<!-- Vendor -->
		
		<script src="../vendor/jquery/jquery.js"></script>
		<script src="../vendor/jquery.appear/jquery.appear.js"></script>
		<script src="../vendor/jquery.easing/jquery.easing.js"></script>
		<script src="../vendor/jquery-cookie/jquery-cookie.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.js"></script>
		<script src="../vendor/common/common.js"></script>
		<script src="../vendor/jquery.validation/jquery.validation.js"></script>
		<script src="../vendor/jquery.stellar/jquery.stellar.js"></script>
		<script src="../vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js"></script>
		<script src="../vendor/jquery.gmap/jquery.gmap.js"></script>
		<script src="../vendor/jquery.lazyload/jquery.lazyload.js"></script>
		<script src="../vendor/isotope/jquery.isotope.js"></script>
		<script src="../vendor/owl.carousel/owl.carousel.js"></script>
		<script src="../vendor/magnific-popup/jquery.magnific-popup.js"></script>
		<script src="../vendor/vide/vide.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="../js/theme.js"></script>
		
		<!-- Current Page Vendor and Views -->
		<script src="../vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
		<script src="../vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
		<script src="../vendor/circle-flip-slideshow/js/jquery.flipshow.js"></script>
		<script src="../js/views/view.home.js"></script>
		
		<!-- Theme Custom -->
		<script src="../js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="../js/theme.init.js"></script>

		<?php include '../web_library/system_function.js'; ?>

		<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
			ga('create', 'UA-12345678-1', 'auto');
			ga('send', 'pageview');
		</script>
		 -->

	</body>
</html>
