<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       User::create([
        'name'=>'admin',
        'email'=>'admin@gmail.com',
        'phone'=>'0912345678',
        'address'=>'Yangon',
        'password'=>Hash::make('admin123'),
        'role'=>'admin'
       ]);
    }
}
