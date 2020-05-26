<?php

class Core
{
    private $controller = "AuthController";
    private $method = "index";
    private $params = [];

    public function __construct()
    {
        $this->params = $this->getUrl();
        $this->controller = isset($this->params[0]) ? $this->getController($this->params[0]) : $this->getController();
        $this->method = isset($this->params[1]) ? $this->getMethod($this->params[1]) : $this->getMethod();
        
        $this->params = $this->params ? array_values($this->params) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);    
    }

    private function getController($controller = null, $index = 0)
    {
        if (isset($controller)) {
            if (file_exists("../app/controllers/" . ucwords($controller) . "Controller.php")) {
                $this->controller = ucwords($controller) . "Controller";
                unset($this->params[$index]);
            }
        }
        require_once "../app/controllers/" . $this->controller . ".php";
        return new $this->controller;
    }

    private function getMethod($method = null, $index = 1)
    {
        if (isset($method)) {
            if (method_exists($this->controller, $method)) {
                $this->method = $method;
                unset($this->params[$index]);
            }
        }
        return $this->method;
    }

    private function getUrl()
    {
        if (isset($_GET["url"])) {

            $url = rtrim($_GET["url"]);
            $url = filter_var($url, FILTER_VALIDATE_URL);
            $url = explode("/", $_GET["url"]);
            return $url;
        }
    }
}
