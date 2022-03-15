<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            店舗情報編集
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- *************************************************
                　　　　　　 コンテンツ部分
                    *************************************************** -->
                    <div>
                        <form action="{{ route('owner.stores.update', ['store'=>$store->id]) }}" method="POST">
                            @csrf
                            <!-- 店舗名 -->
                            <div>
                                <label for="name">店舗名</label>
                                <input type="text" name="name" id="name" value="{{$store->name}}">
                            </div>
                            <!-- 店舗情報 -->
                            <div>
                                <label for="information">店舗情報</label>
                                <textarea name="information" id="information">{{$store->information}}</textarea>
                            </div>
                            <!-- 業務状況 -->
                            <div>
                                <label for="is_selling_1">通常営業</label>
                                <input type="radio" id="is_selling_1" name="is_selling" value="1" @if($store->is_selling === 1){ checked } @endif>
                                <label for="is_selling_0">一時休業</label>
                                <input type="radio" id="is_selling_0" name="is_selling" value="0" @if($store->is_selling === 0){ checked } @endif>
                            </div>
                            <button type="submit">更新</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
