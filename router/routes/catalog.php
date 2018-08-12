<?php

$app->respond('GET', '/get-goods', function ($req, $res, $ser) {
    return 1;
    // $result = Catalog::c()->getGoodsByCategory($req->paramsGet()->all());
	// return $res->json($result);
});