<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            取り扱いメニュー
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- *************************************************
                　　　　　　 コンテンツ部分
                    *************************************************** -->

                    <!-- 店舗情報表示 -->
                    <div>
                        <div>
                            <button onclick="location.href='{{route('owner.menus.create')}}'">メニューを追加する</button>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>品名</th>
                                    <th>情報</th>
                                    <th>料金</th>
                                    <th>カテゴリー</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($owner_eager as $owner)
                                    @foreach ($owner->store->menu as $menu)
                                    <tr>
                                        <td>{{$menu->name}}</td>
                                        <td>{{$menu->information}}</td>
                                        <td>{{$menu->price}}</td>
                                        <td>{{$menu->category->name}}</td>
                                        <td><button type="button" onclick="location.href='{{ route('owner.menus.edit', ['menu' => $menu->id]) }}'" >変更</button></td>
                                        <td>
                                            <form action="{{route('owner.menus.destroy', ['menu'=>$menu->id])}}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit">削除</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
