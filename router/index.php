<?php

function route($path) {
	global $app;

	$app->with($path, function() use ($app, $path) {

		$app->respond('GET', '', function($request, $response, $service) {
			$service->render('index.html');
		});

		$filename = ROOT.'/../router/routes/'.$path.'.php';
		if (file_exists($filename)) {
			require_once ROOT . '/../router/routes/' . $path . '.php';
		}
	});

}

route('/test');

route('/');
route('/gallery');
route('/price');
route('/quality');
route('/contacts');
route('/dillers');
route('/info');
route('/news');
route('/about');
route('/catalog');
route('/catalog/[:action]');
route('/catalog/[:action]/[:id]');

require_once ROOT . '/../router/router.php';