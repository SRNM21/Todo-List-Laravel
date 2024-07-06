<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'todo_id' => fake()->regexify('TODO-[A-Z0-9]{5}'),
            'todo' => fake()->sentence(5),
            'status' => fake()->randomElement(['pending','done','archive']),
            'date_created' => fake()->dateTime()
        ];
    }
}
