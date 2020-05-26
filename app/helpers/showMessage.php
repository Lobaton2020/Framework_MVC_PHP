<?php

function showMessage($session, $type)
{
    if (isset($_SESSION[$session])) {

        $string = "<div class='alert alert-" . $type . "' role='alert'>";
        $string .= $_SESSION[$session];
        $string .= "</div>";
        unset($_SESSION[$session]);
        echo $string;
    }
}
