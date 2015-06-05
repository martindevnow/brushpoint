<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;
use Martin\Quality\Feedback;

class CustomerFeedbackSubmitted extends Event {

	use SerializesModels;
    /**
     * @var Feedback
     */
    public $feedback;

    /**
     * Create a new event instance.
     *
     * @param Feedback $feedback
     * @return \App\Events\CustomerFeedbackSubmitted
     */
	public function __construct(Feedback $feedback)
	{
		//
        $this->feedback = $feedback;
    }

}
