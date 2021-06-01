<?php
    namespace Cgat\Core;

    /*
    * Source: "Learning PHP 7 by Antonio Lopez"
    * Extracts domain, path, method of request and parameters from the URL. Deals with the cookies.
    * Use filter class to filter data send by User. It uses FilteredMap class.
    */
    class Request {
        const GET = 'GET';
        const POST = 'POST';

        private $domain;
        private $path;
        private $method;
        private $params;
        private $cookies;

        public function __construct() {
            $this->domain = $_SERVER['HTTP_HOST'];
            $this->path = explode('?', $_SERVER['REQUEST_URI'])[0]; // get first part if there is a GET method injected into URI
            $this->method = $_SERVER['REQUEST_METHOD'];
            $this->params = new FilteredMap(array_merge($_POST, $_GET));
            $this->cookies = new FilteredMap($_COOKIE);
        }

        public function getUrl() {
            return $this->domain . $this->path;
        }

        public function getDomain() {
            return $this->domain;
        }

        public function getPath() {
            return $this->path;
        }

        public function getMethod() {
            return $this->method;
        }

        public function isPost() {
            return $this->method === self::POST;
        }

        public function isGet() {
            return $this->method === self::GET;
        }

        public function getParams() {
            return $this->params;
        }

        public function getCookies() {
            return $this->cookies;
        }

    }

?>