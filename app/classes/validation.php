<?php 

namespace app\classes;

class validation
{
	public $errors = array();
	private $html;

	public function validar($data, $validacoes)
    {
		$valido = true;
		foreach($validacoes as $key=>$value)
        {
			$explodeBarra=explode('|', $value);
			foreach($explodeBarra as $metodo)
            {
				$post=isset($data[$key]) ? $data[$key] : NULL;
				if(!$this->$metodo($post, $key))
                {
					$valido = false;
				}
			}
		}
		return $valido;
	}

	public function obrigatorio($post, $fieldName)
    {
		$valido = true;
		if(empty($post))
        {
			$valido = false;
			$this->errors[]='O campo '.$fieldName.' não pode ficar em branco';
		}
		return $valido;
	}

	public function email($post, $fieldName)
    {
		$valido = true;
		if(!filter_var($post,FILTER_VALIDATE_EMAIL))
        {
			$this->errors[]='Digite um e-mail válido no campo '.$fieldName;
			$valido = false;
		}
		return $valido;
	}

	public function cep($post, $fieldName)
    {
		$valido = false;
		$er='/^[0-9]{5}\-[0-9]{3}$/';
		if(preg_match($er, $post))
        {
			$valido = true;
		}
		return $valido;
	}

	public function mostrarErros()
    {
		$erros = $this->errors;
		$html = '<ul id="listar-erros">';
		foreach ($erros as $erro) 
        {
			$html.= '<li class="erro">'.$erro.'</li>';
		}
		$html.= '</ul>';
		return $html;
	}



}