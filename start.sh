#!/bin/bash

cp .env.example .env
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan tinker --execute="if (\App\Models\User::where('user_name', 'admin')->doesntExist()) {
    \App\Models\User::create([
        'user_name' => 'admin',
        'first_name' => 'admin',
        'last_name' => 'admin',
        'password' => bcrypt('admin')
    ]);
}"
./vendor/bin/sail npm run dev &
./vendor/bin/sail artisan queue:work
