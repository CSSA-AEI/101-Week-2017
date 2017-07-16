<?php

require 'vendor/autoload.php';

define('SITE_URL', 'http://cssa-aei.ca');

$paypal = new \PayPal\Rest\ApiContext(new \PayPal\Auth\OAuthToken\Credential(
'AfjIdI-aYlNZoM_0E8QRfp2UWvuGv0_MrlzxpGSydysdi90E5vjXCi-uZ-bpJuG1JJHkAYnJEhoMoUsG',
'EEL2Qyjh3Fbg1E3w_KOPZjR6T2xIniAz9vOPgeg6L8lbCUld6e3ZUlKoos6PcsOHzrTn10duah9QW2L_'));