<?php namespace App\Http\Controllers\Admin;

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

        $this->validate($request,[
            'investigation_report' => 'required|mimes:pdf'
        ]);

        $investigation = Investigation::findOrFail($request->investigation_id);



        // TODO: get and save any image which might be attached.
        if ($request->hasFile('investigation_report'))
        {

            $shortPath = '/storage/app/investigationReports/';
            $fullPath = base_path() . $shortPath ;

            $investigationReport = new InvestigationReport();
            $investigationReport->save();


            $investigationReport_name = $investigationReport->id . '.' .
                $request->file('investigation_report')->getClientOriginalExtension();


            $investigationReport->file_name = $shortPath . $investigationReport_name;
            $investigationReport->file_extension = $request->file('investigation_report')->getClientOriginalExtension();
            $investigationReport->save();

            $request->file('investigation_report')->move(
                $fullPath, $investigationReport_name
            );


            Auth::user()->investigationReports()->save($investigationReport);

            $investigation->investigationReports()->save($investigationReport);

            return redirect()->back();
        }
        Flash::error("Your file could not be uploaded.");
        return redirect()->back();
    }


}
