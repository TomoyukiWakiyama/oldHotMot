<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Owner;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\log;
use Illuminate\Validation\Rules;
use Throwable;

class OwnersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    

    public function index()
    {
        //
        $owners = Owner::select('id', 'name', 'email', 'created_at', 'updated_at')
                    ->get();

        return view('admin.owners.index',
                compact('owners'));
    }

    public function create()
    {
        //
        return view('admin.owners.create');
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:owners'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try{
            DB::transaction(function () use($request) {
                // Owner create
                $owner = Owner::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                Store::create([
                    'owner_id' => $owner->id,
                    'name' => '店舗名_未設定',
                    'information' => '店舗情報_未設定',
                    'is_selling' => true,
                ], 2);


            });

        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }

        return redirect()->route('admin.owners.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
        $owner = Owner::findOrFail($id);
        return view('admin.owners.edit',
                compact('owner'));

    }

    public function update(Request $request, $id)
    {
        //

        $owner = Owner::findOrFail($id);

        // Validate

        // Update
        if($request->name && $owner->name !== $request->name){
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
            ]);
            $owner->name = $request->name;
        }
        if($request->email && $owner->email !== $request->email){
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:owners'],
            ]);
            $owner->email = $request->email;
        }
        if($request->password){
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            $owner->password = Hash::make($request->password);
        }
        $owner->updated_at = Carbon::now();
        $owner->save();

        return redirect()->route('admin.owners.index');
    }

    public function destroy($id)
    {
        //
        Owner::findOrFail($id)->delete();
        return redirect()->route('admin.owners.index');
    }

    /*********************************
        canceled-owners
    *********************************/
    public function canceledOwnerIndex()
    {
        $owners = Owner::onlyTrashed()->get();
        return view('admin.owners.canceled-owners', compact('owners'));
    }

    public function canceledOwnerDestroy($id)
    {
        Owner::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('admin.canceled-owners.index');
    }

}
