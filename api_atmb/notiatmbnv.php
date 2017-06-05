<?php
include('components/connection.php');
include('library/system_function.php');
error_reporting(0);

$fp = fopen('php://input', 'r');
$rawData = stream_get_contents($fp);

$result_xml_parser = parserXMLNotifyPayment($rawData);

$product_id = trim((string) $result_xml_parser[7]);

if($result_xml_parser[12]=="reqnotification")
{

	if($product_id==="000")
	{
		//regEO
		$storeReqNotify = mysqli_query($con,"INSERT INTO tbl_reqnotification_eo(booking_id,client_id,cust_name,issuer_bank,issuer_name,amount,product_id,trx_id,trx_date,username,notification_datetime,signature) VALUES('$result_xml_parser[0]','$result_xml_parser[2]','$result_xml_parser[3]','$result_xml_parser[4]','$result_xml_parser[5]','$result_xml_parser[6]','$result_xml_parser[7]','$result_xml_parser[8]','$result_xml_parser[9]','$result_xml_parser[10]','$result_xml_parser[11]','$result_xml_parser[1]')");

		if($storeReqNotify)
		{
			//echo "1";
			echo "<?xml version=\"1.0\" ?>\n";
			echo "\t<return>\n";
			echo "\t\t<type>resnotification</type>\n";
			echo "\t\t<ack>00</ack>\n";
			echo "\t\t<bookingid>$result_xml_parser[0]</bookingid>\n";
			echo "\t\t<signature>$result_xml_parser[1]</signature>\n";
			echo "\t</return>";
		}
		else
		{

		}
	}

	else if($product_id==="0000")
	{
		//reservEO
		$storeReqNotify = mysqli_query($con,"INSERT INTO tbl_reqnotification_reserv_eo(booking_id,client_id,cust_name,issuer_bank,issuer_name,amount,product_id,trx_id,trx_date,username,notification_datetime,signature) VALUES('$result_xml_parser[0]','$result_xml_parser[2]','$result_xml_parser[3]','$result_xml_parser[4]','$result_xml_parser[5]','$result_xml_parser[6]','$result_xml_parser[7]','$result_xml_parser[8]','$result_xml_parser[9]','$result_xml_parser[10]','$result_xml_parser[11]','$result_xml_parser[1]')");

		if($storeReqNotify)
		{
			//echo "2";
			echo "<?xml version=\"1.0\" ?>\n";
			echo "\t<return>\n";
			echo "\t\t<type>resnotification</type>\n";
			echo "\t\t<ack>00</ack>\n";
			echo "\t\t<bookingid>$result_xml_parser[0]</bookingid>\n";
			echo "\t\t<signature>$result_xml_parser[1]</signature>\n";
			echo "\t</return>";
		}
		else
		{

		}
	}

	else if($product_id==="00000")
	{
		//agent

		$storeReqNotify = mysqli_query($con,"INSERT INTO tbl_reqnotification_agent(booking_id,client_id,cust_name,issuer_bank,issuer_name,amount,product_id,trx_id,trx_date,username,notification_datetime,signature) VALUES('$result_xml_parser[0]','$result_xml_parser[2]','$result_xml_parser[3]','$result_xml_parser[4]','$result_xml_parser[5]','$result_xml_parser[6]','$result_xml_parser[7]','$result_xml_parser[8]','$result_xml_parser[9]','$result_xml_parser[10]','$result_xml_parser[11]','$result_xml_parser[1]')");

		if($storeReqNotify)
		{
			//echo "3";
			echo "<?xml version=\"1.0\" ?>\n";
			echo "\t<return>\n";
			echo "\t\t<type>resnotification</type>\n";
			echo "\t\t<ack>00</ack>\n";
			echo "\t\t<bookingid>$result_xml_parser[0]</bookingid>\n";
			echo "\t\t<signature>$result_xml_parser[1]</signature>\n";
			echo "\t</return>";
		}
		else
		{

		}
	}

	else
	{
		//reserv biasa
		$storeReqNotify = mysqli_query($con,"INSERT INTO tbl_reqnotification(booking_id,client_id,cust_name,issuer_bank,issuer_name,amount,product_id,trx_id,trx_date,username,notification_datetime,signature) VALUES('$result_xml_parser[0]','$result_xml_parser[2]','$result_xml_parser[3]','$result_xml_parser[4]','$result_xml_parser[5]','$result_xml_parser[6]','$result_xml_parser[7]','$result_xml_parser[8]','$result_xml_parser[9]','$result_xml_parser[10]','$result_xml_parser[11]','$result_xml_parser[1]')");

		if($storeReqNotify)
		{
			//echo "4";
			echo "<?xml version=\"1.0\" ?>\n";
			echo "\t<return>\n";
			echo "\t\t<type>resnotification</type>\n";
			echo "\t\t<ack>00</ack>\n";
			echo "\t\t<bookingid>$result_xml_parser[0]</bookingid>\n";
			echo "\t\t<signature>$result_xml_parser[1]</signature>\n";
			echo "\t</return>";
		}
		else
		{

		}
	}


	
}
else
{
	//echo "5";
	echo "<?xml version=\"1.0\" ?>\n";
	echo "\t<return>\n";
	echo "\t\t<type>resnotification</type>\n";
	echo "\t\t<ack>78</ack>\n";
	echo "\t\t<bookingid>$result_xml_parser[0]</bookingid>\n";
	echo "\t\t<signature>$result_xml_parser[1]</signature>\n";
	echo "\t</return>";
}


?>