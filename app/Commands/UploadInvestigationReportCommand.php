<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Martin\Quality\Investigation;
use Martin\Quality\InvestigationReport;

class UploadInvestigationReportCommand extends Command {


    /**
     * @var Request
     */
    public $request;

    /**
     * Create a new command instance.
     *
     * @param Request $request
     * @return \App\Commands\UploadInvestigationReportCommand
     */
	public function __construct(Request $request)
	{

        $this->request = $request;
    }

}
