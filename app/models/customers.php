<?php

namespace app\models;
use \app\traits\login as traitLogin;

class customers extends \app\models\appModel
{
	static $table_name = 'customers';
	use traitLogin;

}