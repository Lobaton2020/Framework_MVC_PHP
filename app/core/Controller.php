<?php

class Controller
{

    protected function autentication()
    {
        if (!isset($_SESSION["credentials"])) {
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
            if (class_exists($name)) {
                return new $name;
            } else {
                exit("Model Class not found");
            }
        } else {
            exit("Model file not found");
        }
    }
}
