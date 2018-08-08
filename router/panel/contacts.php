<?php

$app->respond('GET', '/callback', function ($req, $res, $ser) {
	$name = $req->paramsGet()->all()['name'];
	$phone = $req->paramsGet()->all()['phone'];

	return mail(
		'avinean@gmail.com',
		'Запит. Передзвонити',
		"$name залишив запит, щоб йому перетелефонували на номер $phone"
	);
});

$app->respond('GET', '/send-msg', function ($req, $res, $ser) {
	$name = $req->paramsGet()->all()['name'];
	$msg = $req->paramsGet()->all()['msg'];
	$email = $req->paramsGet()->all()['email'];

	return mail(
		'avinean@gmail.com',
		'Запит. Лист',
		"$name відправив листа з сайту blagobud.com \n\n
		$email \n\n
		$msg"
	);
});

//sale.blagobud@ukr.net
//sale.blagobud@ukr.net