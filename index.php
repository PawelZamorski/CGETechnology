<?php
use Cgat\Core\Router;
use Cgat\Core\Request;

// Include the file that handles all the autoloading from the Composer code
require_once(__DIR__ . '/vendor/autoload.php');

// Specify the location of templates
// Use Twig liberary to generate views
$loader = new Twig_Loader_Filesystem(__DIR__ . '/views');
$twig = new Twig_Environment($loader);

$router = new Router();
$response = $router->route(new Request());
echo $response;



