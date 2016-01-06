<?php

namespace app\models;

class pedido extends \app\models\appModel
{
	use \app\traits\login;
	static $table_name = 'images';


	public static function pegarImagensPedido($images){
		$imagesArray = array();
		if(is_array($images)):
			foreach($images as $id=>$qtde):
				$imagesArray[$id]= array(
					'dados' => parent::find('first', array('contidions'=> array('images.id=?', $id))),
					'qtde' => $qtde['qtde']
				);
			endforeach;
			return $imagesArray;
		endif;

	}

}