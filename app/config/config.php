<?php
// constates de la base de datos
define("DBHOST", "localhost");
define("DBNAME", "testuser");
define("DBUSER", "root");
define("DBPASWORD", "");
define("DBDRIVER", "mysql");
define("DBCHARSET", "utf8");

// datos del servidor
define("SEPARATOR", "\\");
define("URL_APP",  dirname(dirname(__FILE__)) . SEPARATOR);
define("URL_PROJECT",  $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["HTTP_HOST"] . str_replace(basename($_SERVER["PHP_SELF"]), "", $_SERVER["PHP_SELF"]));
