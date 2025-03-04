<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Timesheet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Timesheet>
 */
class TimesheetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'task_name' => $this->faker->sentence(3),
            'date' => $this->faker->date(),
            'hours' => $this->faker->randomFloat(2, 1, 8),
            'user_id' => User::factory(),
            'project_id' => Project::factory(),
        ];
    }
}
