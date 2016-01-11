<?php

namespace app\models;

class orders extends \app\models\appModel
{
	use \app\traits\login;
	static $table_name = 'order';

}
