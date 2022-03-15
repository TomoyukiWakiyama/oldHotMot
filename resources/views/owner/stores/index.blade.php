<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            店舗情報
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
                        @foreach ($stores as $store)
                        <!-- 店舗情報変更へ遷移 -->
                            <div>
                                <button onclick="location.href='{{ route('owner.stores.edit', ['store' => $store->id]) }}'">変更</button>
                            </div>
                            <ul>
                                <li>{{$store->name}}</li>
                                <li>{{$store->information}}</li>
                                <li>
                                    @if ($store->is_selling)
                                        通常営業
                                    @else
                                        一時休業
                                    @endif
                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
