<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UpdateUsersPasswordSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')
            ->where('user_id', 1)
            ->update([
                'password' => Hash::make('12345678'),
            ]);

        DB::table('users')
            ->where('user_id', 2)
            ->update([
                'password' => Hash::make('12345678'),
            ]);

        DB::table('users')
            ->where('user_id', 3)
            ->update([
                'password' => Hash::make('12345678'),
            ]);

        DB::table('users')
            ->where('user_id', 4)
            ->update([
                'password' => Hash::make('12345678'),
            ]);
    }
}