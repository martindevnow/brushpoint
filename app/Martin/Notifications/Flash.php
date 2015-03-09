<?php namespace Martin\Notifications;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Illuminate\Support\Facades\Facade;

class Flash extends Facade
{
    protected static function getFacadeAccessor ()
    {
        return 'flash';

    }
}

