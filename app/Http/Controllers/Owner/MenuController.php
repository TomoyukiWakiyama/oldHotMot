<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Store;
use App\Models\Category;
use App\Models\Owner;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MenuController extends Controller
{
    public function __construct()
    {
        // guard設定
        $this->middleware('auth:owners');

        // ログインオーナーチェック
        $this->middleware(function ($request, $next){
            $id = $request->route()->parameter('menu');
            if(!is_null($id)){
                $routeOwnerId = Menu::findOrFail($id)->store->owner_id;
                $currentOwnerId = Auth::id();
                if($routeOwnerId !== $currentOwnerId){
                    abort(404);
                }
            }
            return $next($request);
        });

    }


    public function index()
    {
        //
        $owner_eager = Owner::with('store.menu.category')
                    -> where('id', Auth::id())
                    -> get();

        return view('owner.menus.index',
                compact('owner_eager'));
    }

    public function create()
    {
        //
        // 店舗情報を取得する
        $store = Store::where('owner_id', Auth::id())
                ->select('id', 'name')
                ->first();

        // カテゴリー情報を取得する
        $categories = Category::select('id', 'name')
                    ->get();
        
        return view('owner.menus.create',
            compact('store', 'categories'));
    }


    public function store(Request $request)
    {
        //
        // validate
        $request->validate([
            'name' => ['required', 'string', 'max:50', 'unique:menus'],
            'information' => ['required', 'string', 'max:500'],
            'price' => ['required', 'integer'],
            'is_selling' => ['required'], // boolean
            'sort_order' => ['integer', 'nullable'],
            'category' => ['required', 'exists:categories,id'],
            'new_item' => ['required'], // boolean
            'soon_over' => ['required'], // boolean
            'small_serving' => ['required'], // boolean
        ]);

        // ログインしているオーナーidから、そのオーナーの店舗を調べる
        $store = Store::where('owner_id', Auth::id())
                ->select('id')
                ->first();

        Menu::create([
            'store_id' => $store->id,
            'name' => $request->name,
            'information' => $request->information,
            'price' => $request->price,
            'is_selling' => $request->is_selling,
            'sort_order' => $request->sort_order,
            'category_id' => $request->category,
            'new_item' => $request->new_item,
            'soon_over' => $request->soon_over,
            'small_serving' => $request->small_serving,
        ]);

        return redirect()->route('owner.menus.index');

    }

    public function edit($id)
    {
        //
        $menu = Menu::findOrFail($id);
        // カテゴリー情報を取得する
        $categories = Category::select('id', 'name')
                    ->get();

        return view('owner.menus.edit', compact('menu', 'categories'));
    }

    public function update(Request $request, $id)
    {
        //
        // validate
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'information' => ['required', 'string', 'max:500'],
            'price' => ['required', 'integer', 'max:10000',],
            'is_selling' => ['required', 'boolean'], // boolean
            'sort_order' => ['integer', 'max:100', 'nullable'],
            'category' => ['required', 'exists:categories,id'],
            'new_item' => ['required', 'boolean'], // boolean
            'soon_over' => ['required', 'boolean'], // boolean
            'small_serving' => ['required', 'boolean'], // boolean
        ]);

        // idからmenuを検索する
        $menu = Menu::findOrFail($id);

        $menu->name = $request->name;
        $menu->information = $request->information;
        $menu->price = $request->price;
        $menu->is_selling = $request->is_selling;
        $menu->sort_order = $request->sort_order;
        $menu->category_id = $request->category;
        $menu->new_item = $request->new_item;
        $menu->soon_over = $request->soon_over;
        $menu->small_serving = $request->small_serving;
        $menu->save();

        return redirect()->route('owner.menus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Menu::findOrFail($id)->delete();
        return redirect()->route('owner.menus.index');
    }
}
