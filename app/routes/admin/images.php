<?php

use \app\traits\login;
use \app\classes\cover;
use \app\classes\validation;
use \app\classes\imagem;
use \app\models\users;
use \app\models\categories;
use \app\models\albums;
use \app\models\images;

$app->get('/admin/images/', function() use($app){
	login::estaLogado('user_logado',$app);
	$users = users::where('name',$_SESSION['name']);

	$view = $app->view();
	$view->setTemplatesDirectory(TEMPLATE_ADMIN);
	
	$categories = categories::listar();
	$albums = albums::find('all', array('order' => 'name asc'));
	
	$dados = array(
		'pagina' => 'images',
		'users'   => $users,
		'categories' => $categories,
		'albums' => $albums
	);
	
	$app->render('layout.php',$dados);
});

$app->get('/admin/images/view/:slug', function() use($app){
	login::estaLogado('user_logado',$app);
	$users = users::where('name',$_SESSION['name']);

	$view = $app->view();
	$view->setTemplatesDirectory(TEMPLATE_ADMIN);
	
	$categories = categories::listar();
	$albums = albums::find('all', array('order' => 'name asc'));
	
	$dados = array(
		'pagina' => 'images',
		'users'   => $users,
		'categories' => $categories,
		'albums' => $albums
	);
	
	$app->render('layout.php',$dados);
});

$app->post('/admin/images/photo/:id', function() use($app){
	$id   = $app->request()->post('album-id');

	$foto = $_FILES['foto']['name'];
	$temp_foto = $_FILES['foto']['tmp_name'];

	$extensoes_permitidas = array('jpg','jpeg', 'png');

	$dir = $_SERVER['DOCUMENT_ROOT'].'/img/photos/';
	$dir2 = $_SERVER['DOCUMENT_ROOT'].'/img/photos/thumbs/';

	$count = count($temp_foto);

	for($i = 0; $i < $count; $i++){
		$isImage = imagem::isImage($foto[$i]);
		if($isImage){
				$wide = \WideImage\WideImage::load($temp_foto[$i]);
				
				$images = new imagem();
				
				$explodeFoto = explode('.', $foto[$i]);
				$extensao = end($explodeFoto);
				$novoNome = uniqid().'.'.$extensao;

				$thumb = $wide->crop('center','center',640,480);	

			    	
				$watermark = \WideImage\WideImage::load($_SERVER['DOCUMENT_ROOT'].'/img/logo.png');	
				$wide = $wide->merge($watermark, 'center', 'center', 30);
				$wide = $wide->resize(720,480);	

				$thumb->saveToFile($dir2.$novoNome,80);
				$wide->saveToFile($dir.$novoNome,80);

				$attributes = array('name' => $novoNome, 'album_id' => $id);
				
				images::cadastrar($attributes);
						
			}else{
			$app->flash('mensagem', '<div class="alert alert-danger">Insira uma imagem válida.</div>');
			$app->redirect('/admin/images/view');
			}
	}
	$app->flash('mensagem', '<div class="alert alert-success">Foto Cadastrada.</div>');
	$app->redirect('/admin/images/photo/view/'.$id);
});

$app->get('/admin/images/photo/view/:id', function($id) use($app){
	login::estaLogado('user_logado',$app);
	$users = users::where('name',$_SESSION['name']);

	$view = $app->view();
	$view->setTemplatesDirectory(TEMPLATE_ADMIN);
	$album = albums::where('id',$id);
	
	$images = images::where('album_id',$id,'all');
	
	$dados = array(
		'pagina' => 'images_view',
		'album' => $album,
		'users'   => $users,
		'images' => $images,
	);
	
	$app->render('layout.php',$dados);
});

$app->get('/admin/images/photo/delete/:id', function($id) use($app){
	login::estaLogado('user_logado',$app);
	$users = users::where('name',$_SESSION['name']);

	$view = $app->view();
	$view->setTemplatesDirectory(TEMPLATE_ADMIN);
	$album = albums::where('id',$id);
	
	$images = images::where('album_id',$id,'all');
	
	$dados = array(
		'pagina' => 'images_delete',
		'album' => $album,
		'users'   => $users,
		'images' => $images
	);
	
	$app->render('layout.php',$dados);
});

$app->get('/image/allow-access/:id', function($id) use($app){
	$attributes = [
			'open' => 1
		];

	$images = new images();
	$images->atualizar($id,$attributes);
});

$app->get('/image/deny-access/:id', function($id) use($app){
	$attributes = [
			'open' => 0
		];

	$images = new images();
	$images->atualizar($id,$attributes);
});


$app->delete('/image/delete/:id', function($id) use($app){
	

	$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

	$images = new \app\models\images();

	$images->deletar($id);
		echo 'deletou';
});
