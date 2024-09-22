<?php

use App\Models\User;
use App\Models\Task;
use App\Models\Category;
use function Pest\Laravel\{actingAs, post, get, patch, delete};

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
        'category_id' => $category->id, 
    ];

    $response = $this->post(route('task.store'), $taskPostRequest);

    $this->assertDatabaseHas('tasks', [
        'title' => $taskPostRequest['title'],
        'description' => $taskPostRequest['description'],
        'status' => $taskPostRequest['status'],
        'category_id' => $taskPostRequest['category_id'],
        'user_id' => $this->user->id,
    ]);

    $response->assertRedirect(route('dashboard'))
        ->assertSessionHas('message', 'Task created successfully.');
});