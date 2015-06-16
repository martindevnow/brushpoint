<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Martin\Quality\Investigation;

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
}
