<header id="header" class="header-narrow" data-plugin-options='{"stickyEnabled": true, "stickyEnableOnBoxed": true, "stickyEnableOnMobile": true, "stickyStartAt": 0, "stickySetTop": "0"}'>
	<div class="header-body">
		<div class="header-container container">
			<div class="header-row">
				<div class="header-column">
					<div class="header-logo">
						<a href="./">
							<img alt="Maufutsal" width="150" height="50" data-sticky-width="120" data-sticky-height="40" data-sticky-top="20" src="img/logo/logo.png">
						</a>
						<!-- <span class="hidden-xs">| <strong>Layanan Pemesanan Lapangan Futsal Online di Indonesia</strong></span> -->
					</div>
				</div>

				<div class="header-column">
					<div class="header-row">
						<div class="header-nav header-nav-stripe">
							<ul class="header-social-icons social-icons hidden-xs">
							    <?php
							        $query = "SELECT * FROM tbl_web_social";
							        $result_data = $db->getAllValue($query);
							        
							        foreach($result_data as $data)
							        {
							            $facebook = "http://".$data['facebook'];
							            $twitter  = "http://".$data['twitter'];
							            $instagram = "http://".$data['instagram'];
							        }
							    
							    ?>
								<li class="social-icons-facebook"><a href="<?php echo $facebook; ?>" target="_blank" title="Facebook"><i class="fa fa-facebook" style="padding-top:7px;"></i></a></li>
								<li class="social-icons-twitter"><a href="<?php echo $twitter ?>" target="_blank" title="Twitter"><i class="fa fa-twitter" style="padding-top:7px;"></i></a></li>
								<li class="social-icons-instagram"><a href="<?php echo $instagram ?>" target="_blank" title="Instagram"><i class="fa fa-instagram" style="padding-top:7px;"></i></a></li>
							</ul>

							<button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main">
								<i class="fa fa-bars"></i>
							</button>
							<div class="header-nav-main header-nav-main-square header-nav-main-effect-1 header-nav-main-sub-effect-1 collapse">
								<nav>
									<ul class="nav nav-pills" id="mainNav">
										<li class="">
											<a class="" href="./">Utama</a>
										</li>
										<li class="">
											<a class="" href="about">Tentang</a>
										</li>

										<li class="">
											<a class="" href="privacy">Kebijakan Privasi</a>
										</li>

										<?php

											if(!isset($_COOKIE["maufutsal_dat"]))
											{
												echo "<li class=''>";
												echo "<a class='' href='#'' data-toggle='modal' data-target='#modalLogin'> Masuk </a>";
												echo "</li>";

												echo "<li class=''>";
												echo "<a class='' href='#'' data-toggle='modal' data-target='#modalReg'> Daftar </a>";
												echo "</li>";
											}
										?>
										

										<?php
											if(isset($_COOKIE["maufutsal_dat"]))
											{
												$alias_id = $mfsal->getAlias($util->decode($_COOKIE["maufutsal_dat"]));
												echo "<input type=\"hidden\" value=".$_COOKIE["maufutsal_dat"]." id=\"email_data\">";

												echo "<li class=\"dropdown\">";
												echo "<a class=\"dropdown-toggle text-primary\" href=\"#\">";
												echo $alias_id;
												echo "</a>";

												echo "<ul class=\"dropdown-menu\">";

												echo "<li>";
												echo "<a href=\"dashboard\">Dashboard</a>";
												echo "</li>";

												echo "<li>";
												echo "<a href=\"changepass\">Ubah Kata Sandi</a>";
												echo "</li>";

												echo "<li>";
												echo "<a href=\"#\" id=\"logout\">Logout </a>";
												echo "</li>";


												echo "</ul>";
												echo "</li>";
											}

											else
											{
										
												// 	echo "<li class=\"\" id=\"menuLogin\">";
												// 	echo "<a class=\"\" href=\"#\" data-toggle=\"modal\" data-target=\"#modalLogin\"> Masuk </a>";
												// 	echo "</li>";


												// 	echo "<li class=\"\" id=\"menuRegistration\">";
												// 	echo "<a class=\"\" href=\"#\" data-toggle=\"modal\" data-target=\"#modalReg\"> Daftar </a>";
												// 	echo "</li>";
											}

										?>

									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

				