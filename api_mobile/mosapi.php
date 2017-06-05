<?php
	header('Access-Control-Allow-Origin: *');

	require_once('database.php');
	require_once('util.class.php');
	require_once('auth.class.php');
	require_once('activities.class.php');
	require_once('mfsal.class.php');
	require_once('atmb.class.php');
	require_once('class.phpmailer.php');

	$dbase 	= new Database();
	$util 	= new Utility();
	$mfsal 	= new Maufutsal();
	$atmb 	= new ATMB();
	$mail 	= new PHPMailer();
	$auth 	= new Auth($dbase,$util,$mail);
	$act 	= new Act($dbase,$util,$mfsal,$atmb,$auth);

	//$util->hideErrorReporting();

	if(isset($_POST['type']) && !empty($_POST['type']))
	{
		switch($_POST['type'])
		{
			case 'reqlogin':
				$auth->reqlogin($_POST['mail'],$_POST['pass']);
				break;

			case 'reqgetcat' :
				$auth->reqgetcat($_POST['mail']);
				break;

			case 'reqchangeflagft':
				$auth->reqchangeflagft($_POST['mail']);
				break;

			case 'reqcalcallfield':
				$act->reqcalcallfield();
				break;

			case 'reqchecklogin' :
				$auth->reqchecklogin($_POST['mail']);
				break;

			case 'reqsearchfield':
				$act->reqsearchfield($_POST['key']);
				break;

			case 'reqshowfieldlistcityid' :
				$act->reqshowfieldlistcityid($_POST['city_id']);
				break;

			case 'reqshowfieldlistcourtreg':
				$act->reqshowfieldlistcourtreg($_POST['court_reg']);
				break;

			case 'reqcourtinfo' :
				$act->reqcourtinfo($_POST['courtreg']);
				break;

			case 'reqcourtarena' :
				$act->reqcourtarena($_POST['courtreg']);
				break;

			case 'reqreservtime' :
				$act->reqreservtime();
				break;

			case 'reqtimeusage' :
				$act->reqtimeusage();
				break;

			case 'reqreservtrans'	:
				$act->reqreservtrans($_POST['current_date'],$_POST['court_reg'],$_POST['field_code'],$_POST['code_cat'],$_POST['start_time'],$_POST['duration_time']);
				break;

			case 'reqstorereserv' :
				$act->reqstorereserv($_POST['court_reg'],$_POST['code_cat'],$_POST['field_code'],$_POST['current_date'],$_POST['start_time'],$_POST['duration_time'],$_POST['mail'],$_POST['cost']);
				break;

			case 'reqreservtrx' : 
				$act->reqreservtrx($_POST['bookcode']);
				break;

			case 'reqreservpay' : 
				$act->reqreservpay($_POST['mail']);
				break;

			case 'reqgetbanklist' :
				$act->reqgetbanklist();
				break;

			case 'reqstorereservconf' :
				$act->reqstorereservconf($_POST['bookcode'],$_POST['date'],$_POST['bankname'],$_POST['owneracc'],$_POST['timetrx']);
				break;

			case 'reqshowtrxreservhistory' :
				$act->reqshowtrxreservhistory($_POST['mail']);
				break;
			
			case 'reqsearchturnamen' :
				$act->reqsearchturnamen($_POST['key']);
				break;

			case 'reqshowcomplistbyidcity' :
				$act->reqshowcomplistbyidcity($_POST['city_id']);
				break;

			case 'reqshowcomplistbyidcomp' :
				$act->reqshowcomplistbyidcomp($_POST['id_comp']);
				break;

			case 'reqstorecompetition' :
				$act->reqstorecompetition($_POST['teamname'],$_POST['id_comp'],$_POST['email']);
				break;

			case 'reqturnameninfobycodebook' :
				$act->reqturnameninfobycodebook($_POST['codebook']);
				break;

			case 'reqturnamentpay' :
				$act->reqturnamentpay($_POST['mail']);
				break;

			case 'reqstoreturnamenconf' :
				$act->reqstoreturnamenconf($_POST['bookcode'],$_POST['date'],$_POST['bankname'],$_POST['owneracc'],$_POST['timetrx']);
				break;

			case 'reqshowtrxturnamenhistory' :
				$act->reqshowtrxturnamenhistory($_POST['mail']);
				break;

			case 'reqstateturnamen' :
				$act->reqstateturnamen();
				break;

			case 'reqlistallcomp' :
				$act->reqlistallcomp();
				break;

			case 'reqsetflaqlogin' :
				$auth->reqsetflaqlogin($_POST['flaq_login'],$_POST['mail']);
				break;

			case 'reqgetinfouser' :
				$auth->reqgetinfouser($_POST['mail']);
				break;

			case 'reqstoredatareg' :
				$act->reqstoredatareg($_POST['fullname'],$_POST['email'],$_POST['password'],$_POST['genre']);
				break;

			case 'reqrespass' :
				$auth->reqrespass($_POST['mail']);
				break;

			case 'reqchangepass' :
				$auth->reqchangepass($_POST['oldpass'],$_POST['newpass'],$_POST['mail']);
				break;

			case 'reqgetlatestlogin' :
				$act->reqgetlatestlogin($_POST['mail']);
				break;

			case 'reqinfopayment':
				$act->reqinfopayment($_POST['mail']);
				break;
			
			case 'reqallslider':
			    $act->reqallslider();
			    break;
			
			case 'reqallfoe':
                $act->reqallfoe($_POST['mail']);
                break;
            
            case 'reqallinfofoe':
                $act->reqallinfofoe($_POST['mail']);
                break;
            
            case 'reqallprovince':
                $act->reqallprovince();
                break;
            
            case 'reqcity':
                $act->reqcity($_POST['id_province']);
                break;
            
            case 'reqfield':
                $act->reqfield($_POST['id_city']);
                break;
            
            case 'reqcreatefoe':
                $act->reqcreatefoe($_POST['team_name'],$_POST['time_play'],$_POST['id_province'],$_POST['id_city'],$_POST['id_field'],$_POST['email']);
                break;
            
            case 'reqsearchfoe':
                $act->reqsearchfoe($_POST['key']);
                break;
            
            case 'reqjoinmatch':
                $act->reqjoinmatch($_POST['id'],$_POST['mail']);
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


?>