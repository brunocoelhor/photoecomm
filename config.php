<?php 
session_start();
ini_set('display_errors', 1);

define('TEMPLATE_ADMIN', ROOT.'app/views/admin');
define('SALT', 'lookphotografia');



require ROOT.'vendor/autoload.php';
require ROOT.'app/connection.php';
require ROOT.'app/config.slim.twig.php';
require ROOT.'public/functions/functions.php';

//\app\classes\session::sessionStart();
//\app\classes\session::criarSessao(array('nome'=>'cursos', 'valor' => 'lojaVirtual'));

require ROOT.'app/routes/admin/admin.php';
require ROOT.'app/routes/admin/login.php';
require ROOT.'app/routes/admin/painel.php';
require ROOT.'app/routes/admin/albums.php';
require ROOT.'app/routes/admin/categories.php';
require ROOT.'app/routes/admin/images.php';
require ROOT.'app/routes/site.php';
//require ROOT.'app/routes/customers.php';



$app->run();