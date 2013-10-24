<?php
	chdir('..');
	include "api.php";
	$email = $_POST['email'];
	
	$subscribersPath = $settings['content_dir']."lists/"."subscribers";
	
	$subscriptions = file_get_contents($subscribers_path);
	$subscriptions = explode(";", $subscriptions);
	array_push($subscriptions, $email);
	
	$subsString;
	foreach($subscriptions as $subscriber) {
		$subsString = $subsString.$subscriber.";";
	}
	
	$file = fopen($subscribersPath, "w");
	if (!fwrite($file, $subsString)) {
		die("Please chmod the content folder to 0777. ".getcwd());
	}
	fclose($file);
	
	$headers = 'From: '.$settings['email_from']."\r\n";
	$headers = $headers.'Reply-To: '.$settings['email_reply_to']."\r\n";

	mail($email, $settings['new_subscription_subject'], show("email/welcome.php"), $headers);
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
?>