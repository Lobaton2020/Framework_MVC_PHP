<?php

function redirect($route = null)
{
    if (!$route) {
        $route = $_SERVER["HTTP_REFERER"];
    } else {
        $route = route($route);
    }
    echo "<script> window.location.href = '{$route}' </script>";
    return new Redirect();
}

class Redirect
{
    public  function with($key, $value)
    {
        $_SESSION["MESSAGE"][$key] = $value;
        return new self;
    }
}
