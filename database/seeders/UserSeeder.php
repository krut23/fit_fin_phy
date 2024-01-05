<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->insert([
            [
                'name' => 'Hello',
                'email' => 'hello@gmail.com',
                'phone' => null,
                'password' => Hash::make('this.hello'),
                'is_admin' => 1,
                'is_active' => 1
            ],
            [
                'name' => 'Black',
                'email' => 'black@gmail.com',
                'phone' => null,
                'password' => Hash::make('this.black'),
                'is_admin' => 1,
                'is_active' => 1
            ],

        ]);
    }
}
