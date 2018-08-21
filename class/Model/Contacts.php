<?php

namespace App\Model;
use App\Core\Model;

class Contacts extends Model {

	public function sendRequest($opts = []) {

		if ($opts['type']) {
			$name = $opts['name'];
			$phone = $opts['phone'];
			return mail(
				'avinean@gmail.com',
				'Запит. Передзвонити',
				"$name залишив запит, щоб йому перетелефонували на номер $phone"
			);
		}
		else {
			$name = $opts['name'];
			$viber = $opts['viber'];
			$watsapp = $opts['watsapp'];
			$msg = $opts['msg'];
			$email = $opts['email'];


			return mail(
				'avinean@gmail.com',
				'Запит. Лист',
				"$name відправив листа з сайту blagobud.com \n\n
				email:		$email \n
				viber:		$viber \n
				watsapp:	$watsapp \n\n
				$msg"
			);
		}
	}
	
	public function sendMessage($opts = []) {
		$name = $opts['name'];
		$msg = $opts['msg'];
		$phone = $opts['phone'];
		$email = $opts['email'];

		return mail(
			'avinean@gmail.com',
			'Запит. Лист',
			"$name відправив листа з сайту blagobudvk.com.ua \n\n
			email: $email \n\n
			телефон: $phone \n\n
			$msg"
		);
	}
}