<?php
$factory('Martin\Core\Address', [
    'description' => $faker->sentence,
    'name' => $faker->word,
    'company' => ($faker->word),
    'street_1' => $faker->streetAddress,
    'street_2' => '',
    'city' => $faker->city,
    'province' => $faker->word,
    'postal_code' => $faker->postcode,
    'country' => $faker->country,
    'phone' => $faker->phoneNumber,
    'buzzer' => '',
    'ppid' => '',
    'recipient_name' => '',
    'default_address' => '',
    'addressable_type' => '',
]);

$factory('Martin\Core\Image', [
    'user_id' => 'factory:Martin\Users\User',
    'height' => $faker->numberBetween(200, 500),
    'width' => $faker->numberBetween(200,500),
    'path' => $faker->url,
    'thumbnail' => $faker->boolean(),
]);

$factory('Martin\Core\Note', [
    'user_id' => 'factory:Martin\Users\User',
    'content' => $faker->paragraph,

    'noteable_id' => '',
    'noteable_type' => '',
]);









$factory('Martin\Ecom\Payer', [
    'payer_id' => $faker->name,
    'status' => 'completed',
    'email' => $faker->email,
    'first_name' => ($faker->word),
    'last_name' => ($faker->word),
]);

$factory('Martin\Ecom\Payment', [
    'unique_id' => $faker->firstName,
    'payment_id' => $faker->firstName,
    'hash' => bcrypt(time()),
    'state' => 'completed',
    'intent' => 'sale',
    'shipped' => 0,
    'shipped_at' => '',
    'payer_id' => 'factory:Martin\Ecom\Payer',
    'address_id' => 'factory:Martin\Core\Address',
]);

$factory('Martin\Ecom\SoldItem', [
    'item_id' => 'factory:Martin\Products\Item',
    'sku' => '',
    'lot_code' => '',
    'transaction_id' => 'factory:Martin\Ecom\Transaction',
    'name' => '',
    'price' => '',
    'currency' => '',
    'quantity' => '',
]);

$factory('Martin\Ecom\Transaction', [
    'amount_subtotal' => '',
    'amount_shipping' => '',
    'amount_shipping_real' => '',
    'amount_total' => '',
    'amount_currency' => '',
    'description' => '',
]);




$factory('Martin\Products\Cart', [
    'user_id' => 'factory:Martin\Users\User',
    'unique_id' => bcrypt(time()),
    'item_id' => 'factory:Martin\Products\Item',
    'price' => '',
    'quantity' => '',
]);

$factory('Martin\Products\Inventory', [
    'transaction_id' => 'factory:Martin\Ecom\Transaction',
    'item_id' => 'factory:Martin\Products\Item',
    'lot_code' => '',
    'expiry_date' => '',
    'quantity' => '',
    'description' => '',
]);

$factory('Martin\Products\Item', [
    'product_id' => 'factory:Martin\Products\Product',
    'name' => '',
    'description' => '',
    'sku' => '',
    'price' => '',
    'on_hand' => '',
    'variance' => '',
]);

$factory('Martin\Products\Package', [
    'feedback_id' => 'factory:Martin\Quality\Feedback',
    'address_id' => 'factory:Martin\Code\Address',
    'tracking_number' => '',
]);

$factory('Martin\Products\Product', [
    'name' => $faker->word,
    'description' => $faker->sentence,
    'sku' => $faker->word,
    'price' => 5.00,
    'on_hand' => $faker->numberBetween(100,500),
    'heading' => $faker->sentence,
    'active' => 1,
    'portfolio' => 1,
    'purchase' => 0,
]);

$factory('Martin\Products\Virtue', [
    'body' => $faker->sentence,
    'type' => 'feature',
    'product_id' => 'factory:Martin\Products\Product',
    'priority' => $faker->numberBetween(1,100),
]);






$factory('Martin\Quality\Contact', [
    'name' => $faker->name,
    'email' => $faker->email,
    'message' => $faker->paragraph(),
    'ip' => $faker->ipv4,
    'hash' => bcrypt(time()),
]);
// FEEDBACK
$factory('Martin\Quality\Feedback', [
    'name' => $faker->name,
    'email' => $faker->email,
    'phone' => $faker->phoneNumber,
    'retailer_text' => $faker->word,
    'retailer_id' => 'factory:Martin\Quality\Retailer',
    'retailer_reference' => $faker->word,
    'lot_code' => '',
    'issue_text' => $faker->word,
    'issue_id' => 'factory:Martin\Quality\Issue',
    'hash' => bcrypt(time()),
    'bp_code' => '',
    'ip_address' => $faker->ipv4,
    'country' => $faker->country,
    'address_id' => 'factory:Martin\Code\Address',
    'adverse_event' => $faker->boolean(),
    'health_canada_report' => $faker->boolean(),
    'capa_required' => $faker->boolean(),
    'capa_reason' => '',
    'closed' => 0,
    'closed_at' => '',
]);
// INVESTIGATION
$factory('Martin\Quality\Investigation', [
    'feedback_id' => 'factory:Martin\Quality\Feedback',
    'field_sample_requested_at' => '',
    'field_sample_received_at' => '',
]);
// ISSUE
$factory('Martin\Quality\Issue', [
    'type' => $faker->word,
    'complaint' => $faker->boolean(),
]);
// RETAILER
$factory('Martin\Quality\Retailer', [
    'name' => $faker->name,
    'description' => $faker->sentence(),
    'active' => 1,
]);




// PERMISSION

// ROLE

// USER
$factory('Martin\Users\User', [
    'name' => $faker->name,
    'email' => $faker->email,
    'password' => bcrypt(12345),
]);





/*
Martin\Core\Address             ADDED
Martin\Core\CoreModel           NA
Martin\Core\Image               ADDED
Martin\Core\Note                ADDED
Martin\Core\Pdf                 NA

Martin\Ecom\Checkout            NA
Martin\Ecom\Payer               ADDED
Martin\Ecom\Payment             ADDED
Martin\Ecom\SoldItem            ADDED
Martin\Ecom\Transaction         ADDED

Martin\Products\Cart            ADDED
Martin\Products\Inventory       ADDED
Martin\Products\Item            ADDED
Martin\Products\Package         ADDED
Martin\Products\Product         ADDED
Martin\Products\Virtue          ADDED

Martin\Quality\Contact          ADDED
Martin\Quality\Feedback         ADDED
Martin\Quality\Investigation    ADDED
Martin\Quality\Issue            ADDED
Martin\Quality\Retailer         ADDED

Martin\User\Permission
Martin\User\Role
Martin\User\User                ADDED
 */