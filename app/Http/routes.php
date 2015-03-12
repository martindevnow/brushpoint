<?php
use Martin\Products\Item;
use Martin\Users\Permission;
use Martin\Users\Role;
use Martin\Users\User;


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




/**
 * From LV4 Version of the website
 */




// TODO: all pages -- make the title collapse properly when resized too small (text doesn't wrap well)
// TODO: navbar -- when the page is shrunk, change text to smaller and change logo to only (BRUSHPOINT)
// TODO: portfolio.show -- make it so the right side of the screen is on top when the page size shrinks
// TODO: portfolio.show -- reduce the size of the breadcrumb
// TODO: all pages -- consider removing the breadcrumb all together

// TODO: pages.contact -- make the email addresses clickable

// TODO: build the cart functionality

// TODO: 2015-02-23 -- Met with Paul Cira
// - Add images to the purchase page (replacement head image/thumbnail)
// - Add images to the homepage as per his email
// - Add thumbnail images to the products page
// - adjust the migrations to add Image(s) to the products.



/**
 * Testing
 */

class Bar {

    public $apiKey;
    function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }
}

App::bind('Bar', function(){
    return new Bar('APIKEY');
});

Route::get('bar', function(Bar $bar){

    dd($bar);
});


/**
 * Info
 */
Route::get('emergencyinfo', function()
{
    echo phpinfo();
    return 1;
});


/**
 * Cookies
 */
Route::get('deleteCookies', function()
{
    Cookie::forget('unique_id');
    Session::forget('unique_id');
    return 1;
});
Route::get('showCookies', function()
{
    return Cookie::get('unique_id');
});

/**
 * Cart
 */
Route::get('cartTest', function() {
    return View::make('pages.cartTest');
});

// working
Route::get('cartTotalSession', function(){
    $cartRepo = new \Martin\Products\CartRepository();
    return print_r($cartRepo->getCartTotal(), 1);

});

// working
Route::get('cartTotalDB', function(){
    $cartRepo = new \Martin\Products\CartRepository();
    return print_r($cartRepo->getCartTotalDB(), 1);

});

Route::get('destroyCart', function(){
    $cartRepo = new \Martin\Products\CartRepository();
    $cartRepo->clearCart();

    return print_r(Session::all(), 1);
});

Route::get('loadCartFromDB', function(){
    $cartRepo = new \Martin\Products\CartRepository();
    $cartRepo->loadCartFromDb();
    dd($cartRepo->getCart());
});

Route::get('addToCart/{id}', function($id){
    $item = Item::find($id);
    $cartRepo = new \Martin\Products\CartRepository();
    $cartRepo->addToCart($item, 1);

    return print_r(Session::all(), 1);
});
Route::get('cartView', function(){

});


/**
 * Session
 *
 */
Route::get('viewSession', function() {
    $data = Session::all();
    dd($data);
});
Route::get('sessionTest', function(){

    Session::put('cart.item-1', [
        'price' => 1.42,
        'quantity' => 5
    ]);
    Session::put('cart.item-2', [
        'price' => 1.42,
        'quantity' => 2
    ]);
    Session::put('cart.item-4', [
        'price' => 1.42,
        'quantity' => 4
    ]);
    Session::put('cart.item-7', [
        'price' => 1.42,
        'quantity' => 1
    ]);

    return print_r(Session::all(), 1);

});


/**
 * Images
 */


Route::get('imageDZThumb', function()
{
    $file = "products/RH-DM-555.png";
    $path = public_path() . '/images/brushpoint/';


    $img = Image::make($path . $file);
    $img->crop(200, 200);
    $img->resize(115, null, function($constraint){
        $constraint->aspectRatio();
    });

    // dd($img);
    return Response::make($img->encode('png'), 200, ['Content-Type' => 'image/png']);

});


/**
 * Pages
 */
Route::get('/', 'PagesController@index');
Route::get('home', 'PagesController@index');
Route::get('about', 'PagesController@about');
Route::get('capabilities', 'PagesController@capabilities');
Route::get('contact', 'PagesController@contact');
Route::get('video', 'PagesController@video');

/**
 * Feedback
 */
Route::get('feedback', 'FeedbackController@create');
Route::get('feedback/store', 'FeedbackController@store');


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
Route::get('cart/address', 'CartController@getPayerInfo');
Route::get('cart/checkout/express', 'CartController@expressCheckout');
Route::get('cart/checkout/confirm', 'CartController@confirmPayerInfo');
Route::get('cart/checkout/process', 'CartController@checkout');
Route::get('cart/checkout/success', 'CartController@success');
Route::get('cart/checkout/cancelled', 'CartController@cancelled');

Route::get('cart/confirmAdd/{id}', 'CartController@confirmAddToCart');
Route::post('cart/confirmAdd/{id}', 'CartController@addToCartConfirmed');

Route::get('cart/checkout/status', [
    'as' => 'payment_status',
    'uses' => 'CartController@getPaymentStatus'
]);


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
    Route::resource('admins/feedback', 'FeedbackController');
    Route::resource('admins/purchases', 'PurchasesController');

    // Route::get('admins/products/create', 'ProductsController@create');
    // Route::post('admins/products/create', 'ProductsController@store');
});
