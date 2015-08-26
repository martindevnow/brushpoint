<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Martin\Core\Attention;
use Martin\Notifications\Flash;

class AttentionsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $attentions = Attention::all();
        return view('admins.attentions.index')
            ->with(compact('attentions'));

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$attention = Attention::find($id);
        $attention->see()->save();

        Flash::success('Notification removed.');
        return redirect()->back();
	}



    public function clearAll()
    {
        $attentions = Attention::unseen()->get();
        foreach ($attentions as $attention)
            $attention->see()->save();

        Flash::success('All notifications have been cleared');
        return redirect()->back();;

    }

}
