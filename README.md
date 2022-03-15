@foreach ($owner_eager as $owner)
    @foreach ($owner->store->menu as $menu)
    <tr>
        <td>{{$menu->name}}</td>
        <td>{{$menu->information}}</td>
        <td>{{$menu->price}}</td>
        <td>{{$menu->category->name}}</td>
    </tr>
    @endforeach
@endforeach