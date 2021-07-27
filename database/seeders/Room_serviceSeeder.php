<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room_service;


class Room_serviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room_service::factory(5)->create();
    }
}
