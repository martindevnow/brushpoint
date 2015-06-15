<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;
use Martin\Quality\Contact;
use Martin\Quality\CustomerRequest;
use Martin\Quality\Feedback;

class ContactCustomerIssued extends Event {

	use SerializesModels;


    public $feedback;
    /**
     * @var Contact
     */
    public $contact;
    /**
     * @var CustomerRequest
     */
    public $customerRequest;

    /**
     * Create a new event instance.
     *
     * @param Contact $contact
     * @param CustomerRequest $customerRequest
     * @return \App\Events\ContactCustomerIssued
     */
	public function __construct(Contact $contact, CustomerRequest $customerRequest)
	{
        $this->contact = $contact;
        $this->feedback = $contact->feedback;
        $this->customerRequest = $customerRequest;
    }

}
