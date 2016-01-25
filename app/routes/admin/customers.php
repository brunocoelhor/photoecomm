<?php

use \app\traits\login;
use \app\classes\cover;
use \app\classes\hash;
use \app\classes\slug;
use \app\classes\validation;
use \app\models\users;
use \app\models\categories;
use \app\models\customers;
use \app\models\albums;
use \app\models\images;
use \app\models\albumsCustomers;


$app->get('/admin/customers/', function() use($app){
	login::estaLogado('user_logado',$app);
	$users = users::where('name',$_SESSION['name']);

	$view = $app->view();
	$view->setTemplatesDirectory(TEMPLATE_ADMIN);

	$customers = customers::listar();
	$albums = albums::listar();


	$dados = array(
		'pagina' => 'customers',
		'users' => $users,
		'customers' => $customers,
		'albums' => $albums

	);

	$app->render('layout.php',$dados);
});

$app->post('/admin/customers/create/', function() use($app){

	$name = $app->request()->post('customer-name');
	$pass = $app->request()->post('customer-pass');
	$conf_pass = $app->request()->post('customer-conf-pass');
	$email = $app->request()->post('customer-email');


	$validation = new validation();
	$validacoes = array(
		'customer-email' =>'obrigatorio',
		'customer-pass' =>'obrigatorio',
	);
	$validar = $validation->validar($_POST,$validacoes);

	if($pass != $conf_pass):
		$app->flash('erro', 'As senhas não conferem. Digite novamente.');
		$app->redirect('/admin/customers');
	else:
		if($validar):
			$customerExist = customers::where('email',$email);
			if(count($customerExist) == 1):
				$app->flash('erro', 'Cliente "' .$email. '" já está cadastrado!');
				$app->redirect('/admin/customers');
			else:
				$attributes = array(
					'name' => $name,
					'email' => $email,
					'password' => hash::hash($pass)
				);
				customers::cadastrar($attributes);
				$app->flash('sucesso', 'Cliente cadastrado com sucesso !');
				$app->redirect('/admin/customers');
			endif;
		else:
			$app->flash('erro', $validation->mostrarErros());
			$app->flash('nameAlbum',$name);
			$app->redirect('/admin/customers');
		endif;
	endif;
});

$app->post('/admin/customers/delete/:id', function($id) use($app){

	$customers = new customers();

	$customers->deletar($id);

	$app->flash('sucesso', 'Cliente deletado com sucesso !');
	$app->redirect('/admin/customers');
});

$app->post('/admin/customers/edit/:id', function() use($app){
	$id   = $app->request()->post('customer-id');
	$name = $app->request()->post('customer-name');
	$email = $app->request()->post('customer-email');
	$pass = $app->request()->post('customer-pass');
	$conf_pass = $app->request()->post('customer-conf-pass');

	$validation = new validation();
	$validacoes = array(
		'customer-email' =>'obrigatorio',
		'customer-pass' =>'obrigatorio',
	);
	$validar = $validation->validar($_POST,$validacoes);

	if($pass != $conf_pass):
		$app->flash('erro', 'As senhas não conferem. Digite novamente.');
		$app->redirect('/admin/customers');
	else:
		if($validar):
			$attributes = array(
				'name' => $name,
				'email' => $email,
				'password' => hash::hash($pass)
			);
			$customer = new customers();
			$customer->atualizar($id,$attributes);
			$app->flash('sucesso', 'Dados do cliente alterados com sucesso !');
			$app->redirect('/admin/customers');
		else:
			$app->flash('erro', $validation->mostrarErros());
			$app->flash('nameAlbum',$name);
			$app->redirect('/admin/customers');
		endif;
	endif;

});


$app->get('/admin/customers/albums_manage/:id', function($id) use($app){
	login::estaLogado('user_logado',$app);
	$users = users::where('name',$_SESSION['name']);

	$view = $app->view();
	$view->setTemplatesDirectory(TEMPLATE_ADMIN);
	$customer = customers::where('id',$id);

	$albums = albums::find('all', array('order' => 'name asc'));

	$albumsCustomers = albumsCustomers::where('customers_id',$id,'all');

 $join = "JOIN albums_customers a ON(albums.id = a.albums_id) WHERE customers_id = $id";
 $manages = albums::all(array('joins' => $join));

	$dados = array(
		'pagina' => 'albums_customer',
		'albums' => $albums,
		'customer' => $customer,
		'users'   => $users,
		'albumsCustomers' => $albumsCustomers,
		'manages' => $manages
	);

	$app->render('layout.php',$dados);
});

$app->post('/admin/customers/albums_manage/album_add', function() use($app){
	login::estaLogado('user_logado',$app);
	$users = users::where('name',$_SESSION['name']);

	$view = $app->view();
	$view->setTemplatesDirectory(TEMPLATE_ADMIN);
	$customer = customers::where('id',$id);


});
