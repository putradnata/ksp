<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AnggotaSeeder::class);
        $this->call(AkunSeeder::class);
        $this->call(SimpananSeeder::class);
        $this->call(SimpananPokokSeeder::class);
        $this->call(SimpananKhususSeeder::class);
        $this->call(PinjamanSeeder::class);
    }
}
