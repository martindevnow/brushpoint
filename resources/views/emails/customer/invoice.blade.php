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
                    <p>Thank you {{ $data['customer_name'] }} for your purchase!</p>
                    <p>Invoice: {{ $data['invoice_number'] }}</p>
                </div>
                <div class="col-md-6">
                    <p>Address: {{ $data['address']->street_1 }} <br />
                            {{ $data['address']->street_2 }}     <br />
                            {{ $data['address']->city }}         <br />
                            {{ $data['address']->province }}     <br />
                            {{ $data['address']->postal_code }}  <br />
                            {{ $data['address']->country }}</p>
                </div>
            </div>
        </div>
    </body>
</html>