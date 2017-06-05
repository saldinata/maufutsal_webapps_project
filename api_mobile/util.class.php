<?php

Class Utility
{
	protected $temp_variable = null;
	protected $skey = "logitechlogitech";

	public function startSession()
	{
		ob_start();
		session_start();
	}

	public function hideErrorReporting()
	{
		error_reporting(0);
	}

	public function setDefaultTimeZone($timezones)
	{
		date_default_timezone_set($timezones);
	}

	public function getDateTimeToday()
	{
		$this->setDefaultTimeZone('Asia/Bangkok');
		$respons = date("Y-m-d H:i:s");
		return $respons;
	}

	public function getDateToday()
	{
		$respons = date("d-m-Y");
		return $respons;
	}

	public function setDateRegisterForToday()
	{
		$respons = date("Ymd");
		return $respons;
	}

	public function setRegisterDate($date_data)
	{
		$respons = date("Ymd", strtotime($date_data));
		return $respons;
	}

	public function changeFormatDateFromNumberToString($date_number)
	{
		$respons = date("d F Y", strtotime($date_number));
		return $respons;
	}

	public function changeFormatDateFromDateTimetoDate($date_time)
	{
		return date("Y-m-d", strtotime($date_time));
	}

	public function changeFormatDateInUsualForm($date_time)
	{
		return date("d-m-Y", strtotime($date_time));
	}

	public function getDateBeforeToday($date,$number)
	{
		$this->setDefaultTimeZone('Asia/Bangkok');
		return date( 'Y-m-d', strtotime($date . '-'.$number.' day' ) );
	}

	public function getDateAfterToday($date,$number)
	{
		$this->setDefaultTimeZone('Asia/Bangkok');
		return date( 'Y-m-d', strtotime($date . '+'.$number.' day' ) );
	}

	public function getTimeOnlyFromDateTime($datetime)
	{
		return false;//$output = DateTime::createFromFormat('Y-m-d H:i:s', $datetime)->format('H:i:s');
	}

	public function expiredTime($time)
	{
		$timestamp = strtotime($time) + 60*60;
		return $time = date('H:i:s', $timestamp);
	}

	public function getTimeFromDate($date)
	{
		return date('h:i:s',strtotime($date));
	}

	public function getDayInIndonesia($day)
	{
		if($day==="Monday")
		{
			return $day="Senin";
		}

		else if($day==="Tuesday")
		{
			return $day="Selasa";
		}

		else if($day==="Wednesday")
		{
			return $day="Rabu";
		}

		else if($day==="Thrusday")
		{
			return $day="Kamis";
		}

		else if($day==="Friday")
		{
			return $day="Jum'at";
		}

		else if($day==="Saturday")
		{
			return $day="Sabtu";
		}

		else if($day==="Sunday")
		{
			return $day="Minggu";
		}

		else
		{

		}
	}


	public function getEndTime($start_time,$duration)
	{
		$end_time = ((substr($start_time, 0,2))+$duration);

		if($end_time<10)
		{
			$end_time = "0".$end_time.":00";
		}
		else
		{
			$end_time = $end_time.":00";
		}

		return $end_time;
	}


	public function highestValue(array $numbers, $highest)
	{
		$maxHeap  = new SplMaxHeap;

		foreach($numbers as $number)
		{
			$maxHeap->insert($number);
		}

		return iterator_to_array(new LimitIterator($maxHeap,0,$highest));
	}


	public function dateRangeComparation($date_start,$date_end,$date_comparation)
	{
		$respons = FALSE;

		if($date_comparation<=$date_end && $date_comparation>=$date_start)
		{
			$respons = TRUE;
		}
		else
		{
			$respons = FALSE;
		}

		return $respons;
	}


	public function limitDate($date_today,$date_end_promotion)
	{
		$respons = NULL;

		if($date_today<=$date_end_promotion)
		{
			$respons = 1;
		}
		else
		{
			$respons = 0;
		}

		return $respons;
	}


	public function encryptpass($word)
	{
		$respons = md5($word);
		return $respons;
	}


	public  function safe_b64encode($string) 
	{
    $data = base64_encode($string);
    $data = str_replace(array('+','/','='),array('-','_',''),$data);
    return $data;
  }

  public function safe_b64decode($string) 
  {
    $data = str_replace(array('-','_'),array('+','/'),$string);
    $mod4 = strlen($data) % 4;
    if ($mod4) 
    {
        $data .= substr('====', $mod4);
    }
    return base64_decode($data);
  }

	public function encode($word)
	{ 
    if(!$word)
    {
    	return false;
    }

    $text 		= $word;
    $iv_size 	= mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
    $iv 			= mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $crypttext= mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->skey, $text, MCRYPT_MODE_ECB, $iv);
    return trim($this->safe_b64encode($crypttext)); 
  }

  public function decode($word)
  {
      if(!$word)
      {
      	return false;
      }

      $crypttext 	= $this->safe_b64decode($word); 
      $iv_size 		= mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
      $iv 				= mcrypt_create_iv($iv_size, MCRYPT_RAND);
      $decrypttext= mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->skey, $crypttext, MCRYPT_MODE_ECB, $iv);
      return trim($decrypttext);
  }


	public function uppercaseFirstCharaEachWord($word)
	{
		return ucwords(strtolower($word));
	}


	public function randomCodeGenerator()
	{
		return mt_rand(10,100).$this->setDateRegisterForToday().time();
	}

	public function compareTwoArrayReturnMatch($array1, $array2)
	{
		return array_intersect($array1,$array2);
	}

	public function compareTwoArrayReturnDifferent($array1,$array2)
	{
		return array_diff($array1,$array2);
	}

	public function setStringToArray($word)
	{
		return explode(",", $word);
	}	
}

?>