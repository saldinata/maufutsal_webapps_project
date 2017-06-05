				<div class="container">
					<div class="row center">
						<div class="col-md-12">
							<h2 class="mb-none word-rotator-title mt-lg" data-appear-animation="bounceIn" data-appear-animation-delay="0">							Statistik 
							</h2>
							<!-- <p class="lead">19,000+ customers in more than 100 countries use Porto Template.</p> -->
						</div>
					</div>
					<br><br>
					<div class="row">
						<div class="counters">
							<div class="col-md-3 col-sm-6">
								<div class="counter counter-dark" data-appear-animation="bounceIn" delay="200">
									<i class="fa fa-users"></i>
									<?php
										$calculateMember = mysqli_query($con,"SELECT * FROM tbl_user WHERE level='member'");
										$calMem = 0;
										while($getCalMember = mysqli_fetch_object($calculateMember))
										{
											if($getCalMember)
											{
												$calMem++;
											}
											else
											{
											}
										}
									?>
									<strong data-to="<?php echo $calMem ?>">0</strong>
									<label>Club</label>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="counter counter-dark" data-appear-animation="bounceIn" delay="400">
									<i class="fa fa-paper-plane-o"></i>
									<?php
										$totalField = 0;
										$calculateField = mysqli_query($con,"SELECT * FROM tbl_field_information");
										while($getCalField = mysqli_fetch_object($calculateField))
										{
											if($getCalField)
											{
											  $totalField++;
											}
											else
											{
											
											}
										}
									?>
									<strong data-to="<?php echo $totalField; ?>"></strong>
									<label>Lapangan Futsal</label>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="counter counter-dark" data-appear-animation="bounceIn" delay="600">
									<i class="fa fa-user-plus"></i>
									<?php
										$totalFriendlyMatch = 0;
										$calculateFM = mysqli_query($con,"SELECT * FROM tbl_friendly_match");
										while($getFM = mysqli_fetch_object($calculateFM))
										{
											if($getFM)
											{
											  $totalFriendlyMatch++;
											}
											else
											{
											
											}
										}
									?>
									<strong data-to="<?php echo $totalFriendlyMatch; ?>">0</strong>
									<label>Undangan Bertanding</label>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="counter counter-dark" data-appear-animation="bounceIn" delay="800">
									<i class="fa fa-trophy"></i>
									<?php
										$totalCompetition = 0;
										$calculateComp = mysqli_query($con,"SELECT * FROM tbl_kompetisi");
										while($getComp = mysqli_fetch_object($calculateComp))
										{
											if($getComp)
											{
											  $totalCompetition++;
											}
											else
											{
											
											}
										}
									?>
									<strong data-to="<?php echo $totalCompetition; ?>">0</strong>
									<label>Kompetisi</label>
								</div>
							</div>
						</div>
					</div>

					 <hr class="tall">

					<!--<div class="row">
						<div class="col-md-4">
							<img class="img-responsive mt-xl appear-animation" src="img/layout-styles.png" alt="layout styles" data-appear-animation="fadeInLeft">
						</div>
						<div class="col-md-7 col-md-offset-1">
							<h2 class="mt-xl"><strong>Layout</strong> Styles &amp; Variants</h2>
							<p class="lead">
								There are so many styles you can combine that is possible to create almost any kind of layout based on Porto Template, navigate in our preview and see the header variations, the colors, and the page content types that you will be able to use.
							</p>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur imperdiet hendrerit volutpat. Sed in nunc nec ligula consectetur mollis in vel justo. Vestibulum ante ipsum primis in faucibus orci.
							</p>
						</div>
					</div>

					<hr class="tall">

					<div class="row">
						<div class="col-md-7">
							<h2 class="mt-xl">Exclusive <strong>Style Switcher</strong></h2>
							<p class="lead">
								With our exlusive Style Switcher you will be able to choose any color you want for your website, choose the layout style (wide / boxed), website type (one page / normal), then generate the css that will be compiled by a {less} proccessor. 
							</p>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur imperdiet hendrerit volutpat. Sed in nunc nec ligula consectetur mollis in vel justo. Vestibulum ante ipsum primis in faucibus orci.
							</p>
						</div>
						<div class="col-md-4 col-md-offset-1 mt-xl">
							<img class="img-responsive appear-animation" src="img/style-switcher.png" alt="style switcher" data-appear-animation="fadeInRight">
						</div>
					</div>

					<hr class="tall"> -->

				</div>