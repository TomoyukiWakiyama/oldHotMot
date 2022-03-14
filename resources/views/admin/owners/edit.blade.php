<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            オーナー情報更新
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

                    <!-- *************************************************
                　　　　　　 新規登録用フォーム
                    *************************************************** -->
                    <div>
                        <!-- owners/owner/edit のルートは 第2引数の'owner'で渡される  -->
                        <form action="{{route('admin.owners.update', ['owner'=>$owner->id])}}" method="post">
                            <!-- Resourcesの更新はputで用意される -->
                            @method('PUT')
                            @csrf
                            <div> <!-- デザイン用でとりあえず囲っておく -->
                                <!-- 名前 -->
                                <div>
                                    <label for="name">名前</label>
                                    <input type="text" name="name" id="name" value="{{$owner->name}}">
                                </div>
                                <!-- メール -->
                                <div>
                                    <label for="email">メールアドレス</label>
                                    <input type="email" name="email" id="email" value="{{$owner->email}}">
                                </div>
                                <!-- 店舗名 -->
                                <div>
                                    <label for="store_name">店舗名</label>
                                    <input type="text" name="store_name" id="store_name" value="{{$owner->store->name}}">
                                </div>
                                <!-- 店舗情報 -->
                                <div>
                                    <label for="store_information">店舗情報</label>
                                    <textarea name="store_information" id="store_information">{{$owner->store->information}}</textarea>
                                </div>
                                <!-- パスワード -->
                                <div>
                                    <label for="password">パスワード</label>
                                    <input type="password" name="password" id="password" >
                                </div>
                                <!-- パスワード確認用 -->
                                <div>
                                    <label for="password_confirmation">パスワード</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" >
                                </div>
                                <div>
                                    <!-- 普通にbuttonを実行するとPOST送信してしまうので、type="button"をつける必要がある -->
                                    <button type="button" onclick="location.href='{{ route('admin.owners.index') }}'">戻る</button>
                                    <button type="submit" >更新</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
