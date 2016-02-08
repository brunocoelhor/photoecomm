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

$app->get('/admin/orders/orders_detail/:id', function($id) use($app){
	login::estaLogado('user_logado',$app);
	$users = users::where('name',$_SESSION['name']);

	$view = $app->view();
	$view->setTemplatesDirectory(TEMPLATE_ADMIN);

	$items_order = item_order::find_by_sql("SELECT image_id, amount, total, i.name FROM `item_order`
		JOIN images i ON(item_order.image_id = i.id)
		WHERE item_order.order_id = $id;");

	$dados = array(
		'pagina' => 'order_detail',
		'users' => $users,
    'items_order' => $items_order
	);

	$app->render('layout.php',$dados);
});

$app->post('/admin/orders/orders_detail/edit_status/:id', function($id) use($app){
	login::estaLogado('user_logado',$app);
	$users = users::where('name',$_SESSION['name']);

	$status = $app->request()->post('select-status');

	$attributes = [
		'status' => $status
	];

	$order = new orders();
	$order->atualizar($id,$attributes);
	$app->flash('sucesso', "Status do pedido $id alterado com sucesso !");
	$app->redirect('/admin/orders');


});
