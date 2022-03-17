<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            メニュー変更
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- *************************************************
                    　　　　　　 コンテンツ部分
                    *************************************************** -->

                    <!-- *************************************************
                    　　　　　　 エラー表示Component
                    *************************************************** -->
                    <div>
                        <x-auth-validation-errors :errors="$errors"/>
                    </div>

                    
                    <div>
                        <!-- *************************************************
                        　　　　　　 新規登録用フォーム
                        *************************************************** -->
                        <form action="{{route('owner.menus.update', ['menu'=>$menu->id])}}" method="post">
                            @method('patch')
                            @csrf
                            <div> <!-- デザイン用でとりあえず囲っておく -->
                                <!-- 商品名 -->
                                <div>
                                    <label for="name">商品名</label>
                                    <input type="text" name="name" id="name" required value="{{$menu->name}}">
                                </div>
                                <!-- 商品情報 -->
                                <div>
                                    <label for="information">商品情報</label>
                                    <textarea name="information" id="information" required>{{$menu->information}}</textarea>
                                </div>
                                <!-- 値段 -->
                                <div>
                                    <label for="price">値段</label>
                                    <input type="number" name="price" id="price" min="0" max="10000" required value="{{$menu->price}}">
                                </div>
                                <!-- 販売状況 -->
                                <div>
                                    <label for="is_selling_1">販売中</label>
                                    <input type="radio" name="is_selling" id="is_selling_1" value="1" required @if( $menu->is_selling === 1 ){ checked } @endif>
                                    <label for="is_selling_0">販売停止</label>
                                    <input type="radio" name="is_selling" id="is_selling_0" value="0" required @if( $menu->is_selling === 0 ){ checked } @endif>
                                </div>

                                <!-- 並び順 -->
                                <div>
                                    <label for="sort_order">並び順</label>
                                    <input type="number" name="sort_order" id="sort_order" min="0" max="100" value="{{$menu->sort_order}}">
                                </div>

                                <!-- カテゴリー情報 -->
                                <label for="category">ジャンル</label>
                                <select name="category" id="category">
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}" @if($category->id === $menu->category_id){ selected } @endif>{{$category->name}}</option>
                                    @endforeach
                                </select>

                                <!-- 新商品 -->
                                <div>
                                    <label for="new_item_1">新商品</label>
                                    <input type="radio" name="new_item" id="new_item_1" value="1" required @if( $menu->new_item === 1 ){ checked } @endif >
                                    <label for="new_item_0">未設定</label>
                                    <input type="radio" name="new_item" id="new_item_0" value="0" required @if( $menu->new_item === 0 ){ checked } @endif >
                                </div>

                                <!-- もうすぐ終了 -->
                                <div>
                                    <label for="soon_over_1">もうすぐ終了</label>
                                    <input type="radio" name="soon_over" id="soon_over_1" value="1" required @if( $menu->soon_over === 1 ){ checked } @endif >
                                    <label for="soon_over_0">未設定</label>
                                    <input type="radio" name="soon_over" id="soon_over_0" value="0" required @if( $menu->soon_over === 0 ){ checked } @endif >
                                </div>

                                <!-- 小盛りOK -->
                                <div>
                                    <label for="small_serving_1">小盛りOK</label>
                                    <input type="radio" name="small_serving" id="small_serving_1" value="1" required @if( $menu->small_serving === 1 ){ checked } @endif >
                                    <label for="small_serving_0">未設定</label>
                                    <input type="radio" name="small_serving" id="small_serving_0" value="0" required @if( $menu->small_serving === 0 ){ checked } @endif >
                                </div>

                                <!-- button -->
                                <div>
                                    <!-- 普通にbuttonを実行するとPOST送信してしまうので、type="button"をつける必要がある -->
                                    <button type="button" onclick="location.href='{{ route('owner.menus.index') }}'">戻る</button>
                                    <button type="submit" >登録</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- デザイン用でとりあえず囲っておく -->

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
