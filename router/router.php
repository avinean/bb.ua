<?php

$app->respond(['GET', 'POST'], '/api/request', function($req, $res, $ser) {
	$params = $req->params();
	// return json_encode($params);
	$className = 'App\\Model\\' . $params['className'];
	$methodName = $params['methodName'];

	$ins = new $className();

	$opts = @$params['opts'] ?: '[]';

	$result = $ins->$methodName(json_decode($opts, 1));

	if (is_array($result)) {
		return $res->json($result);
	}
	else {
		return $result;
	}
});