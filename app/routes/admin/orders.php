<?php

use \app\traits\login;
use \app\classes\cover;
use \app\classes\slug;
use \app\classes\validation;
use \app\models\users;
use \app\models\customers;
use \app\models\categories;
use \app\models\albums;
use \app\models\images;
use \app\models\orders;
use \app\models\item_order;

$app->get('/admin/orders/', function() use($app){
	login::estaLogado('user_logado',$app);
	$users = users::where('name',$_SESSION['name']);

	$view = $app->view();
	$view->setTemplatesDirectory(TEMPLATE_ADMIN);

	$categories = categories::listar();
	$customers = customers::find('all', array('order' => 'name asc'));
	$albums = albums::find('all', array('order' => 'name asc'));

	$orders = orders::find_by_sql('SELECT order.id, order.date, order.customer_id, order.status, c.name FROM `order` JOIN customers c ON(order.customer_id = c.id) ORDER BY order.id DESC;');

	$dados = array(
		'pagina' => 'orders',
		'users' => $users,
		'categories' => $categories,
		'customers' => $customers,
		'albums' => $albums,
    'orders' => $orders
	);

	$app->render('layout.php',$dados);
});
