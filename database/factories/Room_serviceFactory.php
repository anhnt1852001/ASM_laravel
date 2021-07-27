<?php

namespace Database\Factories;

use App\Models\Room_service;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Room;
use App\Models\Service;

class Room_serviceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room_service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'room_id' => Room::all()->random()->id,
            'service_id' => Service::all()->random()->id,
            'additional_price' => rand(100, 1000)

        ];
    }
}
