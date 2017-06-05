<div class="slider-container rev_slider_wrapper" style="height: 380px;">
	<div id="revolutionSlider" class="slider rev_slider" data-plugin-revolution-slider data-plugin-options='{"gridwidth": 1170, "gridheight": 380}'>
		<ul>
			
            <?php
                $state = "A";
                $query = "SELECT * FROM tbl_slider WHERE state=?";
                $result_data = $db->getAllValue($query,[$state]);
                
                foreach($result_data as $data)
                {
                    $path = "admin_utama/image/slider/".$data['path'];
                    
                    echo "<li data-transition=\"fade\">";
        			echo "<img src=\"$path\"";  
        		    echo "alt=\"maufutsal advertising\"";
        		    echo "data-bgposition=\"center center\""; 
        			echo "data-bgfit=\"cover\""; 
        			echo "data-bgrepeat=\"no-repeat\""; 
        			echo "class=\"rev-slidebg img-responsive\">";
        			echo "</li>";
			
                }
            
            ?>
			
		</ul>
	</div>
</div>
		
<?php
	// if(isset($_COOKIE["maufutsal_dat"]))
	// {
?>
		<!-- <div class="slider-container rev_slider_wrapper" style="height: 380px;">
			<div id="revolutionSlider" class="slider rev_slider" data-plugin-revolution-slider data-plugin-options='{"gridwidth": 1170, "gridheight": 380}'>
				<ul>
					<li data-transition="fade">
						<img src="img/promotion/Sir Trafford Turnament 2016.jpg"  
							alt="maufutsal advertising"
							data-bgposition="center center" 
							data-bgfit="cover" 
							data-bgrepeat="no-repeat" 
							class="rev-slidebg">
					</li>

					<li data-transition="fade">
						<img src="img/promotion/Ajang Tanding.jpg"  
							alt="maufutsal advertising"
							data-bgposition="center center" 
							data-bgfit="cover" 
							data-bgrepeat="no-repeat" 
							class="rev-slidebg">
					</li>

					<li data-transition="fade">
						<img src="img/promotion/Turnamen Karyawan.jpg"  
							alt="maufutsal advertising"
							data-bgposition="center center" 
							data-bgfit="cover" 
							data-bgrepeat="no-repeat" 
							class="rev-slidebg">
					</li>
				</ul>
			</div>
		</div> -->
<?php
	// }
	// else
	// {
?>
		<!-- <div class="slider-with-overlay">
			<div class="slider-container rev_slider_wrapper" style="height: 380px;">
				<div id="revolutionSlider" class="slider rev_slider" data-plugin-revolution-slider data-plugin-options='{"gridwidth": 1170, "gridheight": 380}'>
					<ul>
						<li data-transition="fade">
							<img src="img/slider/bg_image.jpg"  
								alt=""
								data-bgposition="center center" 
								data-bgfit="cover" 
								data-bgrepeat="no-repeat" 
								class="rev-slidebg">

							<div class="tp-caption"
								data-x="100"
								data-y="100"
								data-start="500"
								data-transform_in="y:[-300%];opacity:0;s:500;"><img src="img/logo/logo_maufutsal.png" alt="">
							</div>

							<div class="tp-caption top-label"
								data-x="100"
								data-y="220"
								data-start="500"
								data-transform_in="y:[-300%];opacity:0;s:500;">Layanan Pemesanan
							</div>

							<div class="tp-caption main-label"
								data-x="100"
								data-y="240"
								data-start="500"
								data-transform_in="y:[50%];opacity:0;s:500;"
								style="font-weight: 600;font-size: 35px;">
								Lapangan Futsal Online
							</div>
								
							<div class="tp-caption  top-label"
								data-x="100"
								data-y="300"
								data-start="500"
								data-transform_in="y:[100%];opacity:0;s:500;">di Indonesia
							</div>
							
						</li>
					</ul>
				</div>
			</div>

			<div class="slider-contact-form" style="top: 0px;">
				<div class="container">
					<div class="row">
						<div class="col-md-5 col-md-offset-7">
							<div class="featured-boxes mt-none mb-none">
								<div class="featured-box mt-xl">
									<div class="box-content">
										<h6 class="mb-none"><strong>Login Melalui Akun Maufutsal</strong></h6>
											<br>
											<div class="row">
												<div class="form-group">
													<div class="col-md-6">
														<span>Alamat email *</span>
														<input type="text" maxlength="100" class="form-control" required id="mail_home_" autocomplete="off">
													</div>
													<div class="col-md-6">
														<span>Kata sandi *</span>
														<input type="password" maxlength="100" class="form-control"  id="pass_home_" required autocomplete="off">
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-12">
													<button type="button" class="mb-xs mt-xs mr-xs btn btn-default" id="login_home_">Masuk</button>
													&nbsp; atau &nbsp;
													<button type="button" class="mb-xs mt-xs mr-xs btn btn-default" id="facebook_" ><i class="fa fa-facebook"></i> | Login dari Facebook</button>
												</div>
											</div>

											<br>
											<small> Lupa kata sandi Anda ? 
												<strong> <a href="#" id="forgot_pass_">Klik disini</a></strong>
											</small>

											<br><br>
											<button type="button" class="mb-xs mt-xs mr-xs btn btn-default" id="reg_home_">
												Mulai Daftar Sekarang
											</button>

											<br>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->

<?php
	// }
?>




<script type="text/javascript" src="js/maufutsal_script/script_log_reg_home.js"></script>