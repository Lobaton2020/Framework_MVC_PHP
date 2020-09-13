<?php

class Router
{
    private $controller = "AuthController";
    private $method = "index";
    private $params = [];

    public function __construct()
    {
        $this->params = $this->getUrl();
        $this->controller = $this->getController();
        $this->method = $this->getMethod();

        $this->params = $this->params ? array_values($this->params) : [];
        $this->params[] = empty($this->params) ? (object) $_POST : [];
        echo  call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function getController($index = 0)
    {
        $controller = isset($this->params[$index]) ? $this->params[$index] . "Controller" : null;
        if (isset($controller)) {
            if (file_exists("../app/controllers/" . ucwords($controller) . ".php")) {
                $this->controller = ucwords($controller);
                unset($this->params[$index]);
            }
        }
        require_once "../app/controllers/" . $this->controller . ".php";
        return new $this->controller;
    }
    public function getMethod($index = 1)
    {
        $method = isset($this->params[$index]) ? $this->params[$index] : null;

        if (isset($method)) {
            if (method_exists($this->controller, $method)) {
                $this->method = $method;
                unset($this->params[$index]);
            }
        }
        return $this->method;
    }

    public function getUrl()
    {
        if (isset($_GET["url"])) {
            $url = rtrim($_GET["url"]);
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode("/", $url);
            return $url;
        }
    }
}
