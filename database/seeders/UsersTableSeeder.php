<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username'        => 'Cariaga, Benhur L.',
            'given_name'      => 'Benhur',
            'middle_name'     => 'Leproso',
            'surname'         => 'Cariaga',
            'role'            => 'Administrator',
            'contact_number'  => '09123456789',
            'password'        => Hash::make('12345678'),
            'profile_picture' => null,
            'time_registered' => now(),
        ]);

        User::create([
            'username'        => 'Hinoctan, Angel Kate P.',
            'given_name'      => 'Angel Kate',
            'middle_name'     => 'Provendido',
            'surname'         => 'Hinoctan',
            'role'            => 'Encoder',
            'contact_number'  => '09987654321',
            'password'        => Hash::make('12345678'),
            'profile_picture' => null,
            'time_registered' => now(),
        ]);

        User::create([
            'username'        => 'Bragas, Mariann F.',
            'given_name'      => 'Mariann',
            'middle_name'     => 'Flores',
            'surname'         => 'Bragas',
            'role'            => 'GL Operator',
            'contact_number'  => '09192837465',
            'password'        => Hash::make('12345678'),
            'profile_picture' => null,
            'time_registered' => now(),
        ]);

        User::create([
            'username'        => 'Cando, Aimee Laurence',
            'given_name'      => 'Aimee Laurence',
            'middle_name'     => null,
            'surname'         => 'Cando',
            'role'            => 'SMS Operator',
            'contact_number'  => '09912837465',
            'password'        => Hash::make('12345678'),
            'profile_picture' => null,
            'time_registered' => now(),
        ]);
    }
}