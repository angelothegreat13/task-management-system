<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskStatusLog>
 */
class TaskStatusLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = config('task.status_sequence');

        return [
            'task_id' => Task::factory(),
            'old_status' => $status[0],
            'new_status' => $status[1],
            'changed_at' => now(), 
        ];
    }
}
