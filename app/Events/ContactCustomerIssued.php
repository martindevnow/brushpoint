<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;
use Martin\Quality\Contact;
use Martin\Quality\Feedback;

class ContactCustomerIssued extends Event {

	use SerializesModels;


    public $feedback;
    /**
     * @var Contact
     */
    public $contact;

    /**
     * Create a new event instance.
     *
     * @param Contact $contact
     * @return \App\Events\ContactCustomerIssued
     */
	public function __construct(Contact $contact)
	{
        $this->contact = $contact;
        $this->feedback = $contact->feedback;
    }

}
