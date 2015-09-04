<div class="panel panel-default">
    <div class="panel-heading">{{ $payer->payer_id }}</div>
    <div class="panel-body">
    <table class="table table-default">
        <thead>
            <tr>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">
                    {{ $payer->email }}
                </td>
            </tr>
            <tr>
                <td>Purchases</td>
                <td>{{ $payer->payments->count() }}</td>
            </tr>
            <tr>
                <td>Name</td>
                <td>
                    {{ $payer->first_name . " " . $payer->last_name }}
                </td>
            </tr>
        </tbody>
    </table>
    </div>
</div>