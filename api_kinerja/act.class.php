<?php

class Activities
{
  //DATA MERCHANT
  private $merchantAppCode      = "47875953937e089464912cdfa14c0dc2c30b70927362b7fa14c859472bc1beb4";
  private $merchantAppPassword  = "D3velMauFuts4L";
  private $merchantIPAddress    = "127.0.0.1";
  
  //PULSA
  private $pulseodertransaction_development = "https://www.kinerjapay.com/sandbox/services/kinerjapay/json/pulsa-process.php";
  private $pulseordertransaction_production = "https://www.kinerjapay.com/services/kinerjapay/json/pulsa-process.php";

  public function __construct()
  {
  }

  public function pulseodertransaction($orderNo,$productID,$productAmt,$sendRef,$additionalMsg)
  {
    $orderNo        = htmlentities(addslashes($orderNo));
    $productID      = htmlentities(addslashes($productID));
    $productAmt     = htmlentities(addslashes($productAmt));
    $sendRef        = htmlentities(addslashes($sendRef));
    $additionalMsg  = htmlentities(addslashes($additionalMsg));

    $data = array(
      "merchantAppCode "  => $this->merchantAppCode,
      "merchantAppPassword" => $this->merchantAppPassword,
      "merchantIPAddress" => $this->merchantIPAddress,
      "orderNo" => $orderNo,
      "productID" => $productID,
      "productAmt"  => $productAmt,
      "sendRef" => $sendRef,
      "additionalMsg" => $additionalMsg
    );

    $str_data = json_encode($data);
    $url      = $this->pulseodertransaction_development;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$str_data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    echo $result;
  }
}


 ?>
