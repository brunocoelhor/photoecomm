<?php

use \app\classes\hash;
use \app\models\images;
use \app\classes\validation;
use \app\models\albums;
use \app\models\customers;
use \app\models\categories;
use \app\traits\login;

$app->get('/area-do-cliente', function() use($app,$twig){
	$categories = categories::listar();

	$dados = array(
		'categories' => $categories
	);

	$template = $twig->loadTemplate('area-do-cliente.html');
	$template->display($dados);

});

$app->map('/area-do-cliente/logar', function() use($app,$twig)
{
	if($app->request()->isGet())
    {
		$template = $twig->loadTemplate('home.html');
		$template->display($dados);
	}else{
		$view = $app->view();
		$view->setTemplatesDirectory(TEMPLATE_ADMIN);

		$email = $app->request()->post('email');
		$pass  = $app->request()->post('pass');

		$validation = new validation();
		$validacoes = array(
			'email' => 'obrigatorio|email',
			'pass'  => 'obrigatorio'
		);

		$validar = $validation->validar($_POST,$validacoes);

		if($validar){
			$customer = new customers();
			$customer->setCampos(array('email','password'));
			$logado = $customer->logar($email,$pass);

			if(count($logado) == 1){
				$_SESSION['user_logado'] = true;
				$_SESSION['name'] = $logado->name;

				$categories = categories::listar();
				$customer = customers::where('name',$_SESSION['name']);
				$id = $customer->id;
			    $dados = array(
			    	'categories' => $categories,
			    	'logado' => $_SESSION['user_logado'],
			    	'customer'  => $customer
				);

				$app->redirect('/area-do-cliente/'.$id);
			}else{
				$erros = array('erro' => 'Usuário ou senha incorretos');
			}
		}else{
			$erros = array('erro' => $validation->mostrarErros());
		}
		$template = $twig->loadTemplate('area-do-cliente.html');
		$template->display($erros);

	}
})->via('GET','POST');

$app->get('/area-do-cliente/logout', function() use($app){
	customers::deslogar('user_logado');
	$app->redirect('/');
});

$app->get('/area-do-cliente/:id', function($id) use($app,$twig)
{

	$logado= login::banLogado('user_logado',$app);

	if ($logado){
		$customer = customers::where('name',$_SESSION['name']);
	}else{

	}


	$customer = customers::where('id',$id);
	$album = $customer->albums_id;

	$albums = albums::where('id',$album);

	$dados = array(
		'customer' => $customer,
		'albums' => $albums
	);

	$template = $twig->loadTemplate('customer-albums.html');
	$template->display($dados);

});

$app->get('/area-do-cliente/:id/:slug', function($id,$slug) use($app,$twig)
{

	$logado= login::banLogado('user_logado',$app);

	if ($logado){
		$customer = customers::where('name',$_SESSION['name']);
	}else{

	}

	$categories = \app\models\categories::listar();
	$album = \app\models\albums::where('slug',$slug);
	$id = $album->id;

	$_SESSION['album'] = $id;

	$images = \app\models\images::all(array('conditions' => array('album_id = ?', $id)));

	$dados = array(
		'categories' => $categories,
		'album' => $album,
		'images' => $images,
		'customer' => $customer
	);

	$template = $twig->loadTemplate('customer-albums-photos.html');
	$template->display($dados);

});


$app->get('/image/buy/:id', function($id) use($app){
	$attributes = [
			'purchased' => 1
		];

	$images = new \app\models\images();
	$images->atualizar($id,$attributes);
});

$app->get('/image/purchased/:id', function($id) use($app){
	$attributes = [
			'purchased' => 0
		];

	$images = new \app\models\images();
	$images->atualizar($id,$attributes);
});



$app->get('/cart', function() use($app,$twig){
	$logado= login::banLogado('user_logado',$app);

	if ($logado){
		$customer = customers::where('name',$_SESSION['name']);
	}else{

	}

	$categories = \app\models\categories::listar();
	$album = albums::where('id',$_SESSION['album']);


	$images = \app\models\images::all(array('conditions' => array('purchased = 1')));

	$dados = array(
		'categories' => $categories,
		'album' => $album,
		'images' => $images,
		'customer' => $customer
	);

	$template = $twig->loadTemplate('cart.html');
	$template->display($dados);

});