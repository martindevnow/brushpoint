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

function sanitiseDate ($stringDate) {

    $dt = DateTime::createFromFormat("m/d/Y", $stringDate);
    dd($dt);

    return $dt !== false && !array_sum($dt->getLastErrors());

    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $value, $match)) {
        return $match[1];
    }
    return false;
}