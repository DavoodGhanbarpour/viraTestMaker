<?php

namespace Database\Seeders;

use Faker\Core\Number;
use Faker\Provider\bg_BG\PhoneNumber;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username'      => 'admin',
            'avatar'        => Str::random(10),
            'name'          => Str::random(10),
            'email'         => Str::random(10).'@gmail.com',
            'phoneNumber'   => Str::random(11),
            'password'      => Hash::make('123'),
            'role'          => 'ADMIN',
        ]);
    }
}
