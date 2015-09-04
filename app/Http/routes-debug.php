<?php

use Martin\Products\Item;
use Martin\Quality\Contact;


Route::get('invo', function()
{
    $product = Product::find(17);
    dd($product->getProductInventory());
});

Route::get('datetime', function() {
    $datet = Carbon::createFromDate(2015, 8, 0);//->createFromTime(0,0,0);
    // $datet = Carbon::cr
    echo (new Carbon('first day of July 2015'))->toDateTimeString();
    die();
});


Route::get('emailLog', function(){

    Mail::send('emails.internal.log', [], function($message) {
        $file = storage_path() . '/logs/laravel-2015-06-25.log';
        $message->attach($file);
        $message->to('the.one.martin@gmail.com')
            ->subject('Nightly Log - 2015-06-25');
    });
    return "Sent";
});


Route::get('fileUpload', function()
{
    return view('testing.fileUpload');
});



Route::get('addOneOfEach', function() {
    $cartRepo = new \Martin\Products\CartRepository();

    $items = \Martin\Products\Item::where('price', '>', 0)->get();
    foreach($items as $item)
        $cartRepo->addToCart($item, 1);
});


Route::get('destroyCart', function(){
    $cartRepo = new \Martin\Products\CartRepository();
    $cartRepo->clearCart();

    return print_r(session()->all(), 1);
});


Route::get('cartWeight', function()
{
    $cartRepo = new \Martin\Products\CartRepository();
    $cartRepo->getTotalWeight();
});






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


Route::get('emailFeedback', function(){
    $contact = Contact::find(1);

    return view('emails.internal.contact')->with(compact('contact'));

    event(new CustomerFeedbackSubmitted($feedback));

    return 1;
});




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

Route::get('dumpCart', function(){
    var_dump(session()->all());
});


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
 * Temporary
 */

Route::get('getPayerFromPayment', function() {
    $ecomPayment = \Martin\Ecom\Payment::find(2);
    $ecomPayer = $ecomPayment->payer;
    dd($ecomPayer);
});
Route::get('getAddressesFromPayer', function() {
    $ecomPayer = \Martin\Ecom\Payer::find(1);
    $ecomAddresses = $ecomPayer->addresses()->where('name', 'Atsuko Martin')->first();
    // echo $ecomAddresses->id;
    dd($ecomPayer->addresses->where('id', 5)->first());
    dd($ecomAddresses);
});





Route::get('test-checkout', function(){
    $checkout = new \Martin\Ecom\Checkout();
    $cartRepo = new \Martin\Products\CartRepository();

    $checkout->newPayment($cartRepo);
});


/**
 * Testing the Checkout Return Redirect URLs
 */


Route::get('displaySession', function(){
    dd(session()->all());
});



Route::get('payer1', function(){
    $payer = \Martin\Ecom\Payer::create([
        'payer_id' => "P69HMJQPKX258",
        'payment_method' => "paypal",
        'status' => "VERIFIED",
        'email' => "me@gmail.com",
        'first_name' => "Ben",
        'last_name' => "Martin",
    ]);

    dd(\Martin\Ecom\Payer::find(1));

});

