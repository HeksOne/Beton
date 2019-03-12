<?php

$method = $_SERVER['REQUEST_METHOD'];

//Script Foreach
$c = true;
if ( $method === 'POST' ) {

	$project_name = trim($_POST["project_name"]);
	$admin_email  = trim($_POST["admin_email"]);
	$form_subject = trim($_POST["form_subject"]);
	
	$admin_email1  = 'mazanovich.ivan@gmail.com';	

	foreach ( $_POST as $key => $value ) {
		if ( $value != "" && $key != "project_name" && $key != "admin_email" && $key != "form_subject" ) {
			$message .= "
			" . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
				<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$key</b></td>
				<td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
			</tr>
			";
		}
	}
} else if ( $method === 'GET' ) {

	$project_name = trim($_GET["project_name"]);
	$admin_email  = trim($_GET["admin_email"]);
	$form_subject = trim($_GET["form_subject"]);

	foreach ( $_GET as $key => $value ) {
		if ( $value != "" && $key != "project_name" && $key != "admin_email" && $key != "form_subject" ) {
			$message .= "
			" . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
				<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$key</b></td>
				<td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
			</tr>
			";
		}
	}
}

$message = "<table style='width: 100%;'>$message</table>";

function adopt($text) {
	return '=?UTF-8?B?'.Base64_encode($text).'?=';
}

$headers = "MIME-Version: 1.0" . PHP_EOL .
"Content-Type: text/html; charset=utf-8" . PHP_EOL .
'From: '.adopt($project_name).' Заявка с сайта <info@moonway.by>' . PHP_EOL .
'Reply-To: admin@moonway.by' . PHP_EOL;

$fd = fopen("mail.log", 'a') or die("Не удалось создать файл");
$th = '-------------------------------------------';
fwrite($fd, $th);
fwrite($fd, $message);
fwrite($fd, $th);
fwrite($fd, '\r\n\r\n');
fclose($fd);

if (strpos($message, 'Телефон') !== false) {
    mail($admin_email, adopt($form_subject), $message, $headers );
	mail($admin_email1, adopt($form_subject), $message, $headers );
	mail($admin_email2, adopt($form_subject), $message, $headers );
	// $json['error'] = 0;
} else {
	mail($admin_email1, adopt($form_subject), $message, $headers );
	$json['error'] = 'Ошибка передачи!';
}
echo json_encode($json);
?>