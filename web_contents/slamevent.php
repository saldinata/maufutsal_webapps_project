<!DOCTYPE html>
<html>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
	      </div>
	      <div class="modal-body">
	        ...
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div>
	    </div>
  	</div>
</div>

	<body>
		<div class="body">
			<div role="main" class="main">
				<section class="parallax section section-text-light section-parallax section-center mt-none mb-none" data-stellar-background-ratio="0.5" style="background-image: url(img/parallax-hosting.jpg);" id="search-domain">
					<div class="container">
						<div class="row">
							<div class="col-md-8 col-md-offset-2 center">
								<h2 class="heading-light mb-none">Cari <strong>Ajang Tanding</strong></h2>
								<p class="mb-xl">Masukkan Nama Ajang Tanding atau Nama Kota</p>

								<div class="form-group form-group-lg">
									<div class="col-sm-12">
										<div class="input-group">
											<input type="text" class="form-control" aria-label="..." placeholder="Ketik disini" required data-msg-required="Anda belum memasukan kata kunci pencarian." size="100" autocomplete="off" id="autocompleteslam">
										</div>
									</div>
								</div>
								
								<button class="btn btn-lg btn-primary mt-md" id="searchSlam">
									Temukan Ajang Tanding
								</button>
							</div>
						</div>
					</div>
				</section>
			</div>
			<br><br>

			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2 class="mb-none">Ajang Tanding</h2>
					</div>
				</div>
				<br>

				<div class="row" id="slam_contents">
				</div>
			</div>

		</div>
	</body>
</html>

<script type="text/javascript" src="js/maufutsal_script/script_slame_event.js"></script>