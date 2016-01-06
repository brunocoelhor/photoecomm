<?php

namespace app\models;

class users extends \app\models\appModel
{
	use \app\traits\login;
	static $table_name = 'users';

}