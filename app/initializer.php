<?php
require_once "config/config.php";
session_start();
date_default_timezone_set("America/Bogota");

$helpers  = scandir(URL_APP . "helpers");
unset($helpers[0], $helpers[1]);
foreach ($helpers as $helper) {
    include_once URL_APP . "helpers" . SEPARATOR . $helper;
}
spl_autoload_register(function ($class) {
    require_once URL_APP . "core/{$class}.php";
});
