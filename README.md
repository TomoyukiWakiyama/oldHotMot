$store = Store::findOrFail($id);

$store->name = $request->name;
$store->information = $request->information;
$store->is_selling = $request->is_selling;
$store->updated_at = Carbon::now();
$store->save();

return redirect()->route('owner.stores.index');