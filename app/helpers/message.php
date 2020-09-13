<?php
function renderMessage($name, $type = "info")
{
    if (sessionExist($name)) {
        if ($name === "success") $type = "success";
        if ($name === "info") $type = "info";
        if ($name === "danger") $type = "danger";
        if ($name === "error") $type = "danger";
        if ($name === "warning") $type = "warning";

        $string   = '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">';
        $string  .=  session($name);
        $string  .=    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        $string  .=        '<span aria-hidden="true">&times;</span>';
        $string  .=    '</button>';
        $string  .= '</div>';

        return $string;
    }
}
