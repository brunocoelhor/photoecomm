<?php

use \app\traits\login;
use \app\classes\cover;
use \app\classes\slug;
use \app\classes\imagem;
use \app\classes\validation;
use \app\models\users;
use \app\models\categories;
use \app\models\albums;
use \app\models\images;

$app->get('/admin/configuration/', function() use($app){
	login::estaLogado('user_logado',$app);
	$users = users::where('name',$_SESSION['name']);

	$view = $app->view();
	$view->setTemplatesDirectory(TEMPLATE_ADMIN);

	$categories = categories::find('all', array('order' => 'name asc'));

	$dados = array(
		'pagina' => 'configuration',
		'users'   => $users		
	);

	$app->render('layout.php',$dados);
});
