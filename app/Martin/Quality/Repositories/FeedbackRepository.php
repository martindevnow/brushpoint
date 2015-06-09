<?php namespace Martin\Quality\Repositories;

use Martin\Quality\Feedback;

class FeedbackRepository {

    public $intents = [
        'sales',
        'product',
        'general',
        'other'
    ];

    public function getClosedCount()
    {
        return Feedback::where('closed', '=', '1')->count();
    }

    public function getOpenCount()
    {
        return Feedback::where('closed', '=', '0')->count();
    }
}