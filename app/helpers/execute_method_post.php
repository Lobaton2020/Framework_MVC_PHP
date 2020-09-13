<?php
function execute_post($callback)
{
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $callback((object)$_POST);
    } else {
        exit("The request method '{$_SERVER["REQUEST_METHOD"]}' is Incorrect for this action");
    }
}
