<?php
function dd($array, $array2 = null, $stop = true)
{
    if ($array2 != null) {
        var_dump($array, $array2);
    } else {
        var_dump($array);
    }
    if ($stop) {
        exit();
    }
};

function ddJson($array, $stop = true)
{
    echo json_encode($array, true);
    if ($stop) {
        exit();
    }
};
