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
	//	$users = users::where('name',$_SESSION['name']);
		$users = users::where('id',$_SESSION['id']);
		$id = $users->id;
		
	$view = $app->view();
	$view->setTemplatesDirectory(TEMPLATE_ADMIN);

	$dados = array(
		'pagina' => 'configuration',
		'users'   => $users
	);

	$app->render('layout.php',$dados);
});

$app->post('/admin/configuration/person/', function() use($app){
	login::estaLogado('user_logado',$app);
//	$users = users::where('name',$_SESSION['name']);
	$users = users::where('id',$_SESSION['id']);
	$id = $users->id;

	$view = $app->view();
	$view->setTemplatesDirectory(TEMPLATE_ADMIN);

	$name = $app->request()->post('name');
	$email = $app->request()->post('email');




	$foto = $_FILES['photo']['name'];
	$temp_foto = $_FILES['photo']['tmp_name'];

	$extensoes_permitidas = array('jpg','jpeg', 'png');

	if(empty($foto)):
		$attributes = array(
			'name' => $name,
			'email' => $email,
			'photo' => $users->photo
		);
		users::atualizar($id,$attributes);
		$app->flash('sucesso', 'Cadastrada atualizado com sucesso !');
		$app->redirect('/admin/configuration');
	else:
		$isImage = imagem::isImage($foto);
		if($isImage):
			$coverAdd = users::where('id',$id);
			if(empty($coverAdd->cover)):
				$wide = \WideImage\WideImage::load($temp_foto);
				$imagem = new imagem();
				$novoNome = $imagem->renomear($foto);
				$imagem->upload($wide, 'img/user_cover', 200,200);

				$attributes = array(
					'name' => $name,
					'email' => $email,
					'photo' => $novoNome
				);
				users::atualizar($id,$attributes);
				$app->flash('sucesso', 'Cadastrada atualizado com sucesso !');
				$app->redirect('/admin/configuration');
			else:
				imagem::deletar($coverAdd->cover);
				$wide = \WideImage\WideImage::load($temp_foto);
				$imagem = new imagem();
				$novoNome = $imagem->renomear($foto);
				$imagem->upload($wide, 'img/user_cover', 200,200);

				$attributes = array(
					'name' => $name,
					'email' => $email,
					'photo' => $novoNome
				);
				users::atualizar($id,$attributes);

				$app->flash('sucesso', 'Cadastrada atualizado com sucesso !');
				$app->redirect('/admin/configuration');

			endif;
		else:
			$app->flash('erro', 'Escolha uma imagem com extensão correta !');
			$app->redirect('/admin/configuration');
		endif;
	endif;










});
