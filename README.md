DB::table('users')->insert([
[
    'name' => 'User1',
    'email' => 'user1@fake.com',
    'password' => Hash::make('password'),
    'created_at' => Carbon::now(),
    'updated_at' => Carbon::now(),
],
...
]);