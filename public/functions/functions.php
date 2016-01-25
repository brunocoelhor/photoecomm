<?php

$function = new \Twig_SimpleFunction('site_url', function()
{
	return 'http://'.$_SERVER['SERVER_NAME'].':8000';
});

$twig->addFunction($function);

function site_url()
{
	return 'http://'.$_SERVER['SERVER_NAME'].':8000';
}
