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

$app->get('/admin/categories/', function() use($app){
	login::estaLogado('user_logado',$app);
	$users = users::where('name',$_SESSION['name']);

	$view = $app->view();
	$view->setTemplatesDirectory(TEMPLATE_ADMIN);
	
	$categories = categories::find('all', array('order' => 'name asc'));
	
	$dados = array(
		'pagina' => 'categories',
		'users'   => $users,
		'categories' => $categories
	);
	
	$app->render('layout.php',$dados);
});

$app->post('/admin/categories/create/', function() use($app){
	
	$name = $app->request()->post('category-name');

	$slug = new slug();
	$slug = $slug->slugify($name);

	$validation = new validation();
	$validacoes = array(
		'category-name' =>'obrigatorio',
	);
	$validar = $validation->validar($_POST,$validacoes);

	if($validar):
		$categoryExist = categories::where('name',$name);
		if(count($categoryExist) == 1):
			$app->flash('erro', 'Categoria "' .$name. '" já está cadastrada!');
			$app->redirect('/admin/categories');	
		else:
			$attributes = array(
				'name' => $name,
				'slug' => $slug
			);
			categories::cadastrar($attributes);
			$app->flash('sucesso', 'Categoria cadastrada com sucesso !');
			$app->redirect('/admin/categories');
		endif;	
	else:
		$app->flash('erro', $validation->mostrarErros());
		$app->flash('nameCategory',$name);
		$app->redirect('/admin/categories');	
	endif;	
});

$app->post('/admin/categories/delete/:id', function($id) use($app){

	$categories = new categories();
	$albums = new albums();

	$albumCadastrado = albums::where('category_id', $id);

	if(count($albumCadastrado) > 0){
		$app->flash('erro', 'Esta categoria possui albuns cadastrados');
		$app->redirect('/admin/categories');
	}else{
		$categories->deletar($id);

		$app->flash('sucesso', 'Categoria deletada com sucesso !');
		$app->redirect('/admin/categories');
	}
});

$app->post('/admin/categories/edit/:id', function() use($app){
	$id   = $app->request()->post('category-id');
	$name = $app->request()->post('category-name');
	$slug = $app->request()->post('category-slug');

	if(empty($name) || empty($slug)){
		$app->flash('erro', 'Nome ou Slug não podem ser vazios');
		$app->redirect('/admin/categories');			
	}else{
		$attributes = [
			'name' => $name,
			'slug' => $slug
		];

		$category = new categories();
		$category->atualizar($id,$attributes);
		$app->flash('sucesso', 'Categoria alterada com sucesso !');
		$app->redirect('/admin/categories');		
	}
});

$app->post('/admin/categories/cover/:id', function() use($app){
	$id   = $app->request()->post('category-id');

	
	$foto = $_FILES['foto']['name'];
	$temp_foto = $_FILES['foto']['tmp_name'];
	
	$extensoes_permitidas = array('jpg','jpeg', 'png');
	
	if(empty($foto)):
		$app->flash('mensagem', '<div class="alert alert-danger">Escolha uma foto.</div>');
		$app->redirect('/admin/categories');
	else:
		$isImage = imagem::isImage($foto);
		if($isImage):
			$coverAdd = categories::where('id',$id);
			if(empty($coverAdd->cover)):
				$wide = \WideImage\WideImage::load($temp_foto);
				$imagem = new imagem();
				$novoNome = $imagem->renomear($foto);
				$imagem->upload($wide, 'img/category_cover', 1000,1000);
				
				$attributes = array('cover' => $novoNome);
				
				categories::atualizar($id,$attributes);
				
				$app->flash('mensagem', '<div class="alert alert-success">Foto Cadastrada.</div>');
				$app->redirect('/admin/categories');
			else:
				
				
				imagem::deletar($coverAdd->cover);
				
				
				$wide = \WideImage\WideImage::load($temp_foto);
				$imagem = new imagem();
				$novoNome = $imagem->renomear($foto);
				$imagem->upload($wide, 'img/category_cover', 1000,1000);

				$attributes = array('cover' => $novoNome);
				
				categories::atualizar($id,$attributes);
				
				$app->flash('mensagem', '<div class="alert alert-success">Foto Cadastrada.</div>');
				$app->redirect('/admin/categories');
							
			endif;
		else:
			$app->flash('mensagem', '<div class="alert alert-danger">Escolha uma foto com a extensão permitida.</div>');
			$app->redirect('/admin/categories');			
		endif;
	endif;
	
	
});