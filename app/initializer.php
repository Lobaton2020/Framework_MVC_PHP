<?php
require_once "helpers/route.php";
require_once "helpers/showMessage.php";
require_once "config/config.php";

date_default_timezone_set("America/Lima");

spl_autoload_register(function ($basename) {
    require "libs/" . $basename . ".php";
});
