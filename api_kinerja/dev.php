<?php
  header('Access-Control-Allow-Origin: *');
  require_once('act.class.php');

  $act = new Activities();

  if(isset($_POST['type']) && !empty($_POST['type']))
  {
    switch($_POST['type'])
    {
      case 'pulseodertransaction':
      $this->act->pulseodertransaction($_POST['orderNO'],$_POST['productID'],$_POST['productAmt'],$_POST['sendRef'],$_POST['additionalMsg']);
      break;

      default:
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
