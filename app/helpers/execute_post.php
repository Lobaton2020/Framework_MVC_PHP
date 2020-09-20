<?php

function execute_post($callback)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        return $callback((object)$_POST);
    } else {
        exit("Error de metodo de peticion");
    }
}
