<?php


function asMoney($integer)
{
    return "$ " . number_format($integer, 2) . " USD";
}