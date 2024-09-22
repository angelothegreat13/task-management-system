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
    $statuses = config('task.status_sequence');
    $nextStatus = app(TaskService::class)->getNextStatus($task->status, $statuses);

    $response = $this->get(route('task.edit', $task->id));
    $response->assertStatus(200);
    $response->assertSee($task->title)
        ->assertSee($task->description) 
        ->assertSee($task->status)
        ->assertSee($task->category->title);

    foreach ($categories as $category) {
        $response->assertSee($category->title);
    }

    foreach ($statuses as $status) {
        $response->assertSee($status);
    }

    if ($nextStatus) {
        $response->assertSee($nextStatus);
    }
});

test('user can update task', function() {
    $this->actingAs($this->user);


});