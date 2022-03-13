Owner::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => $request->password,
]);