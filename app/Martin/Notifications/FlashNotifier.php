<?php

namespace Martin\Notifications;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use \Illuminate\Session\Store;

class FlashNotifier {

    private $session;

    public function __construct(Store $session) {
        $this->session = $session;
    }

    public function success($message) {
        $this->message($message, 'success');
    }

    public function error($message) {
        $this->message($message, 'danger');
    }

    public function overlay($message) {
        $this->message($message);
        $this->session->flash('flash_notification.overlay', true);
    }

    public function message($message, $level = 'info') {
        $this->session->flash('flash_notification.message', $message);
        $this->session->flash('flash_notification.level', $level);

    }
}
