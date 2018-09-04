<?php

use App\Model\Admin;

$app->respond('POST', '/admin', function($req, $res, $ser) {
    if (
        !isset($_POST['user']) ||
        !isset($_POST['pass']) || 
        $_POST['user'] !== "admin" || 
        $_POST['pass'] !== "-T*7K!d?={+v)"
    ) {
		$ser->render('admin.html');
    }
    else  {
        $ser->render('index.html');
    }
});

$app->respond('POST', '/secure/admin', function($req, $res, $ser) {

	$params = $req->params();
	$methodName = $params['methodName'];

	$result = Admin::c()->$methodName(json_decode($params['opts'], 1));

	if (is_array($result)) {
		return $res->json($result);
	}
	else {
		return $result;
	}
});