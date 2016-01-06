<?php
use \app\classes\validation;
use \app\models\users;
use \app\classes\hash;

$app->map('/logar', function() use($app)
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
			$user = new users();
			$user->setCampos(array('email','password'));
			$logado = $user->logar($email,$pass);

			if(count($logado) == 1){
			$_SESSION['user_logado'] = true;
			$_SESSION['name'] = $logado->name;
			$app->redirect('/painel');

			}else{
				$erros = array('erro' => 'Usuário ou senha incorretos');
			}
		}else{
			$erros = array('erro' => $validation->mostrarErros());
		}
		$app->render('login.php',$erros);
	}







	/*if($app->request()->isGet())
    {
		$app->redirect('/admin');
	}
	
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
	
	if($validar)
    {
		$user= new users();
		$user->setCampos(array('email','password'));
		$dadosUser = $user->logar($email,hash::hash($pass));
		
		if(count($dadosUser) == 1)
        {
			$_SESSION['user_logado'] = true;
			$_SESSION['name'] = $dadosUser->name;
			$app->redirect('/painel');
		}else
        {
			$erros = array('erro' => 'Usuário ou senha incorretos');
		}
	}else
    {
		$erros = array('erro' => $validation->mostrarErros());
	}
$app->render('login.php',$erros);*/
})->via('GET', 'POST');

$app->get('/logout', function() use($app){
	users::deslogar('user_logado');
	$app->redirect('/admin');
});