<?php

use \App\Core\Model;

$app->respond('GET', '/get', function ($req, $res, $ser) {
//    return json_encode(Model::c()->req->server);

	return json_encode(require_once("../secret/loc.php") );
});