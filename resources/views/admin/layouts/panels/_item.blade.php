<div class="panel panel-default">
    <div class="panel-heading">{{ $item->sku }}</div>
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
                <td colspan="2">{{ $item->name }}</td>
            </tr>
            <tr>
                <td>On Hand</td>
                <td>{{ $item->on_hand }}</td>
            </tr>
            <tr>
                <td>Image</td>
                <td>
                    @include('admin.layouts.images._thumbnail', ['images'=> $item->product->images])
                </td>
            </tr>
        </tbody>
    </table>
    </div>
</div>