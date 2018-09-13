<?php

namespace App\Model;
use App\Core\Model;
use App\Model\Mail;

class Contacts extends Model {

	public function sendRequest($opts = []) {

		if ($opts['type']) {
			$name = $opts['name'];
			$phone = $opts['phone'];
			$message = "$name залишив запит, щоб йому перетелефонували на номер $phone";
		}
		else {
			$name = $opts['name'];
			$viber = $opts['viber'];
			$watsapp = $opts['watsapp'];
			$msg = $opts['msg'];
			$email = $opts['email'];


			$message = "$name відправив листа з сайту blagobud.com \n\n
				email:		$email \n
				viber:		$viber \n
				watsapp:	$watsapp \n\n
				$msg";
		}

		return Mail::c()->send($message);
	}
	
	public function sendMessage($opts = []) {
		$name = $opts['name'];
		$msg = $opts['msg'];
		$phone = $opts['phone'];
		$email = $opts['email'];

		$message = "$name відправив листа з сайту blagobudvk.com.ua \n\n
			email: $email \n\n
			телефон: $phone \n\n
			$msg";

		return Mail::c()->send($message);
	}
	
	public function sendOrder($opts = []) {
		$name = $opts['name'];
		$cnt = $opts['cnt'];
		$phone = $opts['phone'];
		$id = intval($opts['id']);
		$info = $this->db->query('
			SELECT g.title AS name, c.title AS color
			FROM goods as g
			LEFT JOIN colors as c ON g.color = c.id
			WHERE g.id = '.$id)->fetchAssoc();

		$message = "$name відправив запит з сайту blagobudvk.com.ua \n\n
			телефон: $phone \n\n
			
			Оформлення $cnt м2  \n\n
			Виріб: ".$info['name']." \n\n
			Колір: ".$info['color'];

		return Mail::c()->send($message);
	}

	public function sendCallBack($opts = []) {
		$phone = $opts['phone'];
		
		$message = "З сайту blagobudvk.com.ua відправлено запит передзвонити \n\n
		телефон: <i> $phone </i>";

		return Mail::c()->send($message);

	}
}