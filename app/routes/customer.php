<?php

use \app\classes\hash;
use \app\models\images;
use \app\classes\validation;
use \app\models\albums;
use \app\models\customers;
use \app\models\categories;
use \app\models\orders;
use \app\models\item_order;
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

	$categories = categories::listar();
	$customer = customers::where('id',$id);
	$album = $customer->albums_id;

	$albums = albums::where('id',$album);

	$dados = array(
		'categories' => $categories,
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

$app->post('/cart/remove/:id', function($id) use($app){
	$logado= login::banLogado('user_logado',$app);

	if ($logado){
		$customer = customers::where('name',$_SESSION['name']);
	}else{

	}

	$attributes = [
			'purchased' => 0
	];

	$images = new \app\models\images();
	$images->atualizar($id,$attributes);
});



$app->post('/invoice', function() use($app,$twig){
	$logado= login::banLogado('user_logado',$app);

	if ($logado){
		$customer = customers::where('name',$_SESSION['name']);
	}else{

	}
	$customer_id = $customer->id;


	$categories = \app\models\categories::listar();
	$album = albums::where('id',$_SESSION['album']);
	$price = $album->price;

	$attributes = array(
		'customer_id' => $customer_id,
	);
	orders::cadastrar($attributes);
	$order = \app\models\orders::find('last');
	$order_id = $order->id;


	$images = \app\models\images::all(array('conditions' => array('purchased = 1')));
	$granTotal = 0;
	foreach($images as $image){

		$image_id = $image->id;
		$amount = $app->request()->post("quant-$image_id");
		$total = $price * $amount;
		$att = array(
			'order_id' => $order_id,
			'image_id' => $image_id,
			'amount' => $amount,
			'total' => $total
		);
		item_order::cadastrar($att);
		$granTotal += $total;

		$reset = array(
			'purchased' => 0,
			'sale_count' => 1
		);
		$imageReset = new images();
		$imageReset->atualizar($image_id,$reset);
	}

	$items_order = item_order::all(array('conditions' => array("order_id = $order_id")));

	$dados = array(
		'categories' => $categories,
		'album' => $album,
		'images' => $images,
		'customer' => $customer,
		'order' => $order,
		'items_order' => $items_order,
		'granTotal' => $granTotal
	);

	$template = $twig->loadTemplate('invoice.html');
	$template->display($dados);

});
