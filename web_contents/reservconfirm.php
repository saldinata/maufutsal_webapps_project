<?php
	$reserv_code 	= "";
	$date_time 		= "";
	$code_comp		= "";
	$slame_code 	= "";
	$payment_code 	= "";
	$court_name 	= "";

	$result_booking_info 	= null;
	$result_bank_info 		= null;
	$result_field_info 		= null;

	$result_join_slam_info 	= null;
	$result_slam_info = null;

	if(isset($_COOKIE['maufutsal_dat']))
	{
		if(isset($_COOKIE['maufutsal_dat_reserv_code']) AND isset($_COOKIE['maufutsal_dat_reserv_date_time']))
		{
			$reserv_code 	= $util->decode($_COOKIE['maufutsal_dat_reserv_code']);
			$date_time		= $util->decode($_COOKIE['maufutsal_dat_reserv_date_time']);
			$customer_id	= $util->decode($_COOKIE['maufutsal_dat']);

			//setcookie("maufutsal_dat", $util->encode($customer_id), time() - (3600), "/");
			//setcookie("maufutsal_dat_reserv_code", $util->encode($reserv_code), time() - (3600), "/");
			//setcookie("maufutsal_dat_reserv_date_time", $util->encode($date_time), time() - (3600), "/");
			

			$query = "SELECT * FROM tbl_booking_lapangan WHERE nomor_booking=? AND date_time=? AND id_user_member=?";
			$result_booking_info = $db->getValue($query,[$reserv_code,$date_time,$customer_id]);

			$id_bank 		= $result_booking_info['id_bank'];
			$court_reg 		= $result_booking_info['court_reg'];
			$payment_code 	= $result_booking_info['payment_code'];

			$query = "SELECT * FROM tbl_bank WHERE id_bank=?";
			$result_bank_info = $db->getValue($query,[$id_bank]);

			$query = "SELECT * FROM tbl_field_information WHERE court_reg=?";
			$result_field_info = $db->getValue($query,[$court_reg]);

			$court_name = $result_field_info['nama_lapangan'];
		}


		else if(isset($_COOKIE['maufutsal_dat_comp_code']) AND isset($_COOKIE['maufutsal_dat_reserv_date_time']))
		{
			$code_comp 		= $util->decode($_COOKIE['maufutsal_dat_comp_code']);
			$date_time		= $util->decode($_COOKIE['maufutsal_dat_reserv_date_time']);
			$customer_id	= $util->decode($_COOKIE['maufutsal_dat']);

			$query = "SELECT * FROM tbl_member_kompetisi WHERE code_reg=?";
			$result_join_comp_info = $db->getValue($query,[$code_comp]);

			$payment_code 	= $result_join_comp_info['payment_code'];

			$id_competition = $result_join_comp_info['id_kompetisi'];
			$query = "SELECT * FROM tbl_kompetisi WHERE id_kompetisi=?";
			$result_comp_info = $db->getValue($query,[$id_competition]);

			//setcookie("maufutsal_dat", $util->encode($customer_id), time() - (3600), "/");
			//setcookie("maufutsal_dat_comp_code", $util->encode($code_comp), time() - (3600), "/");
			//setcookie("maufutsal_dat_reserv_date_time", $util->encode($date_time), time() - (3600), "/");
			
		}


		else if(isset($_COOKIE['maufutsal_dat_slam_code']) AND isset($_COOKIE['maufutsal_dat_reserv_date_time']))
		{
			$slame_code 	= $util->decode($_COOKIE['maufutsal_dat_slam_code']);
			$date_time		= $util->decode($_COOKIE['maufutsal_dat_reserv_date_time']);
			$customer_id	= $util->decode($_COOKIE['maufutsal_dat']);

			$query = "SELECT * FROM tbl_member_kompetisi WHERE code_reg=?";
			$result_join_slam_info = $db->getValue($query,[$slame_code ]);

			$payment_code 	= $result_join_slam_info['payment_code'];

			$id_competition = $result_join_slam_info['id_kompetisi'];
			$query = "SELECT * FROM tbl_kompetisi WHERE id_kompetisi=?";
			$result_slam_info = $db->getValue($query,[$id_competition]);

			//setcookie("maufutsal_dat", $util->encode($customer_id), time() - (3600), "/");
			//setcookie("maufutsal_dat_slam_code", $util->encode($slame_code), time() - (3600), "/");
			//setcookie("maufutsal_dat_reserv_date_time", $util->encode($date_time), time() - (3600), "/");
			
		}
		else
		{

		}
	}

	else if(isset($_COOKIE['maufutsal_dat_ph']))
	{
		$phnum = $util->decode($_COOKIE['maufutsal_dat_ph']);

		if(isset($_COOKIE['maufutsal_dat_reserv_code']) AND isset($_COOKIE['maufutsal_dat_reserv_date_time']))
		{
			$reserv_code 	= $util->decode($_COOKIE['maufutsal_dat_reserv_code']);
			$date_time		= $util->decode($_COOKIE['maufutsal_dat_reserv_date_time']);
			$customer_id	= $util->decode($_COOKIE['maufutsal_dat_ph']);

			//setcookie("maufutsal_dat", $util->encode($customer_id), time() - (3600), "/");
			//setcookie("maufutsal_dat_reserv_code", $util->encode($reserv_code), time() - (3600), "/");
			//setcookie("maufutsal_dat_reserv_date_time", $util->encode($date_time), time() - (3600), "/");
			

			$query = "SELECT * FROM tbl_booking_lapangan WHERE nomor_booking=? AND date_time=? AND id_user_member=?";
			$result_booking_info = $db->getValue($query,[$reserv_code,$date_time,$customer_id]);

			$id_bank 		= $result_booking_info['id_bank'];
			$court_reg 		= $result_booking_info['court_reg'];
			$payment_code 	= $result_booking_info['payment_code'];

			$query = "SELECT * FROM tbl_bank WHERE id_bank=?";
			$result_bank_info = $db->getValue($query,[$id_bank]);

			$query = "SELECT * FROM tbl_field_information WHERE court_reg=?";
			$result_field_info = $db->getValue($query,[$court_reg]);

			$court_name = $result_field_info['nama_lapangan'];
		}


		else if(isset($_COOKIE['maufutsal_dat_comp_code']) AND isset($_COOKIE['maufutsal_dat_reserv_date_time']))
		{
			$code_comp 		= $util->decode($_COOKIE['maufutsal_dat_comp_code']);
			$date_time		= $util->decode($_COOKIE['maufutsal_dat_reserv_date_time']);
			$customer_id	= $util->decode($_COOKIE['maufutsal_dat_ph']);

			$query = "SELECT * FROM tbl_member_kompetisi WHERE code_reg=?";
			$result_join_comp_info = $db->getValue($query,[$code_comp]);

			$payment_code 	= $result_join_comp_info['payment_code'];

			$id_competition = $result_join_comp_info['id_kompetisi'];
			$query = "SELECT * FROM tbl_kompetisi WHERE id_kompetisi=?";
			$result_comp_info = $db->getValue($query,[$id_competition]);

			//setcookie("maufutsal_dat", $util->encode($customer_id), time() - (3600), "/");
			//setcookie("maufutsal_dat_comp_code", $util->encode($code_comp), time() - (3600), "/");
			//setcookie("maufutsal_dat_reserv_date_time", $util->encode($date_time), time() - (3600), "/");
			
		}


		else if(isset($_COOKIE['maufutsal_dat_slam_code']) AND isset($_COOKIE['maufutsal_dat_reserv_date_time']))
		{
			$slame_code 	= $util->decode($_COOKIE['maufutsal_dat_slam_code']);
			$date_time		= $util->decode($_COOKIE['maufutsal_dat_reserv_date_time']);
			$customer_id	= $util->decode($_COOKIE['maufutsal_dat_ph']);

			$query = "SELECT * FROM tbl_member_kompetisi WHERE code_reg=?";
			$result_join_slam_info = $db->getValue($query,[$slame_code ]);

			$payment_code 	= $result_join_slam_info['payment_code'];

			$id_competition = $result_join_slam_info['id_kompetisi'];
			$query = "SELECT * FROM tbl_kompetisi WHERE id_kompetisi=?";
			$result_slam_info = $db->getValue($query,[$id_competition]);

			//setcookie("maufutsal_dat", $util->encode($customer_id), time() - (3600), "/");
			//setcookie("maufutsal_dat_slam_code", $util->encode($slame_code), time() - (3600), "/");
			//setcookie("maufutsal_dat_reserv_date_time", $util->encode($date_time), time() - (3600), "/");
			
		}
		else
		{

		}

		//setcookie("maufutsal_dat_ph", $util->encode($phnum), time() - (1200), "/");
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
<!DOCTYPE html>
<html>
	<body>
		<div class="body">
			<div role="main" class="main">
			</div>
			<br><br>

			<div class="container">
				<div class="row">
					<div class="col-md-12">
					<?php
						$page = NULL;

						if(isset($_COOKIE['maufutsal_page']))
						{
							$page = $util->decode($_COOKIE['maufutsal_page']);

							if($page=="reservprocess")
							{
								echo "<h2 class=\"mb-none\">Konfimasi Reservasi</h2>";
							}
							else if($page=="competition")
							{
								echo "<h2 class=\"mb-none\">Konfimasi Kompetisi</h2>";
							}
							else if($page=="slamevent")
							{
								echo "<h2 class=\"mb-none\">Konfimasi Ajang Tanding</h2>";
							}
							else
							{
							}	
						}
					?>
						
					</div>
				</div>
				<br>

				<div class="panel-body">			
					<div class="panel-body panel-body-nopadding">
						<div class="col-md-12">
							<div class="form-group">
									<?php
										if($page=="reservprocess")
										{
											echo "<h4>Terima kasih telah melakukan reservasi,";
										}
										else if($page=="competition")
										{
											echo "<h4>Terima kasih telah melakukan pendaftaran kompetisi,";
										}
										else if($page=="slamevent")
										{
											echo "<h4>Terima kasih telah melakukan pendaftaran ajang tanding,";
										}
										else
										{
										}



										if(isset($_COOKIE['maufutsal_dat']))
										{
											$alias = $mfsal->getAlias($util->decode($_COOKIE['maufutsal_dat']));
											echo " ".$alias;
										}
										else if(isset($_COOKIE['maufutsal_dat_ph']))
										{
											$alias = "melalui nomor ponsel : ".$util->decode($_COOKIE['maufutsal_dat_ph']);
											echo " ".$alias;
										}
										else
										{

										}



										echo "</h4>";


										if($page=="reservprocess")
										{
											echo "<small>Mohon lakukan pembayaran kurang dari 1 (satu) jam setelah reservasi untuk menghindari pembatalan secara otomatis</small>";
										}
										else if($page=="competition" || $page=="slamevent")
										{
											echo "<small>Mohon lakukan pembayaran kurang dari 1 (satu) jam setelah pendaftaran untuk menghindari pembatalan secara otomatis</small>";
										}
										else
										{

										}
									?>
								
								
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group">
									<button type="button" class="mb-xs mt-xs mr-xs btn btn-warning" data-toggle="modal" data-target="#defaultModal" id="confirm_now"> 
										Konfirmasi Sekarang 
									</button>
								<hr class="solid tall">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<h6><strong>Ringkasan Transaksi</strong></h6>
							</div>
							<?php 
								if($page=="reservprocess")
								{
									if($result_booking_info['payment_method']==="1")
									{
										echo "<h6 class=\"text-success\">Kode Booking : $reserv_code";
										echo "</h6>";
										echo "<h6 class=\"text-success\">Kode Pembayaran : $payment_code </h6>";
									}
									else
									{
										echo "<h6 class=\"text-success\">Kode Booking : $reserv_code";
										echo "</h6>";
									}
								}
								else if($page=="competition")
								{
									if($result_join_comp_info['payment_method']==="1")
									{
										echo "<h6 class=\"text-success\">Kode Pendaftaran : $code_comp";
										echo "</h6>";
										echo "<h6 class=\"text-success\">Kode Pembayaran : $payment_code </h6>";
									}
									else
									{
										echo "<h6 class=\"text-success\">Kode Pendaftaran : $code_comp";
										echo "</h6>";
									}
									
								}
								else if($page=="slamevent")
								{
									if($result_join_slam_info['payment_method']==="1")
									{
										echo "<h6 class=\"text-success\">Kode Pendaftaran : $slame_code";
										echo "</h6>";
										echo "<h6 class=\"text-success\">Kode Pembayaran : $payment_code </h6>";
									}
									else
									{
										echo "<h6 class=\"text-success\">Kode Pendaftaran : $slame_code";
										echo "</h6>";
									}
									
								}
								else
								{

								}								
							?>
							
							<div class="form-group">
								<table class="table table-bordered">
								<?php
									if($page=="reservprocess")
									{
								?>
										<thead>
											<tr>
												<td align="center"><strong>Item</strong></td>
												<td align="center"><strong>Rincian</strong></td>
												<td align="center"><strong>Tarif (Rupiah)</strong></td>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><span>Lokasi Futsal : <?php echo $court_name ?></span></td>
												<td>
													<span><strong>Waktu Pemakaian :</strong></span>
													<br>
													<span>
														<?php
															$timestamp = strtotime($result_booking_info['tanggal']);
															echo $util->getDayInIndonesia(date('l', $timestamp)).",".$util->changeFormatDateFromNumberToString($result_booking_info['tanggal']);
														?>
													</span>
													<br>
													<span>
														<?php 
															echo $result_booking_info['jam_mulai'];
														?>
														hingga 

														<?php 
															echo $result_booking_info['jam_akhir'];
														?>
													</span>
													<br><br>
													<span><strong>Arena Lapangan :</strong></span><br>
													<span><?php echo $result_booking_info['nama_area']; ?></span>
												</td>
												<td align="right">
													<span>
														Rp.<?php echo number_format($result_booking_info['price']); ?>
													</span>
												</td>
											</tr>
											<tr>
												<td colspan="2"><span>Biaya Administrasi</span></td>
												<td align="right"><span>Rp.0</span></td>
											</tr>
											<tr>
												<td colspan="2"><span>Payment Charge</span></td>
												<td align="right"><span>Rp.0</span></td>
											</tr>
											<tr>
												<td colspan="2" align="center">
													<h6><strong>Total Pembayaran Reservasi</strong></h6>
												</td>
												<td align="right">
													<h6>
														<strong>
															Rp.<?php echo number_format($result_booking_info['price']); ?>
														</strong>
													</h6>
												</td>
											</tr>
										</tbody>
								<?php
									}

									if($page=="competition")
									{
								?>
										<thead>
											<tr>
												<td align="center" colspan="2"><strong>Item</strong></td>
												<td align="center"><strong>Tarif (Rupiah)</strong></td>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td colspan="2">
													<span>Pendaftaran Kompetisi : 
														<br><br>
															<strong>
															Nama Kompetisi :
															<?php echo $result_comp_info['nama_kompetisi']; ?>
															</strong>
														<br>
															Berlangsung mulai 
															<?php echo $result_comp_info['tanggal_mulai']; ?> hingga 
															<?php echo $result_comp_info['tanggal_akhir']; ?>
														<br>
															Team terdaftar :
															<?php echo $result_join_comp_info['nama_team']; ?>
													</span>
												</td>
							
												<td align="right">
													<span>
														Rp. <?php echo number_format($result_comp_info['biaya']); ?>
													</span>
												</td>
											</tr>
											<tr>
												<td colspan="2"><span>Biaya Administrasi</span></td>
												<td align="right"><span>Rp.0</span></td>
											</tr>
											<tr>
												<td colspan="2"><span>Payment Charge</span></td>
												<td align="right"><span>Rp.0</span></td>
											</tr>
											<tr>
												<td colspan="2" align="center">
													<h6><strong>Total Tarif</strong></h6>
												</td>
												<td align="right">
													<h6>
														<strong>
															Rp. <?php echo number_format($result_comp_info['biaya']); ?>
														</strong>
													</h6>
												</td>
											</tr>
										</tbody>
								<?php
									}

									if($page=="slamevent")
									{
								?>
										<thead>
											<tr>
												<td align="center" colspan="2"><strong>Item</strong></td>
												<td align="center"><strong>Tarif (Rupiah)</strong></td>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td colspan="2">
													<span>Pendaftaran Ajang Tanding : 
														<br><br>
															<strong>
															Nama Ajang Tanding :
															<?php echo $result_slam_info['nama_kompetisi']; ?>
															</strong>
														<br>
															Berlangsung mulai 
															<?php echo $result_slam_info['tanggal_mulai']; ?> hingga 
															<?php echo $result_slam_info['tanggal_akhir']; ?>
														<br>
															Team terdaftar :
															<?php echo $result_join_slam_info['nama_team']; ?>
													</span>
												</td>
							
												<td align="right">
													<span>
														<span>
														Rp. <?php echo number_format($result_slam_info['biaya']); ?>
														</span>
													</span>
												</td>
											</tr>
											<tr>
												<td colspan="2"><span>Biaya Administrasi</span></td>
												<td align="right"><span>0</span></td>
											</tr>
											<tr>
												<td colspan="2"><span>Payment Charge</span></td>
												<td align="right"><span>0</span></td>
											</tr>
											<tr>
												<td colspan="2" align="center">
													<h6><strong>Total Tarif</strong></h6>
												</td>
												<td align="right">
													<h6>
														<strong>
															Rp. <?php echo number_format($result_slam_info['biaya']); ?>
														</strong>
													</h6>
												</td>
											</tr>
										</tbody>
								<?php
									}
								?>									
								</table>

							</div>

							<div class="form-group">
								<h6><strong>Metode Pembayaran</strong></h6>
								<?php
									if($page=="reservprocess")
									{
										if($result_booking_info['payment_method']==="0")
										{
											$type = NULL;

											if($result_booking_info['type_transfer']==="0-0")
											{
												$type = "ATM";
											}
											else if($result_booking_info['type_transfer']==="0-1")
											{
												$type = "NON-ATM";
											}
											else
											{

											}
											echo "<span>Transfer Antar Bank - ".$type."</span>";
											echo "<br>";
											echo "<span>".$result_booking_info['account_no']."</span><br>";
											echo "<span>".$result_bank_info['nama_bank']."</span><br>";
											echo "<span>a.n. ".$result_booking_info['account_name']."</span>";
										}

										else if($result_booking_info['payment_method']==="1")
										{
											echo "<span>Melalui ATM Bersama</span>";
										}

										else if($result_booking_info['payment_method']==="4")
										{
											echo "<span>Melalui Agent Maufutsal</span>";
										}
									}
									else if($page=="competition")
									{
										if($result_join_comp_info['payment_method']==0)
										{
											$type = NULL;

											if($result_join_comp_info['type_transfer']==="0-0")
											{
												$type = "ATM";
											}
											else if($result_join_comp_info['type_transfer']==="0-1")
											{
												$type = "NON-ATM";
											}
											else
											{

											}
											echo "<span>Transfer Antar Bank - ".$type."</span>";
											echo "<br>";
											echo "<span>".$result_join_comp_info['account_no']."</span><br>";
											echo "<span>".$result_join_comp_info['bank_name']."</span><br>";
											echo "<span>a.n. ".$result_join_comp_info['account_name']."</span>";
										}
										else if($result_join_comp_info['payment_method']==="1")
										{
											echo "<span>Melalui ATM Bersama</span>";
										}

										else if($result_join_comp_info['payment_method']==="4")
										{
											echo "<span>Melalui Agent Maufutsal</span>";
										}
									}
									else if($page=="slamevent")
									{
										if($result_join_slam_info['payment_method']==0)
										{
											$type = NULL;

											if($result_join_slam_info['type_transfer']==="0-0")
											{
												$type = "ATM";
											}
											else if($result_join_slam_info['type_transfer']==="0-1")
											{
												$type = "NON-ATM";
											}
											else
											{

											}
											echo "<span>Transfer Antar Bank - ".$type."</span>";
											echo "<br>";
											echo "<span>".$result_join_slam_info['account_no']."</span><br>";
											echo "<span>".$result_join_slam_info['bank_name']."</span><br>";
											echo "<span>a.n. ".$result_join_slam_info['account_name']."</span>";
										}
										else if($result_join_slam_info['payment_method']==="1")
										{
											echo "<span>Melalui ATM Bersama</span>";
										}

										else if($result_join_slam_info['payment_method']==="4")
										{
											echo "<span>Melalui Agent Maufutsal</span>";
										}
									}
									else
									{

									}


									
								?>
								
							</div>
						</div>
					</div>
					<br>
				</div>
			</div>
		</div>
	</body>
</html>


<script type="text/javascript" src="js/maufutsal_script/script_reservconfirm.js"></script>