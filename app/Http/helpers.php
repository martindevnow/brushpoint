<?php


function asMoney($integer)
{
    return "$ " . number_format($integer, 2) . " USD";
}

function get_current_time()
{
    $dt = new DateTime;
    return $dt->format('y-m-d H:i:s');
}