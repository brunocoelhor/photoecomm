<?php

namespace app\traits;

trait login
{
	
	private $campos;
	private $campo;
	private $sqlCampo;
	
	public function setCampos($campos)
    {
		$this->campos = $campos;
	}
	
	public function getCampos()
    {
		return $this->campos;
	}
	
	public function logar($email,$senha)
    {
		foreach($this->getCampos() as $campo):
		$this->campo.= $campo.'=? and ';	
		endforeach;
		$this->sqlCampo = rtrim($this->campo, 'and ');
		return parent::find('first', array('conditions' => array($this->sqlCampo,$email,$senha)));
	}

	public static function deslogar($sessao)
    {
		if(isset($_SESSION[$sessao])){
			unset($_SESSION[$sessao]);
			session_destroy();
			session_regenerate_id();
		}
	}

/*	public static function estaLogado($sessao,$app,$redirect=null)
    {
		if(!isset($_SESSION[$sessao])){
			if($redirect == null):
				return false;
			else:
				$app->redirect($redirect);
			endif;
		}else{
			return true;
		}
	}

	public static function dadosLogin ($sessao)
	{
		return (\app\classes\session::sessaoExiste($sessao)) ? \app\classes\session::recuperarSessao($sessao) : 'visitante';
	}*/

	
/*	public static function deslogar($sessao)
    {
		if(isset($_SESSION[$sessao]))
        {
			unset($_SESSION[$sessao]);
		}
	}*/
	
	public static function estaLogado($sessao,$app)
    {
		if(!isset($_SESSION[$sessao]))
        {
			$app->redirect('/admin');
		}
        else
        {
			return true;
		}
	}

	public static function banLogado($sessao,$app)
    {
		if(!isset($_SESSION[$sessao])){
			$app->redirect('/area-do-cliente');
		}else{
			return true;
		}
	}

		public static function customerLogado($sessao,$app)
    {
		if(!isset($_SESSION[$sessao])){
			return false;
		}else{
			return true;
		}
	}
}
