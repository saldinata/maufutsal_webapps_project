<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php
				$page = null;

				if(isset($_COOKIE['maufutsal_page']))
				{
					$page = $util->decode($_COOKIE['maufutsal_page']);

					if($page=="competition")
					{
						echo "<h2 class=\"mb-none\">Prosess Pembayaran Kompetisi</h2>";
					}
					else if($page=="reservprocess")
					{
						echo "<h2 class=\"mb-none\">Prosess Pembayaran Reservasi Lapangan Futsal</h2>";
					}
					else if($page=="slamevent")
					{
						echo "<h2 class=\"mb-none\">Prosess Pembayaran Ajang Tanding</h2>";
					}
					else if($page=="reservprocesspayment")
					{
			?>
						<script type="text/javascript">
							document.location.href="./";
						</script>
			<?php
					}
					else
					{
			?>
						<script type="text/javascript">
							document.location.href="./";
						</script>
			<?php
					}
				}
				else
				{
			?>
					<script type="text/javascript">
						document.location.href="./";
					</script>
			<?php
				}
			?>
			
			<input type="hidden" value="<?php echo $page ?>" id="page" autocomplete="off" readonly>
		</div>
	</div>
	<br>

	<div class="panel-body">			
			<div class="panel-body panel-body-nopadding">
				<form class="form-horizontal" novalidate="novalidate">
					<div class="col-md-12">
						<div class="form-group">
							<h4>Pilih Metode Pembayaran</h4>
						</div>

						<div class="form-group">
							<ul class="list list-icons list-icons-style-3">
								<li>
									<i class="fa">
										<input type="radio" name="payment" value="0">
									</i> 
									<span><strong> Transfer Antar Bank </strong></span>
									<p class="panel-subtitle">
										Transfer melalui ATM atau melalui bank dengan tujuan nomor rekening Maufutsal
									</p>
									<div id="transfer_type">
										<h6>Tipe Pembayaran</h6>
										<select class="form-control" maxlength="14" id="type_transfer">
											<option value="">Pilihan</option>
											<option value="0-0">ATM / Internet Banking / Mobile Banking</option>
											<option value="0-1">NON-ATM</option>
										</select>
									</div>
								</li>

								<li>
									<i class="fa">
										<input type="radio" name="payment" value="1">
									</i> 
									<span><strong> Payment ATM Bersama </strong></span>
									<p class="panel-subtitle">
										Melalui ATM Bersama dengan memasukan code payment dalam menu pembayaran Maufutsal
									</p>
								</li>

								<!-- 
								<li id="card">
									<i class="fa">s
										<input type="radio" name="payment" value="2">
									</i> 
									<span><strong> Kartu Debit/Kartu Kredit </strong></span>
									<p class="panel-subtitle">
										Semua kartu Debit/Kredit berlogo Visa atau MasterCard
									</p>
								</li>

								<li id="paypal">
									<i class="fa">
										<input type="radio" name="payment" value="3">
									</i> 
									<span><strong> PayPal </strong></span>
									<p class="panel-subtitle">
										Menggunakan akun Paypal
									</p>
								</li>
 								-->

								<li>
									<i class="fa">
										<input type="radio" name="payment" value="4">
									</i> 
									<span><strong> Agent Maufutsal </strong></span>
									<p class="panel-subtitle">
										Outlet Payment Resmi Maufutsal. Pembayaran melalui Agent mungkin akan dikenakan biaya tambahan.
									</p>
								</li>


								<!-- 
								<li id="indomaret">
									<i class="fa">
										<input type="radio" name="payment" value="5">
									</i> 
									<span><strong> Indomaret/Alfamart </strong></span>
									<p class="panel-subtitle">
										
									</p>
								</li>


								<li id="emoney">
									<i class="fa">
										<input type="radio" name="payment" value="6" >
									</i> 
									<span><strong> Uang Elektronik </strong></span>
									<p class="panel-subtitle">
										Mandiri e-Cash, Sakuku, Uangku, Paytren, Veritrans
									</p>
								</li>
								-->

							</ul>
						</div>
					</div>
				</form>
			</div>
			<br>

			<div class="panel-footer">
				<!-- <ul class="pager">
					<li class="next"> -->
						<button type="button" class="mb-xs mt-xs mr-xs btn btn-warning" id="payment_now">
								Bayar Sekarang
						</button>
				<!-- 	</li>								
				</ul> -->
			</div>
	</div>
</div>


<script type="text/javascript" src="js/maufutsal_script/script_reservation_payment.js"></script>