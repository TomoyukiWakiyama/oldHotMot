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