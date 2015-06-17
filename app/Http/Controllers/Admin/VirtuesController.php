<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Martin\Products\Product;
use Martin\Products\Virtue;

class VirtuesController extends Controller {

    /**
     * @param Request $request
     * @return string
     */
    public function ajaxStore(Request $request)
    {
        $product = Product::find($request->product_id);

        $type = $request->type;
        $body = $request->body;

        $virtue = Virtue::firstOrCreate([
            'type' => $type,
            'body' => $body
        ]);

        $product->virtues()->save($virtue);

        return view('admin.ajax.singles.virtue')->with(compact('virtue'));
    }

    public function ajaxDelete(Request $request)
    {
        Virtue::find($request->virtueToDelete)->delete();;
    }
}
