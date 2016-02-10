<?php

use \app\traits\login;
use \app\classes\cover;
use \app\classes\slug;
use \app\classes\validation;
use \app\models\users;
use \app\models\customers;
use \app\models\categories;
use \app\models\albums;
use \app\models\images;

$app->get('/admin/albums/', function() use($app){
	login::estaLogado('user_logado',$app);
	$users = users::where('name',$_SESSION['name']);

	$view = $app->view();
	$view->setTemplatesDirectory(TEMPLATE_ADMIN);

	$categories = categories::listar();
	$customers = customers::find('all', array('order' => 'name asc'));
	$albums = albums::find('all', array('order' => 'name asc'));

	$dados = array(
		'pagina' => 'albums',
		'users' => $users,
		'categories' => $categories,
		'customers' => $customers,
		'albums' => $albums
	);

	$app->render('layout.php',$dados);
});

$app->post('/admin/albums/create/', function() use($app){

	$name = $app->request()->post('album-name');
	$category = $app->request()->post('album-category');
	$price = $app->request()->post('album-price');

	$slug = new slug();
	$slug = $slug->slugify($name);



	$validation = new validation();
	$validacoes = array(
		'album-name' =>'obrigatorio',
	);
	$validar = $validation->validar($_POST,$validacoes);

	if($validar):
		$albumExist = albums::where('name',$name);
		if(count($albumExist) == 1):
			$app->flash('erro', 'Álbum "' .$name. '" já está cadastrada!');
			$app->redirect('/admin/albums');
		else:
			$attributes = array(
				'name' => $name,
				'category_id' => $category,
				//'password' => $pass,
				'price' => $price,
				'slug' => $slug
			);
			albums::cadastrar($attributes);
			$app->flash('sucesso', 'Álbum cadastrada com sucesso !');
			$app->redirect('/admin/albums');
		endif;
	else:
		$app->flash('erro', $validation->mostrarErros());
		$app->flash('nameAlbum',$name);
		$app->redirect('/admin/albums');
	endif;
});


$app->post('/admin/albums/edit/:id', function() use($app){
	$id   = $app->request()->post('album-id');
	$name = $app->request()->post('album-name');
	$category = $app->request()->post('album-category');
	//$pass = $app->request()->post('album-password');
	$price = $app->request()->post('album-price');
	$slug = $app->request()->post('album-slug');

	if(empty($name) || empty($slug)){
		$app->flash('erro', 'Nome ou Slug não podem ser vazios');
		$app->redirect('/admin/albums');
	}else{
		$attributes = [
			'name' => $name,
			'category_id' => $category,
			//'password' => $pass,
			'price' => $price,
			'slug' => $slug
		];

		$album = new albums();
		$album->atualizar($id,$attributes);
		$app->flash('sucesso', 'Categoria alterada com sucesso !');
		$app->redirect('/admin/albums');
	}
});

$app->post('/admin/albums/delete/:id', function($id) use($app){

	$albums = new albums();
	$images = new images();

	$imageCadastrada = images::where('album_id', $id);

	if(count($imageCadastrada) > 0){
		$app->flash('erro', 'Este álbum possui fotos cadastradas');
		$app->redirect('/admin/albums');
	}else{
		$albums->deletar($id);

		$app->flash('sucesso', 'Álbum deletado com sucesso !');
		$app->redirect('/admin/albums');
	}
});

$app->post('/admin/albums/cover/:id', function() use($app){
	$id   = $app->request()->post('album-id');


	$foto = $_FILES['foto']['name'];
	$temp_foto = $_FILES['foto']['tmp_name'];

	$extensoes_permitidas = array('jpg','jpeg', 'png');

	if(empty($foto)):
		$app->flash('mensagem', '<div class="alert alert-danger">Escolha uma foto.</div>');
		$app->redirect('/admin/albums');
	else:
		$isImage = cover::isImage($foto);
		if($isImage):
			$coverAdd = albums::where('id',$id);
			if(empty($coverAdd->cover)):
				$wide = \WideImage\WideImage::load($temp_foto);
				$cover = new cover();
				$novoNome = $cover->renomear($foto);
				$cover->upload($wide, 'img/album_cover', 500,500);

				$attributes = array('cover' => $novoNome);

				albums::atualizar($id,$attributes);

				$app->flash('mensagem', '<div class="alert alert-success">Foto Cadastrada.</div>');
				$app->redirect('/admin/albums');
			else:


				cover::deletar($coverAdd->cover);


				$wide = \WideImage\WideImage::load($temp_foto);
				$cover = new cover();
				$novoNome = $cover->renomear($foto);
				$cover->upload($wide, 'img/album_cover', 500,500);

				$attributes = array('cover' => $novoNome);

				albums::atualizar($id,$attributes);

				$app->flash('mensagem', '<div class="alert alert-success">Foto Cadastrada.</div>');
				$app->redirect('/admin/albums');

			endif;
		else:
			$app->flash('mensagem', '<div class="alert alert-danger">Escolha uma foto com a extensão permitida.</div>');
			$app->redirect('/admin/albums');
		endif;
	endif;
});
