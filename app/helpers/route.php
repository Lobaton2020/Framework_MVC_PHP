<?php
function route($path)
{
    return URL_PROJECT . $path;
}
/**
 * @param bool $type 
 * Allow decide if it wants to create a url of Operatice System
 * Or a url normal. with http...
 */

function path($path, $type = true)
{
    if ($type) {
        $path = str_replace(".", SEPARATOR, $path);
        return URL_APP . $path;
    } else {
        $path = str_replace(".", "/", $path);
        return URL_PROJECT . $path;
    }
}

function relativePath($path, $type = true)
{
    if ($type) {
        return str_replace(".", SEPARATOR, $path);
    } else {
        return str_replace(".", "/", $path);
    }
}
