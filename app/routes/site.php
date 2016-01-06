<?php

use \app\classes\hash;
use \app\classes\validation;
use \app\models\albums;
use \app\models\customers;
use \app\models\categories;
use \app\traits\login;

$app->get('/', function() use($app,$twig)
{
	

	$logado = login::customerLogado('user_logado',$app);

	if ($logado){
		$customer = customers::where('name',$_SESSION['name']);
	}else{
		$customer = null;
	}
	//$customer = customers::where('name',$_SESSION['name']);

    $categories = categories::listar();

    $dados = array(
    	'categories' => $categories,
    	'customer'  => $customer
	);

	$template = $twig->loadTemplate('home.html');
	$template->display($dados);

});

$app->get('/assessoria-de-eventos-e-organizacao', function() use($app,$twig){

	$logado = login::customerLogado('user_logado',$app);

	if ($logado){
		$customer = customers::where('name',$_SESSION['name']);
	}else{
		$customer = null;
	}

	$categories = \app\models\categories::listar();
	
	$dados = array(
		'categories' => $categories
	);

	$template = $twig->loadTemplate('contato.html');
	$template->display($dados);

});

$app->get('/contato', function() use($app,$twig){

	$logado = login::customerLogado('user_logado',$app);

	if ($logado){
		$customer = customers::where('name',$_SESSION['name']);
	}else{
		$customer = null;
	}

	//login::customerLogado('user_logado',$app);
	//$customer = customers::where('name',$_SESSION['name']);
	$categories = \app\models\categories::listar();
	
	$dados = array(
		'categories' => $categories,
		'customer'  => $customer
	);

	$template = $twig->loadTemplate('contato.html');
	$template->display($dados);

});

$app->get('/:slug', function($slug) use($app,$twig){

	$logado= login::customerLogado('user_logado',$app);

	if ($logado){
		$customer = customers::where('name',$_SESSION['name']);
	}else{
		$customer = null;
	}

	$categories = \app\models\categories::listar();
	$category = \app\models\categories::where('slug',$slug);
	$id = $category->id;


	$albums = \app\models\albums::where('category_id',$id, 'all');

	$dados = array(
		'categories' => $categories,
		'category' => $category,
		'albums' => $albums,
		'customer' => $customer
	);

	$template = $twig->loadTemplate('album.html');
	$template->display($dados);

});

$app->get('/:slug/:album', function($slug,$album) use($app,$twig){


	$logado= login::customerLogado('user_logado',$app);

	if ($logado){
		$customer = customers::where('name',$_SESSION['name']);
	}else{
		$customer = null;
	}

	$categories = \app\models\categories::listar();
	$album = \app\models\albums::where('slug',$album);
	$id = $album->id;


	//$images = \app\models\images::where('album_id',$id, 'all');
	$images = \app\models\images::all(array('conditions' => array('album_id = ? AND open = ?', $id, 1)));

	$dados = array(
		'categories' => $categories,
		'album' => $album,
		'images' => $images,
		'customer' => $customer
	);

	$template = $twig->loadTemplate('photo.html');
	$template->display($dados);

});


