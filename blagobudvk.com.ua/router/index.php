<?php

function route($path) {
	global $app;

	$app->with($path, function() use ($app, $path) {

		$app->respond('GET', '', function($request, $response, $service) {
			$service->render('index.html');
		});

		$filename = ROOT.'/router/routes/'.$path.'.php';
		if (file_exists($filename)) {
			require_once ROOT . '/router/routes/' . $path . '.php';
		}
	});

}

route('/test');

route('/');
route('/gallery');
route('/price');
route('/quality');
route('/contacts');
route('/payment');
route('/arrival');
route('/dillers');
route('/info');
route('/info/[:id]');
route('/news');
route('/news/[:id]');
route('/sale');
route('/sale/[:id]');
route('/about');
route('/catalog');
route('/catalog/[:action]');
route('/catalog/[:action]/[:id]');

require_once ROOT . '/router/router.php';
require_once ROOT . '/router/admin.php';