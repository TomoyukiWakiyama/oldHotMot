<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            新規登録
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
                        <form action="{{route('admin.owners.store')}}" method="post">
                            @csrf
                            <div> <!-- デザイン用でとりあえず囲っておく -->
                                <!-- 名前 -->
                                <div>
                                    <label for="name">名前</label>
                                    <input type="text" name="name" id="name" required value="{{old('name')}}">
                                </div>
                                <!-- メール -->
                                <div>
                                    <label for="email">メールアドレス</label>
                                    <input type="email" name="email" id="email" required value="{{old('email')}}">
                                </div>
                                <!-- パスワード -->
                                <div>
                                    <label for="password">パスワード</label>
                                    <input type="password" name="password" id="password" required value="">
                                </div>
                                <!-- パスワード確認用 -->
                                <div>
                                    <label for="password_confirmation">パスワード</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" required value="">
                                </div>
                                <div>
                                    <!-- 普通にbuttonを実行するとPOST送信してしまうので、type="button"をつける必要がある -->
                                    <button type="button" onclick="location.href='{{ route('admin.owners.index') }}'">戻る</button>
                                    <button type="submit" >登録</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
