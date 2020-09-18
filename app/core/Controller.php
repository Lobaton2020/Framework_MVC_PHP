<?php

class Controller
{

    protected function autentication()
    {
        if (!isset($_SESSION["user_logged"])) {
            redirect("auth");
            exit();
        }
    }

    protected function model($name)
    {
        $name = ucwords($name);
        $path = URL_APP . "models" . SEPARATOR . "{$name}.php";
        if (file_exists($path)) {
            require URL_APP . "models" . SEPARATOR . "{$name}.php";
            // if (class_exists($path, false)) {
            return new $name;
            // } else {
            // exit("Model Class not found");
            // }
        } else {
            exit("Model file not found");
        }
    }
}
