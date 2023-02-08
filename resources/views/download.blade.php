<table>
    <thead>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>price</th>
        <th>stock</th>
        <th>created at</th>
        <th>updated at</th>
    </tr>
    </thead>

    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->price}}</td>
            <td>{{$product->stock}}</td>
            <td>{{$product->created_at}}</td>
            <td>{{$product->updated_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
