<?php

use \app\traits\login;
use \app\classes\cover;
use \app\classes\slug;
use \app\classes\imagem;
use \app\classes\validation;
use \app\classes\hash;
use \app\models\users;
use \app\models\categories;
use \app\models\albums;
use \app\models\images;
use \app\models\company;
use \app\models\social;

$app->get('/admin/configuration/', function() use($app){
	login::estaLogado('user_logado',$app);
	//	$users = users::where('name',$_SESSION['name']);
		$users = users::where('id',$_SESSION['id']);
		$id = $users->id;
		$social = social::where('id', 1);

	$view = $app->view();
	$view->setTemplatesDirectory(TEMPLATE_ADMIN);

	$dados = array(
		'pagina' => 'configuration',
		'users'   => $users,
		'social' => $social
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
		$app->flash('sucesso', 'Cadastrado atualizado com sucesso !');
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


$app->post('/admin/configuration/company/', function() use($app){
	login::estaLogado('user_logado',$app);
	$users = users::where('id',$_SESSION['id']);

	$view = $app->view();
	$view->setTemplatesDirectory(TEMPLATE_ADMIN);

	$name= $app->request()->post('name');
	$email = $app->request()->post('email');
	$address = $app->request()->post('address');
	$number = $app->request()->post('number');
	$city = $app->request()->post('city');
	$state = $app->request()->post('state');
	$zipcode = $app->request()->post('ceṕ');
	$timetable = $app->request()->post('timetable');

	$foto = $_FILES['logo']['name'];
	$temp_foto = $_FILES['logo']['tmp_name'];

	$extensoes_permitidas = array('jpg','jpeg', 'png');

	if(empty($foto)):
		$attributes = array(
			'name' => $name,
			'email' => $email,
			'photo' => $company->photo
		);
		users::atualizar($id,$attributes);
		$app->flash('sucesso', 'Cadastrado atualizado com sucesso !');
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


$app->post('/admin/configuration/social/', function() use($app){
	login::estaLogado('user_logado',$app);
//	$users = users::where('name',$_SESSION['name']);
	$users = users::where('id',$_SESSION['id']);

	$view = $app->view();
	$view->setTemplatesDirectory(TEMPLATE_ADMIN);

	$facebook = $app->request()->post('facebook');
	$linkedin = $app->request()->post('linkedin');
	$twitter = $app->request()->post('twitter');
	$gplus = $app->request()->post('gplus');


	$attributes = array(
		'facebook' => $facebook,
		'linkedin' => $linkedin,
		'twitter' => $twitter,
		'gplus' => $gplus
	);

	$social = new social();
	$social->atualizar('1',$attributes);
	$app->flash('sucesso', 'Dados das redes sociais alterados com sucesso !');
	$app->redirect('/admin/configuration');
});




$app->post('/admin/configuration/password/', function() use($app){
	login::estaLogado('user_logado',$app);
//	$users = users::where('name',$_SESSION['name']);
	$users = users::where('id',$_SESSION['id']);
	$id = $users->id;

	$view = $app->view();
	$view->setTemplatesDirectory(TEMPLATE_ADMIN);

	$old_pass = $app->request()->post('old-pass');
	$pass = $app->request()->post('pass');
	$conf_pass = $app->request()->post('conf-pass');



	$validation = new validation();
	$validacoes = array(
		'old-pass' =>'obrigatorio',
		'pass' =>'obrigatorio',
		'conf-pass' =>'obrigatorio'
	);
	$validar = $validation->validar($_POST,$validacoes);

	if($pass != $conf_pass):
		$app->flash('erro', 'As senhas não conferem. Digite novamente.');
		$app->redirect('/admin/configuration');
	else:
		if($validar):
			$user = new users();
			$user->setCampos(array('id','password'));
			$logado = $user->logar($id,hash::hash($old_pass));

			if(count($logado) == 1):
				$attributes = array(
					'password' => hash::hash($pass)
				);
				$user = new users();
				$user->atualizar($id,$attributes);
				$app->flash('sucesso', 'Dados do cliente alterados com sucesso !');
				$app->redirect('/admin/configuration');
			else:
				$app->flash('erro', 'Senha não confere com a cadastrada');
				$app->redirect('/admin/configuration');
			endif;
		else:
			$app->flash('erro', $validation->mostrarErros());
			$app->flash('nameAlbum',$name);
			$app->redirect('/admin/configuration');
		endif;
	endif;
});
