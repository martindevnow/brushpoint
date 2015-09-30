<?php namespace App\Http\Controllers\Admin;

use App\Commands\UploadInvestigationReportCommand;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Martin\Notifications\Flash;
use Martin\Quality\Investigation;
use Martin\Quality\InvestigationReport;

class InvestigationsController extends Controller {


    public function ajaxPatch($investigationId, Request $request)
    {
        $field = $request->get('field');
        $value = $request->has($field);

        $investigation = Investigation::find($investigationId);

        if ($field == "field_sample_received")
            $investigation->toggleFieldSampleReceived($value);
        else
            $investigation->$field = $value;
        $investigation->save();
        return "Passed";
    }

    public function reportStore(Request $request)
    {
        $result = $this->dispatch(new UploadInvestigationReportCommand($request));

        if ($result)
            Flash::message('Your file was uploaded.');
        else

        return redirect()->back();
    }

    public function reportDownload($investigationReportId)
    {
        $investigationReport = InvestigationReport::find($investigationReportId);

        return $investigationReport->download();
    }


}
