<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Support\Facades\Request;
use Martin\Products\Virtue;
use Martin\Products\Product;
use mikehaertl\wkhtmlto\Pdf;

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('testpath', function(){
    $path = url('/');
    dd($path);
});

Route::get('pathvars', function() {
    echo "app path: " . app_path().
        "\n base path: ". base_path() .
        "\n public path: ". public_path().
        "\n url(/) " . url('/');
});





// TODO: Make the /cart calculate shipping cost everytime that page loads.




Route::get('googletopdf', function(){

    // You can pass a filename, a HTML string or an URL to the constructor
        $pdf = new Pdf('http://www.google.com');

    // On some systems you may have to set the binary path.
    // $pdf->binary = 'C:\...';


    if (!$pdf->saveAs('/home/martioo7/brushpoint/public/tmp/new.pdf')) {
        // dd($pdf->getCommand()->getOutput());
        throw new Exception('Could not create PDF: '.$pdf->getError());
    }
});


Route::get('dumpcart', function(){
    $cartRepo =  new \Martin\Products\CartRepository();
    var_dump(session()->all());
});


// Server Stuff
// TODO: Make sure the Invoices can be generated to PDFs on the server!!!!!!!
// TODO: THIS IS WORKING. Added a function to PaymentRepository



// TODO: all pages -- make the title collapse properly when resized too small (text doesn't wrap well)
// TODO: navbar -- when the page is shrunk, change text to smaller and change logo to only (BRUSHPOINT)
// TODO: all pages -- consider removing the breadcrumb all together



// May 6th 2015
// TODO: - RE-DISABLE duplication of 'Payments' in ProcessPaymentStatusCommandHandler.php
// TODO: - check the email that is generated and sent to the customer
// TODO: Build at least a little more on the admin area so that I can see what was purchased and how much
// TODO: build in the lot codes for the purchasing... '
// TODO: need to add the ability to keep track of inventory levels

// TODO: add middleware for moderators
// TODO: enable the creation of users for MODERATORS only



/**
 * Pages
 */
Route::get('/', 'PagesController@index');
Route::get('home', 'PagesController@index');
Route::get('about', 'PagesController@about');
Route::get('capabilities', 'PagesController@capabilities');
Route::get('contact', 'PagesController@contact');
Route::post('contact', 'PagesController@sendContact');
Route::get('contact/thankyou', 'PagesController@thankyouContact');
Route::get('video', 'PagesController@video');
Route::get('video.htm', 'PagesController@video');


/**
 * Feedback
 */
Route::get('feedback', 'FeedbackController@create');
Route::post('feedback/send', 'FeedbackController@send');
Route::post('feedback/address', 'FeedbackController@address');
Route::get('feedback/thankyou', 'FeedbackController@thankyou');
//Route::get('feedback/send', 'FeedbackController@send');


/**
 * Portfolio
 */
Route::get('products', 'ProductsController@index');
Route::get('products/id-{id}', 'ProductsController@show');
Route::get('products/id-{id}/{name}', 'ProductsController@show');



/**
 * Products
 */
Route::get('purchase/retailers', 'PurchaseController@retailers');
Route::get('purchase', 'PurchaseController@index');
Route::get('purchase/id-{id}', 'PurchaseController@show');
Route::get('purchase/id-{id}/{name}', 'PurchaseController@show');

/**
 * Cart
 */
Route::get('cart', 'CartController@index');
Route::get('cart/add/{id}', 'CartController@confirmAddToCart');
Route::post('cart/add/confirm', 'CartController@addToCartConfirmed');
Route::get('cart/remove/{id}', 'CartController@remove');
Route::post('cart/update', 'CartController@update');
Route::post('cart/shipping/country', 'CartController@shippingToCountry');
Route::get('cart/shipping/clear', 'CartController@clearShippingCountry');


/**
 * Checkout Controller
 */
Route::get('checkout/address', 'CartController@getPayerInfo');
Route::get('checkout/express', 'CheckoutController@expressCheckout');
Route::get('checkout/confirm', 'CheckoutController@confirmPayerInfo');
Route::get('checkout/process', 'CheckoutController@checkout');
Route::get('checkout/error', 'CheckoutController@error');
Route::get('checkout/status', 'CheckoutController@status'); // Route is HI

Route::get('checkout/thankyou/{invoiceId}', 'CheckoutController@thankyou');

Route::get('cart/checkout/status', 'CheckoutController@status'); // used???
Route::get('checkout/cancel', 'CheckoutController@cancel');




/**
 * Payment Processing
 */

Route::get('paymentTest', 'CartController@paymentTest');
Route::get('payment/execute', 'CartController@paymentTestExecute');


/**
 * Admin Routes
 *
 */
Route::group(['namespace' => 'Admin', 'middleware' => 'auth'], function()
{
    Route::get(         'admins', 'AdminController@index');




    Route::patch(       'admins/products/ajax/{id}',   'ProductsController@ajaxPatch');
    Route::patch(       'admins/products/active/{id}',         'ProductsController@ajaxActive');
    Route::patch(       'admins/products/portfolio/{id}',      'ProductsController@ajaxPortfolio');
    Route::patch(       'admins/products/purchase/{id}',       'ProductsController@ajaxPurchase');
    Route::get(         'admins/products/virtues/saveOrder',   'ProductsController@ajaxSaveListOrder');
    Route::get(         'admins/products/rearrange',            'ProductsController@rearrange');
    Route::get(         'admins/products/rearrange/saveOrder',            'ProductsController@ajaxSaveProductOrder');
    Route::resource(    'admins/products',      'ProductsController');



    Route::get(         'admins/feedback/filter',      'FeedbackController@filtered');
    Route::get(         'admins/feedback/{feedbackId}/retailer/remove', 'FeedbackController@removeRetailer');
    Route::get(         'admins/feedback/{feedbackId}/issue/remove',     'FeedbackController@removeIssue');
    Route::resource(    'admins/feedback',             'FeedbackController');
    Route::patch(       'admins/feedback/ajax/{id}',   'FeedbackController@ajaxPatch');


    Route::resource(    'admins/purchases',         'PurchasesController');

    Route::get(         'admins/payments/filter',      'PaymentsController@filtered');
    Route::resource(    'admins/payments',          'PaymentsController');
    Route::patch(       'admins/payments/ajax/{id}',   'PaymentsController@ajaxPatch');
    // TODO: Make a command for this action
    // TODO: using the full path /usr/local/bin/wkhtmltopdf works.
    // TODO: see if I can override the command set in phpwkhtmltopdf
    Route::get(         'admins/payments/invoice/{id}',         'PaymentsController@invoice');


    Route::resource(    'admins/users',          'UsersController');


    Route::post(        'admins/notes/store',       'NotesController@ajaxStore');

    Route::resource(    'admins/inventory',     'InventoryController');


    Route::post(        'admins/issues/store',      'IssuesController@ajaxStore');
    Route::patch(       'admins/issues/ajax/{id}',  'IssuesController@ajaxPatch');
    Route::resource(    'admins/issues',            'IssuesController');

    Route::post(        'admins/virtues/store',      'VirtuesController@ajaxStore');
    Route::get(        'admins/virtues/delete',     'VirtuesController@ajaxDelete');
    // Route::resource(    'admins/virtues',            'VirtuesController');

    Route::post(        'admins/retailers/store',      'RetailersController@ajaxStore');
    Route::patch(       'admins/retailers/ajax/{id}',  'RetailersController@ajaxPatch');
    Route::resource(    'admins/retailers',         'RetailersController');
    // store a new


    // Route::get(      'admins/products/create',   'ProductsController@create');
    // Route::post(     'admins/products/create',   'ProductsController@store');
});

Route::group(['namespace' => 'Admin'], function()
{
    Route::get('admins/payments/invoice/html/{id}', 'PaymentsController@invoiceHtml');
});

Route::get('destroyCart', function(){
    $cartRepo = new \Martin\Products\CartRepository();
    $cartRepo->clearCart();

    return print_r(Session::all(), 1);
});


Route::get('cartWeight', function()
{
    $cartRepo = new \Martin\Products\CartRepository();
    $cartRepo->getTotalWeight();
});

Route::get('sessionId', function() {
    dd(session('unique_id'));
});


/**
 * TODO: Adjust shipping calculation to do real shipping cost
 *      Other
        (Non-standard
        and Oversize)	0 - 100 g | 100 - 200 g | 200 - 300 g | 300 - 400 g	| 400 - 500 g
        Stamp(s)	    $1.80		$2.95	      $4.10			$4.70		  $5.05
 *
 */
