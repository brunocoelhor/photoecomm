<?php 

namespace app\interfaces;

interface iPedido{

	public function adicionarPedido($id);
	public function atualizarPedido($id, $qtde);
	public function deletarImagePedido($id);
	public function deletarPedido();
	public function imagesPedido();
	public function debugPedido();
}