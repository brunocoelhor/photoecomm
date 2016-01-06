<?php

namespace app\interfaces;

interface iSql
{
	public static function listar($limite);
	public static function atualizar($id,$attributes);
	public static function cadastrar($attributes);
	public static function deletar($id);
	public static function where($campo,$valor,$tipo);
	public static function verificaCadastroUpdate($id,$campo,$valor,$sinal);
	public function paginate($limit,$offset);
}