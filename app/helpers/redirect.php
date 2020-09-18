<?php

function redirect($route)
{
    $route = route($route);
    echo "<script> window.location.href = '{$route}' </script>";
}
