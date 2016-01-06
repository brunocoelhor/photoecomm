<?php

namespace app\classes;

use \app\interfaces\iPedido;

class pedido implements iPedido{

	private $sessionId;
	private $debug;

	public function __construct($sessionId){
		$this->sessionId = $sessionId;

		if(!isset($_SESSION['sessionId']['pedido'])){
			$_SESSION[$sessionId]['pedido'] = array();
		}
	}

	public function adicionarPedido($id)
	{
		if(!isset($_SESSION[$this->sessionId]['pedido'][$id])){
			$_SESSION[$this->sessionId]['pedido'][$id] = array();
			$_SESSION[$this->sessionId]['pedido'][$id][$qtde] = 0;
		}

		if($_SESSION[$this->sessionId]['pedido'][$id][$qtde] > 0){
			$_SESSION[$this->sessionId]['pedido'][$id][$qtde] += 1;
		}else{
			$_SESSION[$this->sessionId]['pedido'][$id][$qtde] = 1;
		}
	}

	public function atualizarPedido($id, $qtde)
	{
		if(isset($_SESSION[$this->sessionId]['pedido'][$id])){
			$_SESSION[$this->sessionId]['pedido'][$id][$qtde] = $qtde;
		}
	}

	public function deletarImagePedido($id)
	{
		if(isset($_SESSION[$this->sessionId]['pedido'][$id])){
			unset($_SESSION[$this->sessionId]['pedido'][$id]);
		}
	}

	public function deletarPedido()
	{
		unset($_SESSION[$this->sessionId]['pedido']);
	}

	public function imagesPedido()
	{
		if(isset($_SESSION[$this->sessionId]['pedido'])){
			return $_SESSION[$this->sessionId]['pedido'];
		}
	}

	public function debugPedido()
	{
		$this->debug = '<pre>';
		$this->debug.= var_dump($_SESSION[$this->sessionId]['pedido']);
		$this->debug.= '</pre>';
		return $this->debug;
	}

}