<?php

namespace app\models;

class posts extends \app\models\appModel
{
	use \app\traits\login;
	static $table_name = 'posts';
}