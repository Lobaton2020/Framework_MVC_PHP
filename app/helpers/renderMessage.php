<?php

function renderMessage($key)
{
    $type = "default";
    if ($key == "error") $type = "danger";
    if ($key == "success") $type = "success";
    if ($key == "info") $type = "info";
    if ($key == "warning") $type = "warning";
    if (isset($_SESSION["MESSAGE"][$key])) {
        $string = "<div class='alert alert-{$type} alert-dismissible fade show mt-2' role='alert'>";
        $string .= $_SESSION["MESSAGE"][$key];
        $string .= '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        $string .= '    <span aria-hidden="true">&times;</span>';
        $string .= '  </button>';
        $string .= '</div>';
        unset($_SESSION["MESSAGE"][$key]);
        return $string;
    }
}

function attendMessage()
{
    echo renderMessage("error");
    echo renderMessage("success");
    echo renderMessage("info");
    echo renderMessage("warning");
}
