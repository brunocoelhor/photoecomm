<?php

$app->get('/admin', function() use($app)
{
	
	$view = $app->view();
	$view->setTemplatesDirectory(TEMPLATE_ADMIN);
	$app->render('login.php');
	
});
