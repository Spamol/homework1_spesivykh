<?php
header("Content-type: text/html; charset=UTF-8");
session_start();
	// e-mail получателя

	$emailAddress = 'pozzitiff-91@mail.ru';



	// библиотека phpmailer 

	require "lib/class.phpmailer.php";



	// обрабатываем данные

	$name = nl2br(strip_tags(stripslashes($_POST['name'])));

	$email = nl2br(strip_tags(stripslashes($_POST['email'])));

	$message = nl2br(strip_tags(stripslashes($_POST['mess'])));	



	//правильность емайл

	if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['mess'])) {             

		echo "Заполнены не все поля!";         

	} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {

		echo "Неправильно введён e-mail";

	}elseif(isset($_SESSION['captcha_keystring']) && ($_SESSION['captcha_keystring'] === $_POST['keystring'])){
        
		$msg = "Клиент <strong>".$name."</strong>(".$email.") написал сообщение:<br /><h4>&laquo;".$message."&raquo;</h4>";

		// Используем класс PHPMailer

		$mail = new PHPMailer();

		$mail->IsMail();

		// Добавляем адрес получателя

		$mail->AddAddress($emailAddress);

		$mail->Subject = 'Сообщение с сайта '.$_SERVER['HTTP_HOST'];

		$mail->MsgHTML($msg);

		$mail->AddReplyTo('noreply@'.$_SERVER['HTTP_HOST'], 'Feedback');

		$mail->SetFrom('noreply@'.$_SERVER['HTTP_HOST'], 'Feedback');

		$mail->Send();
		unset($_SESSION['captcha_keystring']);
		echo 'Сообщение отправлено, спасибо!';

	}else{
		echo "Проверочный код введен неверно!";
	}

?>