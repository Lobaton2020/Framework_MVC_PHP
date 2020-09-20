<?php

function currentDatetime()
{
    return date("Y-m-d H:i:s");
}

function format_date($date)
{
    $date = explode(" ", $date);
    $date = str_replace("-", "/", $date[0]);
    return $date;
}
