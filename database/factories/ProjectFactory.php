<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Project $project) {
            $project->users()->attach(User::factory(3)->create());
        });
    }
}
