<?php

namespace Database\Factories\Recruitment;

use App\Models\Recruitment\JobAdvertisement;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobAdvertisementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobAdvertisement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'position_number'=>'VAC' . ' '.$this->faker->randomNumber(2, true).'/'.$this->faker->randomNumber(4, true),
        ];
    }
}
