				<style type="text/css">
					#support
					{
						margin-top: 30px;
					}
					#support h2
					{
						font-weight: 500;
					}
					.content-support
					{
						font-size: 13px;
					}
					.heading-default
					{
						margin-bottom:0px;
						color:#47a447;
						font-weight:600;
					}
				</style>

				<div class="container" id="support">
					<div class="row">
						<div class="col-md-12 content-support">
						   <?php
    					        $query = "SELECT * FROM tbl_web_privacy";
    					        $result_data = $db->getAllValue($query);
    					        
    					        foreach($result_data as $data)
    					        {
    					            echo $data['content'];
    					        }
    					    
					        ?>
					    

						</div>
					</div>

					<!-- <div class="row">
						<div class="col-md-12">
							<hr class="tall">
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<h3 class="heading-primary mt-xl">Our <strong>History</strong></h3>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">

							<ul class="history">
								<li class="appear-animation" data-appear-animation="fadeInUp">
									<div class="thumb">
										<img src="img/office-4.jpg" alt="" />
									</div>
									<div class="featured-box">
										<div class="box-content">
											<h4 class="heading-primary"><strong>2012</strong></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc vehicula lacinia. Proin adipiscing porta tellus, Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc vehicula lacinia. Proin adipiscing porta tellus,</p>
										</div>
									</div>
								</li>
								<li class="appear-animation" data-appear-animation="fadeInUp">
									<div class="thumb">
										<img src="img/office-3.jpg" alt="" />
									</div>
									<div class="featured-box">
										<div class="box-content">
											<h4 class="heading-primary"><strong>2010</strong></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc vehicula lacinia. Proin adipiscing porta tellus, Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc vehicula lacinia.</p>
										</div>
									</div>
								</li>
								<li class="appear-animation" data-appear-animation="fadeInUp">
									<div class="thumb">
										<img src="img/office-2.jpg" alt="" />
									</div>
									<div class="featured-box">
										<div class="box-content">
											<h4 class="heading-primary"><strong>2005</strong></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc vehicula lacinia. Proin adipiscing porta tellus, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc vehicula lacinia. Proin adipiscing porta tellus, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc vehicula lacinia. Proin adipiscing porta tellus,</p>
										</div>
									</div>
								</li>
								<li class="appear-animation" data-appear-animation="fadeInUp">
									<div class="thumb">
										<img src="img/office-1.jpg" alt="" />
									</div>
									<div class="featured-box">
										<div class="box-content">
											<h4 class="heading-primary"><strong>2000</strong></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc vehicula lacinia. Proin adipiscing porta tellus, Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc vehicula lacinia. Proin adipiscing porta tellus, Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc vehicula lacinia. Proin adipiscing porta tellus,</p>
										</div>
									</div>
								</li>
							</ul>

						</div>
					</div> -->

				</div>