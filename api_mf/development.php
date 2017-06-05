<?php
	header('Access-Control-Allow-Origin: *');

	require_once('../library/database.php');
	require_once('../library/utility.php');
	require_once('../library/maufutsal.php');
	require_once('../library/class.phpmailer.php');
	require_once('../library/atmb.php');
	include('../library/supported_function.php');
	require_once('../library/class.phpmailer.php');

	$db 		= new Database();
	$util 	= new Utility();
	$mfsal 	= new Maufutsal();
	$mail 	= new PHPMailer();
	$atmb		= new ATMB();

	if(isset($_POST['type']) && !empty($_POST['type']))
	{
		switch($_POST['type'])
		{
			case 'reqallpromofieldlist':
				reqallpromofieldlist($db,$util);
				break;

			case 'reqallcomplist':
				reqallcomplist($db,$util);
				break;

			case 'reqallslamevent':
				reqallslamevent($db,$util);
				break;

			case 'reqshowfieldlistcourtreg':
				reqshowfieldlistcourtreg($db,$util,$_POST['court_reg']);
				break;

			case 'reqshowfieldlistcityid':
				reqshowfieldlistcityid($db,$util,$_POST['city_id']);
				break;

			case 'reqshowcomplistidcomp':
				reqshowcomplistidcomp($db,$util,$_POST['comp_id']);
				break;

			case 'reqshowcomplistidcity':
				reqshowcomplistidcity($db,$util,$_POST['city_id']);
				break;

			case 'reqshowslameventlistidcomp':
				reqshowslameventlistidcomp($db,$util,$_POST['comp_id']);
				break;

			case 'reqshowslameventlistidcity':
				reqshowslameventlistidcity($db,$util,$_POST['city_id']);
				break;

			case 'reqaddrreservpro':
				reqaddrreservpro($db,$util,$_POST['court_reg']);
				break;

			case 'reqaddrpay':
				reqaddrpay($db,$util,$_POST['team_name'],$_POST['id_competition']);
				break;

			case 'reqaddrpayforslam':
				reqaddrpayforslam($db,$util,$_POST['team_name'],$_POST['field'],$_POST['id_slam']);
				break;

			case 'reqcheseslog':
				reqcheseslog($util);
				break;

			case 'reqcourtinfo':
				reqcourtinfo($db,$_POST['court_reg']);
				break;

			case 'reqcourtarena':
				reqcourtarena($db,$_POST['court_reg']);
				break;

			case 'reqreservtime':
				reqreservtime($db);
				break;

			case 'reqcategory':
				reqcategory($db);
				break;

			case 'reqtimeusage':
				reqtimeusage($db);
				break;

			case 'reqstoregmember':
				reqstoregmember($db,$util,$_POST['username'],$_POST['pass'],$_POST['mail'],$_POST['cat']);
				break;

			case 'reqclearcookie':
				reqclearcookie($util);
				break;

			case 'reqchecklogin':
				reqchecklogin($db,$util,$_POST['username'],$_POST['password']);
				break;

			case 'reqchangepass':
				reqchangepass($db,$util,$_POST['oldpass'],$_POST['newpass']);
				break;

			case 'reqrespass':
				reqrespass($db,$util,$mail,$_POST['mail']);
				break;

			case 'reqchelogfb':
				reqchelogfb($db,$util,$_POST['name'],$_POST['email']);
				break;

			case 'reqgetmemberdata':
				reqgetmemberdata($db,$util);
				break;

			case 'reqreservtrans':
				reqreservtrans($db,$util,$mfsal,$_POST['current_date'],$_POST['court_reg'],$_POST['field_code'],$_POST['code_cat'],$_POST['start_time'],$_POST['duration_time']);
				break;

			case 'reqpaymentpage':
				reqpaymentpage($db,$util,$_POST['current_date'],$_POST['court_reg'],$_POST['field_code'],$_POST['code_cat'],$_POST['start_time'],$_POST['duration_time'],$_POST['cost'],$_POST['state']);
				break;

			case 'reqpaymentpagenologin':
				reqpaymentpagenologin($db,$util,$_POST['current_date'],$_POST['court_reg'],$_POST['field_code'],$_POST['code_cat'],$_POST['start_time'],$_POST['duration_time'],$_POST['cost'],$_POST['state'],$_POST['phnum']);
				break;

			case 'reqstorebooking':
				reqstorebooking($db,$util,$atmb,$mfsal,$_POST['methodpayment'],$_POST['type_transfer'],$_POST['page']);
				break;

			case 'reqsearchfield':
				reqsearchfield($db,$util,$_POST['key']);
				break;

			case 'reqcomplistname':
				reqcomplistname($db,$util,$_POST['key']);
				break;

			case 'reqslameventlist':
				reqslameventlist($db,$util,$_POST['key']);
				break;

			case 'reqsaveresconfirm':
				reqsaveresconfirm($db,$util,$_POST['date_transfer'],$_POST['time_transfer'],$_POST['bank_name'],$_POST['account_name_reserv'],$_POST['id_booking']);
				break;

			case 'reqsaveregconfirm':
				reqsaveregconfirm($db,$util,$_POST['date_transfer'],$_POST['time_transfer'],$_POST['bank_name'],$_POST['account_name_reserv'],$_POST['id_reg']);
				break;

			case 'reqsaveidcomptemp':
				reqsaveidcomptemp($db,$util,$_POST['id_comp'],$_POST['page']);
				break;

			case 'reqconfirmpage':
				reqconfirmpage($db,$util,$mfsal);
				break;

			case 'reqpagerespro':
				reqpagerespro($db,$util,$_POST['cat'],$_POST['court_reg']);
				break;

			case 'reqstorecatfb':
				reqstorecatfb($db,$util,$_POST['cat'],$_POST['email']);
				break;

			case 'reqlogout':
				reqlogout($db,$util,$_POST['email']);
				break;

			case 'reqcalculateallfield':
				reqcalculateallfield($db);
				break;

			case 'reqsavecourtref':
				reqsavecourtref($db,$util,$_POST['court_name'],$_POST['court_address'],$_POST['court_number'],$_POST['court_mail'],$_POST['court_owner'],$_POST['spons_name'],$_POST['spons_number'],$_POST['spons_mail']);
				break;

			case 'reqcourtref':
				reqcourtref($db,$util);
				break;

			case 'reqmapcordinate':
				reqmapcordinate($db,$util,$_POST['court_reg']);
				break;

			case 'reqchecompartn':
				reqchecompartn($db,$util,$mfsal,$_POST['id_competition']);
				break;

			case 'reqgetdistorder':
				reqgetdistorder($db,$util);
				break;

			case 'reqdistordereg':
				reqdistordereg($db,$util,$_POST['id_user'],$_POST['date'],$_POST['nominal'],$_POST['quantity']);
				break;

			case 'reqcost':
				reqcost($db,$util,$_POST['cat_data'],$_POST['court_reg']);
			break;
			

			default :
			break;
		}
	}
	else
	{
		badrequestpage();
	}



	function badrequestpage()
	{
		$message = "<h1>400 - Bad Request</h1>";
		$message.="<p>The request could not be understood by the server due to malformed syntax. The client SHOULD NOT repeat the request without modifications.</p>";
		$message.="<strong>{ Maufutsal Developer Team }</strong>";
		echo $message;
	}


	function reqcheseslog($util)
	{
		$dataRespons = [];

		/*
		$util->startSession();

		if(isset($_SESSION['username']))
		{
			$username = $_SESSION['username'];
		}
		else
		{
			$username = "";
		}
		*/

		if(isset($_COOKIE['maufutsal_dat']))
		{
			$username = $_COOKIE['maufutsal_dat'];
		}
		else
		{
			$username = "";
		}

		if(!empty($username))
		{
			array_push($dataRespons,
			[
				'type'			=> "rescheseslog",
				'login_state'	=> "true"
			]);
		}
		else
		{
			array_push($dataRespons,
			[
				'type'				=> 'rescheseslog',
				'login_state'	=> 'false'
			]);
		}

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function reqaddrreservpro($db,$util,$court_reg)
	{
		$court_reg 		= htmlentities(addslashes($court_reg));
		$dataRespons 	= [];

		//$util->startSession();
		session_start();
		$_SESSION['court_reg'] = $court_reg;

		array_push($dataRespons,
		[
			'type' => 'resaddrreservpro',
			'link' => 'reservprocess'
		]);

		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}


	function reqcost($db,$util,$cat_data,$court_reg)
	{
		$cat_data		= htmlentities(addslashes($cat_data));
		$court_reg		= htmlentities(addslashes($court_reg));
		$dataRespons 	= [];

		$query = "SELECT * FROM tbl_harga_lapangan WHERE code_category=? AND court_reg=?";
		$result_data = $db->getAllValue($query,[$cat_data,$court_reg]);

		foreach($result_data as $data)
		{
			$name_field 		= $data['name_field'];
			$pricelist_online	= $data['pricelist_online'];
			$valid_hour			= $data['valid_hour'];

			$query = "SELECT * FROM tbl_arena_futsal WHERE code_arena=?";
			$result_data 	= $db->getValue($query,[$name_field]);
			$nama_arena		= $result_data['nama_arena'];

			array_push($dataRespons,
			[
				'type'			=> 'rescost',
				'nama_arena'	=> $nama_arena,
				'price_online'	=> $pricelist_online,
				'valid_hour'	=> $valid_hour
			]);
		}
		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}


	function reqsaveidcomptemp($db,$util,$id_comp,$req_page)
	{
		$id_comp 		= htmlentities(addslashes($id_comp));
		$req_page 		= htmlentities(addslashes($req_page));
		$dataRespons 	= [];

		//$util->startSession();
		session_start();
		$_SESSION['id_comp'] = $id_comp;

		if($req_page=="schedulle")
		{
			array_push($dataRespons,
			[
				'type' => 'ressaveidcomptemp',
				'link' => 'dashcompinfosche'
			]);
		}
		else if($req_page=="scoring")
		{
			array_push($dataRespons,
			[
				'type' => 'ressaveidcomptemp',
				'link' => 'dashcompinfoscor'
			]);
		}
		else
		{

		}
		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}


	function reqaddrpay($db,$util,$team_name,$id_comp)
	{
		$team_name 		= htmlentities(addslashes($team_name));
		$id_comp 		= htmlentities(addslashes($id_comp));
		$dataRespons 	= [];

		setcookie("maufutsal_team_name", $util->encode($team_name), time() + (3600), "/");
		setcookie("maufutsal_id_comp", $util->encode($id_comp), time() + (3600), "/");

		array_push($dataRespons,
		[
			'type' => 'resaddrpay',
			'link' => 'reservprocesspayment'
		]);

		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}



	function reqaddrpayforslam($db,$util,$team_name,$field,$id_slam)
	{
		$team_name 		= htmlentities(addslashes($team_name));
		$id_slam 		= htmlentities(addslashes($id_slam));
		$field 			= htmlentities(addslashes($field));

		$dataRespons 	= [];

		setcookie("maufutsal_team_name", $util->encode($team_name), time() + (3600), "/");
		setcookie("maufutsal_slam_dat", $util->encode($id_slam), time() + (3600), "/");
		setcookie("maufutsal_field_dat", $util->encode($field), time() + (3600), "/");

		array_push($dataRespons,
		[
			'type' => 'resaddrpayforslam',
			'link' => 'reservprocesspayment'
		]);

		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}



	function reqsearchfield($db,$util,$key)
	{
		$key = "%".htmlentities(addslashes($key))."%";
		$dataRespons = [];

		$query = "SELECT * FROM tbl_city WHERE kokab_nama LIKE ?";
		$result_search_city = $db->getAllValue($query,[$key]);

		if($result_search_city!=NULL)
		{
			foreach ($result_search_city as $row)
			{
				array_push($dataRespons,
				[
					'type'		=> 'ressearchfield',
					'court_reg'	=>	'-',
					'id_kota'	=> $row['kota_id']
				]);
			}
		}
		else
		{
			$query = "SELECT * FROM tbl_field_information WHERE nama_lapangan LIKE ?";
			$result_field_info = $db->getAllValue($query,[$key]);

			foreach ($result_field_info as $row)
			{
				array_push($dataRespons,
				[
					'type'		=> 'ressearchfield',
					'court_reg'	=> $row['court_reg'],
					'id_kota'	=> $row['id_kota']
				]);
			}
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}



	function reqcomplistname($db,$util,$key)
	{
		$default_key	= "Kota ".ucfirst(strtolower(htmlentities(addslashes($key))));
		$key 			= "%".htmlentities(addslashes($key))."%";
		$dataRespons 	= [];

		$query = "SELECT * FROM tbl_city WHERE kokab_nama=?";
		$result_search_city_default = $db->getValue($query,[$default_key]);

		$id_city = $result_search_city_default['kota_id'];

		if(empty($result_search_city_default))
		{
			$query = "SELECT * FROM tbl_city WHERE kokab_nama LIKE ?";
			$result_search_city = $db->getAllValue($query,[$key]);

			if(!empty($result_search_city))
			{
				foreach ($result_search_city as $row)
				{
					array_push($dataRespons,
					[
						'type'			=> 'rescomplistname',
						'id_competition'=>	'-',
						'id_city'		=> $row['kota_id']
					]);
				}
			}
			else
			{
				$query = "SELECT * FROM tbl_kompetisi WHERE nama_kompetisi LIKE ?";
				$result_comp_info = $db->getAllValue($query,[$key]);

				foreach ($result_comp_info as $row)
				{
					array_push($dataRespons,
					[
						'type'			=> 'rescomplistname',
						'id_competition'=> $row['id_kompetisi'],
						'id_city'		=> $row['kota']
					]);
				}
			}
		}
		else
		{
			array_push($dataRespons,
			[
				'type'			=> 'rescomplistname',
				'id_competition'=>	'-',
				'id_city'		=> $id_city
			]);
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}




	function reqslameventlist($db,$util,$key)
	{
		$key = "%".htmlentities(addslashes($key))."%";
		$dataRespons = [];

		$query = "SELECT * FROM tbl_city WHERE kokab_nama LIKE ?";
		$result_search_city = $db->getAllValue($query,[$key]);

		if($result_search_city!=NULL)
		{
			foreach ($result_search_city as $row)
			{
				array_push($dataRespons,
				[
					'type'			=> 'resslameventlist',
					'id_competition'=>	'-',
					'id_city'		=> $row['kota_id']
				]);
			}
		}
		else
		{
			$query = "SELECT * FROM tbl_kompetisi WHERE nama_kompetisi LIKE ?";
			$result_comp_info = $db->getAllValue($query,[$key]);

			foreach ($result_comp_info as $row)
			{
				array_push($dataRespons,
				[
					'type'			=> 'resslameventlist',
					'id_competition'=> $row['id_kompetisi'],
					'id_city'		=> $row['kota']
				]);
			}
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function reqshowcomplistidcomp($db,$util,$id_comp)
	{
		$id_comp 		= explode(",",htmlentities(addslashes($id_comp)));
		$dataRespons 	= [];

		$util->setDefaultTimeZone("Asia/Bangkok");
		$reg_date_today = $util->setDateRegisterForToday();

		foreach ($id_comp as $data_comp)
		{
			$query = "SELECT * FROM tbl_kompetisi WHERE id_kompetisi=?";
			$result_competition_info = $db->getAllValue($query,[$data_comp]);

			if(!empty($result_competition_info))
			{
				foreach ($result_competition_info as $data)
				{
					$competition_name	= $data['nama_kompetisi'];
					$start_date 		= $data['tanggal_mulai'];
					$end_date 			= $data['tanggal_akhir'];
					$kind_comp			= $data['jenis_kompetisi'];
					$city_id			= $data['kota'];
					$club_number 		= $data['jumlah_club'];
					$cost 				= $data['biaya'];
					$id_competition 	= $data['id_kompetisi'];

					$query = "SELECT * FROM tbl_city WHERE kota_id=?";
					$result_city_info = $db->getValue($query,[$city_id]);

					if($kind_comp!="ajang")
					{
						$reg_end_date	= $util->setRegisterDate($end_date);
						$limit_date 	= $util->limitDate($reg_date_today,($reg_end_date));

						if($limit_date=="1")
						{
							array_push($dataRespons,
							[
								'type'						=> 'resshowcomplistidcomp',
								'competition_name'=> $competition_name,
								'start_date'			=> $start_date,
								'end_date'				=> $end_date,
								'kind_comp'				=> $kind_comp,
								'city_id'					=> $city_id,
								'city_name'				=> $result_city_info['kokab_nama'],
								'club_number'			=> $club_number,
								'cost'						=> $cost,
								'id_competition'	=> $id_competition
							]);
						}
						else
						{
							array_push($dataRespons,
							[
								'type'						=> 'resshowcomplistidcomp',
								'competition_name'=> '-',
								'start_date'			=> '-',
								'end_date'				=> '-',
								'kind_comp'				=> '-',
								'city_id'					=> '-',
								'city_name'				=> '-',
								'club_number'			=> '-',
								'cost'						=> '-',
								'id_competition'	=> '-'
							]);
						}
					}
				}
			}
			else
			{
				array_push($dataRespons,
				[
					'type'						=> 'resshowcomplistidcomp',
					'competition_name'=> '-',
					'start_date'			=> '-',
					'end_date'				=> '-',
					'kind_comp'				=> '-',
					'city_id'					=> '-',
					'city_name'				=> '-',
					'club_number'			=> '-',
					'cost'						=> '-',
					'id_competition'	=> '-'
				]);
			}
		}

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function reqshowslameventlistidcomp($db,$util,$id_comp)
	{
		$id_comp 		= explode(",",htmlentities(addslashes($id_comp)));
		$dataRespons 	= [];

		$util->setDefaultTimeZone("Asia/Bangkok");
		$reg_date_today = $util->setDateRegisterForToday();

		foreach ($id_comp as $data_comp)
		{
			$query = "SELECT * FROM tbl_kompetisi WHERE id_kompetisi=?";
			$result_competition_info = $db->getAllValue($query,[$data_comp]);

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
					$result_city_info = $db->getValue($query,[$city_id]);

					if($kind_comp=="ajang")
					{
						array_push($dataRespons,
						[
							'type'						=> 'resshowslameventlistidcomp',
							'competition_name'=> $competition_name,
							'start_date'			=> $start_date,
							'end_date'				=> $end_date,
							'kind_comp'				=> $kind_comp,
							'city_id'					=> $city_id,
							'city_name'				=> $result_city_info['kokab_nama'],
							'club_number'			=> $club_number,
							'cost'						=> $cost,
							'id_competition'	=> $id_competition
						]);
					}
				}
			}
			else
			{
				array_push($dataRespons,
				[
					'type'						=> 'resshowslameventlistidcomp',
					'competition_name'=> '-',
					'start_date'			=> '-',
					'end_date'				=> '-',
					'kind_comp'				=> '-',
					'city_id'					=> '-',
					'city_name'				=> '-',
					'club_number'			=> '-',
					'cost'						=> '-',
					'id_competition'	=> '-'
				]);
			}
		}

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function reqshowslameventlistidcity($db,$util,$id_city)
	{
		$id_comp 			= explode(",",htmlentities(addslashes($id_city)));
		$dataRespons 	= [];

		foreach ($id_comp as $data_city)
		{
			$query = "SELECT * FROM tbl_kompetisi WHERE kota=?";
			$result_comp_info = $db->getAllValue($query,[$data_city]);

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

				$query = "SELECT * FROM tbl_city WHERE kota_id=?";
				$result_city_info = $db->getValue($query,[$city_id]);

				if($kind_comp=="ajang")
				{
					array_push($dataRespons,
					[
						'type'							=> 'resshowslameventlistidcity',
						'competition_name'	=> $competition_name,
						'start_date'				=> $start_date,
						'end_date'					=> $end_date,
						'kind_comp'					=> $kind_comp,
						'city_id'						=> $city_id,
						'city_name'					=> $result_city_info['kokab_nama'],
						'club_number'				=> $club_number,
						'cost'							=> $cost,
						'id_competition'		=> $id_competition
					]);
				}
			}
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}



	function reqshowcomplistidcity($db,$util,$id_city)
	{
		$id_comp 			= explode(",",htmlentities(addslashes($id_city)));
		$dataRespons 	= [];

		$util->setDefaultTimeZone("Asia/Bangkok");
		$reg_date_today = $util->setDateRegisterForToday();

		foreach ($id_comp as $data_city)
		{
			$query = "SELECT * FROM tbl_kompetisi WHERE kota=?";
			$result_comp_info = $db->getAllValue($query,[$data_city]);

			if(!empty($result_comp_info))
			{
				foreach ($result_comp_info as $data)
				{
					$competition_name	= $data['nama_kompetisi'];
					$start_date 		= $data['tanggal_mulai'];
					$end_date 			= $data['tanggal_akhir'];
					$kind_comp			= $data['jenis_kompetisi'];
					$city_id			= $data['kota'];
					$club_number 		= $data['jumlah_club'];
					$cost 				= $data['biaya'];
					$id_competition 	= $data['id_kompetisi'];

					$query = "SELECT * FROM tbl_city WHERE kota_id=?";
					$result_city_info = $db->getValue($query,[$city_id]);

					if($kind_comp!="ajang")
					{
						$reg_end_date 	= $util->setRegisterDate($end_date);
						$limit_date		= $util->limitDate($reg_date_today,$reg_end_date);

						if($limit_date=="1")
						{
							array_push($dataRespons,
							[
								'type'				=> 'resshowcomplistidcity',
								'competition_name'	=> $competition_name,
								'start_date'		=> $start_date,
								'end_date'			=> $end_date,
								'kind_comp'			=> $kind_comp,
								'city_id'			=> $city_id,
								'city_name'			=> $result_city_info['kokab_nama'],
								'club_number'		=> $club_number,
								'cost'				=> $cost,
								'id_competition'	=> $id_competition
							]);
						}
						else
						{
							array_push($dataRespons,
							[
								'type'				=> 'resshowcomplistidcity',
								'competition_name'	=> '-',
								'start_date'		=> '-',
								'end_date'			=> '-',
								'kind_comp'			=> '-',
								'city_id'			=> '-',
								'city_name'			=> '-',
								'club_number'		=> '-',
								'cost'				=> '-',
								'id_competition'	=> '-'
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


	function reqshowfieldlistcourtreg($db,$util,$court_reg)
	{
		$court_reg 		=  explode(",",htmlentities(addslashes($court_reg)));
		$dataRespons 	= [];
		$promo_state	= 0;

		foreach ($court_reg as $data_court_reg)
		{
			$util->setDefaultTimeZone("Asia/Bangkok");
			$reg_date_today = $util->setDateRegisterForToday();

			$query = "SELECT * FROM tbl_field_information WHERE court_reg=?";
			$result_field_info = $db->getAllValue($query,[$data_court_reg]);

			foreach ($result_field_info as $data)
			{
				$court_name 	= $data['nama_lapangan'];
				$court_address 	= $data['alamat'];
				$city_id		= $data['id_kota'];

				$query = "SELECT * FROM tbl_city WHERE kota_id=?";
				$result_city = $db->getValue($query,[$city_id]);

				$query	= "SELECT * FROM tbl_link_promo WHERE court_reg=? ORDER BY reg_date_end ASC";
				$result_promo = $db->getAllValue($query,[$data_court_reg]);

				if(!empty($result_promo))
				{
					foreach ($result_promo as $data_promo)
					{
						$reg_date_end = $data_promo['reg_date_end'];
						$promo_limitation = $util->limitDate($reg_date_today,$reg_date_end);

						if($promo_limitation==1)
						{
							$promo_state = 1;

							array_push($dataRespons,
							[
								'type'			=> "resshowfieldlistcourtreg",
						    	'date_start'	=> $data_promo['date_start'],
						     	'date_end' 		=> $data_promo['date_end'],
						    	'reg_date_start'=> $data_promo['reg_date_start'],
						     	'reg_date_end' 	=> $data_promo['reg_date_end'],
						     	'court_reg'		=> $data_court_reg,
						      	'court_name' 	=> $court_name,
						      	'court_address' => $court_address,
						      	'link' 			=> $data_promo['link'],
						      	'promo_price' 	=> $data_promo['promo_price'],
						      	'normal_price'	=> '-',
						      	'id_kota' 		=> $result_city['kokab_nama']
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
						$result_normal = $db->getAllValue($query,[$data_court_reg]);
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
							'type'			=> "resshowfieldlistcourtreg",
					    	'date_start'	=> "-",
					     	'date_end' 		=> "-",
					    	'reg_date_start'=> "-",
					     	'reg_date_end' 	=> "-",
					     	'court_reg'		=> $data_court_reg,
					      	'court_name' 	=> $court_name,
					      	'court_address' => $court_address,
					      	'link' 			=> "-",
					      	'promo_price' 	=> "-",
					      	'normal_price'	=> $lowest_price,
					      	'id_kota' 		=> $result_city['kokab_nama']
						]);

					}
				}

				$promo_state = 0;
			}
		}// end of foreach outside

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function reqshowfieldlistcityid($db,$util,$city_id)
	{
		$city_id 		=  explode(",",htmlentities(addslashes($city_id)));
		$dataRespons 	= [];
		$promo_state	= 0;
		$court_reg 		= "";

		foreach ($city_id as $data_city_id)
		{
			$util->setDefaultTimeZone("Asia/Bangkok");
			$reg_date_today = $util->setDateRegisterForToday();

			$query = "SELECT * FROM tbl_field_information WHERE id_kota=?";
			$result_field_info = $db->getAllValue($query,[$data_city_id]);

			foreach ($result_field_info as $data)
			{
				$court_reg 			= $data['court_reg'];
				$court_name 		= $data['nama_lapangan'];
				$court_address 	= $data['alamat'];
				$city_id				= $data['id_kota'];

				$query = "SELECT * FROM tbl_city WHERE kota_id=?";
				$result_city = $db->getValue($query,[$data_city_id]);

				$query	= "SELECT * FROM tbl_link_promo WHERE court_reg=? ORDER BY reg_date_end ASC";
				$result_promo = $db->getAllValue($query,[$court_reg]);

				if(!empty($result_promo))
				{
					foreach ($result_promo as $data_promo)
					{
						$reg_date_end = $data_promo['reg_date_end'];
						$promo_limitation = $util->limitDate($reg_date_today,$reg_date_end);

						if($promo_limitation==1)
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
						    'id_kota' 			=> $result_city['kokab_nama']
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
						$result_normal = $db->getAllValue($query,[$court_reg]);
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
					    'id_kota' 			=> $result_city['kokab_nama']
						]);

					}
				}
				$promo_state = 0;
			}
		}

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}



	function reqallpromofieldlist($db,$util)
	{
		$dataRespons = [];

		$util->setDefaultTimeZone("Asia/Bangkok");
		$reg_date_today = $util->setDateRegisterForToday();

		$query	= "SELECT * FROM tbl_link_promo";
		$result	= $db->getAllValue($query);

		foreach ($result as $data)
		{
			$reg_date_end						= $data['reg_date_end'];
			$result_in_promo_limit 	= $util->limitDate($reg_date_today,$reg_date_end);

			if($result_in_promo_limit==1)
			{

				$court_reg					= $data['court_reg'];
				$query_court_name		= "SELECT * FROM tbl_field_information WHERE court_reg=?";
				$result_court_name	= $db->getValue($query_court_name,[$court_reg]);
				$court_name 				= $result_court_name['nama_lapangan'];
				$court_address			= $result_court_name['alamat'];


				$id_kota 					= $data['id_kota'];
				$query_city_name	= "SELECT * FROM tbl_city WHERE kota_id=?";
				$result_city_name	= $db->getValue($query_city_name,[$id_kota]);
				$city_name 				= $result_city_name['kokab_nama'];

				$date_start = $util->changeFormatDateFromNumberToString($data['date_start']);
				$date_end 	= $util->changeFormatDateFromNumberToString($data['date_end']);

				array_push($dataRespons,
				[
					'type'					=> "resallpromofieldlist",
			    'date_start'		=> $date_start,
			    'date_end' 			=> $date_end,
			    'reg_date_start'=> $data['reg_date_start'],
			    'reg_date_end' 	=> $data['reg_date_end'],
			    'court_reg'			=> $data['court_reg'],
			    'court_name' 		=> $court_name,
			    'court_address' => $court_address,
			    'link' 					=> $data['link'],
			    'promo_price' 	=> $data['promo_price'],
			    'normal_price'	=> "-",
			    'id_kota' 			=> $city_name,
			    'promo_state'		=> "yes"
	    		]);
	    	}
	    	else
	    	{
	    		array_push($dataRespons,
				[
					'type'					=> "resallpromofieldlist",
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
			    'promo_state'		=> "no"
	    		]);
	    	}
		}
		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}


	function reqallcomplist($db,$util)
	{
		$dataRespons = [];

		$util->setDefaultTimeZone("Asia/Bangkok");
		$reg_date_today = $util->setDateRegisterForToday();

		$query = "SELECT * FROM tbl_kompetisi ORDER BY id_kompetisi ASC";
		$result_get_all_comp = $db->getAllValue($query);

		foreach ($result_get_all_comp as $data)
		{
			$date_comp_expired 	= $data['tanggal_akhir'];
			$id_city 						= $data['kota'];

			$query 						= "SELECT * FROM tbl_city WHERE kota_id=?";
			$result_city_info = $db->getValue($query,[$id_city]);

			$result_check_comp 	= $util->setRegisterDate($date_comp_expired);
			$limit_date 				= $util->limitDate($reg_date_today,$result_check_comp);

			if($data['jenis_kompetisi']!="ajang")
			{
				if($limit_date==1)
				{
					array_push($dataRespons,
					[
						'type'							=> "resallcomplist",
						'competition_name'	=> $data['nama_kompetisi'],
						'date_start'				=> $data['tanggal_mulai'],
						'date_end'					=> $data['tanggal_akhir'],
						'register'					=> $data['register'],
						'kind_comp'					=> $data['jenis_kompetisi'],
						'cost'							=> $data['biaya'],
						'id_eo_detail'			=> $data['id_eo_detail'],
						'city_name'					=> $result_city_info['kokab_nama'],
						'id_competition'		=> $data['id_kompetisi']
					]);
				}
				else if($limit_date==0)
				{

				}
				else
				{
					array_push($dataRespons,
					[
						'type'				=> "resallcomplist",
						'competition_name'	=> "-",
						'date_start'		=> "-",
						'date_end'			=> "-",
						'register'			=> "-",
						'kind_comp'			=> "-",
						'cost'				=> "-",
						'id_eo_detail'		=> "-",
						'city_name'			=> "-",
						'id_competition'	=> "-"
					]);
				}
			}
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function reqallslamevent($db,$util)
	{
		$dataRespons = [];

		$util->setDefaultTimeZone("Asia/Bangkok");
		$reg_date_today = $util->setDateRegisterForToday();

		$query = "SELECT * FROM tbl_kompetisi ORDER BY id_kompetisi ASC";
		$result_get_all_comp = $db->getAllValue($query);

		foreach ($result_get_all_comp as $data)
		{
			$date_comp_expired 	= $data['tanggal_akhir'];
			$id_city 			= $data['kota'];

			$query = "SELECT * FROM tbl_city WHERE kota_id=?";
			$result_city_info = $db->getValue($query,[$id_city]);

			$result_check_comp 	= $util->setRegisterDate($date_comp_expired);
			$limit_date 		= $util->limitDate($reg_date_today,$result_check_comp);

			if($data['jenis_kompetisi']=="ajang")
			{
				if($limit_date==1)
				{
					array_push($dataRespons,
					[
						'type'				=> "resallslamevent",
						'competition_name'	=> $data['nama_kompetisi'],
						'date_start'		=> $data['tanggal_mulai'],
						'date_end'			=> $data['tanggal_akhir'],
						'register'			=> $data['register'],
						'kind_comp'			=> $data['jenis_kompetisi'],
						'cost'				=> $data['biaya'],
						'id_eo_detail'		=> $data['id_eo_detail'],
						'city_name'			=> $result_city_info['kokab_nama'],
						'id_competition'	=> $data['id_kompetisi']
					]);
				}
				else
				{
					array_push($dataRespons,
					[
						'type'				=> "resallslamevent",
						'competition_name'	=> "-",
						'date_start'		=> "-",
						'date_end'			=> "-",
						'register'			=> "-",
						'kind_comp'			=> "-",
						'cost'				=> "-",
						'id_eo_detail'		=> "-",
						'city_name'			=> "-",
						'id_competition'	=> "-"
					]);
				}
			}

		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}



	function reqcourtinfo($db,$court_reg)
	{
		$court_reg = htmlentities(addslashes($court_reg));
		$dataRespons = [];

		$query = "SELECT * FROM tbl_field_information WHERE court_reg=?";
		$result_court_name = $db->getValue($query,[$court_reg]);

		array_push($dataRespons,
		[
			'type'			=> "rescourtinfo",
			'field_name'	=> $result_court_name['nama_lapangan'],
			'time_ops'		=> $result_court_name['jam_ops'],
			'address'		=> $result_court_name['alamat'],
			'id_prov'		=> $result_court_name['id_prov'],
			'id_city'		=> $result_court_name['id_kota'],
			'court_reg'		=> $result_court_name['court_reg'],
			'id_user'		=> $result_court_name['id_user'],
			'id_field_info'	=> $result_court_name['id_field_information'],
		]);

		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}


	function reqcourtarena($db,$court_reg)
	{
		$court_reg = htmlentities(addslashes($court_reg));
		$dataRespons = [];

		$query = "SELECT * FROM tbl_arena_futsal WHERE court_reg=? ORDER BY nama_arena ASC";
		$result_court_name = $db->getAllValue($query,[$court_reg]);

		foreach($result_court_name as $data)
		{
			array_push($dataRespons,
			[
				'type'		=> "rescourtarena",
				'arena_name'=> $data['nama_arena'],
				'arena_code'=> $data['code_arena'],
				'id_arena'	=> $data['id_arean']
			]);
		}

		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}


	function reqreservtime($db)
	{
		$dataRespons = [];

		$query = "SELECT * FROM tbl_waktu";
		$result_reserv_time = $db->getAllValue($query);

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



	function reqrespass($db,$util,$mail,$email)
	{
		$dataRespons = [];
		$email = htmlentities(addslashes($email));

		$query = "SELECT * FROM tbl_user WHERE username=?";
		$result_check_mail = $db->getValue($query,[$email]);

		if(!empty($result_check_mail))
		{
			$name = $result_check_mail['name'];

			$send  = false;

			$seed = str_split('abcdefghijklmnopqrstuvwxyz'.'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
    			shuffle($seed);
	    		$rand = '';
	    		foreach (array_rand($seed, 5) as $k)
	    		{
	    			$rand .= $seed[$k];
	    		}

			$random_pass = $rand;
			$encode_random_pass = $util->encode($random_pass);

			$query="UPDATE tbl_user SET password=? WHERE username=?";
			$result_change_password = $db->updateValue($query,[$encode_random_pass,$email]);

			$mail->IsSMTP();
			$mail->SMTPSecure = 'ssl';
			$mail->Host = "www.maufutsal.com"; 		//source hosting
			$mail->SMTPDebug = 1;
			$mail->Port = 465;
			$mail->SMTPAuth = true;
			$mail->Username = "resetter@maufutsal.com"; 		//sender mail
			$mail->Password = "zaq1xsw2"; 				//sender mail's password
			$mail->SetFrom("resetter@maufutsal.com","Password Resetter"); 	//sender
			$mail->AddReplyTo('resetter@maufutsal.com', 'Password Resetter' );
			$mail->Subject = "Pemulihan Kata Sandi"; 		//Email subject
			$mail->AddAddress($email,$name);  		//destination mail

			$message = "<h1>Hallo,".$name."</h1>";
			$message .= "<br>Permintaan reset password Anda telah diproses. Password Anda yang baru adalah "."<strong>".$random_pass."</strong>";
			$message .="<br><br>Silahkan login menggunakan password ini. Apabila ingin mengganti password dengan yang lebih mudah diingat, cukup menggunakan menu ganti password";
			$message .="<br><br>Terima kasih.";
			$message .= "<br><br><br><br><small>Email ini dikirim secara otomatis. mohon untuk tidak membalas email ini.</small>";

			$mail->MsgHTML($message);

			if($mail->Send())
			{
				$send = true;
			}
			else
			{
				$send = false;
			}


			if($send==true)
			{
				array_push($dataRespons,
				[
					'type'		=> 'resrespass',
					'success'	=>	$send,
					'registered'=> 'true'
				]);
			}
			else
			{
				array_push($dataRespons,
				[
					'type'		=> 'resrespass',
					'success'	=>	$send,
					'registered'=> 'true'
				]);
			}
		}
		else
		{
			array_push($dataRespons,
				[
					'type'		=> 'resrespass',
					'success'	=> $send,
					'registered'=> 'false'
				]);
		}

		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}



	function reqcategory($db)
	{
		$dataRespons = [];

		$query = "SELECT * FROM tbl_category";
		$result_category = $db->getAllValue($query);

		foreach($result_category as $data)
		{
			array_push($dataRespons,
			[
				'type'			=> "rescategory",
				'category_name'	=> $data['nama_kategori'],
				'category_code'	=> $data['code_kategori'],
			]);
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function reqtimeusage($db)
	{
		$dataRespons = [];

		$query = "SELECT * FROM tbl_jam_pemakaian";
		$result_time_usage = $db->getAllValue($query);

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
					'type'		=> "restimeusage",
					'time_usage'=> $data['jam']
				]);
			}

		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function reqstoregmember($db,$util,$username,$pass,$mail,$cat)
	{
		$username 	= htmlentities(addslashes($username));
		//$pass 		= $util->encryptpass(htmlentities(addslashes($pass)));
		$pass 		= $util->encode(htmlentities(addslashes($pass)));
		$mail 		= htmlentities(addslashes($mail));
		$cat 		= htmlentities(addslashes($cat));
		$level		= "member";

		$dataRespons = [];

		$query = "SElECT * FROM tbl_user WHERE username=?";
		$result_check_mail = $db->getValue($query,[$mail]);

		if($result_check_mail['username']==$mail)
		{
			array_push($dataRespons,
			[
				'type'		=> "resstoregmember",
				'registered'=> "true",
				'success'	=> "false"
			]);
		}
		else
		{
			$id_reg 			= (date("Ymd").time());
			$status				= 0;
			$code_activation	= md5(uniqid(rand()));

			$query = "INSERT INTO tbl_user(name,username,password,level,genre,id_reg,status_aktivasi,kode_aktivasi)VALUES(?,?,?,?,?,?,?,?)";
			$store_in_user_table = $db->insertValue($query,[$username,$mail,$pass,$level,$cat,$id_reg,$status,$code_activation]);

			$query = "INSERT INTO tbl_detail_member(name,email,genre,id_reg) VALUES(?,?,?,?)";
			$store_in_detail_member_table = $db->insertValue($query,[$username,$mail,$cat,$id_reg]);

			$store_in_detail_member_table;

			if($store_in_user_table==1 AND $store_in_detail_member_table==1)
			{
				setcookie("maufutsal_dat", $util->encode($mail), time() + (86400 * 30), "/");
				array_push($dataRespons,
				[
					'type'		=> "resstoregmember",
					'registered'=> "false",
					'success'	=> "true"
				]);
			}

			else
			{
				array_push($dataRespons,
				[
					'type'		=> "resstoregmember",
					'registered'=> "false",
					'success'	=> "false"
				]);
			}
		}

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}



	function reqchangepass($db,$util,$oldpass,$newpass)
	{
		$oldpass 	= $util->encode(htmlentities(addslashes($oldpass)));
		$newpass 	= $util->encode(htmlentities(addslashes($newpass)));
		$email 		= $util->decode($_COOKIE['maufutsal_dat']);
		$dataRespons= [];

		$query = "SELECT * FROM tbl_user WHERE password=? AND username=?";
		$result_check = $db->getValue($query,[$oldpass,$email]);

		if($result_check['username']==$email)
		{
			$query = "UPDATE tbl_user SET password=? WHERE username=?";
			$result_change_pass = $db->updateValue($query,[$newpass,$email]);

			array_push($dataRespons,
			[
				'type'		=> 'reschangepass',
				'success'	=> 'true'
			]);
		}
		else
		{
			array_push($dataRespons,
			[
				'type'		=> 'reschangepass',
				'success'	=> 'false'
			]);
		}

		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}



	function reqclearcookie($util)
	{
		$dataRespons = [];
		$success = "false";

		if(isset($_COOKIE['maufutsal_dat']))
		{
			$data = $util->decode($_COOKIE["maufutsal_dat"]);
			setcookie("maufutsal_dat", $util->encode($data), time()-3600, "/");
			$success = "true";
		}
		else
		{
			$success = "false";
		}

		array_push($dataRespons,
		[
			"type"		=> 'resclearcookie',
			"success"	=> $success
		]);

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function reqchecklogin($db,$util,$username,$password)
	{
		$username 	= htmlentities(addslashes($username));
		//$password 	= $util->encryptpass(htmlentities(addslashes($password)));
		$password 	= $util->encode(htmlentities(addslashes($password)));

		$dataRespons = [];

		$query = "SELECT * FROM tbl_user WHERE username=? AND password=?";
		$result_check_login = $db->getValue($query,[$username,$password]);

		if($result_check_login['username']==$username)
		{
			//$util->startSession();
			//$_SESSION['username'] = $result_check_login['username'];
			setcookie("maufutsal_dat", $util->encode($username), time() + (86400 * 30), "/");

			array_push($dataRespons,
			[
				'type'			=> "reschecklogin",
				'level'			=> $result_check_login['level'],
				'genre'			=> $result_check_login['genre'],
				'activation'	=> $result_check_login['status_aktivasi'],
				'registered'	=> "true"
			]);
		}
		else
		{
			array_push($dataRespons,
			[
				'type'			=> "reschecklogin",
				'level'			=> "-",
				'genre'			=> "-",
				'activation'	=> "-",
				'registered'	=> "false"
			]);
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function reqchelogfb($db,$util,$name,$email)
	{
		$email = htmlentities(addslashes($email));

		$genre 				= "";
		$activation 	= "-";
		$registered 	= "false";
		$level 				= "-";
		$dataRespons 	= [];

		$query 					= "SELECT * FROM tbl_user WHERE username=?";
		$result_user_fb = $db->getValue($query,[$email]);

		if(!empty($result_user_fb))
		{
			if($result_user_fb['username']==$email)
			{
				$registered = 'true';
				setcookie("maufutsal_dat", $util->encode($email), time() + (86400 * 30), "/");

				if(!empty($result_user_fb['genre']))
				{
					$genre 			= $result_user_fb['genre'];
					$activation = $result_user_fb['status_aktivasi'];
					$level 			= $result_user_fb['level'];
				}
				else
				{
					$activation = $result_user_fb['status_aktivasi'];
					$level 			= $result_user_fb['level'];
					//$registered = 'already';
				}
			}
			else
			{
				$registered = 'false';
			}
		}
		else
		{
			$activation = "1";
			$id_reg 		= (date("Ymd").time());
			$level 			= "member";

			$query = "INSERT INTO tbl_user(name,username,level,status_aktivasi,id_reg) VALUES(?,?,?,?,?)";
			$result_email_register = $db->insertValue($query,[$name,$email,$level,$activation,$id_reg]);

			if($result_email_register==1)
			{
				$query 					= "SELECT * FROM tbl_user WHERE username=?";
				$result_user_fb = $db->getValue($query,[$email]);

				$genre 			= $result_user_fb['genre'];
				$activation = $result_user_fb['status_aktivasi'];
				$level 			= $result_user_fb['level'];

				setcookie("maufutsal_dat", $util->encode($email), time() + (86400 * 30), "/");
				$registered = 'true';
			}
			else
			{
				$registered = 'false';
			}
		}

		array_push($dataRespons,
		[
			'type'			=> "reschelogfb",
			'level'			=> $level,
			'genre'			=> $genre,
			'activation'=> $activation,
			'registered'=> $registered
		]);

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function reqgetmemberdata($db,$util)
	{
		$dataRespons = [];
		/*
		$util->startSession();
		$username = $_SESSION['username'];
		*/

		$username = $util->decode($_COOKIE['maufutsal_dat']);

		$query = "SELECT * FROM tbl_user WHERE username=?";
		$result_member_data = $db->getValue($query,[$username]);

		array_push($dataRespons,
		[
			'type'			=> "resgetmemberdata",
			'level'			=> $result_member_data['level'],
			'genre'			=> $result_member_data['genre'],
			'activation'	=> $result_member_data['status_aktivasi'],
			'registered'	=> "true"
		]);

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}



	function reqreservtrans($db,$util,$mfsal,$current_date,$court_reg,$field_code,$code_cat,$start_time,$duration_time)
	{
		$dataResponse 	= [];
		$book_state		= "";
		$promo_state	= "";
		$final_price	= 0;

		$current_date 	= htmlentities(addslashes($current_date));
		$court_reg		= htmlentities(addslashes($court_reg));
		$field_code		= htmlentities(addslashes($field_code));
		$start_time		= htmlentities(addslashes($start_time));
		$duration_time	= htmlentities(addslashes($duration_time));
		$code_cat		= htmlentities(addslashes($code_cat));

		$result_open_hour = $mfsal->checkOpenHours($court_reg,$field_code,date('N',strtotime($current_date)),$code_cat,substr($start_time,0,2),getEndTime($start_time,$duration_time));

		if($result_open_hour==1)
		{
			$current_date 	= $util->setRegisterDate($current_date);
			$end_time		= $util->getEndTime($start_time,$duration_time);

			$result_check_book = $mfsal->checkAvailableBook($current_date,$field_code,$court_reg,substr($start_time,0,2),substr($end_time,0,2));

			if($result_check_book==1)
			{
				$book_state	= "available";
				$promo_state = checkAvailablePromo($db,$util,$current_date,$court_reg,$field_code);

				if($promo_state=="true")
				{
					$final_price = calculatePromoPrice($db,$court_reg,$field_code,date('N', strtotime($current_date)),$code_cat,substr($start_time,0,2),getEndTime($start_time,$duration_time));
				}
				else
				{
					$final_price = calculateNormalPrice($db,$court_reg,$field_code,date('N', strtotime($current_date)),$code_cat,substr($start_time,0,2),getEndTime($start_time,$duration_time));
				}
			}
			else
			{
				$book_state	= "unavailable";
				$promo_state = "false";
			}


			if(getEndTime($start_time,$duration_time)<10)
			{
				$end_time = "0".getEndTime($start_time,$duration_time).":00";
			}
			else
			{
				$end_time = getEndTime($start_time,$duration_time).":00";
			}


			array_push($dataResponse,
			[
				'type'			=> 'resreservtrans',
				'book_state'	=> $book_state,
				'promo_state'	=> $promo_state,
				'final_cost'	=> $final_price,
				'date_usage'	=> $start_time." - ".$end_time
			]);
		}
		else
		{
			if(getEndTime($start_time,$duration_time)<10)
			{
				$end_time = "0".getEndTime($start_time,$duration_time).":00";
			}
			else
			{
				$end_time = getEndTime($start_time,$duration_time).":00";
			}

			array_push($dataResponse,
			[
				'type'			=> 'resreservtrans',
				'book_state'	=> 'unavailable',
				'promo_state'	=> 'false',
				'final_cost'	=> '0',
				'date_usage'	=> $start_time." - ".$end_time
			]);
		}

		echo json_encode($dataResponse, JSON_PRETTY_PRINT);
	}



	function reqpaymentpage($db,$util,$current_date,$court_reg,$field_code,$code_cat,$start_time,$duration_time,$cost,$state)
	{
		$dataRespons = [];

		if($state==="available" AND $cost!="0")
		{
			session_start();

			$_SESSION['current_date'] = $util->encode($current_date);
			$_SESSION['court_reg']		= $util->encode($court_reg);
			$_SESSION['field_code']		= $util->encode($field_code);
			$_SESSION['code_cat']			= $util->encode($code_cat);
			$_SESSION['start_time']		= $util->encode($start_time);
			$_SESSION['duration_time']= $util->encode($duration_time);
			$_SESSION['cost']					= $util->encode($cost);
			$_SESSION['state']				= $util->encode($state);

			array_push($dataRespons,
			[
				'type'		=> 'respaymentpage',
				'warning'	=> 	'false',
				'link'		=> 'reservprocesspayment'
			]);
		}

		else
		{
			array_push($dataRespons,
			[
				'type'		=> 'respaymentpage',
				'warning'	=> 	'true',
				'link'		=> 'reservprocesspayment'
			]);
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}



	function reqpaymentpagenologin($db,$util,$current_date,$court_reg,$field_code,$code_cat,$start_time,$duration_time,$cost,$state,$phnum)
	{
		$dataRespons = [];

		if($state==="available" AND $cost!="0")
		{
			session_start();

			$_SESSION['current_date'] = $util->encode($current_date);
			$_SESSION['court_reg']		= $util->encode($court_reg);
			$_SESSION['field_code']		= $util->encode($field_code);
			$_SESSION['code_cat']			= $util->encode($code_cat);
			$_SESSION['start_time']		= $util->encode($start_time);
			$_SESSION['duration_time']= $util->encode($duration_time);
			$_SESSION['cost']					= $util->encode($cost);
			$_SESSION['state']				= $util->encode($state);
			setcookie("maufutsal_dat_ph", $util->encode($phnum), time() + (1200), "/");

			array_push($dataRespons,
			[
				'type'		=> 'respaymentpagenologin',
				'warning'	=> 	'false',
				'link'		=> 'reservprocesspayment'
			]);
		}

		else
		{
			array_push($dataRespons,
			[
				'type'		=> 'respaymentpagenologin',
				'warning'	=> 'true',
				'link'		=> 'reservprocesspayment'
			]);
		}

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}



	function reqstorebooking($db,$util,$atmb,$mfsal,$methodpayment,$type_transfer,$page)
	{
		$dataRespons = [];

		$methodpayment 	= htmlentities(addslashes($methodpayment));
		$type_transfer 	= htmlentities(addslashes($type_transfer));
		$page 	= htmlentities(addslashes($page));

		if($methodpayment==0)
		{
			if($page=="competition")
			{
				$result_store_competition = $mfsal->storecompetition($methodpayment,$type_transfer);

				if($result_store_competition==1)
				{
					$code_reg 	= $mfsal->getCodeRegCompetition();
					$date_time	= $mfsal->getDateTime();
					$customer_id= $mfsal->getCustomerId();

					setcookie("maufutsal_dat_comp_code", $util->encode($code_reg), time() + (3600), "/");
					setcookie("maufutsal_dat_reserv_date_time", $util->encode($date_time), time() + (3600), "/");

					$link = 'reservconfirm';
					array_push($dataRespons,
					[
						'type'			=> 'resstorebooking',
						'success'		=> 'true',
						'code_book'		=> $code_reg,
						'payment_code'	=> '-',
						'date_time'		=> $date_time,
						'customer_id'	=> $customer_id,
						'link'			=> $link
					]);
				}
			}
			else if($page=="reservprocess")
			{
				$result_store_booking = $mfsal ->storeonlinebookbytransfer($methodpayment,$type_transfer);

				if($result_store_booking==1)
				{
					$code_book 	= $mfsal->getCodeBook();
					$date_time	= $mfsal->getDateTime();
					$customer_id= $mfsal->getCustomerId();

					setcookie("maufutsal_dat_reserv_code", $util->encode($code_book), time() + (3600), "/");
					setcookie("maufutsal_dat_reserv_date_time", $util->encode($date_time), time() + (3600), "/");

					$link = 'reservconfirm';
					array_push($dataRespons,
					[
						'type'				=> 'resstorebooking',
						'success'			=> 'true',
						'code_book'		=> $code_book,
						'payment_code'=> '-',
						'date_time'		=> $date_time,
						'customer_id'	=> $customer_id,
						'link'				=> $link
					]);
				}
			}
			else if($page=="slamevent")
			{
				$result_store_slam_event = $mfsal->storeslamevent($methodpayment,$type_transfer);

				if($result_store_slam_event==1)
				{
					$code_reg 	= $mfsal->getCodeRegSlamEvent();
					$date_time	= $mfsal->getDateTime();
					$customer_id= $mfsal->getCustomerId();

					setcookie("maufutsal_dat_slam_code", $util->encode($code_reg), time() + (3600), "/");
					setcookie("maufutsal_dat_reserv_date_time", $util->encode($date_time), time() + (3600), "/");

					$link = 'reservconfirm';
					array_push($dataRespons,
					[
						'type'				=> 'resstorebooking',
						'success'			=> 'true',
						'code_book'		=> $code_reg,
						'payment_code'=> '-',
						'date_time'		=> $date_time,
						'customer_id'	=> $customer_id,
						'link'				=> $link
					]);
				}
			}
			else
			{

			}
		}

		else if($methodpayment==1)
		{
			if($page=="reservprocess")
			{
				$result_store_booking = $mfsal ->storeonlinebookbypaymentcode($methodpayment,$type_transfer);

				if($result_store_booking==1)
				{
					$code_book 			= $mfsal->getCodeBook();
					$date_transaction	= $mfsal->getDateTime();
					$id_user 				= $mfsal->getCustomerId();
					$cust_name 			= $mfsal->getNameCustomer($id_user);
					$amount 				= $mfsal->getAmountTransaction();
					$id_booking 		= $mfsal->getIdBooking();
					$id_product 		= $mfsal->getIdProduct();
					$signature 			= $atmb->signatureAlternativeThree($id_booking);
					$username 			= $atmb->getUsername();
					$service_url 		= $atmb->endPointRequestPaymentCodeBersamaIDPro();
					//$service_url 		= "http://localhost/curl_atm/target.php";

					$data_xml = $atmb->requestPaymentCodeBersamaID($id_booking,$id_user,$cust_name,$amount,$date_transaction,$id_product,$signature,$username);

					$respons 		= $atmb->requestPaymentCode($data_xml,$service_url);
					$data_parse = $atmb->parserXMLResponsePaymentCode($respons);

					list($vaid,$bankcode,$bookingid,$signature) = explode(",", $data_parse);

				  $query = "UPDATE tbl_booking_lapangan SET payment_code=?, bank_code=?, signature=?, booking_datetime=? WHERE id_booking=?";

				  $result_update_booking = $db->updateValue($query,[$vaid,$bankcode,$signature,$date_transaction,$id_booking]);

				  $code_reg 	= $mfsal->getCodeBook();
					$date_time	= $mfsal->getDateTime();
					$customer_id= $mfsal->getCustomerId();

					setcookie("maufutsal_dat_reserv_code", $util->encode($code_book), time() + (3600), "/");
					setcookie("maufutsal_dat_reserv_date_time", $util->encode($date_time), time() + (3600), "/");

			    $link = 'reservconfirm';

					array_push($dataRespons,
					[
						'type'				=> 'resstorebooking',
						'success'			=> 'true',
						'code_book'		=> $code_reg,
						'payment_code'=> $vaid,
						'date_time'		=> $date_time,
						'customer_id'	=> $customer_id,
						'link'				=> $link
					]);
				}
			}
			else if($page=="competition")
			{
				$result_store_competition = $mfsal->storecompetition($methodpayment,$type_transfer);

				if($result_store_competition==1)
				{
					$code_book 					= $mfsal->getCodeRegCompetition();
					$date_transaction		= $mfsal->getDateTime();
					$id_user 						= $mfsal->getCustomerId();
					$cust_name 					= $mfsal->getNameCustomer($id_user);
					$amount 						= $mfsal->getAmountTransaction();
					$id_member_kompetisi= $mfsal->getIdBooking();
					$id_product 				= $mfsal->getIdProduct();
					$signature 					= $atmb->signatureAlternativeThree($id_member_kompetisi);
					$username 					= $atmb->getUsername();
					$service_url 				= $atmb->endPointRequestPaymentCodeBersamaIDPro();
					//$service_url 		= "http://localhost/curl_atm/target.php";

					$data_xml = $atmb->requestPaymentCodeBersamaID($id_member_kompetisi,$id_user,$cust_name,$amount,$date_transaction,$id_product,$signature,$username);

					$respons 		= $atmb->requestPaymentCode($data_xml,$service_url);
					$data_parse = $atmb->parserXMLResponsePaymentCode($respons);

					list($vaid,$bankcode,$bookingid,$signature) = explode(",", $data_parse);

					$query = "UPDATE tbl_member_kompetisi SET payment_code=?, bank_code=?, signature=?, booking_datetime=? WHERE id_member_kompetisi=?";

				  $result_update_member_kompetisi = $db->updateValue($query,[$vaid,$bankcode,$signature,$date_transaction,$id_member_kompetisi]);

				  $code_reg 	= $mfsal->getCodeRegCompetition();
					$date_time	= $mfsal->getDateTime();
					$customer_id= $mfsal->getCustomerId();

					setcookie("maufutsal_dat_comp_code", $util->encode($code_reg), time() + (3600), "/");
					setcookie("maufutsal_dat_reserv_date_time", $util->encode($date_time), time() + (3600), "/");

					$link = 'reservconfirm';
					array_push($dataRespons,
					[
						'type'				=> 'resstorebooking',
						'success'			=> 'true',
						'code_book'		=> $code_reg,
						'payment_code'=> $vaid,
						'date_time'		=> $date_time,
						'customer_id'	=> $customer_id,
						'link'				=> $link
					]);
				}
			}
			else if($page=="slamevent")
			{
				$result_store_slam_event = $mfsal->storeslamevent($methodpayment,$type_transfer);

				if($result_store_slam_event==1)
				{
					$code_book 				= $mfsal->getCodeRegSlamEvent();
					$date_transaction	= $mfsal->getDateTime();
					$id_user 				= $mfsal->getCustomerId();
					$cust_name 			= $mfsal->getNameCustomer($id_user);
					$amount 				= $mfsal->getAmountTransaction();
					$id_member_kompetisi= $mfsal->getIdBooking();
					$id_product 		= $mfsal->getIdProduct();
					$signature 			= $atmb->signatureAlternativeThree($id_member_kompetisi);
					$username 			= $atmb->getUsername();
					//$service_url 		= $atmb->endPointRequestPaymentCodeBersamaID();
					$service_url 		= "http://localhost/curl_atm/target.php";

					$data_xml = $atmb->requestPaymentCodeBersamaID($id_member_kompetisi,$id_user,$cust_name,$amount,$date_transaction,$id_product,$signature,$username);

					$respons 		= $atmb->requestPaymentCode($data_xml,$service_url);
					$data_parse = $atmb->parserXMLResponsePaymentCode($respons);

					list($vaid,$bankcode,$bookingid,$signature) = explode(",", $data_parse);

					$query = "UPDATE tbl_member_kompetisi SET payment_code=?, bank_code=?, signature=?, booking_datetime=? WHERE id_member_kompetisi=?";

				  $result_update_member_kompetisi = $db->updateValue($query,[$vaid,$bankcode,$signature,$date_transaction,$id_member_kompetisi]);

				  $code_reg 	= $mfsal->getCodeRegSlamEvent();
					$date_time	= $mfsal->getDateTime();
					$customer_id= $mfsal->getCustomerId();

					setcookie("maufutsal_dat_slam_code", $util->encode($code_reg), time() + (3600), "/");
					setcookie("maufutsal_dat_reserv_date_time", $util->encode($date_time), time() + (3600), "/");

					$link = 'reservconfirm';
					array_push($dataRespons,
					[
						'type'				=> 'resstorebooking',
						'success'			=> 'true',
						'code_book'		=> $code_reg,
						'payment_code'=> $vaid,
						'date_time'		=> $date_time,
						'customer_id'	=> $customer_id,
						'link'				=> $link
					]);
				}
			}
			else
			{

			}
		}

		else if($methodpayment==4)
		{
			if($page=="competition")
			{
				$result_store_competition = $mfsal->storecompetition($methodpayment,$type_transfer);

				if($result_store_competition==1)
				{
					$code_reg 	= $mfsal->getCodeRegCompetition();
					$date_time	= $mfsal->getDateTime();
					$customer_id= $mfsal->getCustomerId();

					setcookie("maufutsal_dat_comp_code", $util->encode($code_reg), time() + (3600), "/");
					setcookie("maufutsal_dat_reserv_date_time", $util->encode($date_time), time() + (3600), "/");

					$link = 'reservconfirm';
					array_push($dataRespons,
					[
						'type'				=> 'resstorebooking',
						'success'			=> 'true',
						'code_book'		=> $code_reg,
						'payment_code'=> '-',
						'date_time'		=> $date_time,
						'customer_id'	=> $customer_id,
						'link'				=> $link
					]);
				}
			}
			else if($page=="reservprocess")
			{
				$result_store_booking = $mfsal ->storeonlinebookbyagent($methodpayment,$type_transfer);

				if($result_store_booking==1)
				{
					$code_book 	= $mfsal->getCodeBook();
					$date_time	= $mfsal->getDateTime();
					$customer_id= $mfsal->getCustomerId();

					setcookie("maufutsal_dat_reserv_code", $util->encode($code_book), time() + (3600), "/");
					setcookie("maufutsal_dat_reserv_date_time", $util->encode($date_time), time() + (3600), "/");

					$link = 'reservconfirm';
					array_push($dataRespons,
					[
						'type'				=> 'resstorebooking',
						'success'			=> 'true',
						'code_book'		=> $code_book,
						'payment_code'=> '-',
						'date_time'		=> $date_time,
						'customer_id'	=> $customer_id,
						'link'				=> $link
					]);
				}
			}
			else if($page=="slamevent")
			{
				$result_store_slam_event = $mfsal->storeslamevent($methodpayment,$type_transfer);

				if($result_store_slam_event==1)
				{
					$code_reg 	= $mfsal->getCodeRegSlamEvent();
					$date_time	= $mfsal->getDateTime();
					$customer_id= $mfsal->getCustomerId();

					setcookie("maufutsal_dat_slam_code", $util->encode($code_reg), time() + (3600), "/");
					setcookie("maufutsal_dat_reserv_date_time", $util->encode($date_time), time() + (3600), "/");

					$link = 'reservconfirm';
					array_push($dataRespons,
					[
						'type'				=> 'resstorebooking',
						'success'			=> 'true',
						'code_book'		=> $code_reg,
						'payment_code'=> '-',
						'date_time'		=> $date_time,
						'customer_id'	=> $customer_id,
						'link'				=> $link
					]);
				}
			}
			else
			{

			}

		}

		else
		{

		}
		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}


	function reqsaveresconfirm($db,$util,$date_transfer,$time_transfer,$bank_name,$account_name_reserv,$id_booking)
	{
		$date_transfer			= htmlentities(addslashes($date_transfer));
		$time_transfer			= htmlentities(addslashes($time_transfer));
		$bank_name					= htmlentities(addslashes($bank_name));
		$account_name_reserv= htmlentities(addslashes($account_name_reserv));
		$id_booking					= htmlentities(addslashes($id_booking));
		$verification = "1";

		$dataRespons = [];

		$query = "INSERT INTO tbl_transf_conf(id_reservation,account_owner,bank_transfer,date_transfer,time_transfer) VALUES(?,?,?,?,?)";
		$result_store_reserv_transfer = $db->insertValue($query,[$id_booking,$account_name_reserv,$bank_name,$date_transfer,$time_transfer]);


		$query = "UPDATE tbl_booking_lapangan SET verification=? WHERE id_booking=?";
		$result_update_verification = $db->updateValue($query,[$verification,$id_booking]);

		if($result_store_reserv_transfer==1)
		{
			array_push($dataRespons,
			[
				'type'		=> 'ressaveresconfirm',
				'success'	=> 'true'
			]);
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}



	function reqsaveregconfirm($db,$util,$date_transfer,$time_transfer,$bank_name,$account_name_reserv,$id_reg)
	{
		$date_transfer			= htmlentities(addslashes($date_transfer));
		$time_transfer			= htmlentities(addslashes($time_transfer));
		$bank_name					= htmlentities(addslashes($bank_name));
		$account_name_reserv= htmlentities(addslashes($account_name_reserv));
		$id_reg							= htmlentities(addslashes($id_reg));
		$verification 			= "1";

		$dataRespons = [];

		$query = "INSERT INTO tbl_com_conf(id_member_comp,account_name,bank_name,date_transaction,time_transfer) VALUES(?,?,?,?,?)";
		$result_store_reserv_transfer = $db->insertValue($query,[$id_reg,$account_name_reserv,$bank_name,$date_transfer,$time_transfer]);


		$query = "UPDATE tbl_member_kompetisi SET verification=? WHERE id_member_kompetisi=?";
		$result_update_verification = $db->updateValue($query,[$verification,$id_reg]);

		if($result_store_reserv_transfer==1)
		{
			array_push($dataRespons,
			[
				'type'		=> 'ressaveregconfirm',
				'success'	=> 'true'
			]);
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function reqlogout($db,$util,$email)
	{
		$email	= htmlentities(addslashes($email));

		$dataRespons = [];
		setcookie("maufutsal_dat", $util->decode($email) , time()-3600, "/");

		array_push($dataRespons,
		[
			'type'		=> 'reslogout',
			'success'	=> 'true'
		]);

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}

	function reqconfirmpage($db,$util,$mfsal)
	{
		$dataRespons = [];

		array_push($dataRespons,
		[
			'type'	=> 'resconfirmpage',
			'link'	=> 'dashreservconfirm'
		]);

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function reqpagerespro($db,$util,$cat,$court_reg)
	{
		$cat	= htmlentities(addslashes($cat));
		$dataRespons = [];

		setcookie("maufutsal_cat_dat", $util->encode($cat) , time() + (900), "/");
		session_start();
		$_SESSION['court_reg'] = $court_reg;

		array_push($dataRespons,
		[
			'type'	=> 'respagerespro',
			'link'	=> 'reservprocess'
		]);

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function reqstorecatfb($db,$util,$cat,$email)
	{
		$cat		= htmlentities(addslashes($cat));
		$email	= htmlentities(addslashes($email));

		$dataRespons = [];

		$query = "UPDATE tbl_user SET genre=? WHERE username=?";
		echo $result_update_genre = $db->updateValue($query,[$cat,$email]);


		array_push($dataRespons,
		[
			'type'		=> 'resstorecatfb',
			'success'	=> 'true'
		]);
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function reqcalculateallfield($db)
	{
		$counter 	= 0;
		$total		= 0;
		$dataRespons = [];

		$query = "SELECT * FROM tbl_field_information";
		$result_num_data = $db->getAllValue($query);

		foreach ($result_num_data as $data_num)
		{
			$counter++;

		}

		$total = $counter;
		array_push($dataRespons,
		[
			'type'				=> 'rescalculateallfield',
			'total_field'	=> $total
		]);

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function reqsavecourtref($db,$util,$court_name,$court_address,$court_number,$court_mail,$court_owner,$spons_name,$spons_number,$spons_mail)
	{
		$court_name			= htmlentities(addslashes($court_name));
		$court_address	= htmlentities(addslashes($court_address));
		$court_number		= htmlentities(addslashes($court_number));
		$court_mail			= htmlentities(addslashes($court_mail));
		$court_owner		= htmlentities(addslashes($court_owner));
		$spons_name			= htmlentities(addslashes($spons_name));
		$spons_number		= htmlentities(addslashes($spons_number));
		$spons_mail			= htmlentities(addslashes($spons_mail));

		$dataRespons = [];

		$query = "INSERT INTO tbl_court_ref(nama_lap,alamat,no_telp_lap,email_lap,personal,sponsor,no_telp_sponsor,email_sponsor) VALUES(?,?,?,?,?,?,?,?)";
		$result_insert_court_ref = $db->insertValue($query,[$court_name,$court_address,$court_number,$court_mail,$court_owner,$spons_name,$spons_number,$spons_mail]);

		array_push($dataRespons,
		[
			'type'		=> 'ressavecourtref',
			'success'	=> 'true'
		]);

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function reqcourtref($db,$util)
	{
		$dataRespons = [];

		array_push($dataRespons,
		[
			'type'		=> 'rescourtref',
			'link'		=> 'courtref'
		]);

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function reqmapcordinate($db,$util,$court_reg)
	{
		$dataRespons = [];
		$court_reg 	= htmlentities(addslashes($court_reg));

		$query = "SELECT * FROM tbl_field_cordinate WHERE court_reg=?";
		$result_cordinate = $db->getValue($query,[$court_reg]);

		if(!empty($result_cordinate))
		{
			$lat = $result_cordinate['lat'];
			$lng = $result_cordinate['lng'];

			array_push($dataRespons,
			[
				'type'=> 'resmapcordinate',
				'lat'	=> $lat,
				'lng'	=> $lng
			]);
		}
		else
		{
			array_push($dataRespons,
			[
				'type'=> 'resmapcordinate',
				'lat'	=> '-',
				'lng'	=> '-'
			]);
		}

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}

	function reqchecompartn($db,$util,$mfsal,$id_competition)
	{
		$dataRespons 		= [];
		$id_competition = htmlentities(addslashes($id_competition));
		$email_user 		= $util->decode($_COOKIE['maufutsal_dat']);

		$id_reg_member 	= $mfsal->getIDRegistration($email_user);

		$query = "SELECT * FROM tbl_member_kompetisi WHERE id_kompetisi=? AND id_reg_member=?";
		$result_check_participant = $db->getValue($query,[$id_competition,$id_reg_member]);

		if(!empty($result_check_participant))
		{
			array_push($dataRespons,
			[
				'type'		=> 'reschecompartn',
				'joined'	=> 'yes',
			]);
		}
		else
		{
			array_push($dataRespons,
			[
				'type'		=> 'reschecompartn',
				'joined'	=> 'no',
			]);
		}

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function reqgetdistorder($db,$util)
	{
		$dataRespons 	= [];
		$condition 		= "1";

		$query 			= "SELECT * FROM tbl_pengajuan_item_distributor WHERE kondisi_pengajuan=? ORDER BY id_pengajuan DESC";
		$result_get = $db->getAllValue($query,[$condition]);

		if(!empty($result_get))
		{
			foreach($result_get as $data)
			{
				$id_user 				= $data['id_user'];

				$query 					= "SELECT * FROM tbl_user WHERE id_user=?";
				$user_inf_data 	= $db->getValue($query,[$id_user]);
				$id_reg 				= $user_inf_data['id_reg'];

				$query 					= "SELECT * FROM tbl_field_information WHERE id_user=?";
				$field_inf_data	= $db->getValue($query,[$id_user]);
				$id_city 				= $field_inf_data['id_kota'];

				$query 					= "SELECT * FROM tbl_city WHERE kota_id=?";
				$city_inf_data	= $db->getValue($query,[$id_city]);
				$city_name 			= $city_inf_data['kokab_nama'];

				array_push($dataRespons,
				[
					'type'					=> 'resgetdistorder',
					'id_user'				=> $data['id_user'],
					'id_reg'				=> $id_reg,
					'futsal_name'		=> $user_inf_data['name'],
					'city'					=> $city_name,
					'date'					=> $data['tanggal'],
					'nominal'				=> $data['nominal'],
					'quantity'			=> $data['kuantitas'],
					'payment_state'	=> $data['status_pembayaran'],
					'condition'			=> $data['kondisi_pengajuan']
				]);
			}
		}
		else
		{
			array_push($dataRespons,
			[
				'type'					=> 'resgetdistorder',
				'id_user'				=> '-',
				'id_reg'				=> '-',
				'futsal_name'		=> '-',
				'city'					=> '-',
				'date'					=> '-',
				'nominal'				=> '-',
				'quantity'			=> '-',
				'payment_state'	=> '-',
				'condition'			=> '-'
			]);
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}

function reqdistordereg($db,$util,$id_user,$date,$nominal,$quantity)
{
	$id_user 				= htmlentities(addslashes($id_user));
	$date 					= htmlentities(addslashes($date));
	$nominal 				= htmlentities(addslashes($nominal));
	$quantity 			= htmlentities(addslashes($quantity));
	$condition			= "1";
	$payment_state 	= "belum";
	$dataRespons		= [];

	$query 		= "INSERT INTO tbl_pengajuan_item_distributor(id_user,tanggal,nominal,kuantitas,status_pembayaran,kondisi_pengajuan) VALUES(?,?,?,?,?,?)";
	$result 	= $db->insertValue($query,[$id_user,$date,$nominal,$quantity,$payment_state,$condition]);

	if($result)
	{
		array_push($dataRespons,
		[
			'type'	=> 'resdistordereg',
			'state'	=> 'success'
		]);
	}
	else
	{
		array_push($dataRespons,
		[
			'type'	=> 'resdistordereg',
			'state'	=> 'fail'
		]);
	}

	echo json_encode($dataRespons,JSON_PRETTY_PRINT);
}
?>
