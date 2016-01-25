<?php

use \app\traits\login;
use \app\models\users;
use \app\models\categories;
use \app\models\albums;
use \app\models\images;
use \app\models\orders;


$app->get('/painel', function() use($app)
{
	login::estaLogado('user_logado',$app);

	$users = users::where('name',$_SESSION['name']);

	$categories = categories::find('all');
	$albums = albums::find('all');
	$images = images::find('all');
	$orders = orders::find('all');	

	$view = $app->view();
	$view->setTemplatesDirectory(TEMPLATE_ADMIN);


	$dados = array(
		'pagina' => 'painel',
		'name'   => $_SESSION['name'],
		'users'  => $users,
		'categories' => $categories,
		'albums' => $albums,
		'images' => $images,
		'orders' => $orders 
	);

	$app->render('layout.php',$dados);

});
