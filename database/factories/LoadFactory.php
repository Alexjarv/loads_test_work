<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Load;

class LoadFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Load::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->word,
            "weight" => '10 т.',
            "name" => $this->faker->city . ' - ' . $this->faker->city,
            "date" => date('d.m')
        ];
    }

}
