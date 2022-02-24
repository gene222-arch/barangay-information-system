<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'title' => $this->faker->title(),
            'subject' => $this->faker->title(),
            'body' => $this->faker->sentence(),
            'created_at' => Carbon::now()
        ];
    }
}
