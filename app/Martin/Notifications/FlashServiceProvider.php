<?php namespace Martin\Notifications;

use Illuminate\Support\ServiceProvider;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class FlashServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bindShared('flash', function() {
            return $this->app->make('Martin\Notifications\FlashNotifier');

        });
    }
}