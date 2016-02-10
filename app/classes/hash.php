<?php

namespace app\classes;

class hash
{
	public static function hash($senha){
		return crypt( $senha, SALT);
	}

}
