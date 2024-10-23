<?php

namespace Database\Seeders;

use App\Models\Clothing;
use App\Models\User;
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
        User::factory(1)->admin()->create();
        User::factory(2)->create();

        Clothing::factory(5)->create();
    }
}
