<?php

namespace Cgat\Core;

use Cgat\Controllers\ErrorController;

/*
* Source: "Learning PHP 7 by Antonio Lopez"
*/
class Router {
    private $routeMap;
    private static $regexPatterns = [
        'int' => '\d+',
        'string' => '\w*([^0-9/]+)\w*'
    ];

    public function __construct() {
        // Create route map based on json file
        $json = file_get_contents(__DIR__ . '/../../config/routes.json');
        $this->routeMap = json_decode($json, true);
    }

    /*
    * Routes to the Controller
    */
    public function route(Request $request) { // Request contains parts of URL + GET, POST, COOKIES (domain, path, method, params, cookies)
        // Extract path from the URL
        $path = $request->getPath();

        // Search for a path in a route map
        foreach($this->routeMap as $route => $info) { // key => value

            // Create regex from route map and compare it to the path
            $regexRoute = $this->getRegexRoute($route, $info);

            if(preg_match("@^\/$regexRoute$@", $path)) { // starts with / and matches the whole regex
                return $this->executeController($route, $path, $info, $request); // execute controller if the route was found
            }
        }
        // Create ErrorController if path does't matches any route
        $errorController = new ErrorController($request); // execute ErrorController if no route was found
        return $errorController->notFound('pl');
    }

    // Returns the route with a parameter replaced by regex; i.e.: "courses/:category" where ":category": "string" returns "courses/\w"
    private function getRegexRoute($route, $info) {
        if(isset($info['params'])) {
            foreach($info['params'] as $name => $type) {
                $route = str_replace($name, self::$regexPatterns[$type], $route);
            }
        }
        return $route;
    }

    private function extractParams($route, $path) {
        $params = [];

        $pathParts = explode('/', $path);
        $routeParts = explode('/', $route);

        foreach ($routeParts as $key => $routePart) {
            if (strpos($routePart, ':') === 0) {
                $name = substr($routePart, 1);
                $params[$name] = $pathParts[$key+1];
            }
        }


        return $params;
    }

    private function executeController($route, $path, $info, $request) {
        $controllerName = '\Cgat\Controllers\\' . $info['controller']; // TODO: \\ - isn't it mistake?

        $controller = new $controllerName($request);

        // TODO: make authorisation system secure
        // if(isset($info['login']) && $info['login']) {
        //     if($request->getCookies()->has('user')) {
        //         $customerId = $request->getCookies()->get('user');
        //         $controller->setCustomerId($customerId);
        //     } else {
        //         $errorController = new CustomerController($request);
        //         return $errorController->login();
        //     }
        // }

        $params = $this->extractParams($route, $path);
        return call_user_func_array([$controller, $info['method']], $params);
    }


}

