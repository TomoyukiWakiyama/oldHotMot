<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Owner;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

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

        Owner::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

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
