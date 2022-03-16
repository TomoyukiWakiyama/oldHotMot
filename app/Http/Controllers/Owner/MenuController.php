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
        $stores = Store::where('owner_id', Auth::id())
                ->select('id', 'name')
                ->get();
        // カテゴリー情報を取得する
        $categories = Category::select('id', 'name')
                    ->get();
        
        return view('owner.menus.create',
            compact('stores', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        dd($request->category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}
