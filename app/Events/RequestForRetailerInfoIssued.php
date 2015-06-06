<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;
use Martin\Quality\Feedback;

class RequestForRetailerInfoIssued extends Event {

	use SerializesModels;
    /**
     * @var Feedback
     */
    public $feedback;
    /**
     * @var string
     */
    public  $brushType;

    /**
     * Create a new event instance.
     *
     * @param Feedback $feedback
     * @param string $brushType
     * @return \App\Events\RequestForRetailerInfoIssued
     */
	public function __construct(Feedback $feedback, $brushType = 'battery')
	{
        $this->feedback = $feedback;
        $this->brushType = $brushType;
    }

}
