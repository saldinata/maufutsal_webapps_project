<?php
include('../components/connection.php');
include('../library/system_function.php');
//error_reporting(0);

$dataPOST = trim(file_get_contents('php://input'));

$result_xml_parser = parserXMLNotifyPayment($dataPOST);

if($result_xml_parser[12]=="reqnotification")
{
	$storeReqNotify = mysqli_query($con,"INSERT INTO tbl_reqnotification(booking_id,client_id,cust_name,issuer_bank,issuer_name,amount,product_id,trx_id,trx_date,username,notification_datetime,signature) VALUES('$result_xml_parser[0]','$result_xml_parser[2]','$result_xml_parser[3]','$result_xml_parser[4]','$result_xml_parser[5]','$result_xml_parser[6]','$result_xml_parser[7]','$result_xml_parser[8]','$result_xml_parser[9]','$result_xml_parser[10]','$result_xml_parser[11]','$result_xml_parser[1]')");

	if($storeReqNotify)
	{
		$respons = "<?xml version=\"1.0\" ?>
		<return>
		    <type>resnotification</type>
		    <ack>00</ack>
		    <bookingid>$result_xml_parser[0]</bookingid>
		    <signature>$result_xml_parser[1]</signature>
		</return>";

		echo ($respons);
	}
	else
	{

	}
}
else
{
	$respons = "<?xml version=\"1.0\" ?>
		<return>
		    <type>resnotification</type>
		    <ack>78</ack>
		    <bookingid>$result_xml_parser[0]</bookingid>
		    <signature>$result_xml_parser[1]</signature>
		</return>";
	print_r($respons);
}





?>