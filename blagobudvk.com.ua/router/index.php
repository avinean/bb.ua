<?php

use App\Model\Admin;

function route($path) {
	global $app;

	$app->with($path, function() use ($app, $path) {

		$app->respond('GET', '', function($request, $response, $service) {
			$service->render('index.phtml',[
				"meta" => \App\Model\Info::c()->getMeta(),
//				"singlePageMeta" => \App\Model\InfoPage::c()->getAllPages()
			]);
		});

		$filename = ROOT.'/router/routes/'.$path.'.php';
		if (file_exists($filename)) {
			require_once ROOT . '/router/routes/' . $path . '.php';
		}
	});

}

route('/');
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
route('/search');
route('/policy');

$app->respond(['GET', 'POST'], '/api/request', function($req, $res, $ser) {
	$params = $req->params();
	$className = 'App\\Model\\' . $params['className'];
	$methodName = $params['methodName'];
	$ins = new $className();
	$opts = @$params['opts'] ?: '[]';

	$result = $ins->$methodName(json_decode($opts, 1));
	return is_array($result) ? $res->json($result) : $result;
});

//admin

$app->respond(['GET', 'POST'], '/admin', function($req, $res, $ser) {
	global $config;
	if (
		!isset($_POST['user']) ||
		!isset($_POST['pass']) ||
		@$_POST['user'] !== $config['admin']['login'] ||
		@$_POST['pass'] !== $config['admin']['pass']
	) $ser->render('admin.phtml');
	else
		$ser->render('index.phtml', [
			"secure" => "someoneelse"
		]);
});

$app->respond('POST', '/secure/admin', function($req, $res, $ser) {
	$params = $req->params();
	$methodName = $params['methodName'];
	$result = Admin::c()->$methodName(json_decode($params['opts'], 1));
	return is_array($result) ? $res->json($result) : $result;
});

$app->respond('POST', '/secure/upload', function($req, $res, $ser) {
	$result = Admin::c()->uploadImg($req->params()['folder']);
	return is_array($result) ? $res->json($result) : $result;
});

$app->respond('POST', '/secure/uploadFile', function($req, $res, $ser) {
	$result = Admin::c()->uploadFile();
	return is_array($result) ? $res->json($result) : $result;
});