<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Panila',
                'username' => 'pani',
                'email' => 'pani@gmail.com',
                'password' => Hash::make('asdasd123'),
                'jabatan' => 'K',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Panila',
                'username' => 'admin',
                'email' => 'panila@gmail.com',
                'password' => Hash::make('asdasd123'),
                'jabatan' => 'A',
                'created_at' => Carbon::now(),
            ],
        ];
        DB::table('users')->insert($data);
    }
}
