<?php

namespace Cgat\Controllers;

use Cgat\Core\Config;
use Cgat\Core\Request;
use Twig_Environment;
use Twig_Loader_Filesystem;

/*
* Source: "Learning PHP 7 by Antonio Lopez"
* Initialize configuration readers
* Process HTTP requests coming from the client and return a response
*/
abstract class AbstractController {
    protected $request;
    protected $config;
    protected $view;

    public function __construct(Request $request) {
        $this->request = $request;
        $this->config = Config::getConfig();

        $loader = new Twig_Loader_Filesystem(__DIR__ . '/../../views');
        $this->view = new Twig_Environment($loader);

    }

    protected function render($template, $params) {
        return $this->view->loadTemplate($template)->render($params);
    }

}