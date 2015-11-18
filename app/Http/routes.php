<?php


use Martin\Core\Address;
use Martin\Core\Attention;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Martin\Core\Note;
use Martin\Ecom\Payer;
use Martin\Ecom\Payment;
use Martin\Ecom\Transaction;
use Martin\Products\Category;
use Martin\Products\Product;
use Martin\Quality\Contact;
use Martin\Quality\CustomerRequest;
use Martin\Quality\Feedback;


//Route::get('build_categories', function(){
//    $current = Category::all()->count();
//
//    if ($current)
//        return redirect('/');
//
//    Category::create([
//        'name' => 'Power Toothbrushes',
////        'description' => 'Power Toothbrushes',
//        'slug' => 'power',
//    ]);
//    Category::create([
//        'name' => 'Children’s Toothbrushes',
////        'description' => 'Childrens Toothbrushes',
//        'slug' => 'childrens',
//    ]);
//    Category::create([
//        'name' => 'Manual Toothbrushes',
////        'description' => 'Manual Toothbrushes',
//        'slug' => 'manual',
//    ]);
//    Category::create([
//        'name' => 'Whitening',
////        'description' => 'Whitening Toothbrushes',
//        'slug' => 'whitening',
//    ]);
//    Category::create([
//        'name' => 'Denture',
////        'description' => 'Denture Accessories',
//        'slug' => 'denture',
//    ]);
//    Category::create([
//        'name' => 'Toothpaste',
////        'description' => 'Toothpastes',
//        'slug' => 'toothpaste',
//    ]);
//    Category::create([
//        'name' => 'Interdental & Accessories',
////        'description' => 'Interdental and Other Accessories',
//        'slug' => 'interdental',
//    ]);
//
//    return "Categories Built ... next please assign the categories";
//});
//
//
//
//Route::get('assign_categories', function(){
//
//    $power = Category::find(1)->products->count();
//    if ($power)
//        return 'Power Toothbrushes already setup.';
//
//
//    // 1. Power
//    Product::find(1)->categories()->attach(1);  // VH Power
//    Product::find(2)->categories()->attach(1);  // VH Recharg
//    Product::find(3)->categories()->attach(1);  // VH Sonic
//    Product::find(7)->categories()->attach(1);      // Sonic
//    Product::find(8)->categories()->attach(1);      // Dual Zone
//    Product::find(9)->categories()->attach(1);      // Power Whitening
//    Product::find(10)->categories()->attach(1);     // Pro Clean
//    Product::find(11)->categories()->attach(1);     // Pulsating
//    $products[] = ['name' => 'Deep Clean Rechargeable', 'cat' => 1];
//    Product::find(12)->categories()->attach(1);     // Osc Recharge
//    Product::find(13)->categories()->attach(1);     // Pulsating Recharge
//    Product::find(4)->categories()->attach(1);  // Kids Power
//
//    // 2. Kids
//    Product::find(4)->categories()->attach(2);  // Kids Power
//    Product::find(5)->categories()->attach(2);  // Kids Manual
//    // CANDY STRIPE
//    $products[] = ['name' => 'Designer Stripe Manual Toothbrush',
//                   'sku' => 'CandyStripe', 'cat' => 2];
//    // SUCTION CUP
//    $products[] = ['name' => 'Suction Cup Manual Toothbrushes',
//                   'sku' => 'SuctionCupManual', 'cat' => 2];
//
//
//
//    // 3. Manual
//    // DEEP CLEAN
//    $products[] = ['name' => 'Deep Clean Manual', 'cat' => 3];
//    // WHITENING
//    $products[] = ['name' => 'Optimal Whitening™ Manual',
//                   'sku' => 'OptimalWhiteningManual', 'cat' => 3];
//    // OVERALL HEALTH
//    $products[] = ['name' => 'Overall Health Manual', 'cat' => 3];
//    // SENSITIVE
//    $products[] = ['name' => 'Sensitive Reprieve™ Manual',
//                   'sku' => 'SensitiveReprieveManual', 'cat' => 3];
//
//
//    // 4. Whitening
//    Product::find(16)->categories()->attach(4);  // Whitening Pen
//    // OPTIMAL WHITENING
//    $products[] = ['name' => 'Optimal Whitening™ Power System',
//                   'sku' => 'OptimalWhiteningPowerSystem', 'cat' => 4];
//    // WHITENING TOOTHPASTE
//    $products[] = ['name' => 'Whitening Toothpaste', 'cat' => 4];
//
//
//    // 5. Denture
//    // COMPLETE
//    $products[] = ['name' =>  'Complete Denture Adhesive',  'cat' => 5];
//    // SUPER HOLD
//    $products[] = ['name' =>  'Super Hold Denture Adhesive','cat' => 5];
//    // SUPER HOLD FREE
//    $products[] = ['name' =>  'Super Hold Free Denture Adhesive', 'cat' => 5];
//    // DENTURE BRUSH
//    $products[] = ['name' =>  'Denture Brush', 'cat' => 5];
//    // DENTURE BATH
//    $products[] = ['name' =>  'Denture Bath', 'cat' => 5];
//
//
//    // 6. Toothpaste
//    // SENSITIVE
//    $products[] = ['name' => 'Sensitive Toothpaste', 'cat' => 6];
//    // SENSITIVE WHITENING
//    $products[] = ['name' => 'Sensitive Whitening', 'cat' => 6];
//    // ENAMEL PROTECTION
//    $products[] = ['name' => 'Enamel Protection', 'cat' => 6];
//
//
//    // 7. Interdental / Accessories
//    // NIGHT GUARD
//    $products[] = ['name' => 'Night Guard', 'cat' => 7];
//    // INTERENTAL TOOLS
//    $products[] = ['name' => 'Interdental Tools', 'cat' => 7];
//    // INTERDENTAL BRUSHES
//    $products[] = ['name' => 'Interdental Brushes', 'cat' => 7];
//    // FLOSSER PICKS
//    $products[] = ['name' => 'Flosser Picks', 'cat' => 7];
//    // COMFORT FLOSS
//    $products[] = ['name' => 'Comfort Dental Floss', 'cat' => 7];
//
//
//    foreach($products as $product)
//    {
//        $dbProduct = Product::create([
//            'name'      => $product['name'],
//            // 'description' => $product['name'],
//            'sku'       => (isset($product['sku'])?$product['sku']:str_replace(' ', '', $product['name'])),
//            'on_hand'   => 0,
//            'price'     => 0,
//            'active'    => 0,
//            'portfolio' => 1,
//        ]);
//        if (!is_array($product['cat']))
//            $dbProduct->categories()->attach($product['cat']);
//        else{
//            foreach ($product['cat'] as $cat)
//                $dbProduct->categories()->attach($cat);
//        }
//    }
//
//    return "Products created and associated to the proper tags";
//});

//
//Route::get('testCarbon', function() {
//    $feedback = Feedback::find(4);
//    dd(get_class($feedback->created_at));
//    $relation = $feedback->notable();
//    dd($relation);
//
//});
//
//Route::get('classtest', function()
//{
//    $add['address'] = Address::latest()->first();
//    $add['payer'] = Payer::latest()->first();
//    $add['payment'] = Payment::latest()->first();
//    $add['contact'] = Contact::latest()->first();
//    $add['customerRequest'] = CustomerRequest::latest()->first();
//    $add['feedback'] = Feedback::latest()->first();
//
//
//    foreach ($add as $name => $model)
//    {
//        $attention = new Attention([
//            'global' => true,
//            'action' => "created_{$name}",
//            'attentionable_id' => $model->id,
//            'attentionable_type' => get_class($model)
//        ]);
//        $attention->save();
//    }
//});
//
//Route::get('findalldeadtransactions', function()
//{
//    $bad_ones = "";
//    $transactions = Transaction::all();
//    foreach ($transactions as $transaction)
//    {
//        $bad_ones .= "Transaction {$transaction->id}: ";
//
//        if (! $transaction->payments)
//        {
//            $bad_ones .= "Has a bad payents relationship.<br />";
//        }
//        else
//        {
//            foreach ($transaction->payments as $payment)
//            {
//                $bad_ones .= "Payment {$payment->id} is associated. Payment: {$payment->state}<br />";
//            }
//        }
//    }
//    return $bad_ones;
//});
//
//
//Route::get('attentions', function() {
//    $attentions = Attention::unseen()->get();
//    dd($attentions);
//});
//




/**
 * June 23 2015
 * - TODO: make a nightly cron that will deactivate any dead Purchase SKUs
 *
 * - TODO: make a weekly cron to run some quick statistics on the DB
 *
 * - TODO: 
 */


/**
 * June 11 2015
 * - TODO: When resizing the page, I changed at what size the large nav bar becomes the small one.
 *         I was able to make the long nav bar stay at smaller resolutions because the logo would
 *         change to the small logo (no innovations) and be responsive.
 *      However, some items in the nav bar change depending on the resolution of the screen. In
 *         particular, the purchase will show an additional "toothbrushes" and AboutUs will show
 *         "About Us" in the sub menu. This is because the smaller menu that this template uses
 *         does not support clicking on any node that is a parent node to change the URL. only
 *         clicking on the final child would lead to a page.
 *
 * = TODO: Resize the banner at the top of the page. Only needs to be 272px tall
 *          just keep the same ratio and it should scale just fine
 *
 * - TODO: Try to identify unused CSS / JS that can be removed from the project and not affect it.
 *          ideally, we need to remove what we don't need and then we can use gulp to minify the
 *          pages too. since it's all text, that should save on some load times
 *
 * - TODO: check the order of imports of files. make sure all CSS is loaded before JS
 *          js can load after the page has been loaded, however, css should load first.
 *
 * - TODO: remove these debug routes from the routes file so they cannot be used after launch
 *
 *
 * - TODO: test the purchasing a few more times to make sure it goes through properly.
 *          refunds etc will have to be handled manually (can make a function for this if required.
 *
 * - DONE: INVENTORY - make it so lots/skus can be put "on hold" so that item won't ship
 *
 *
 * - DONE: INVENTORY/PURCHASE - when an item is OOS, have it so that item is disabled on the site
 *
 *
 * - TODO: PURCHASE/INVENTORY - when an item has say < 20 left in stock, have a post on the site
 *          and don't allow people have more than that in their cart at one time
 *
 * - TODO: INVO/PURCH - allow users to be notified if an item is out of stock and when it comes back into stock
 *
 * - TODO: change the slideshows on the about page to not have a black background when the images are loading
 *
 * - TODO: get a file from Vivian that has all the retailers and issues she'd need for her QA stuff
 *
 * - TODO: Make sure the cart shipping calculation is working correctly
 *          especially when changing quantity, adding items, deleting items etc..
 *
 * - TODO: Make sure duplicate payments will not be accepted. (ie if a user refreshes a page or reposts the same
 *          data that paypal sent, then it won't issue the purchase on our site twice
 *          This was disabled before, but it was turned off for testing.
 *      FILE:    ProcessPaymentStatusCommandHandler.php
 *
 *
 */



// May 6th 2015
// TODO: - RE-DISABLE duplication of 'Payments' in
// TODO: - check the email that is generated and sent to the customer
// TODO: - add the date to the invoice that is generated.

// TODO: Build at least a little more on the admin area so that I can see what was purchased and how much
// TODO: build in the lot codes for the purchasing... '

// TODO: need to add the ability to keep track of inventory levels

// TODO: add middleware for moderators
// TODO: enable the creation of users for MODERATORS only




// Server Stuff
// TODO: Make sure the Invoices can be generated to PDFs on the server!!!!!!!
// TODO: - Add a function to PaymentRepository (DONE?)



// DONE: all pages -- make the title collapse properly when resized too small (text doesn't wrap well)
// DONE: navbar -- when the page is shrunk, change text to smaller and change logo to only (BRUSHPOINT)
// N//A: all pages -- consider removing the breadcrumb all together


/**
 * Authorization
 */

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

/**
 * Pages
 */
Route::get('/', 'PagesController@index');
Route::get('home', 'PagesController@index');
Route::get('about', 'PagesController@about');
Route::get('capabilities', 'PagesController@capabilities');
Route::get('contact', 'PagesController@contact'); // redirects to feedback

Route::get('video', 'PagesController@video');

// Backwards compatible with the QR code on packaged goods
Route::get('video.htm', function(){
    return redirect('/video', 301);
});


/**
 * Feedback
 */
Route::get('feedback/edit/{feedbackId}/{customerRequestId}/{customerRequestHash}', 'FeedbackController@editCustomerRequest');
Route::post('feedback/edit/{feedbackId}/{customerRequestId}/{customerRequestHash}', 'FeedbackController@storeCustomerRequest');

Route::get('feedback',          'FeedbackController@create');
Route::post('feedback/send',    'FeedbackController@send');

Route::get('feedback/address', 'FeedbackController@createAddress');
Route::post('feedback/address', 'FeedbackController@storeAddress');

Route::get('feedback/thankyou', 'FeedbackController@thankyou');


/**
 * Portfolio
 */
Route::get('products', 'ProductsController@index');
Route::get('products/id-{id}', 'ProductsController@show');
Route::get('products/id-{id}/{name}', 'ProductsController@show');


/**
 * Categories
 */
Route::get('category/', 'CategoriesController@index');
Route::get('category/{slug}', 'CategoriesController@show');


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
// Route::post('cart/add/confirm', 'CartController@addToCartConfirmed'); depreciated
Route::post('cart/confirm/add', 'CartController@addToCartConfirmed');
Route::get('cart/remove/{id}', 'CartController@remove');
Route::post('cart/update', 'CartController@update');
Route::post('cart/shipping/country', 'CartController@shippingToCountry');
Route::get('cart/shipping/clear', 'CartController@clearShippingCountry');


/**
 * Checkout Controller
 *
 * There are some unused routes in here. Need to go through the code and identify them
 * and remove the unused ones.
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
 * Admin Routes (Protected by Middleware)
 *
 */
Route::group(['namespace' => 'Admin', 'middleware' => 'auth'], function()
{


    /**
     * Attachments
     */
    Route::post(        'admins/attachments/store',       'AttachmentsController@attachmentStore');
    Route::get(        'admins/attachments/download/{id}',   'AttachmentsController@attachmentDownload');



    /**
     * Addresses
     */
    Route::post(        'admins/addresses/store',       'AddressesController@ajaxStore');
    Route::get(         'admins/addresses/remove/{id}',       'AddressesController@delete');



    /**
     * Attentions
     */
    Route::get(         'admins/attentions/clearAll', 'AttentionsController@clearAll');
    Route::get(         'admins/attentions/remove/{id}', 'AttentionsController@destroy');
    Route::resource(         'admins/attentions', 'AttentionsController',
        ['only' => ['index', 'show']]);




    /**
     * Contacts
     */
    Route::resource(    'admins/contacts', 'ContactsController');




    /**
     * Dashboard
     */
    Route::get(         'admins', 'AdminController@index');


    /**
     * Debug
     */

    Route::get('admins/debug', 'DebugController@index');
    Route::get('admins/debug/inventory/calculate', 'DebugController@calculateInventory');

    /**
     * Emails
     * - view the email templates that are sent to different people.
     */
    Route::get('admins/emails', 'EmailsController@index');
    Route::get('admins/emails/{emailScope}/{emailType}', 'EmailsController@show');



    /**
     * Feedback
     */
    Route::post(        'admins/feedback/contact/customer',     'FeedbackController@contactCustomer');
    Route::post(        'admins/feedback/contact/send',         'FeedbackController@sendContactCustomer');
    // Route::post(         'admins/feedback/email/requestRetailerInfo', 'FeedbackController@emailRequestRetailerInfo');
    Route::get(         'admins/feedback/filter',               'FeedbackController@filtered');
    Route::get(         'admins/feedback/{feedbackId}/retailer/remove', 'FeedbackController@removeRetailer');
    Route::get(         'admins/feedback/{feedbackId}/issue/remove',     'FeedbackController@removeIssue');
    Route::patch(       'admins/feedback/ajax/{id}',            'FeedbackController@ajaxPatch');
    Route::patch(       'admins/feedback/ajaxToggle/{id}',      'FeedbackController@ajaxToggle');
    Route::resource(    'admins/feedback',                      'FeedbackController');
    Route::patch(       'admins/feedback/{id}',                 'FeedbackController@update');
    Route::get(         'admins/feedback/{id}/close',           'FeedbackController@close');
    Route::get(         'admins/feedback/{id}/shipped',         'FeedbackController@sendShippedNotificationToCustomer');




    Route::get('admins/images/download/{id}', 'ImagesController@download');


    /**
     * Inventory
     */
    Route::get(         'admins/inventory/item/{id}/create',     'InventoryController@createForItem');
    Route::get(         'admins/inventory/item/{id}',     'InventoryController@showItem');
    Route::get(         'admins/inventory/lot/{id}',     'InventoryController@showLotActivity');
    Route::get(         'admins/inventory/hold/{id}',     'InventoryController@putOnHold');
    Route::get(         'admins/inventory/activate/{id}',     'InventoryController@activate');
    Route::resource(    'admins/inventory',             'InventoryController');


    /**
     * Issues
     */
    Route::post(        'admins/issues/store',      'IssuesController@ajaxStore');
    Route::patch(       'admins/issues/ajax/{id}',  'IssuesController@ajaxPatch');
    Route::resource(    'admins/issues',            'IssuesController');


    /**
     * Investigations
     */
    Route::patch(       'admins/investigations/ajax/{id}',   'InvestigationsController@ajaxPatch');
    Route::post(        'admins/investigations/report/store',   'InvestigationsController@reportStore');
    Route::get(        'admins/investigations/download/{id}',   'InvestigationsController@reportDownload');




    /**
     * Notes
     */
    Route::post(        'admins/notes/store',       'NotesController@ajaxStore');




    /**
     * Purchaseable Products Only
     */
    Route::get(         'admins/purchase/rearrange',            'ProductsController@rearrangePurchase');
    Route::get(         'admins/purchase/rearrange/saveOrder',   'ProductsController@ajaxSaveProductOrder');
    // Route::resource(    'admins/purchases',         'PurchasesController');


    /**
     * Payments
     */
    Route::get(         'admins/payments/create',      'PaymentsController@create');
    Route::post(         'admins/payments/createCart',      'PaymentsController@createCart');
    Route::post(         'admins/payments/processOrder',      'PaymentsController@processOrder');
    Route::get(         'admins/payments/filter',      'PaymentsController@filtered');
    Route::patch(       'admins/payments/ajax/{id}',   'PaymentsController@ajaxPatch');
    // TODO: Make a command for this action
    // TODO: using the full path [/usr/local/bin/wkhtmltopdf] works.
    // TODO: see if I can override the command set in phpwkhtmltopdf
    Route::get(         'admins/payments/invoice/{id}',         'PaymentsController@invoice');
    Route::resource(    'admins/payments',          'PaymentsController');


    /**
     * Payers
     */
    Route::resource('admins/payers', 'PayersController');




    /**
     * Products
     */
    // Route::get(      'admins/products/create',               'ProductsController@create');
    // Route::post(     'admins/products/create',               'ProductsController@store');
    Route::patch(       'admins/products/ajax/{id}',            'ProductsController@ajaxPatch');
    Route::patch(       'admins/products/active/{id}',          'ProductsController@ajaxActive');
    Route::patch(       'admins/products/portfolio/{id}',       'ProductsController@ajaxPortfolio');
    Route::patch(       'admins/products/purchase/{id}',        'ProductsController@ajaxPurchase');
    Route::get(         'admins/products/virtues/saveOrder',    'ProductsController@ajaxSaveListOrder');
    Route::get(         'admins/products/rearrange',            'ProductsController@rearrange');
    Route::get(         'admins/products/rearrange/saveOrder',  'ProductsController@ajaxSaveProductOrder');
    Route::resource(    'admins/products',                      'ProductsController');

    /**
     * Reports
     */
    Route::get(         'admins/reports', 'ReportsController@index');
    Route::post(         'admins/reports/run', 'ReportsController@run');
    Route::get(         'admins/reports/generate/payments', 'ReportsController@generatePayments');
    Route::get(         'admins/reports/generate/soldItems', 'ReportsController@generateSoldItems');
    Route::get(         'admins/reports/generate/feedback', 'ReportsController@generateFeedback');




    /**
     * Retailers
     */
    Route::post(        'admins/retailers/store',      'RetailersController@ajaxStore');
    Route::patch(       'admins/retailers/ajax/{id}',  'RetailersController@ajaxPatch');
    Route::resource(    'admins/retailers',             'RetailersController');


    /**
     * Search
     */

    Route::get(         'admins/search', 'SearchController@index');
    Route::post(         'admins/search', 'SearchController@show');

    /**
     * Virtues
     */
    Route::post(        'admins/virtues/store',      'VirtuesController@ajaxStore');
    Route::get(         'admins/virtues/delete',     'VirtuesController@ajaxDelete');
    // Route::resource(    'admins/virtues',            'VirtuesController');




    /**
     * Users
     */
    Route::resource(    'admins/users',          'UsersController');


});


/**
 * Admin Routes
 *  ( Not protected by middleware.
 *  ( This is so that the server can visit these links to process the PDF from this
 *  ( Need to find a work around for this so it can be locked.
 */
Route::group(['namespace' => 'Admin'], function()
{
    Route::get('admins/payments/invoice/html/{id}', 'PaymentsController@invoiceHtml');
});



/**
 * TODO: Adjust shipping calculation to do real shipping cost
 *      Other
        (Non-standard
        and Oversize)	0 - 100 g | 100 - 200 g | 200 - 300 g | 300 - 400 g	| 400 - 500 g
        Stamp(s)	    $1.80		$2.95	      $4.10			$4.70		  $5.05
 *
 */
