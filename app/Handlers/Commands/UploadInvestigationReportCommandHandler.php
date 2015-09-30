<?php namespace App\Handlers\Commands;

use App\Commands\UploadInvestigationReportCommand;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Martin\Quality\Investigation;
use Martin\Quality\InvestigationReport;

class UploadInvestigationReportCommandHandler {

    use ValidatesRequests;


    public $request;

    /**
     * Create the command handler.
     *
     * @return \App\Handlers\Commands\UploadInvestigationReportCommandHandler
     */
    public function __construct()
    {
//        dd("handler created");
    }

    /**
     * Handle the command.
     * @param UploadInvestigationReportCommand $command
     * @return bool
     */
    public function handle(UploadInvestigationReportCommand $command)
    {
        $this->request = $command->request;
        $this->validate($this->request,[
            'investigation_report' => 'required|mimes:pdf'
        ]);

        $investigation = Investigation::findOrFail($this->request->investigation_id);

        // TODO: get and save any image which might be attached.
        if ($this->request->hasFile('investigation_report'))
        {
            $shortPath = config('brushpoint.investigation_report_storage_path');
            $fullPath = base_path() . $shortPath ;

            $investigationReport = new InvestigationReport();
            $investigationReport->save();


            $investigationReport_name = $investigationReport->id . '.' .
                $this->request->file('investigation_report')->getClientOriginalExtension();


            $investigationReport->file_name = $this->request->file('investigation_report')->getClientOriginalName();
            $investigationReport->file_path = $shortPath . $investigationReport_name;
            $investigationReport->file_extension = $this->request->file('investigation_report')->getClientOriginalExtension();
            $investigationReport->save();

            $this->request->file('investigation_report')->move(
                $fullPath, $investigationReport_name
            );

            Auth::user()->investigationReports()->save($investigationReport);

            $investigation->investigationReports()->save($investigationReport);

            return true;
        }
        Flash::error("Your file could not be uploaded.");

        return false;
    }
}
