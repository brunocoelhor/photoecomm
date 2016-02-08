<?php
session_start();
ini_set('display_errors', 1);

define('TEMPLATE_ADMIN', ROOT.'app/views/admin');
define('SALT', 'lookphotografia');



require ROOT.'vendor/autoload.php';
require ROOT.'app/connection.php';
require ROOT.'app/config.slim.twig.php';
require ROOT.'public/functions/functions.php';
require ROOT.'app/routes/admin/admin.php';
require ROOT.'app/routes/admin/login.php';
require ROOT.'app/routes/admin/painel.php';
require ROOT.'app/routes/admin/albums.php';
require ROOT.'app/routes/admin/categories.php';
require ROOT.'app/routes/admin/images.php';
require ROOT.'app/routes/admin/customers.php';
require ROOT.'app/routes/admin/orders.php';
require ROOT.'app/routes/admin/configuration.php';
require ROOT.'app/routes/customer.php';
require ROOT.'app/routes/site.php';




$app->run();
