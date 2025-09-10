<?php

namespace Database\Factories;

use App\Models\Label;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title(),
            'description' => $this->faker->paragraph(),
            'assigned_to' => User::factory(),
            'project_id' => Project::factory(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Task $task) {
            $labels = Label::factory(3)->create();
            $task->labels()->attach($labels);
        });
    }
}
