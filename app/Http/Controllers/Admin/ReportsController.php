<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Martin\Ecom\Payment;
use Martin\Ecom\SoldItem;
use Martin\Ecom\Transaction;
use Martin\Notifications\Flash;
use Martin\Quality\Feedback;

class ReportsController extends Controller {


    protected $viableReports = ['SoldItems', 'Payments', 'Feedback'];

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return view('admin.reports.index')
            ->with(['viableReports' => $this->viableReports]);
	}


    /**
     * This method is run first
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function run(Request $request)
    {
        if ($request->report >= count($this->viableReports) || $request->report < 0)
        {
            Flash::error('That report could not be run');
            return redirect()->back();
        }
        $reportToRun = "generate" . $this->viableReports[$request->report];

        return $this->$reportToRun($request);
    }




    public function generateSoldItems(Request $request)
    {
        $model = new SoldItem();
        return $this->prepareReport($model, $request);
    }

    public function generateFeedback(Request $request)
    {
        $model = new Feedback();
        return $this->prepareReport($model, $request);
    }

    public function generatePayments(Request $request)
    {
        $model = new Payment();
        return $this->prepareReport($model, $request);
    }


    public function prepareReport(Model $model, Request $request)
    {
        $dates = $model->getDatesFromRequest($request);

        $file = storage_path() . '/'. $model->generateFileName($dates['from'], $dates['to']);

        $data = $model->generateReport($model->reporterFields, $dates['from'], $dates['to']);

        $fp = fopen($file, 'w');
        foreach ($data as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);

        return response()->download($file);
    }



//    protected function getMonthName($monthNumber)
//    {
//        $dateObj   = DateTime::createFromFormat('!m', $monthNumber);
//        $monthName = $dateObj->format('F'); // March
//        return $monthName;
//    }

}
