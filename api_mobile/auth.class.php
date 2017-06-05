<?php

class Auth
{
	private $db;
	private $util;
	private $mail;

	public function __construct($database,$utility,$mail)
	{
		$this->db 	= $database;
		$this->util = $utility;
		$this->mail = $mail;
	}

	public function reqlogin($mail,$pass)
	{
		$dataRespons = [];

		$mail = trim(htmlentities(addslashes($mail)));
		$pass = htmlentities(addslashes($pass));

		$pass 			= $this->util->encode($pass);
		$date_login = $this->util->getDateTimeToday();

		$query 		= "SELECT * FROM tbl_user WHERE username=? AND password=? ";
		$chk_data	= $this->db->getValue($query,[$mail,$pass]);

		if($chk_data)
		{

			$id_user			= $chk_data['id_user'];
			$flag_ft			= $chk_data['flag_ft'];
			$query 				= "UPDATE tbl_user SET flag_login=?, latest_login=? WHERE id_user=?";
			$update_flag 	= $this->db->updateValue($query,["1",$date_login,$id_user]);

			array_push($dataRespons,
			[
				'type'		=> 	'reschklogin',
				'mail'      =>  $mail,
				'name'      =>  $chk_data['name'],
				'result'	=>	'true',
				'flag_ft'	=> 	$flag_ft
			]);
		}
		else
		{
			$flag_ft			= $chk_data['flag_ft'];

			array_push($dataRespons,
			[
				'type'		=> 	'reschklogin',
				'mail'      =>  $mail,
				'name'      =>  $chk_data['name'],
				'result'	=>	'false',
				'flag_ft'	=> 	$flag_ft
			]);
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	public function reqchecklogin($mail)
	{
		$dataRespons	= [];

		$mail	= trim(htmlentities(addslashes($mail)));

		$query 			= "SELECT * FROM tbl_user WHERE username=?";
		$fetch_data = $this->db->getValue($query,[$mail]);

		if($fetch_data)
		{
			$flag_login = $fetch_data['flag_login'];

			if($flag_login==1)
			{
				array_push($dataRespons,
				[
					'type'			=> 'reschecklogin',
					'state'			=> 'act',
					'flag_login'=> $flag_login,
					'register'	=> 'yes'
				]);
			}
			else
			{
				array_push($dataRespons,
				[
					'type'			=> 'reschecklogin',
					'state'			=> 'noact',
					'flag_login'=> $flag_login,
					'register'	=> 'yes'
				]);
			}
		}
		else
		{
			array_push($dataRespons,
			[
				'type'			=> 'reschecklogin',
				'state'			=> '-',
				'flag_login'=> $flag_login,
				'register'	=> 'no'
			]);
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	public function reqchangeflagft($mail)
	{
		$dataRespons = [];

		$flag_ft 	= "0";
		$mail 		= trim(htmlentities(addslashes($mail)));

		$query 					= "UPDATE tbl_user SET flag_ft=? WHERE username=?";
		$update_flag_ft = $this->db->updateValue($query,[$flag_ft,$mail]);

		if($update_flag_ft)
		{
			array_push($dataRespons,
			[
				'type'		=> 	'reschangeflagft',
				'result'	=>	'true'
			]);
		}
		else
		{
			array_push($dataRespons,
			[
				'type'		=> 	'reschangeflagft',
				'result'	=>	'false'
			]);
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	public function reqgetcat($mail)
	{
		$dataRespons = [];

		$mail		= trim(htmlentities(addslashes($mail)));

		$query	= "SELECT * FROM tbl_user WHERE username=?";
		$getCat = $this->db->getValue($query,[$mail]);

		if($getCat)
		{
			$cat = $getCat['genre'];
			array_push($dataRespons,
			[
				'type'			=> 'resgetcat',
				'category'	=> $cat
			]);
		}
		else
		{
			array_push($dataRespons,
			[
				'type'			=> 'resgetcat',
				'category'	=> 'nan'
			]);
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function getInformationUser($mail)
	{
		$mail 				= htmlentities(addslashes($mail));
		$dataRespons 	= null;

		$query = "SELECT * FROM tbl_user WHERE username=?";
		$result_data = $this->db->getValue($query,[$mail]);

		if($result_data)
		{
			$dataRespons = array
			(
				'id_reg'	=> $result_data['id_reg'],
				'level'		=> $result_data['level'],
				'name'		=> $result_data['name'],
				'genre'		=> $result_data['genre']
			);
		}
		else
		{
			$dataRespons = array
			(
				'id_reg'	=> '-',
				'level'		=> '-',
				'name'		=> '-',
				'genre'		=> '-'
			);
		}
		return json_encode($dataRespons, JSON_PRETTY_PRINT);
	}


	public function reqgetinfouser($mail)
	{
		$dataRespons = [];
		$mail = htmlentities(addslashes($mail));

		$query 			= "SELECT * FROM tbl_user WHERE username=?";
		$result_data 	= $this->db->getValue($query,[$mail]);

		if($result_data)
		{
		    $id_genre = $result_data['genre'];
		    
		    $query      = "SELECT * FROM tbl_genre WHERE id_genre=?";
		    $genre_dat  = $this->db->getValue($query,[$id_genre]);
		    
			array_push($dataRespons,
			[
				'type'		=> 'resgetinfouser',
				'id_reg'	=> $result_data['id_reg'],
				'email'     => $mail,
				'level'		=> $result_data['level'],
				'name'		=> $result_data['name'],
				'genre'		=> $genre_dat['nama_genre'],
			]);
		}
		else
		{
			array_push($dataRespons,
			[
				'type'		=> 'resgetinfouser',
				'id_reg'	=> '-',
				'email'     => '-',
				'level'		=> '-',
				'name'		=> '-',
				'genre'		=> '-'
			]);
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	public function reqsetflaqlogin($flag_login,$mail)
	{
		$dataRespons 	= [];

		$flag_login 	= htmlentities(addslashes($flag_login));
		$mail 				= htmlentities(addslashes($mail));

		$query = "UPDATE tbl_user SET flag_login=? WHERE username=?";
		$result_data = $this->db->updateValue($query,[$flag_login,$mail]);

		if($result_data)
		{
			array_push($dataRespons,
			[
				'type' 		=> 'ressetflaqlogin',
				'succuss'	=> 'true'
			]);
		}
		else
		{
			array_push($dataRespons,
			[
				'type' 		=> 'ressetflaqlogin',
				'succuss'	=> 'false'
			]);
		}
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	function reqrespass($email)
	{
		$dataRespons = [];
		$email = trim(htmlentities(addslashes($email)));
		$send  = false;

		$query = "SELECT * FROM tbl_user WHERE username=?";
		$result_check_mail = $this->db->getValue($query,[$email]);

		if(!empty($result_check_mail))
		{
			$name 	= $result_check_mail['name'];
			$seed 	= str_split('abcdefghijklmnopqrstuvwxyz'.'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
			shuffle($seed);
  		$rand 	= '';

  		foreach (array_rand($seed, 5) as $k)
  		{
  			$rand .= $seed[$k];
  		}

			$random_pass = $rand;
			$encode_random_pass = $this->util->encode($random_pass);

			$query	=	"UPDATE tbl_user SET password=? WHERE username=?";
			$result_change_password = $this->db->updateValue($query,[$encode_random_pass,$email]);

			$this->mail->IsSMTP();
			$this->mail->SMTPSecure = 'ssl';
			$this->mail->Host 			= "www.maufutsal.com"; 		//source hosting
			$this->mail->SMTPDebug 	= 1;
			$this->mail->Port 		= 465;
			$this->mail->SMTPAuth = true;
			$this->mail->Username = "resetter@maufutsal.com"; //sender mail
			$this->mail->Password = "zaq1xsw2"; 							//sender mail's password
			$this->mail->SetFrom("resetter@maufutsal.com","Password Resetter"); 	//sender
			$this->mail->AddReplyTo('resetter@maufutsal.com','Password Resetter' );
			$this->mail->Subject 	= "Pemulihan Kata Sandi"; 	//Email subject
			$this->mail->AddAddress($email,$name);  					//destination mail

			$message 	= "<h1>Hallo,".$name."</h1>";
			$message .= "<br>Permintaan reset password Anda telah diproses. Password Anda yang baru adalah "."<strong>".$random_pass."</strong>";
			$message .="<br><br>Silahkan login menggunakan password ini. Apabila ingin mengganti password dengan yang lebih mudah diingat, cukup menggunakan menu ganti password";
			$message .="<br><br>Terima kasih.";
			$message .= "<br><br><br><br><small>Email ini dikirim secara otomatis. mohon untuk tidak membalas email ini.</small>";

			$this->mail->MsgHTML($message);

			if($this->mail->Send())
			{
				$send = 'true';
			}
			else
			{
				$send = 'false';
			}


			if($send==true)
			{
				array_push($dataRespons,
				[
					'type'			=> 'resrespass',
					'success'		=>	$send,
					'registered'=> 'true'
				]);
			}
			else
			{
				array_push($dataRespons,
				[
					'type'			=> 'resrespass',
					'success'		=>	$send,
					'registered'=> 'true'
				]);
			}
		}
		else
		{
			array_push($dataRespons,
			[
				'type'			=> 'resrespass',
				'success'		=> $send,
				'registered'=> 'false'
			]);
		}
		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}


	function reqchangepass($oldpass,$newpass,$mail)
	{
		$oldpass 			= $this->util->encode(htmlentities(addslashes($oldpass)));
		$newpass 			= $this->util->encode(htmlentities(addslashes($newpass)));
		$email 				= htmlentities(addslashes($mail));
		$dataRespons	= [];

		$query = "SELECT * FROM tbl_user WHERE password=? AND username=?";
		$result_check = $this->db->getValue($query,[$oldpass,$email]);

		if($result_check['username']==$email)
		{
			$query = "UPDATE tbl_user SET password=? WHERE username=?";
			$result_change_pass = $this->db->updateValue($query,[$newpass,$email]);

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


	function reqchelogfb($name,$email)
	{
		$email 				= trim(htmlentities(addslashes($email)));
		$genre 				= "";
		$activation 	= "-";
		$registered 	= "false";
		$level 				= "-";
		$dataRespons 	= [];

		$query 					= "SELECT * FROM tbl_user WHERE username=?";
		$result_user_fb = $this->db->getValue($query,[$email]);

		if(!empty($result_user_fb))
		{
			if($result_user_fb['username']==$email)
			{
				$registered = 'true';

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
			$result_email_register = $this->db->insertValue($query,[$name,$email,$level,$activation,$id_reg]);

			if($result_email_register==1)
			{
				$query 					= "SELECT * FROM tbl_user WHERE username=?";
				$result_user_fb = $this->db->getValue($query,[$email]);

				$genre 			= $result_user_fb['genre'];
				$activation = $result_user_fb['status_aktivasi'];
				$level 			= $result_user_fb['level'];

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

}

?>
