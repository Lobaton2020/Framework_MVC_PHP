<?php


if (!isset($_REQUEST["c"])) {

    $controller = "AuthController"; // por defecto
    require URL_APP . "controllers" . SEPARATOR . $controller . ".php"; //url por defecto
    $controller = new $controller();
    $controller->index();
} else {

    $controller = ucwords(strtolower($_REQUEST["c"])) . "Controller";
    $method = isset($_REQUEST["m"]) ? $_REQUEST["m"] : "index";
    $id = isset($_GET["id"]) ? $_GET["id"] : null;

    if (file_exists(URL_APP . "controllers" . SEPARATOR . $controller . ".php")) {
        require URL_APP . "controllers" . SEPARATOR . $controller . ".php";
        if (class_exists($controller)) {
            $controller = new $controller;
            if (method_exists($controller, $method)) {
                echo call_user_func_array([$controller, $method], [$id]);
            } else {
                exit("Method of class not exist");
            }
        } else {
            exit("Class not exist");
        }
    } else {
        exit("File of controller not exist");
    }
}
