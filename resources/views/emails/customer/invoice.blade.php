<html>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>BrushPoint Innovations Inc.</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <p>Thank you {{ $customer_name }} for your purchase!</p>
                    <p>Invoice: {{ $invoice_number }}</p>
                </div>
                <div class="col-md-6">
                    <p>Address: {{ $customer_address->street_1 }} <br />
                            {{ $customer_address->street_2 }}     <br />
                            {{ $customer_address->city }}         <br />
                            {{ $customer_address->province }}     <br />
                            {{ $customer_address->postal_code }}  <br />
                            {{ $customer_address->country }}</p>
                </div>
            </div>
        </div>
    </body>
</html>