<?php

namespace app\models;

abstract class appModel extends \ActiveRecord\Model
{

	public static function listar($limite=null)
    {
		if($limite != null)
        {
			return parent::find('all', array('select' => "*", 'limit' => $limite));
		}

		return parent::find('all');
	}
    
	public static function atualizar($id,$attributes)
    {
		$atualizar = parent::find($id);
		$atualizar->update_attributes($attributes);
	}
    
	public static function cadastrar($attributes)
    {
		return parent::create($attributes);
	}
    
	public static function deletar($id)
    {
		$deletar = parent::find($id);
		$deletar->delete();
	}
    
	public static function where($campo,$valor,$tipo=null)
    {
		$tipoListagem= ($tipo == null) ? 'first' : 'all';
		return parent::find($tipoListagem, array('conditions' => array($campo.'=?',$valor)));
	}
    
	public static function verificaCadastroUpdate($id,$campo,$valor,$sinal)
    {
		switch($sinal)
        {
			case 'igual':
			$sinal = '=';
				break;
			case 'diferente':
			$sinal = '!=';
				break;
		}
		return parent::find('all', array('conditions' => array($campo.'=? and id '.$sinal.' ?',$valor)));
	}

	 public function paginate($limit,$offset)
     {
        return parent::find('all', array('limit' => $limit, 'offset'=>$offset));
     }

}