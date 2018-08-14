<?php

namespace App\Model;
use App\Core\Model;

class Contacts extends Model {

	public function sendRequest($opts = []) {

		return $opts;

//		$name = $req->paramsGet()->all()['name'];
//		$phone = $req->paramsGet()->all()['phone'];
//
//		return mail(
//			'avinean@gmail.com',
//			'Запит. Передзвонити',
//			"$name залишив запит, щоб йому перетелефонували на номер $phone"
//		);


//		$name = $req->paramsGet()->all()['name'];
//		$msg = $req->paramsGet()->all()['msg'];
//		$email = $req->paramsGet()->all()['email'];
//
//		return mail(
//			'avinean@gmail.com',
//			'Запит. Лист',
//			"$name відправив листа з сайту blagobud.com \n\n
//			$email \n\n
//			$msg"
//		);
    }
}