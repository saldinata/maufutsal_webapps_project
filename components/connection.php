<?php

//ob_start();
// if (!isset($_SESSION))
// {
//     session_start();
// }


define('DB_SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_BASE','futsalku');


/*
define('DB_SERVER','localhost');
define('DB_USERNAME','wwwmaufu_root');
define('DB_PASSWORD','zaq1xsw2');
define('DB_BASE','wwwmaufu_demo');
*/

$con=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_BASE);
//error_reporting(0);
?>