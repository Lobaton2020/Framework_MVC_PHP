<?php

function route($path)
{
    $path = explode("/", $path);
    $method = isset($path[1]) ? "&m=" . $path[1] : "";
    $id = isset($path[2]) ? "&id=" . $path[2] : "";
    $path = "?c={$path[0]}{$method}{$id}";
    return URL_PROJECT . $path;
}
