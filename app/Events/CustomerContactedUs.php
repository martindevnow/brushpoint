<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;
use Martin\Quality\Contact;

class CustomerContactedUs extends Event {

	use SerializesModels;
    /**
     * @var Contact
     */
    public $contact;

    /**
     * Create a new event instance.
     *
     * @param Contact $contact
     * @return \App\Events\CustomerContactedUs
     */
	public function __construct(Contact $contact)
	{
		//
        $this->contact = $contact;
    }

}
