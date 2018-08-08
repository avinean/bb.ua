<?php

function route($path) {
	global $app;

	$app->with($path, function() use ($app, $path) {

		$app->respond('GET', '', function($request, $response, $service) {
			$service->render('index.html');
		});

		$filename = ROOT.'/../router/panel/'.$path.'.php';
		if (file_exists($filename)) {
			require_once ROOT . '/../router/panel/' . $path . '.php';
		}
	});

}

route('/');
route('/gallery');
route('/price');
route('/quality');
route('/contacts');
