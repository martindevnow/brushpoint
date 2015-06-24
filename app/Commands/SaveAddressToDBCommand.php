<?php namespace App\Commands;

use App\Commands\Command;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class SaveAddressToDBCommand extends Command {

    use ValidatesRequests;
    /**
     * @var Request
     */
    public $request;

    /**
     * Create a new command instance.
     *
     * @param Request $request
     * @return \App\Commands\SaveAddressToDBCommand
     */
	public function __construct(Request $request)
	{
        $this->request = $request;
    }
}
