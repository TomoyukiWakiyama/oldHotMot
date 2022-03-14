<tbody>
    @foreach ($owners as $owner)
        <tr>
            <td>{{$owner->name}}</td>
            <td>{{$owner->email}}</td>
            <td>{{$owner->created_at->diffForHumans()}}</td>
            <td>{{$owner->updated_at->diffForHumans()}}</td>
            <td>
                <form method="post" action="{{ route('admin.canseled-owners.destroy', ['owner'=>$owner->id]) }}">                                            
                    @csrf
                    <button type="submit">削除</button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>