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

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('testpath', function(){
    $path = url('/');
    dd($path);
});


Route::get('prodatt', function()
{
    //$replh = Product::find(17);
    //dd($replh->items()->get());



    $product = Product::find(1);

    /*$virtue_1 = Virtue::create([
        'type' => 'feature',
        'body'  =>  'THis is the first feature'
    ]);



    $virtue_2 = Virtue::create([
        'type' => 'benefit',
        'body'  =>  'THis is the first benefit'
    ]);


    $product->virtues()->save($virtue_1);
    $product->virtues()->save($virtue_2);*/


    dd($product->benefits);

});




// Server Stuff
// TODO: Make sure the Invoices can be generated to PDFs on the server!!!!!!!



// TODO: all pages -- make the title collapse properly when resized too small (text doesn't wrap well)
// TODO: navbar -- when the page is shrunk, change text to smaller and change logo to only (BRUSHPOINT)
// TODO: all pages -- consider removing the breadcrumb all together



// May 6th 2015
// TODO: - get proper copy from paul
// TODO:        -- make a csv format that can be imported easily
// TODO:        -- Make the CSV support arrays in the fields...

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
    Route::resource(    'admins/products',      'ProductsController');
    Route::patch(       'admins/products/ajax/{id}',   'ProductsController@ajaxPatch');

    Route::patch(       'admins/products/active/{id}',         'ProductsController@ajaxActive');
    Route::patch(       'admins/products/portfolio/{id}',      'ProductsController@ajaxPortfolio');
    Route::patch(       'admins/products/purchase/{id}',       'ProductsController@ajaxPurchase');

    Route::get(         'admins/feedback/filter',      'FeedbackController@filtered');
    Route::get(         'admins/feedback/{feedbackId}/retailer/remove', 'FeedbackController@removeRetailer');
    Route::get(         'admins/feedback/{feedbackId}/issue/remove',     'FeedbackController@removeIssue');
    Route::resource(    'admins/feedback',             'FeedbackController');
    Route::patch(       'admins/feedback/ajax/{id}',   'FeedbackController@ajaxPatch');


    Route::resource(    'admins/purchases',         'PurchasesController');
    
    Route::resource(    'admins/payments',          'PaymentsController');
    Route::patch(       'admins/payments/ajax/{id}',   'PaymentsController@ajaxPatch');

    Route::resource(    'admins/users',          'UsersController');

    Route::get(         'admins/payments/invoice/{id}',         'PaymentsController@invoice');
    Route::get(         'admins/payments/invoice/html/{id}',    'PaymentsController@invoiceHtml');

    Route::post(        'admins/notes/store',       'NotesController@ajaxStore');

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



