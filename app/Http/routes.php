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
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('testpath', function(){
    $path = url('/');
    dd($path);
});



// TODO: all pages -- make the title collapse properly when resized too small (text doesn't wrap well)
// TODO: navbar -- when the page is shrunk, change text to smaller and change logo to only (BRUSHPOINT)
// TODO: all pages -- consider removing the breadcrumb all together

// TODO: pages.contact -- make the email addresses clickable

// TODO: build the cart functionality

// TODO: 2015-02-23 -- Met with Paul Cira
// - Add images to the purchase page (replacement head image/thumbnail)
// - Add images to the homepage as per his email
// - Add thumbnail images to the products page
// - adjust the migrations to add Image(s) to the products.


/**
 * Pages
 */
Route::get('/', 'PagesController@index');
Route::get('home', 'PagesController@index');
Route::get('about', 'PagesController@about');
Route::get('capabilities', 'PagesController@capabilities');
Route::get('contact', 'PagesController@contact');
Route::post('contact', 'PagesController@sendContact');

Route::get('video', 'PagesController@video');

/**
 * Feedback
 */
Route::get('feedback', 'FeedbackController@create');
Route::post('feedback/send', 'FeedbackController@send');
Route::post('feedback/address', 'FeedbackController@address');
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



/**
 * Checkout Controller
 */
Route::get('checkout/address', 'CartController@getPayerInfo');
Route::get('checkout/express', 'CheckoutController@expressCheckout');
Route::get('checkout/confirm', 'CheckoutController@confirmPayerInfo');
Route::get('checkout/process', 'CheckoutController@checkout');
Route::get('checkout/error', 'CheckoutController@error');
Route::get('checkout/status', 'CheckoutController@status');

Route::get('cart/checkout/status', 'CheckoutController@status');
Route::get('checkout/cancel', 'CheckoutController@cancel');


/*
Route::get('checkout/success', 'CheckoutController@success');
Route::get('checkout/cancelled', 'CheckoutController@cancelled'); */
/*Route::get('checkout/status', [
    'as' => 'payment_status',
    'uses' => 'CheckoutController@getPaymentStatus'
]);*/




/**
 * Payment Processing
 */

Route::get('paymentTest', 'CartController@paymentTest');
Route::get('payment/execute', 'CartController@paymentTestExecute');


/**
 * Admin Routes
 *
 */
Route::group(['namespace' => 'Admin'], function()
{
    Route::get('admins', 'AdminController@index');
    Route::resource('admins/products', 'ProductsController');
    // TODO: Replace these 3 with one Ajax method that will accept a variety of info to be updated via PATCH
    Route::patch('admins/products/active/{id}', 'ProductsController@ajaxActive');
    Route::patch('admins/products/portfolio/{id}', 'ProductsController@ajaxPortfolio');
    Route::patch('admins/products/purchase/{id}', 'ProductsController@ajaxPurchase');

    Route::get('admins/feedback/filter', 'FeedbackController@filtered');
    Route::resource('admins/feedback', 'FeedbackController');
    Route::patch('admins/feedback/resolved/{id}', 'FeedbackController@ajaxResolved');
    Route::patch('admins/feedback/closed/{id}', 'FeedbackController@ajaxClosed');
    Route::patch('admins/feedback/ajax/{id}', 'FeedbackController@ajaxPatch');


    Route::resource('admins/purchases', 'PurchasesController');
    
    Route::resource('admins/payments', 'PaymentsController');

    Route::get('admins/payments/invoice/{id}', 'PaymentsController@invoice');
    Route::get('admins/payments/invoice/html/{id}', 'PaymentsController@invoiceHtml');


    Route::post('admins/note/store', 'NotesController@ajaxStore');
    // Route::get('admins/products/create', 'ProductsController@create');
    // Route::post('admins/products/create', 'ProductsController@store');
});








