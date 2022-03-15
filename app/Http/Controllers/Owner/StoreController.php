<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Store;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StoreController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:owners');

        $this->middleware(function ($request, $next){
            $id = $request->route()->parameter('store');
            if(!is_null($id)){
                $routeOwnerId = Store::findOrFail($id)->owner->id;
                $owner_id = Auth::id();
                if($routeOwnerId !== $owner_id){
                    abort(404);
                }
            }
            return $next($request);
        });
    }


    public function index()
    {

        $stores = Store::where('owner_id', Auth::id())
            ->get();
        return view('owner.stores.index',
             compact('stores'));
    }

    public function edit($id)
    {
        $store = Store::findOrFail($id);
        return view('owner.stores.edit', 
                compact('store'));
        
    }

    public function update(Request $request, $id)
    {

        $store = Store::findOrFail($id);

        $store->name = $request->name;
        $store->information = $request->information;
        $store->is_selling = $request->is_selling;
        $store->updated_at = Carbon::now();
        $store->save();

        return redirect()->route('owner.stores.index');
    }
}
