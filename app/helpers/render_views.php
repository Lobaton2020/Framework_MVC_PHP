<?php

function view($view, $data = [],  $all = true, $alone = false)
{

    extract($data);
    $view = str_replace('.', SEPARATOR, $view);
    if (file_exists(URL_APP . "views" . SEPARATOR . "{$view}.php")) {
        if ($alone) {
            require_once URL_APP . "views" . SEPARATOR .  $view . ".php";
        } else {
            require_once URL_APP . "views" . SEPARATOR . "layouts" . SEPARATOR . "header.php";
            if ($all) {
                require_once URL_APP . "views" . SEPARATOR . "layouts" . SEPARATOR . "navbar.php";
                require_once URL_APP . "views" . SEPARATOR . "{$view}.php";
                require_once URL_APP . "views" . SEPARATOR . "layouts" . SEPARATOR . "slidebar.php";
                require_once URL_APP . "views" . SEPARATOR . "layouts" . SEPARATOR . "footerbar.php";
            } else {
                require_once URL_APP . "views" . SEPARATOR . "{$view}.php";
            }
            require_once URL_APP . "views" . SEPARATOR . "layouts" . SEPARATOR . "footer.php";
        }
    } else {
        exit("View {$view} not found");
    }
}


function include_document($view, $datos = [])
{
    extract($datos);
    $view = str_replace('.', SEPARATOR, $view);
    $view = URL_APP . "views" . SEPARATOR . "{$view}.php";
    if (file_exists($view)) {
        require_once $view;
    } else {
        exit("File '{$view}'  not  found");
    }
}
