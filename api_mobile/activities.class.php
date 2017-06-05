<?php

Class Act
{
	private $db;
	private $util;
	private $mfsal;
	private $atmb;
	private $auth;

	public function __construct($database,$utility,$mfsal,$atmb,$auth)
	{
		$this->db 		= $database;
		$this->util 	= $utility;
		$this->mfsal	= $mfsal;
		$this->atmb 	= $atmb;
		$this->auth 	= $auth;
	}

	public function reqcalcallfield()
	{
		$counter 			= 0;
		$total				= 0;
		$dataRespons 	= [];

		$query 						= "SELECT * FROM tbl_field_information";
		$result_num_data 	= $this->db->getAllValue($query);

		foreach ($result_num_data as $data_num)
		{
			$counter++;
		}

		$total = $counter;
		array_push($dataRespons,
		[
			'type'				=> 'rescalcallfield',
			'total_field'	=> $total
		]);

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function reqsearchfield($key)
	{
		$key = "%".htmlentities(addslashes($key))."%";

		$dataRespons = [];

		$query 							= "SELECT * FROM tbl_city WHERE kokab_nama LIKE ?";
		$result_search_city = $this->db->getAllValue($query,[$key]);

		if(!empty($result_search_city))
		{
			foreach ($result_search_city as $row)
			{
				array_push($dataRespons,
				[
					'type'			=> 'ressearchfield',
					'court_reg'	=> '-',
					'id_kota'		=> $row['kota_id'],
					'found'			=> 'yes'
				]);
			}
		}
		else
		{
			$query 							= "SELECT * FROM tbl_field_information WHERE nama_lapangan LIKE ?";
			$result_field_info 	= $this->db->getAllValue($query,[$key]);

			if(!empty($result_field_info))
			{
				foreach ($result_field_info as $row)
				{
					array_push($dataRespons,
					[
						'type'			=> 'ressearchfield',
						'court_reg'	=> $row['court_reg'],
						'id_kota'		=> $row['id_kota'],
						'found'			=> 'yes'
					]);
				}
			}
			else
			{
				array_push($dataRespons,
					[
						'type'			=> 'ressearchfield',
						'court_reg'	=> '-',
						'id_kota'		=> '-',
						'found'			=> 'no'
					]);
			}
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	public function reqsearchturnamen($key)
	{
		$default_key	= "Kota ".ucfirst(strtolower(htmlentities(addslashes($key))));
		$key 					= "%".htmlentities(addslashes($key))."%";
		$dataRespons 	= [];

		$query = "SELECT * FROM tbl_city WHERE kokab_nama=?";
		$result_search_city_default = $this->db->getValue($query,[$default_key]);

		$id_city = $result_search_city_default['kota_id'];

		if(empty($result_search_city_default))
		{
			$query = "SELECT * FROM tbl_city WHERE kokab_nama LIKE ?";
			$result_search_city = $this->db->getAllValue($query,[$key]);

			if(!empty($result_search_city))
			{
				foreach ($result_search_city as $row)
				{
					array_push($dataRespons,
					[
						'type'					=> 'ressearchturnamen',
						'id_competition'=> '-',
						'id_city'				=> $row['kota_id'],
						'found'					=> 'yes'
					]);
				}
			}
			else
			{
				$query = "SELECT * FROM tbl_kompetisi WHERE nama_kompetisi LIKE ?";
				$result_comp_info = $this->db->getAllValue($query,[$key]);

				foreach ($result_comp_info as $row)
				{
					array_push($dataRespons,
					[
						'type'					=> 'ressearchturnamen',
						'id_competition'=> $row['id_kompetisi'],
						'id_city'				=> $row['kota'],
						'found'					=> 'yes'
					]);
				}
			}
		}
		else
		{
			array_push($dataRespons,
			[
				'type'					=> 'ressearchturnamen',
				'id_competition'=> '-',
				'id_city'				=> $id_city,
				'found'					=> 'yes'
			]);
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	public function reqshowfieldlistcourtreg($court_reg)
	{
		$court_reg 		=  explode(",",htmlentities(addslashes($court_reg)));
		$dataRespons 	= [];
		$promo_state	= 0;

		foreach ($court_reg as $data_court_reg)
		{
			$this->util->setDefaultTimeZone("Asia/Bangkok");
			$reg_date_today = $this->util->setDateRegisterForToday();

			$query 							= "SELECT * FROM tbl_field_information WHERE court_reg=? ORDER BY nama_lapangan ASC";
			$result_field_info 	= $this->db->getAllValue($query,[$data_court_reg]);

			if(!empty($result_field_info))
			{
				foreach ($result_field_info as $data)
				{
					$court_name 		= $data['nama_lapangan'];
					$court_address 	= $data['alamat'];
					$city_id				= $data['id_kota'];

					$query 				= "SELECT * FROM tbl_city WHERE kota_id=?";
					$result_city 	= $this->db->getValue($query,[$city_id]);

					$query				= "SELECT * FROM tbl_link_promo WHERE court_reg=? ORDER BY reg_date_end ASC";
					$result_promo = $this->db->getAllValue($query,[$data_court_reg]);

					if(!empty($result_promo))
					{
						foreach ($result_promo as $data_promo)
						{
							$reg_date_end 		= $data_promo['reg_date_end'];
							$promo_limitation = $this->util->limitDate($reg_date_today,$reg_date_end);

							if($promo_limitation==1)
							{
								$promo_state = 1;

								array_push($dataRespons,
								[
									'type'					=> "resshowfieldlistcourtreg",
							    'date_start'		=> $data_promo['date_start'],
							    'date_end' 			=> $data_promo['date_end'],
							    'reg_date_start'=> $data_promo['reg_date_start'],
							    'reg_date_end' 	=> $data_promo['reg_date_end'],
							    'court_reg'			=> $data_court_reg,
							    'court_name' 		=> $court_name,
							    'court_address' => $court_address,
							    'link' 					=> $data_promo['link'],
							    'promo_price' 	=> $data_promo['promo_price'],
							    'normal_price'	=> '-',
							    'id_kota' 			=> $result_city['kokab_nama'],
							    'found'					=> "yes"
								]);
							}
							else
							{
							}
						}
					}

					else
					{
						if($promo_state==0)
						{
							$query = "SELECT * FROM tbl_harga_lapangan WHERE court_reg=?";
							$result_normal = $this->db->getAllValue($query,[$data_court_reg]);

							$price = NULL;
							$count = 0;

							foreach ($result_normal as $data_normal)
							{
								$price[$count] = $data_normal['pricelist_online'];
								$count++;
							}

							$count = 0;
							$lowest_price = min($price);

							array_push($dataRespons,
							[
								'type'					=> "resshowfieldlistcourtreg",
						    'date_start'		=> "-",
						    'date_end' 			=> "-",
						    'reg_date_start'=> "-",
						    'reg_date_end' 	=> "-",
						    'court_reg'			=> $data_court_reg,
						    'court_name' 		=> $court_name,
						    'court_address' => $court_address,
						    'link' 					=> "-",
						    'promo_price' 	=> "-",
						    'normal_price'	=> $lowest_price,
						    'id_kota' 			=> $result_city['kokab_nama'],
						    'found'					=> "yes"
							]);
						}
					}
					$promo_state = 0;
				}
			}
			else
			{
				array_push($dataRespons,
				[
					'type'					=> "resshowfieldlistcourtreg",
			    'date_start'		=> "-",
			    'date_end' 			=> "-",
			    'reg_date_start'=> "-",
			    'reg_date_end' 	=> "-",
			    'court_reg'			=> "-",
			    'court_name' 		=> "-",
			    'court_address' => "-",
			    'link' 					=> "-",
			    'promo_price' 	=> "-",
			    'normal_price'	=> "-",
			    'id_kota' 			=> "-",
			    'found'					=> "no"
				]);
			}
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	public function reqshowfieldlistcityid($city_id)
	{
		$city_id 			=  explode(",",htmlentities(addslashes($city_id)));
		$dataRespons 	= [];
		$promo_state	= 0;
		$court_reg 		= "";

		foreach ($city_id as $data_city_id)
		{
			$this->util->setDefaultTimeZone("Asia/Bangkok");
			$reg_date_today = $this->util->setDateRegisterForToday();

			$query 							= "SELECT * FROM tbl_field_information WHERE id_kota=? ORDER BY nama_lapangan ASC";
			$result_field_info 	= $this->db->getAllValue($query,[$data_city_id]);

			if(!empty($result_field_info))
			{
				foreach ($result_field_info as $data)
				{
					$court_reg 			= $data['court_reg'];
					$court_name 		= $data['nama_lapangan'];
					$court_address 	= $data['alamat'];
					$city_id				= $data['id_kota'];

					$query = "SELECT * FROM tbl_city WHERE kota_id=?";
					$result_city = $this->db->getValue($query,[$data_city_id]);

					$query	= "SELECT * FROM tbl_link_promo WHERE court_reg=? ORDER BY reg_date_end ASC";
					$result_promo = $this->db->getAllValue($query,[$court_reg]);

					if(!empty($result_promo))
					{
						foreach ($result_promo as $data_promo)
						{
							$reg_date_end 		= $data_promo['reg_date_end'];
							$promo_limitation = $this->util->limitDate($reg_date_today,$reg_date_end);

							if($promo_limitation == 1)
							{
								$promo_state = 1;

								array_push($dataRespons,
								[
									'type'					=> "resshowfieldlistcityid",
							    'date_start'		=> $data_promo['date_start'],
							    'date_end' 			=> $data_promo['date_end'],
							    'reg_date_start'=> $data_promo['reg_date_start'],
							    'reg_date_end' 	=> $data_promo['reg_date_end'],
							    'court_reg'			=> $court_reg,
							    'court_name' 		=> $court_name,
							    'court_address' => $court_address,
							    'link' 					=> $data_promo['link'],
							    'promo_price' 	=> $data_promo['promo_price'],
							    'normal_price'	=> '-',
							    'id_kota' 			=> $result_city['kokab_nama'],
							    'found'					=> "yes"
								]);
							}
							else
							{
								array_push($dataRespons,
								[
									'type'					=> "resshowfieldlistcityid",
							    'date_start'		=> "-",
							    'date_end' 			=> "-",
							    'reg_date_start'=> "-",
							    'reg_date_end' 	=> "-",
							    'court_reg'			=> "-",
							    'court_name' 		=> "-",
							    'court_address' => "-",
							    'link' 					=> "-",
							    'promo_price' 	=> "-",
							    'normal_price'	=> "-",
							    'id_kota' 			=> "-",
							    'found'					=> "no"
								]);
							}
						}
					}

					else
					{
						if($promo_state == 0)
						{
							$query = "SELECT * FROM tbl_harga_lapangan WHERE court_reg=?";
							$result_normal = $this->db->getAllValue($query,[$court_reg]);
							$price = array();
							$count = 0;
							$lowest_price = 0;

							foreach ($result_normal as $data_normal)
							{
								$price[$count] = $data_normal['pricelist_online'];
								$count++;
							}

							$count = 0;

							if(!empty($price))
							{
								$lowest_price = min($price);
							}

							array_push($dataRespons,
							[
								'type'					=> "resshowfieldlistcityid",
						    'date_start'		=> "-",
						    'date_end' 			=> "-",
						    'reg_date_start'=> "-",
						    'reg_date_end' 	=> "-",
						    'court_reg'			=> $court_reg,
						    'court_name' 		=> $court_name,
						    'court_address' => $court_address,
						    'link' 					=> "-",
						    'promo_price' 	=> "-",
						    'normal_price'	=> $lowest_price,
						    'id_kota' 			=> $result_city['kokab_nama'],
						    'found'					=> "yes"
							]);
						}
					}
					$promo_state = 0;
				}
			}
			else
			{
				array_push($dataRespons,
				[
					'type'					=> "resshowfieldlistcityid",
			    'date_start'		=> "-",
			    'date_end' 			=> "-",
			    'reg_date_start'=> "-",
			    'reg_date_end' 	=> "-",
			    'court_reg'			=> "-",
			    'court_name' 		=> "-",
			    'court_address' => "-",
			    'link' 					=> "-",
			    'promo_price' 	=> "-",
			    'normal_price'	=> "-",
			    'id_kota' 			=> "-",
			    'found'					=> "no"
				]);
			}
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function reqshowcomplistbyidcity($id_city)
	{
		$id_comp 			= explode(",",htmlentities(addslashes($id_city)));
		$dataRespons 	= [];

		$this->util->setDefaultTimeZone("Asia/Bangkok");
		$reg_date_today = $this->util->setDateRegisterForToday();

		foreach ($id_comp as $data_city)
		{
			$query 						= "SELECT * FROM tbl_kompetisi WHERE kota=?";
			$result_comp_info = $this->db->getAllValue($query,[$data_city]);

			if(!empty($result_comp_info))
			{
				foreach ($result_comp_info as $data)
				{
					$competition_name	= $data['nama_kompetisi'];
					$start_date 			= $data['tanggal_mulai'];
					$end_date 				= $data['tanggal_akhir'];
					$kind_comp				= $data['jenis_kompetisi'];
					$city_id					= $data['kota'];
					$club_number 			= $data['jumlah_club'];
					$cost 						= $data['biaya'];
					$id_competition 	= $data['id_kompetisi'];

					$query 						= "SELECT * FROM tbl_city WHERE kota_id=?";
					$result_city_info = $this->db->getValue($query,[$city_id]);

					if($kind_comp!="ajang")
					{
						$reg_end_date = $this->util->setRegisterDate($end_date);
						$limit_date		= $this->util->limitDate($reg_date_today,$reg_end_date);

						if($limit_date == "1")
						{
							array_push($dataRespons,
							[
								'type'							=> 'resshowcomplistbyidcity',
								'competition_name'	=> $competition_name,
								'start_date'				=> $start_date,
								'end_date'					=> $end_date,
								'kind_comp'					=> $kind_comp,
								'city_id'						=> $city_id,
								'city_name'					=> $result_city_info['kokab_nama'],
								'club_number'				=> $club_number,
								'cost'							=> $cost,
								'id_competition'		=> $id_competition,
								'found'							=> 'yes'
							]);
						}
						else
						{
							array_push($dataRespons,
							[
								'type'							=> 'resshowcomplistbyidcity',
								'competition_name'	=> '-',
								'start_date'				=> '-',
								'end_date'					=> '-',
								'kind_comp'					=> '-',
								'city_id'						=> '-',
								'city_name'					=> '-',
								'club_number'				=> '-',
								'cost'							=> '-',
								'id_competition'		=> '-',
								'found'							=> 'no'
							]);
						}
					}
				}
			}
			else
			{
				// array_push($dataRespons,
				// [
				// ]);
			}
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function reqshowcomplistbyidcomp($id_comp)
	{
		$id_comp 			= explode(",",htmlentities(addslashes($id_comp)));
		$dataRespons 	= [];

		$this->util->setDefaultTimeZone("Asia/Bangkok");
		$reg_date_today = $this->util->setDateRegisterForToday();

		foreach ($id_comp as $data_comp)
		{
			$query = "SELECT * FROM tbl_kompetisi WHERE id_kompetisi=?";
			$result_competition_info = $this->db->getAllValue($query,[$data_comp]);

			if(!empty($result_competition_info))
			{
				foreach ($result_competition_info as $data)
				{
					$competition_name	= $data['nama_kompetisi'];
					$start_date 			= $data['tanggal_mulai'];
					$end_date 				= $data['tanggal_akhir'];
					$kind_comp				= $data['jenis_kompetisi'];
					$city_id					= $data['kota'];
					$club_number 			= $data['jumlah_club'];
					$cost 						= $data['biaya'];
					$id_competition 	= $data['id_kompetisi'];

					$query = "SELECT * FROM tbl_city WHERE kota_id=?";
					$result_city_info = $this->db->getValue($query,[$city_id]);

					if($kind_comp!="ajang")
					{
						$reg_end_date	= $this->util->setRegisterDate($end_date);
						$limit_date 	= $this->util->limitDate($reg_date_today,($reg_end_date));

						if($limit_date=="1")
						{
							array_push($dataRespons,
							[
								'type'						=> 'resshowcomplistbyidcomp',
								'competition_name'=> $competition_name,
								'start_date'			=> $start_date,
								'end_date'				=> $end_date,
								'kind_comp'				=> $kind_comp,
								'city_id'					=> $city_id,
								'city_name'				=> $result_city_info['kokab_nama'],
								'club_number'			=> $club_number,
								'cost'						=> $cost,
								'id_competition'	=> $id_competition,
								'found'						=> 'yes'
							]);
						}
						else
						{
							array_push($dataRespons,
							[
								'type'						=> 'resshowcomplistbyidcomp',
								'competition_name'=> '-',
								'start_date'			=> '-',
								'end_date'				=> '-',
								'kind_comp'				=> '-',
								'city_id'					=> '-',
								'city_name'				=> '-',
								'club_number'			=> '-',
								'cost'						=> '-',
								'id_competition'	=> '-',
								'found'						=> 'no'
							]);
						}
					}
				}
			}
			else
			{
				array_push($dataRespons,
				[
					'type'						=> 'resshowcomplistbyidcomp',
					'competition_name'=> '-',
					'start_date'			=> '-',
					'end_date'				=> '-',
					'kind_comp'				=> '-',
					'city_id'					=> '-',
					'city_name'				=> '-',
					'club_number'			=> '-',
					'cost'						=> '-',
					'id_competition'	=> '-',
					'found'						=> 'no'
				]);
			}
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function reqcourtinfo($court_reg)
	{
		$court_reg = htmlentities(addslashes($court_reg));
		$dataRespons = [];

		$query = "SELECT * FROM tbl_field_information WHERE court_reg=?";
		$result_court_name = $this->db->getValue($query,[$court_reg]);

		array_push($dataRespons,
		[
			'type'					=> "rescourtinfo",
			'field_name'		=> $result_court_name['nama_lapangan'],
			'time_ops'			=> $result_court_name['jam_ops'],
			'address'				=> $result_court_name['alamat'],
			'id_prov'				=> $result_court_name['id_prov'],
			'id_city'				=> $result_court_name['id_kota'],
			'court_reg'			=> $result_court_name['court_reg'],
			'id_user'				=> $result_court_name['id_user'],
			'id_field_info'	=> $result_court_name['id_field_information'],
		]);
		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}


	function reqcourtarena($court_reg)
	{
		$court_reg = htmlentities(addslashes($court_reg));
		$dataRespons = [];

		$query = "SELECT * FROM tbl_arena_futsal WHERE court_reg=? ORDER BY nama_arena ASC";
		$result_court_name = $this->db->getAllValue($query,[$court_reg]);

		foreach($result_court_name as $data)
		{
			array_push($dataRespons,
			[
				'type'			=> "rescourtarena",
				'arena_name'=> $data['nama_arena'],
				'arena_code'=> $data['code_arena'],
				'id_arena'	=> $data['id_arean']
			]);
		}

		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}


	function reqreservtime()
	{
		$dataRespons = [];

		$query = "SELECT * FROM tbl_waktu";
		$result_reserv_time = $this->db->getAllValue($query);

		foreach($result_reserv_time as $data)
		{
			array_push($dataRespons,
			[
				'type'	=> "resreservtime",
				'time'	=> $data['waktu']
			]);
		}
		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}


	function reqtimeusage()
	{
		$dataRespons = [];

		$query = "SELECT * FROM tbl_jam_pemakaian";
		$result_time_usage = $this->db->getAllValue($query);

		foreach($result_time_usage as $data)
		{
			if($data['jam']>3)
			{
				break;
			}
			else
			{
				array_push($dataRespons,
				[
					'type'			=> "restimeusage",
					'time_usage'=> $data['jam']
				]);
			}
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function reqreservtrans($current_date,$court_reg,$field_code,$code_cat,$start_time,$duration_time)
	{
		$dataResponse = [];
		$book_state		= "";
		$promo_state	= "";
		$final_price	= 0;

		$current_date 	= htmlentities(addslashes($current_date));
		$court_reg			= htmlentities(addslashes($court_reg));
		$field_code			= htmlentities(addslashes($field_code));
		$start_time			= htmlentities(addslashes($start_time));
		$duration_time	= htmlentities(addslashes($duration_time));
		$code_cat				= htmlentities(addslashes($code_cat));

		$result_open_hour = $this->mfsal->checkOpenHours($court_reg,$field_code,date('N',strtotime($current_date)),$code_cat,substr($start_time,0,2),self::getEndTime($start_time,$duration_time));

		if($result_open_hour==1)
		{
			$current_date 	= $this->util->setRegisterDate($current_date);
			$end_time				= $this->util->getEndTime($start_time,$duration_time);

			$result_check_book = $this->mfsal->checkAvailableBook($current_date,$field_code,$court_reg,substr($start_time,0,2),substr($end_time,0,2));

			if($result_check_book==1)
			{
				$book_state	= "available";
				$promo_state = self::checkAvailablePromo($current_date,$court_reg,$field_code);

				if($promo_state=="true")
				{
					$final_price = self::calculatePromoPrice($court_reg,$field_code,date('N', strtotime($current_date)),$code_cat,substr($start_time,0,2),self::getEndTime($start_time,$duration_time));
				}
				else
				{
					$final_price = self::calculateNormalPrice($court_reg,$field_code,date('N', strtotime($current_date)),$code_cat,substr($start_time,0,2),self::getEndTime($start_time,$duration_time));
				}
			}
			else
			{
				$book_state	= "unavailable";
				$promo_state = "false";
			}


			if(self::getEndTime($start_time,$duration_time)<10)
			{
				$end_time = "0".self::getEndTime($start_time,$duration_time).":00";
			}
			else
			{
				$end_time = self::getEndTime($start_time,$duration_time).":00";
			}


			array_push($dataResponse,
			[
				'type'				=> 'resreservtrans',
				'book_state'	=> $book_state,
				'promo_state'	=> $promo_state,
				'final_cost'	=> $final_price,
				'date_usage'	=> $start_time." - ".$end_time
			]);
		}
		else
		{
			if(self::getEndTime($start_time,$duration_time)<10)
			{
				$end_time = "0".self::getEndTime($start_time,$duration_time).":00";
			}
			else
			{
				$end_time = self::getEndTime($start_time,$duration_time).":00";
			}

			array_push($dataResponse,
			[
				'type'				=> 'resreservtrans',
				'book_state'	=> 'unavailable',
				'promo_state'	=> 'false',
				'final_cost'	=> '0',
				'date_usage'	=> $start_time." - ".$end_time
			]);
		}
		echo json_encode($dataResponse, JSON_PRETTY_PRINT);
	}



	function checkAvailablePromo($current_date,$court_reg,$field_code)
	{
		$result_check_promo = false;
		$get_promo_data			= NULL;

		$query = "SELECT DISTINCT * FROM tbl_harga_lapangan_promo WHERE court_reg=? AND name_field=?";
		$get_promo_data = $this->db->getValue($query,[$court_reg,$field_code]);

		if(!empty($get_promo_data))
		{
			$current_date	= $this->util->setRegisterDate($current_date);
			$start_date 	= $this->util->setRegisterDate($get_promo_data['start_date']);
			$end_date 		= $this->util->setRegisterDate($get_promo_data['end_date']);

			$result_check_promo = $this->util->dateRangeComparation($start_date,$end_date,$current_date);
		}
		else
		{
			$result_check_promo = false;
		}
		return $result_check_promo;
	}


	function calculatePromoPrice($court_reg,$field_code,$number_of_day,$code_cat,$start_time,$end_time)
	{
		$time_master	= "";
		$promo_price 	= "";
		$register_time	= "";
		$result_1		= "";
		$result_2		= "";
		$total			= 0;

		$query = "SELECT * FROM tbl_harga_lapangan_promo WHERE court_reg=? AND name_field=? AND code_category=? AND ('$number_of_day' BETWEEN start_day AND end_day) ORDER BY register ASC";
		$result_promo_info = $this->db->getAllValue($query,[$court_reg,$field_code,$code_cat]);

		foreach ($result_promo_info as $row)
		{
			$start_day 	= $row['start_day'];
			$end_day 		= $row['end_day'];

			$promo_price 		= $row['pricelist_promo'];
			$register_time	= $row['register'];

			// if($number_of_day<=$end_day AND $number_of_day>=$start_day)
			// { echo "masuk sini";
			// 	$promo_price 	= $row['pricelist_promo'];
			// 	$register_time	= $row['register'];
			// 	break;
			// }
		}

		$start_time_promo 	= substr($register_time, 0,2);
		$end_time_promo			= substr($register_time, 4,2);

		if($start_time<$end_time_promo AND $start_time>=$start_time_promo)
		{
			$result_1 		= 1;
			$time_master 	= $end_time_promo;
		}
		else
		{
			$result_1 		= 0;
			$time_master 	= $start_time_promo;
		}

		if($end_time<=$end_time_promo AND $end_time>$start_time_promo)
		{
			$result_2 = 1;
		}
		else
		{
			$result_2 = 0;
		}


		if($result_1==0 AND $result_2==0)
		{
			$total = self::calculateNormalPrice($court_reg,$field_code,$number_of_day,$code_cat,$start_time,$end_time);
		}

		if($result_1==0 AND $result_2==1)
		{
			$total = (self::calculateNormalPrice($court_reg,$field_code,$number_of_day,$code_cat,$time_master,$end_time)) + (($end_time-$time_master)*$promo_price);
		}

		if($result_1==1 AND $result_2==0)
		{
			$total = ($time_master-$start_time)*$promo_price;
			$total = $total + (self::calculateNormalPrice($court_reg,$field_code,$number_of_day,$code_cat,$time_master,$end_time));
		}

		if($result_1==1 AND $result_2==1)
		{
			$total = ($end_time-$start_time)*$promo_price;
		}
		return $total;
	}


	function calculateNormalPrice($court_reg,$field_code,$number_of_day,$code_cat,$start_time,$end_time)
	{
		$count 					= 0;
		$register_time 	= null;
		$normal_price		= null;
		$time_master		= "";
		$result_1				= NULL;
		$result_2				= NULL;
		$total					= NULL;
		$final_total		= 0;
		$skip						= "no";
		$data_open_hour	= array();

		$query = "SELECT * FROM tbl_harga_lapangan WHERE court_reg=? AND name_field=? AND code_category=? AND ('$number_of_day' BETWEEN start_day AND end_day) ORDER BY register ASC" ;
		$result_normal_info = $this->db->getAllValue($query,[$court_reg,$field_code,$code_cat]);

		foreach ($result_normal_info as $row)
		{
			$start_day[$count] 	= $row['start_day'];
			$end_day[$count] 	= $row['end_day'];

			if($number_of_day<=$end_day[$count] AND $number_of_day>=$start_day[$count])
			{
				$normal_price[$count] 	= $row['pricelist_online'];
				$register_time[$count]	= $row['register'];
			}
			else
			{
				$normal_price[$count] 	= 00000000;
				$register_time[$count]	= 00000000;
			}

			$start_time_normal[$count] 	= substr($register_time[$count], 0,2);
			$end_time_normal[$count]	= substr($register_time[$count], 4,2);

			// if($start_time<$start_time_normal[$count])
			// {
			// 	$result_1[$count]=0;
			// 	$result_2[$count]=0;
			// 	$skip="yes";
			// 	break;
			// }

			$count++;
		}

		if($skip=="no")
		{
			$maxloop 	= sizeof($normal_price);
			$loop		= 0;

			for($loop;$loop<$maxloop;$loop++)
			{
				if($start_time<$end_time_normal[$loop] AND $start_time>=$start_time_normal[$loop])
				{
					$result_1[$loop] 	= 1;
					$time_master 		= $end_time_normal[$loop];
				}
				else
				{
					$result_1[$loop] 	= 0;
					//$time_master		= $end_time;
				}

				if($end_time<=$end_time_normal[$loop] AND $end_time>$start_time_normal[$loop])
				{
					$result_2[$loop] 	= 1;
				}
				else
				{
					$result_2[$loop] 	= 0;
				}
			}
		}

		$maxloop_check	= sizeof($result_1);
		$loop			= 0;

		for($loop;$loop<$maxloop_check;$loop++)
		{
			if($result_1[$loop]==0 AND $result_2[$loop]==0)
			{
				$total[$loop] = (0*$normal_price[$loop]) + (0*$normal_price[$loop]);
			}

			if($result_1[$loop]==0 AND $result_2[$loop]==1)
			{
				$total[$loop] = (0*$normal_price[$loop]) + (($end_time-$time_master)*$normal_price[$loop]);
			}

			if($result_1[$loop]==1 AND $result_2[$loop]==0)
			{
				$total[$loop] = (($time_master-$start_time)*$normal_price[$loop]) + (0*$normal_price[$loop]);
			}

			if($result_1[$loop]==1 AND $result_2[$loop]==1)
			{
				$total[$loop] = (($end_time-$start_time)*$normal_price[$loop]);
			}
		}

		$maxloop_addAll	= sizeof($total);
		$loop			= 0;

		for($loop;$loop<$maxloop_addAll;$loop++)
		{
			$final_total = $final_total + $total[$loop];
		}

		return $final_total;
	}


	function getEndTime($start_time,$duration)
	{
		$hour 						= substr($start_time, 0,2);
		return $new_hour 	= ($hour+$duration);
	}


	function reqstorereserv($court_reg,$code_cat,$field_code,$current_date,$start_time,$duration_time,$mail,$cost)
	{
		$court_reg 			= htmlentities(addslashes($court_reg));
		$code_cat 			= htmlentities(addslashes($code_cat));
		$field_code			= htmlentities(addslashes($field_code));
		$current_date		= htmlentities(addslashes($current_date));
		$start_time 		= htmlentities(addslashes($start_time));
		$duration_time	= htmlentities(addslashes($duration_time));
		$id_user_member	= htmlentities(addslashes($mail));
		$cost 					= htmlentities(addslashes($cost));

		$methodpayment	= "1";
		$type_transfer	= "";

		$dataRespons 	= [];

		$code_book		= $this->mfsal->codebook();
		$register 		= $this->util->setRegisterDate($current_date);
		$end_time 		= $this->util->getEndTime($start_time,$duration_time);

		$this->util->setDefaultTimeZone("Asia/Bangkok");
		$date_time		= $this->util->getDateTimeToday();

		$query 							= "SELECT * FROM tbl_arena_futsal WHERE code_arena=?";
		$result_arena_info 	= $this->db->getValue($query,[$field_code]);
		$arena_name 				= $result_arena_info['nama_arena'];

		$verification 	= 0;
		$friendly_match = 0;
		$source 				= $this->mfsal->sourceonline();

		$query 							= "SELECT * FROM tbl_bank_account";
		$result_bank_account= $this->db->getValue($query);
		$account_no 				= $result_bank_account['account_no'];
		$account_name				= $result_bank_account['account_name'];
		$account_id					= $result_bank_account['id_bank'];

		$query = "INSERT INTO tbl_booking_lapangan(tanggal,date_time,register,court_reg,nama_area,code_arena,code_category,jam_mulai,jam_akhir,source,nomor_booking,verification,id_user_member,price,friendly_match,payment_method,type_transfer,account_no,account_name,id_bank) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

		$current_date = $this->util->changeFormatDateInUsualForm($current_date);

		$result_store_booking = $this->db->insertValue($query,[$current_date,$date_time,$register,$court_reg,$arena_name,$field_code,$code_cat,$start_time,$end_time,$source,$code_book,$verification,$id_user_member,$cost,$friendly_match,$methodpayment,$type_transfer,$account_no,$account_name,$account_id]);

		$query = "SELECT * FROM tbl_booking_lapangan WHERE nomor_booking=?";
		$result_booking_info = $this->db->getValue($query,[$code_book]);

		if($result_booking_info)
		{
			$this->mfsal->setIdBooking($result_booking_info['id_booking']);
			$this->mfsal->setIdProduct($court_reg);
			$this->mfsal->setAmountTransaction($cost);
			$this->mfsal->setCodeBook($code_book);
			$this->mfsal->setDateTime($date_time);
			$this->mfsal->setCustomerId($id_user_member);

			$code_book 				= $this->mfsal->getCodeBook();
			$date_transaction	= $this->mfsal->getDateTime();
			$id_user 					= $this->mfsal->getCustomerId();
			$cust_name 				= $this->mfsal->getNameCustomer($id_user);
			$amount 					= $this->mfsal->getAmountTransaction();
			$id_booking 			= $this->mfsal->getIdBooking();
			$id_product 			= $this->mfsal->getIdProduct();
			$signature 				= $this->atmb->signatureAlternativeTwo($id_booking);
			$username 				= $this->atmb->getUsername();
			$service_url 			= $this->atmb->endPointRequestPaymentCodeBersamaIDPro();

			$data_xml = $this->atmb->requestPaymentCodeBersamaID($id_booking,$id_user,$cust_name,$amount,$date_transaction,$id_product,$signature,$username);

			$respons 		= $this->atmb->requestPaymentCode($data_xml,$service_url);
			$data_parse = $this->atmb->parserXMLResponsePaymentCode($respons);

			list($vaid,$bankcode,$bookingid,$signature) = explode(",", $data_parse);

		  $query = "UPDATE tbl_booking_lapangan SET payment_code=?, bank_code=?, signature=?, booking_datetime=? WHERE id_booking=?";

		  $result_update_booking = $this->db->updateValue($query,[$vaid,$bankcode,$signature,$date_transaction,$id_booking]);

		  if($result_update_booking)
		  {
		  	$date_time		= $this->mfsal->getDateTime();
				$customer_id	= $this->mfsal->getCustomerId();

			  array_push($dataRespons,
				[
					'type'				=> 'resstorereserv',
					'success'			=> 'true',
					'code_book'		=> $code_book,
					'payment_code'=> $vaid,
					'date_time'		=> $date_time,
					'customer_id'	=> $customer_id
				]);
		  }
		  else
		  {
		  	array_push($dataRespons,
				[
					'type'				=> 'resstorereserv',
					'success'			=> 'false',
					'code_book'		=> $code_book,
					'payment_code'=> $vaid,
					'date_time'		=> $date_time,
					'customer_id'	=> $customer_id
				]);
		  }
		}

		else
		{
			array_push($dataRespons,
			[
				'type'				=> 'resstorereserv',
				'success'			=> 'false',
				'code_book'		=> '-',
				'payment_code'=> '-',
				'date_time'		=> '-',
				'customer_id'	=> '-'
			]);
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}

	public function reqstorecompetition($teamname,$id_comp,$email)
	{
		$dataRespons = [];

		$team_name 		= htmlentities(addslashes($teamname));
		$id_comp 			= htmlentities(addslashes($id_comp));
		$email 				= htmlentities(addslashes($email));

		$this->util->setDefaultTimeZone("Asia/Bangkok");
		$date_time			= $this->util->getDateTimeToday();
		$current_date 	= $this->util->getDateToday();

		$user_information		= json_decode($this->auth->getInformationUser($email));
		$id_reg_member 			= $user_information->{'id_reg'};
		$payment 						= "-";
		$bank_name 					= "-";
		$account_no 				= "-";
		$account_name 			= "-";
		$agent_code_payment	= "-";
		$verification 			= "-";
		$code_reg 					= $this->mfsal->coderegcomp();
		$lolos 							= "NULL";
		$usage_member 			= "0";
		$payment_code 			= "-";
		$bank_code 					= "-";
		$signature 					= "-";
		$booking_datetime 	= "-";
		$verification 			= "0";
		$methodpayment			= "0";
		$type_transfer			= "0-0";

		$query = "SELECT * FROM tbl_bank_account";
		$result_bank_info = $this->db->getValue($query);

		$id_bank = $result_bank_info['id_bank'];
		$query = "SELECT * FROM tbl_bank WHERE id_bank=?";
		$result_bank_data_info = $this->db->getValue($query,[$id_bank]);

		$bank_name 			= $result_bank_data_info['nama_bank'];
		$account_name 	= $result_bank_info['account_name'];
		$account_no 		= $result_bank_info['account_no'];

		$query = "INSERT INTO tbl_member_kompetisi(tanggal,nama_team,id_reg_member,id_kompetisi,payment,payment_method,type_transfer,bank_name,account_no,account_name,agent_code_payment,verification,code_reg,lolos,usage_member,payment_code,bank_code,signature,booking_datetime,date_time) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

		$result_store_competition = $this->db->insertValue($query,[$current_date,$team_name,$id_reg_member,$id_comp,$payment,$methodpayment,$type_transfer,$bank_name,$account_no,$account_name,$agent_code_payment,$verification,$code_reg,$lolos,$usage_member,$payment_code,$bank_code,$signature,$booking_datetime,$date_time]);

		if($result_store_competition)
		{
			$query = "SELECT * FROM tbl_member_kompetisi WHERE code_reg=?";
			$result_comp_info = $this->db->getValue($query,[$code_reg]);
			$id_competition 	= $result_comp_info['id_kompetisi'];

			$query 								 = "SELECT * FROM tbl_kompetisi WHERE id_kompetisi=?";
			$result_comp_full_info = $this->db->getValue($query,[$id_competition]);

			$this->mfsal->setIdBooking($result_comp_info['id_member_kompetisi']);
			$this->mfsal->setIdProduct($id_competition);
			$this->mfsal->setAmountTransaction($result_comp_full_info['biaya']);
			$this->mfsal->setCodeRegCompetition($code_reg);
			$this->mfsal->setDateTime($date_time);
			$this->mfsal->setCustomerId($email);

			$code_book 					= $this->mfsal->getCodeRegCompetition();
			$date_transaction		= $this->mfsal->getDateTime();
			$id_user 						= $this->mfsal->getCustomerId();
			$cust_name 					= $this->mfsal->getNameCustomer($email);
			$amount 						= $this->mfsal->getAmountTransaction();
			$id_member_kompetisi= $this->mfsal->getIdBooking();
			$id_product 				= $this->mfsal->getIdProduct();
			$signature 					= $this->atmb->signatureAlternativeTwo($id_member_kompetisi);
			$username 					= $this->atmb->getUsername();
			$service_url 				= $this->atmb->endPointRequestPaymentCodeBersamaIDPro();

			$data_xml = $this->atmb->requestPaymentCodeBersamaID($id_member_kompetisi,$id_user,$cust_name,$amount,$date_transaction,$id_product,$signature,$username);

			$respons 		= $this->atmb->requestPaymentCode($data_xml,$service_url);
			$data_parse = $this->atmb->parserXMLResponsePaymentCode($respons);

			list($vaid,$bankcode,$bookingid,$signature) = explode(",", $data_parse);

			$query = "UPDATE tbl_member_kompetisi SET payment_code=?, bank_code=?, signature=?, booking_datetime=? WHERE id_member_kompetisi=?";

			$result_update_member_kompetisi = $this->db->updateValue($query,[$vaid,$bankcode,$signature,$date_transaction,$id_member_kompetisi]);

			$code_reg 	= $this->mfsal->getCodeRegCompetition();
			$date_time	= $this->mfsal->getDateTime();
			$customer_id= $this->mfsal->getCustomerId();

			array_push($dataRespons,
			[
				'type'				=> 'resstorecompetition',
				'success'			=> 'true',
				'code_book'		=> $code_reg,
				'payment_code'=> $vaid,
				'date_time'		=> $date_time,
				'customer_id'	=> $customer_id
			]);
		}
		else
		{
			array_push($dataRespons,
			[
				'type'				=> 'resstorecompetition',
				'success'			=> 'false',
				'code_book'		=> '-',
				'payment_code'=> '-',
				'date_time'		=> '-',
				'customer_id'	=> '-',
			]);
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}



	public function reqreservtrx($code_book)
	{
		$dataRespons = [];

		$code_book = htmlentities(addslashes($code_book));

		$query 				= "SELECT * FROM tbl_booking_lapangan WHERE nomor_booking=?";
		$result_data 	= $this->db->getValue($query,[$code_book]);

		if($result_data)
		{
			$usage_date 	= $result_data['tanggal'];
			$area_name 		= $result_data['nama_area'];
			$court_reg 		= $result_data['court_reg'];
			$court_name 	= "";
			$start_time 	= $result_data['jam_mulai'];
			$end_time 		= $result_data['jam_akhir'];
			$code_payment	= $result_data['payment_code'];
			$price 				= $result_data['price'];
			$dataTrx 			= $result_data['booking_datetime'];
			$verification = $result_data['verification'];

			$query 							= "SELECT * FROM tbl_field_information WHERE court_reg=?";
			$result_data_court 	= $this->db->getValue($query,[$court_reg]);

			if($result_data_court)
			{
				$court_name = $result_data_court['nama_lapangan'];
			}

			array_push($dataRespons,
			[
				'type' 				=> 'resreservtrx',
				'court_name'	=> $court_name,
				'area_name'		=> $area_name,
				'date'				=> $usage_date,
				'start_date'	=> $start_time,
				'end_date'		=> $end_time,
				'payment_code'=> $code_payment,
				'price'				=> $price,
				'dataTrx'			=> $dataTrx,
				'verification'=> $verification
			]);
		}
		else
		{
			array_push($dataRespons,
			[
				'type' 				=> 'resreservtrx',
				'court_name'	=> '-',
				'area_name'		=> '-',
				'date'				=> '-',
				'start_date'	=> '-',
				'end_date'		=> '-',
				'payment_code'=> '-',
				'price'				=> '-',
				'dataTrx'			=> '-',
				'verification'=> '-',
			]);
		}

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	public function reqreservpay($mail)
	{
		$dataRespons = [];

		$mail 				= trim(htmlentities(addslashes($mail)));
		$verification = (int) "0";
		$source 			= "online";
		$reg_today 		= $this->util->setDateRegisterForToday();
		//$currenttime 	= $this->util->getTimeOnlyFromDateTime($this->util->getDateTimeToday());

		//$query = "SELECT * FROM tbl_booking_lapangan WHERE (verification=? AND id_user_member=? AND source=? AND register=?)";
		//$result_data 	= $this->db->getAllValue($query,[$verification,$mail,$source,$reg_today]);
		$query = "SELECT * FROM tbl_booking_lapangan WHERE (verification=? AND id_user_member=? AND source=?)";
		$result_data 	= $this->db->getAllValue($query,[$verification,$mail,$source]);
		
		

		if($result_data)
		{
			foreach($result_data as $datas)
			{
				$booktime 		= $datas['booking_datetime'];
				$bookcode 		= $datas['nomor_booking'];
				$starttime 		= $datas['jam_mulai'];
				$endtime 			= $datas['jam_akhir'];
				$courtreg			= $datas['court_reg'];
				$arenaname 		= "";

				$query 			= "SELECT * FROM tbl_field_information WHERE court_reg=?";
				$fetchData 	= $this->db->getValue($query,[$courtreg]);

				if($fetchData)
				{
					$arenaname = $fetchData['nama_lapangan'];
				}

				$date_str 		= $this->util->changeFormatDateFromNumberToString($booktime);
				$expiredtime	= $this->util->expiredTime($this->util->getTimeOnlyFromDateTime($booktime));

				if($currenttime<=$expiredtime)
				{
					array_push($dataRespons,
					[
						'type'				=> 'resreservpay',
						'found'				=> 'yes',
						'expired'			=> 'no',
						'arenaname'		=> $arenaname,
						'date'				=> $booktime,
						'date_str'		=> $date_str,
						'start_time'	=> $starttime,
						'end_time'		=> $endtime,
						'bookcode'		=> $bookcode
					]);
				}
				else
				{
					array_push($dataRespons,
					[
						'type'				=> 'resreservpay',
						'found'				=> 'yes',
						'expired'			=> 'yes',
						'arenaname'		=> $arenaname,
						'date'				=> $booktime,
						'date_str' 		=> $date_str,
						'start_time'	=> $starttime,
						'end_time'		=> $endtime,
						'bookcode'		=> $bookcode
					]);
				}
			}
		}
		else
		{
			array_push($dataRespons,
			[
				'type'				=> 'resreservpay',
				'found'				=> 'no',
				'expired'			=> '-',
				'arenaname'		=> '-',
				'date'				=> '-',
				'date_str' 		=> '-',
				'start_time'	=> '-',
				'end_time'		=> '-',
				'bookcode'		=> '-'
			]);
		}
		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}


	public function reqturnamentpay($mail)
	{
		$dataRespons 		= [];
		$mail 					= trim(htmlentities(addslashes($mail)));

		$user_data 			= json_decode($this->auth->getInformationUser($mail));
		$id_reg_member	= $user_data->{'id_reg'};
		$verification 	= "0";

		$reg_today 		= $this->util->setDateRegisterForToday();
		$currenttime 	= $this->util->getTimeOnlyFromDateTime($this->util->getDateTimeToday());

		$query = "SELECT * FROM tbl_member_kompetisi WHERE id_reg_member=? AND verification=?";
		$result_data = $this->db->getAllValue($query,[$id_reg_member,$verification]);

		if(!empty($result_data))
		{
			foreach($result_data as $data)
			{
				$bookdate = $data['booking_datetime'];
				$bookdate_reg = $this->util->setRegisterDate($bookdate);

				$expiredtime	= $this->util->expiredTime($this->util->getTimeOnlyFromDateTime($bookdate));

				if($reg_today<=$bookdate_reg)
				{
					if($currenttime<=$expiredtime)
					{
						$id_comp 	= $data['id_kompetisi'];

						$query 		= "SELECT * FROM tbl_kompetisi WHERE id_kompetisi=?";
						$result_compdata = $this->db->getValue($query,[$id_comp]);

						if($result_compdata)
						{
							array_push($dataRespons,
							[
								'type'			=> 'resturnamentpay',
								'found'			=> 'yes',
								'expired'		=> 'no',
								'comp_name'	=> $result_compdata['nama_kompetisi'],
								'comp_kind'	=> $result_compdata['jenis_kompetisi'],
								'price'			=> $result_compdata['biaya'],
								'start_date'=> $result_compdata['tanggal_mulai'],
								'end_date'	=> $result_compdata['tanggal_akhir'],
								'bookdate'	=> $bookdate,
								'code_reg' 	=> $data['code_reg'],
								'team_name'	=> $data['nama_team'],
								'id_comp'		=> $id_comp
							]);
						}
						else
						{
							array_push($dataRespons,
							[
								'type'			=> 'resturnamentpay',
								'found'			=> 'no',
								'expired'		=> 'no',
								'comp_name'	=> '-',
								'comp_kind'	=> '-',
								'price'			=> '-',
								'start_date'=> '-',
								'end_date'	=> '-',
								'bookcode'	=> '-',
								'code_reg'	=> '-',
								'team_name'	=> '-',
								'id_comp'		=> '-'
							]);
						}
					}
					else
					{
						// array_push($dataRespons,
						// [
						// 	'type'			=> 'resturnamentpay',
						// 	'found'			=> 'no',
						// 	'expired'		=> 'yes',
						// 	'bookcode'	=> '-',
						// 	'code_reg'	=> '-',
						// 	'id_comp'		=> '-'
						// ]);
					}
				}
				else
				{
					array_push($dataRespons,
					[
						'type'			=> 'resturnamentpay',
						'found'			=> 'yes',
						'expired'		=> 'yes',
						'comp_name'	=> '-',
						'comp_kind'	=> '-',
						'price'			=> '-',
						'start_date'=> '-',
						'end_date'	=> '-',
						'bookcode'	=> '-',
						'code_reg'	=> '-',
						'team_name'	=> '-',
						'id_comp'		=> '-'
					]);
				}
			}
		}
		else
		{
			array_push($dataRespons,
			[
				'type'			=> 'resturnamentpay',
				'found'			=> 'no',
				'expired'		=> 'no',
				'comp_name'	=> '-',
				'comp_kind'	=> '-',
				'price'			=> '-',
				'start_date'=> '-',
				'end_date'	=> '-',
				'bookcode'	=> '-',
				'code_reg'	=> '-',
				'team_name'	=> '-',
				'id_comp'		=> '-'
			]);
		}
		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}


	public function reqgetbanklist()
	{
		$dataRespons = [];

		$query = "SELECT * FROM tbl_bank ORDER BY nama_bank ASC";
		$result_data = $this->db->getAllValue($query);

		if(!empty($result_data))
		{
			foreach($result_data as $data)
			{
				$bankname = $data['nama_bank'];
				$bankcode = $data['id_bank'];

				array_push($dataRespons,
				[
					'type'			=> 'resgetbanklist',
					'bank_name'	=> $bankname,
					'bankcode'	=> $bankcode
				]);
			}
		}
		else
		{
			array_push($dataRespons,
			[
				'type'			=> 'resgetbanklist',
				'bank_name'	=> '-',
				'bankcode'	=> '-'
			]);
		}
		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}

	public function reqstorereservconf($bookcode,$date,$bankname,$owneracc,$timetrx)
	{
		$dataRespons = [];

		$bookcode = trim(htmlentities(addslashes($bookcode)));
		$date 		= htmlentities(addslashes($date));
		$bankname = htmlentities(addslashes($bankname));
		$owneracc	= htmlentities(addslashes($owneracc));
		$timetrx	= htmlentities(addslashes($timetrx));

		$query = "SELECT * FROM tbl_booking_lapangan WHERE nomor_booking=?";
		$result_booking_lapangan = $this->db->getValue($query,[$bookcode]);

		if($result_booking_lapangan)
		{
			$id_reservation = $result_booking_lapangan['id_booking'];
			$trxnominal 		= $result_booking_lapangan['price'];

			$query = "UPDATE tbl_booking_lapangan SET verification=? WHERE nomor_booking=?";
			$updatetrx = $this->db->updateValue($query,['1',$bookcode]);

			$query = "INSERT INTO tbl_transf_conf(no_booking,id_reservation,account_owner,bank_transfer,date_transfer,time_transfer,nominal_transfer) VALUES (?,?,?,?,?,?,?)";

			$result_insert = $this->db->insertValue($query,[$bookcode,$id_reservation,$owneracc,$bankname,$date,$timetrx,$trxnominal]);

			if($result_insert)
			{
				array_push($dataRespons,
				[
					'type'		=> 'resstorereservconf',
					'found'		=> 'yes',
					'success'	=> 'true'
				]);
			}
			else
			{
				array_push($dataRespons,
				[
					'type'		=> 'resstorereservconf',
					'found'		=> 'yes',
					'success' => 'false'
				]);
			}
		}
		else
		{
			array_push($dataRespons,
			[
				'type'		=> 'resstorereservconf',
				'found'		=> 'no',
				'success'	=> 'false'
			]);
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	public function reqstoreturnamenconf($bookcode,$date,$bankname,$owneracc,$timetrx)
	{
		$dataRespons = [];

		$bookcode = trim(htmlentities(addslashes($bookcode)));
		$date 		= htmlentities(addslashes($date));
		$bankname = htmlentities(addslashes($bankname));
		$owneracc	= htmlentities(addslashes($owneracc));
		$timetrx	= htmlentities(addslashes($timetrx));

		$query = "SELECT * FROM tbl_member_kompetisi WHERE code_reg=?";
		$result_booking_turnamen = $this->db->getValue($query,[$bookcode]);

		if($result_booking_turnamen)
		{
			$id_comp 				= $result_booking_turnamen['id_kompetisi'];
			$id_member_comp = $result_booking_turnamen['id_member_kompetisi'];

			$query = "SELECT * FROM tbl_kompetisi WHERE id_kompetisi=?";
			$result_com_data = $this->db->getValue($query,[$id_comp]);

			$trxnominal 		= $result_com_data['biaya'];

			$query = "UPDATE tbl_member_kompetisi SET verification=? WHERE code_reg=?";
			$updatetrx = $this->db->updateValue($query,['1',$bookcode]);

			$query = "INSERT INTO tbl_com_conf(code_reg,id_member_comp,account_name,bank_name,date_transaction,time_transfer,nominal_transaction) VALUES (?,?,?,?,?,?,?)";

			$result_insert = $this->db->insertValue($query,[$bookcode,$id_member_comp,$owneracc,$bankname,$date,$timetrx,$trxnominal]);

			if($result_insert)
			{
				array_push($dataRespons,
				[
					'type'		=> 'resstoreturnamenconf',
					'found'		=> 'yes',
					'success'	=> 'true'
				]);
			}
			else
			{
				array_push($dataRespons,
				[
					'type'		=> 'resstoreturnamenconf',
					'found'		=> 'yes',
					'success' => 'false'
				]);
			}
		}
		else
		{
			array_push($dataRespons,
			[
				'type'		=> 'resstoreturnamenconf',
				'found'		=> 'no',
				'success'	=> 'false'
			]);
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	public function reqshowtrxreservhistory($mail)
	{
		$dataRespons = [];
		$mail 				= trim(htmlentities(addslashes($mail)));
		$verification = "0";

		$query = "SELECT * FROM tbl_booking_lapangan WHERE NOT (verification=?) AND id_user_member=? ORDER BY UNIX_TIMESTAMP(date_time) DESC";
		$result_search = $this->db->getAllValue($query,[$verification,$mail]);

		if(!empty($result_search))
		{
			foreach($result_search as $data)
			{
				$id_reservation = $data['id_booking'];
				$court_reg 			= $data['court_reg'];

				$query = "SELECT * FROM tbl_transf_conf WHERE id_reservation=?";
				$result_data = $this->db->getValue($query,[$id_reservation]);

				if($result_data)
				{
					$query = "SELECT * FROM tbl_field_information WHERE court_reg=?";
					$result_courtreg_data = $this->db->getValue($query,[$court_reg]);

					array_push($dataRespons,
					[
						'type'						=> 'resshowtrxreservhistory',
						'bookcode'				=> $data['nomor_booking'],
						'datetimereserv'	=> $data['date_time'],
						'fieldname'				=> $result_courtreg_data['nama_lapangan'],
						'state'						=> $data['verification']
					]);
				}
				else
				{
					array_push($dataRespons,
					[
						'type'						=> 'resshowtrxreservhistory',
						'bookcode'				=> '-',
						'datetimereserv'	=> '-',
						'fieldname'				=> '-',
						'state'						=> '-'
					]);
				}
			}
		}
		else
		{
			array_push($dataRespons,
			[
				'type'						=> 'resshowtrxreservhistory',
				'bookcode'				=> '-',
				'datetimereserv'	=> '-',
				'fieldname'				=> '-',
				'state'						=> '-'
			]);
		}
		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}

	public function reqshowtrxturnamenhistory($mail)
	{
		$dataRespons 	= [];
		$mail 				= trim(htmlentities(addslashes($mail)));
		$verification = "0";
		$state 				= "";

		$data_user 			= json_decode($this->auth->getInformationUser($mail));
		$id_user_member = $data_user->{'id_reg'};

		$query = "SELECT * FROM tbl_member_kompetisi WHERE NOT (verification=?) AND id_reg_member=? ORDER BY UNIX_TIMESTAMP(date_time) DESC";
		$result_search = $this->db->getAllValue($query,[$verification,$id_user_member]);

		if(!empty($result_search))
		{
			foreach($result_search as $data)
			{
				$id_kompetisi = $data['id_kompetisi'];
				$nama_team 		= $data['nama_team'];
				$verification = $data['verification'];

				if($verification=="1")
				{
					$state = "1";
				}
				else if($verification=="2")
				{
					$state = "2";
				}
				else
				{
					$state = "";
				}

				$query = "SELECT * FROM tbl_kompetisi WHERE id_kompetisi=?";
				$result_data = $this->db->getValue($query,[$id_kompetisi]);

				if($result_data)
				{
					array_push($dataRespons,
					[
						'type'			=> 'resshowtrxturnamenhistory',
						'team_name'	=> $nama_team,
						'book_code'	=> $data['code_reg'],
						'comp_name'	=> $result_data['nama_kompetisi'],
						'start_date'=> $result_data['tanggal_mulai'],
						'end_date'	=> $result_data['tanggal_akhir'],
						'kind_comp'	=> $result_data['jenis_kompetisi'],
						'state'			=> $state
					]);
				}
				else
				{
					array_push($dataRespons,
					[
						'type'			=> 'resshowtrxturnamenhistory',
						'team_name'	=> '-',
						'book_code'	=> '-',
						'comp_name'	=> '-',
						'start_date'=> '-',
						'end_date'	=> '-',
						'kind_comp'	=> '-',
						'state'			=> '-'
					]);
				}
			}
		}
		else
		{
			array_push($dataRespons,
			[
				'type'			=> 'resshowtrxturnamenhistory',
				'team_name'	=> '-',
				'book_code'	=> '-',
				'comp_name'	=> '-',
				'start_date'=> '-',
				'end_date'	=> '-',
				'kind_comp'	=> '-',
				'state'			=> '-'
			]);
		}
		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}


	public function reqturnameninfobycodebook($codebook)
	{
		$dataRespons 	= [];
		$codebook 		= htmlentities(addslashes($codebook));

		$query 								= "SELECT * FROM tbl_member_kompetisi WHERE code_reg=?";
		$result_data_member 	= $this->db->getValue($query,[$codebook]);

		if($result_data_member)
		{
			$id_comp 	= $result_data_member['id_kompetisi'];

			$query 				= "SELECT * FROM tbl_kompetisi WHERE id_kompetisi=?";
			$result_data 	= $this->db->getValue($query,[$id_comp]);

			if($result_data)
			{
				array_push($dataRespons,
				[
					'type'							=> 'resturnameninfobycodebook',
					'competition_name'	=> $result_data['nama_kompetisi'],
					'start_date'				=> $result_data['tanggal_mulai'],
					'end_date'					=> $result_data['tanggal_akhir'],
					'kind_komp'					=> $result_data['jenis_kompetisi'],
					'team_name'					=> $result_data_member['nama_team'],
					'price'							=> $result_data['biaya'],
					'payment_code'			=> $result_data_member['payment_code']
				]);
			}
			else
			{
				array_push($dataRespons,
				[
					'type'							=> 'resturnameninfobycodebook',
					'competition_name'	=> '-',
					'start_date'				=> '-',
					'end_date'					=> '-',
					'kind_komp'					=> '-',
					'team_name'					=> '-',
					'price'							=> '-',
					'payment_code'			=> '-'
				]);
			}
		}
		else
		{
			array_push($dataRespons,
				[
					'type'							=> 'resturnameninfobycodebook',
					'competition_name'	=> '-',
					'start_date'				=> '-',
					'end_date'					=> '-',
					'kind_komp'					=> '-',
					'team_name'					=> '-',
					'price'							=> '-',
					'payment_code'			=> '-'
				]);
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}

	public function reqstateturnamen()
	{
		$dataRespons 	= [];
		$total_comp 	= 0;
		$total_city		= 0;
		$total_member = 0;
		$currentDate  = $this->util->setDateRegisterForToday();

		$query 				= "SELECT * FROM tbl_kompetisi";
		$calc_turnamen= $this->db->getAllValue($query);

		foreach($calc_turnamen as $calturn)
		{
			$start_date 	= $this->util->setRegisterDate($calturn['tanggal_mulai']);
			$end_date 		= $this->util->setRegisterDate($calturn['tanggal_akhir']);
			$register 		= $calturn['register'];
			$id_comp 		= $calturn['id_kompetisi'];

			$query 			= "SELECT * FROM tbl_member_kompetisi WHERE id_kompetisi=?";
			$calc_member 	= $this->db->getAllValue($query,[$id_comp]);

			foreach($calc_member as $calmember)
			{
				if($currentDate<=$register)
				{
					$total_member++;
				}
			}

			if($currentDate<=$register)
			{
				$total_comp++;
			}
		}

		$query			= "SELECT DISTINCT kota,tanggal_mulai,tanggal_akhir,register FROM tbl_kompetisi";
		$calc_city 	= $this->db->getAllValue($query);

		foreach($calc_city as $calcity)
		{
			$start_date 	= $this->util->setRegisterDate($calcity['tanggal_mulai']);
			$end_date 		= $this->util->setRegisterDate($calcity['tanggal_akhir']);
			$register 		= $calcity['register'];

			if($currentDate<=$register)
			{
				$total_city++;
			}
		}

		array_push($dataRespons,
		[
			'type'					=> 'resstateturnamen',
			'total_member'	=> $total_member,
			'total_city'		=> $total_city,
			'total_comp'		=> $total_comp
		]);

		echo json_encode($dataRespons, JSON_PRETTY_PRINT);

	}


	public function reqlistallcomp()
	{
		$dataRespons 	= [];

		$query 				= "SELECT * FROM tbl_kompetisi";
		$result_data 	= $this->db->getAllValue($query);

		$currenttime 	= $this->util->setDateRegisterForToday();

		foreach($result_data as $data)
		{
			$start_day 	= $this->util->setRegisterDate($data['tanggal_mulai']);
			$end_day 		= $this->util->setRegisterDate($data['tanggal_akhir']);
			$register 	= $data['register'];
			$city_data	= $data['kota'];

			$query 				= "SELECT * FROM tbl_city WHERE kota_id=?";
			$result_city 	= $this->db->getValue($query,[$city_data]);

			if($currenttime<=$register)
			{
				array_push($dataRespons,
				[
					'type'				=> 'reslistallcomp',
					'comp_name'		=> $data['nama_kompetisi'],
					'start_date'	=> $data['tanggal_mulai'],
					'end_date'		=> $data['tanggal_akhir'],
					'register'		=> $data['register'],
					'kind_comp'		=> $data['jenis_kompetisi'],
					'total_club'	=> $data['jumlah_club'],
					'genre'				=> $data['genre'],
					'cost'				=> $data['biaya'],
					'id_comp'			=> $data['id_kompetisi'],
					'city'				=> $result_city['kokab_nama']
				]);
			}
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	public function reqstoredatareg($fullname,$email,$password,$genre)
	{
		$dataRespons = [];

		$fullname 	    = htmlentities(addslashes($fullname));
		$email 			= trim(htmlentities(addslashes($email)));
		$password 	    = $this->util->encode(htmlentities(addslashes($password)));
		$genre 			= htmlentities(addslashes($genre));
		$level 			= "member";
		$id_reg 		= $this->mfsal->getRegId();
		$state 			= "1";
		$actv_state     = "1";
		$flag_login	    = "0";
		$flag_ft		= "1";

		$date_login = $this->util->getDateTimeToday();

		$query 	    = "SELECT * FROM tbl_user WHERE username=?";
		$chk_mail   = $this->db->getValue($query,[$email]);

		if($chk_mail)
		{
			array_push($dataRespons,
			[
				'type'		=> 'resstoredatareg',
				'found'		=> 'true',
				'status'	=> 'false'
			]);
		}
		else
		{
			$query = "INSERT INTO tbl_user(name,username,password,level,genre,id_reg,state,status_aktivasi,flag_login,flag_ft,latest_login) VALUES(?,?,?,?,?,?,?,?,?,?,?)";

			$result_data = $this->db->insertValue($query,[$fullname,$email,$password,$level,$genre,$id_reg,$state,$actv_state,$flag_login,$flag_ft,$date_login]);

			if($result_data)
			{
				array_push($dataRespons,
				[
					'type'		=> 'resstoredatareg',
					'found'		=> 'false',
					'status'	=> 'true'
				]);
			}
			else
			{
				array_push($dataRespons,
				[
					'type'		=> 'resstoredatareg',
					'found'		=> 'false',
					'status'	=> 'false'
				]);
			}
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	public function reqgetlatestlogin($mail)
	{
		$dataRespons = [];
		$mail 	= trim(htmlentities(addslashes($mail)));

		$query				= "SELECT * FROM tbl_user WHERE username=?";
		$result_data 	= $this->db->getValue($query,[$mail]);

		$date = null;
		$time = null;

		if($result_data)
		{
			$date 	= $this->util->changeFormatDateInUsualForm($result_data['latest_login']);
			$time 	= $this->util->getTimeFromDate($result_data['latest_login']);

			array_push($dataRespons,
			[
				'type' 		=> 'resgetlatestlogin',
				'found'		=> 'yes',
				'date'		=> $date,
				'time'		=> $time
			]);
		}
		else
		{
			array_push($dataRespons,
			[
				'type' 		=> 'resgetlatestlogin',
				'found'		=> 'no',
				'date'		=> $date,
				'time'		=> $time
			]);
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	public function reqinfopayment($mail)
	{
		$dataRespons 	= [];
		$verification = "0";
		$mail 				= trim(htmlentities(addslashes($mail)));
		$get_id_reg		= json_decode($this->auth->getInformationUser($mail));
		$id_reg_member= $get_id_reg->{'id_reg'};
		$book_counter = 0;
		$tour_counter = 0;
		$source 			= "online";

		$total_book_confirm 	= 0;
		$total_tour_confirm 	= 0;

		$reg_today 		= $this->util->setDateRegisterForToday();
		$currenttime 	= $this->util->getTimeOnlyFromDateTime($this->util->getDateTimeToday());

		$query = "SELECT * FROM tbl_booking_lapangan WHERE verification=? AND id_user_member=? AND source=? AND register=?";
		$result_data_book = $this->db->getAllValue($query,[$verification,$mail,$source,$reg_today]);

		if(!empty($result_data_book))
		{
			foreach ($result_data_book as $bookdata)
			{
				$booktime 		= $bookdata['booking_datetime'];
				$date_str 		= $this->util->changeFormatDateFromNumberToString($booktime);
				$expiredtime	= $this->util->expiredTime($this->util->getTimeOnlyFromDateTime($booktime));

				if($currenttime<=$expiredtime)
				{
					$total_book_confirm = $book_counter++;
				}

			}
		}


		$query = "SELECT * FROM tbl_member_kompetisi WHERE verification=? AND id_reg_member=?";
		$result_data_comp = $this->db->getAllValue($query,[$verification,$id_reg_member]);

		if(!empty($result_data_comp))
		{
			foreach($result_data_comp as $data)
			{
				$bookdate = $data['booking_datetime'];
				$bookdate_reg = $this->util->setRegisterDate($bookdate);

				$expiredtime	= $this->util->expiredTime($this->util->getTimeOnlyFromDateTime($bookdate));

				if($reg_today<=$bookdate_reg)
				{
					if($currenttime<=$expiredtime)
					{
						$total_tour_confirm = $tour_counter++;
					}
				}
			}
		}

		array_push($dataRespons,
		[
			'type'				=> 'resinfopayment',
			'total_book'	=> $total_book_confirm,
			'total_comp'	=> $total_tour_confirm
		]);

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}
	
	public function reqallslider()
	{
	   $dataRespons = [];
	   $state       = "A";
	   
	   $query   = "SELECT * FROM tbl_slider WHERE state=?";
	   $result  = $this->db->getAllValue($query,[$state]);
	   
	   foreach($result as $data)
	   {
	       $url = "http://maufutsal.com/admin_utama/image/slider/".$data['path'];
	       
	       array_push($dataRespons,
	       [
	           'type'   => 'resallslider',
	           'link'   => $url
	       ]);
	   }
	   
	   echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}   
	
	
	public function reqallfoe($mail)
	{
	    $dataRespons = [];
	    $id_user_penantang = "";
	    $owned  = "no";
	    
	    $mail   = trim(htmlentities(addslashes($mail)));
	    
	    $query      = "SELECT * FROM tbl_user WHERE username=?";
	    $result     = $this->db->getValue($query,[$mail]);
	    $id_user    = $result['id_user'];
	    
	    $query  = "SELECT * FROM tbl_cari_lawan WHERE id_user_penantang=? ORDER BY id_cari_lawan DESC";
	    $result = $this->db->getAllValue($query,[$id_user_penantang]);
	    
	    foreach($result as $data)
	    {
	        $id_province    = $data['id_provinsi'];
	        $id_kota        = $data['id_city'];
	        $id_lapangan    = $data['id_lapangan'];
	        
	        if($data['id_user_creator']==$id_user)
	        {
	            $owner = "yes";
	        }
	        
	        $query  = "SELECT * FROM tbl_provinsi WHERE provinsi_id=?";
	        $result = $this->db->getValue($query,[$id_province]);
	        $province_name = $result['provinsi_nama'];
	        
	        $query  = "SELECT * FROM tbl_city WHERE kota_id=?";
	        $result = $this->db->getValue($query,[$id_kota]);
	        $city_name = $result['kokab_nama'];
	        
	        $query  = "SELECT * FROM tbl_field_information WHERE id_field_information=?";
	        $result = $this->db->getValue($query,[$id_lapangan]);
	        $field_name = $result['nama_lapangan'];
	        
	        array_push($dataRespons,
	        [
	            'type'          => 'resallfoe',
	            'nama_team'     => $data['nama_team'],
	            'jam'           => $data['jam'],
	            'provinsi'      => $province_name,
	            'kota'          => $city_name,
	            'lapangan'      => $field_name,
	            'creator'       => $data['id_user_creator'],
	            'owned'         => $owned,
	            'id_cari_lawan' => $data['id_cari_lawan']
	            
	        ]);
	    }
	    
	    echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}
	
	
	
	public function reqallinfofoe($mail)
	{
	    $dataRespons = [];
	    $id_user_penantang = "";
	    $owned  = "no";
	    
	    $mail   = trim(htmlentities(addslashes($mail)));
	    
	    $query      = "SELECT * FROM tbl_user WHERE username=?";
	    $result     = $this->db->getValue($query,[$mail]);
	    $id_user    = $result['id_user'];
	    
	    $query  = "SELECT * FROM tbl_cari_lawan WHERE id_user_penantang=? OR id_user_creator=? ORDER BY id_cari_lawan DESC";
	    $result = $this->db->getAllValue($query,[$id_user,$id_user]);
	    
	    foreach($result as $data)
	    {
	        $id_province    = $data['id_provinsi'];
	        $id_kota        = $data['id_city'];
	        $id_lapangan    = $data['id_lapangan'];
	        
	        if($data['id_user_creator']==$id_user)
	        {
	            $owner = "yes";
	        }
	        
	        $query  = "SELECT * FROM tbl_provinsi WHERE provinsi_id=?";
	        $result = $this->db->getValue($query,[$id_province]);
	        $province_name = $result['provinsi_nama'];
	        
	        $query  = "SELECT * FROM tbl_city WHERE kota_id=?";
	        $result = $this->db->getValue($query,[$id_kota]);
	        $city_name = $result['kokab_nama'];
	        
	        $query  = "SELECT * FROM tbl_field_information WHERE id_field_information=?";
	        $result = $this->db->getValue($query,[$id_lapangan]);
	        $field_name = $result['nama_lapangan'];
	        
	        array_push($dataRespons,
	        [
	            'type'          => 'resallinfofoe',
	            'nama_team'     => $data['nama_team'],
	            'jam'           => $data['jam'],
	            'provinsi'      => $province_name,
	            'kota'          => $city_name,
	            'lapangan'      => $field_name,
	            'creator'       => $data['id_user_creator'],
	            'owned'         => $owned,
	            'id_cari_lawan' => $data['id_cari_lawan']
	            
	        ]);
	    }
	    
	    echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}
	
	
	public function reqallprovince()
	{
	    $dataRespons    = [];
	    
	    $query  = "SELECT * FROM tbl_provinsi";
	    $result = $this->db->getAllValue($query);
	    
	    foreach($result as $data)
	    {
	        array_push($dataRespons,
    	    [
    	        'type'          => 'resallprovince', 
    	        'id_province'   => $data['provinsi_id'],
    	        'nama_province' => $data['provinsi_nama']
    	    ]);
	    }
	    
	    echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}
	
	
	public function reqcity($id_province)
	{
	    $dataRespons    = [];
	    $id_province    = trim(htmlentities(addslashes($id_province)));
	    
	    $query  = "SELECT * FROM tbl_city WHERE provinsi_id=?";
	    $result = $this->db->getAllValue($query,[$id_province]);
	    
	    foreach($result as $data)
	    {
	        array_push($dataRespons,
    	    [
    	        'type'      => 'rescity', 
    	        'id_city'   => $data['kota_id'],
    	        'nama_city' => $data['kokab_nama']
    	    ]);
	    }
	    
	    echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}
	
	
	public function reqfield($id_city)
	{
	    $dataRespons    = [];
	    $id_city        = trim(htmlentities(addslashes($id_city)));
	    
	    $query  = "SELECT * FROM tbl_field_information WHERE id_kota=?";
	    $result = $this->db->getAllValue($query,[$id_city]);
	    
	    foreach($result as $data)
	    {
	        array_push($dataRespons,
    	    [
    	        'type'      => 'resfield', 
    	        'id_field'   => $data['id_field_information'],
    	        'nama_field' => $data['nama_lapangan']
    	    ]);
	    }
	    
	    echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}
	
	public function reqcreatefoe($team_name,$time_play,$id_province,$id_city,$id_field,$email)
	{
	    $dataRespons    = [];
	    $team_name      = trim(htmlentities(addslashes($team_name)));
	    $time_play      = trim(htmlentities(addslashes($time_play)));
	    $id_province    = trim(htmlentities(addslashes($id_province)));
	    $id_city        = trim(htmlentities(addslashes($id_city)));
	    $id_field       = trim(htmlentities(addslashes($id_field)));
	    $email          = trim(htmlentities(addslashes($email)));
	    
	    $query      = "SELECT * FROM tbl_user WHERE username=?";
	    $result     = $this->db->getValue($query,[$email]);
	    $id_user    = $result['id_user'];
	    
	    $query  = "INSERT INTO tbl_cari_lawan(nama_team,jam,id_provinsi,id_city,id_lapangan,id_user_creator) VALUES (?,?,?,?,?,?)";
	    $result = $this->db->insertValue($query,[$team_name,$time_play,$id_province,$id_city,$id_field,$id_user]);
	    
	    array_push($dataRespons,
	    [
	        'type'      => rescreatefoe,
	        'success'   => 'true'
	    ]);
	    
	    echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}
	
	
	public function reqsearchfoe($key)
	{
	    $dataRespons        = [];
	    $key                = "%".htmlentities(addslashes($key))."%";
	    $id_user_penantang  = "";
	    
	    $query  = "SELECT * FROM tbl_city WHERE kokab_nama LIKE ?";
	    $result = $this->db->getAllValue($query,[$key]);
	    
	    if(!empty($result))
	    {
	        foreach($result as $data)
	        {
	            $id_city = $data['kota_id'];
	            
	            
	            $query  = "SELECT * FROM tbl_cari_lawan WHERE id_city=? AND id_user_penantang=? ORDER BY id_cari_lawan DESC";
	            $dat    = $this->db->getAllValue($query,[$id_city,$id_user_penantang]);
	            
	            foreach($dat as $data_foe)
	            {
	                $id_province    = $data_foe['id_provinsi'];
        	        $id_kota        = $data_foe['id_city'];
        	        $id_lapangan    = $data_foe['id_lapangan'];
        	        
        	        $query  = "SELECT * FROM tbl_provinsi WHERE provinsi_id=?";
        	        $result = $this->db->getValue($query,[$id_province]);
        	        $province_name = $result['provinsi_nama'];
        	        
        	        $query  = "SELECT * FROM tbl_city WHERE kota_id=?";
        	        $result = $this->db->getValue($query,[$id_kota]);
        	        $city_name = $result['kokab_nama'];
        	        
        	        $query  = "SELECT * FROM tbl_field_information WHERE id_field_information=?";
        	        $result = $this->db->getValue($query,[$id_lapangan]);
        	        $field_name = $result['nama_lapangan'];
        	        
        	        array_push($dataRespons,
        	        [
        	            'type'          => 'ressearchfoe',
        	            'nama_team'     => $data_foe['nama_team'],
        	            'jam'           => $data_foe['jam'],
        	            'provinsi'      => $province_name,
        	            'kota'          => $city_name,
        	            'lapangan'      => $field_name,
        	            'creator'       => $data_foe['id_user_creator'],
        	            'id_cari_lawan' => $data_foe['id_cari_lawan']
        	            
        	        ]);
	        
	            }
	        }
	    }
	    else
	    {
	        array_push($dataRespons,
	        [
	            'type'          => 'ressearchfoe',
	            'nama_team'     => '-',
	            'jam'           => '-',
	            'provinsi'      => '-',
	            'kota'          => '-',
	            'lapangan'      => '-',
	            'creator'       => '-',
	            'id_cari_lawan' => '-'
	            
	        ]);
	    }
	    
	    echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}
	
	
	
	public function reqjoinmatch($id,$mail)
	{
	    $dataRespons = [];
	    $id     = trim(htmlentities(addslashes($id)));
	    $mail   = trim(htmlentities(addslashes($mail)));
	    
	    $query      = "SELECT * FROM tbl_user WHERE username=?";
	    $result     = $this->db->getValue($query,[$mail]);
	    $id_user    = $result['id_user'];
	    
	    $query = "SELECT * FROM tbl_cari_lawan WHERE id_cari_lawan=?";
	    $result_dat = $this->db->getValue($query,[$id]);
	    
	    $id_user_penantang = $result_dat['id_user_penantang'];
	    
	    if(!empty($id_user_penantang))
	    {
	        array_push($dataRespons,
            [
                'type'  => 'resjoinmatch',
                'state' => 'false',
            ]);
	    }
	    else
	    {
	        $query  = "UPDATE tbl_cari_lawan SET id_user_penantang=? WHERE id_cari_lawan=?";
	        $result = $this->db->updateValue($query,[$id_user,$id]);
	    
	        array_push($dataRespons,
            [
                'type'  => 'resjoinmatch',
                'state' => 'true',
            ]);
	    
	    }
	    
	    echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}
}

?>
