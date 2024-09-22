<?php

use App\Models\User;
use App\Models\Task;
use App\Models\Category;
use function Pest\Laravel\{actingAs, post, get, patch, delete};
use App\Services\TaskService;

beforeEach(function () {
    $this->user = User::factory()->create();
});

test('user can create a task', function() {
    $this->actingAs($this->user);
    
    $category = Category::factory()->create();

    $taskPostRequest = [
        'title' => fake()->sentence(),
        'description' => fake()->paragraph(),
        'status' => 'New', 
        'category' => $category->id, 
    ];

    $response = $this->post(route('task.store'), $taskPostRequest);

    $this->assertDatabaseHas('tasks', [
        'title' => $taskPostRequest['title'],
        'description' => $taskPostRequest['description'],
        'status' => $taskPostRequest['status'],
        'category_id' => $taskPostRequest['category'],
        'user_id' => $this->user->id,
    ]);

    $response->assertRedirect(route('dashboard'))
        ->assertSessionHas('message', 'Task created successfully.');
});

test('user can view edit task form', function() {
    $this->actingAs($this->user);

    $task = Task::factory()->create(['user_id' => $this->user->id]);
    $categories = Category::factory()->count(5)->create();

    $response = $this->get(route('task.edit', $task->id));
    $response->assertStatus(200);
    $response->assertSee($task->title)
        ->assertSee($task->description) 
        ->assertSee($task->status)
        ->assertSee($task->category->title);
});

test('user can update task', function() {
    $this->actingAs($this->user);

    $oldStatus = 'New';
    $task = Task::factory()->create([
        'user_id' => $this->user->id, 
        'status' => $oldStatus
    ]);

    $updatedTask = [
        'title' => 'Updated Task Title',
        'description' => 'Updated task description.',
        'category' => $task->category_id,
        'status' => 'In Progress'
    ];

    $response = $this->patch(route('task.update', $task->id), $updatedTask);

    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'title' => $updatedTask['title'],
        'description' => $updatedTask['description'],
        'status' => $updatedTask['status']
    ]);

    $this->assertDatabaseHas('task_status_logs', [
        'task_id' => $task->id,
        'old_status' => $oldStatus,
        'new_status' => $updatedTask['status'],
        'changed_at' => now()->format('Y-m-d H:i:s')
    ]);

    $response->assertRedirect(route('dashboard'))
             ->assertSessionHas('message', 'Task updated successfully.');
});

test('user can delete task', function() {
    $this->actingAs($this->user);

    $task = Task::factory()->create(['user_id' => $this->user->id]);

    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
    ]);

    $response = $this->delete(route('task.destroy', $task->id));

    $this->assertDatabaseMissing('tasks', [
        'id' => $task->id
    ]);

    $response->assertRedirect(route('dashboard'))
             ->assertSessionHas('message', 'Task deleted successfully.');
});