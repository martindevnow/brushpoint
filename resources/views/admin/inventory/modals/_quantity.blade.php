<?php
$modal[$inventory->id] = [
    'class' => '',
    'icon' => 'fa-pencil',
    'button_text' => '',

    'lc_name' => 'inventory-'. $inventory->id,
    'name' => 'Inventory-'. $inventory->id,

    'field' => 'quantity',
    'field_label' => 'Quantity On Hand',
    'field_value' => $inventory->quantity,

    'method' => 'patch',
    'url' => '/admins/inventory/'. $inventory->id,
    'model_key' => '',
];
?>
@include('admin/ajax/patch/_text', ['modal' => $modal[$inventory->id]])
