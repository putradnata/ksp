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
                'name' => 'Ditta',
                'username' => 'ditta',
                'email' => 'ditta68@gmail.com',
                'password' => Hash::make('asdasd123'),
                'jabatan' => 'K',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Galdi',
                'username' => 'admin',
                'email' => 'galdi666@gmail.com',
                'password' => Hash::make('asdasd123'),
                'jabatan' => 'A',
                'created_at' => Carbon::now(),
            ],
        ];
        DB::table('users')->insert($data);
    }
}
