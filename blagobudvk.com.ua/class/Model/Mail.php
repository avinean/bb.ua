<?php

namespace App\Model;
use App\Core\Model;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail extends Model {

	private function getMailer() {
		$mail = new PHPMailer();
		$mail->SMTPDebug = 2;                                 // Enable verbose debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'uashared12.twinservers.net';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'admin@blagobudvk.com.ua';                 // SMTP username
		$mail->Password = 'Coba1953';                           // SMTP password
//		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		//Recipients
		$mail->setFrom('admin@blagobudvk.com.ua');
		$mail->addAddress('sale.blagobud@ukr.net', 'Joe User');
//		$mail->addCC('sale.blagobud@ukr.net');
//		$mail->addBCC('sale.blagobud@ukr.net');

		//Attachments
//		$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//		$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		//Content
		$mail->isHTML(true);                                  // Set email format to HTML
		return $mail;

	}

	public function send($body = 'From blagobudvk.com.ua', $subj = 'blagobudvk.com.ua', $altBody) {
		$altBody = $altBody ?: $body;
		try {
			$mail = $this->getMailer();
			$mail->Subject = $subj;
			$mail->Body = $body;
			$mail->AltBody = $altBody;
			$mail->send();
		}
		catch (Exception $e) {
			echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
	}
}