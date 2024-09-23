<?php

use App\Models\User;
use App\Models\Task;
use App\Models\Category;
use function Pest\Laravel\{actingAs, post, get, patch, delete};
use Illuminate\Testing\Fluent\AssertableJson;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('user can retrieve paginated tasks', function () {
    Task::factory()->count(57)->create();

    $response = $this->getJson(route('tasks.index', ['per_page' => 20, 'page' => 2]));

    $response->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
            $json->where('success', true)
                 ->where('message', 'Tasks retrieved successfully.')
                 ->has('data.tasks', 20) 
                 ->has('data.pagination', fn ($json) =>
                     $json->where('current_page', 2)
                          ->where('last_page', 3)
                          ->where('per_page', 20)
                          ->where('count', 20)  
                          ->where('total', 57)  
                          ->etc()
                 )
        );
});

test('can filter tasks by category', function () {
    $category1 = Category::factory()->create();
    $category2 = Category::factory()->create();

    Task::factory()->count(10)->create(['category_id' => $category1->id]);
    Task::factory()->count(5)->create(['category_id' => $category2->id]);  

    $response = $this->getJson(route('tasks.index', ['category' => $category1->id]));

    $response->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
            $json->where('success', true)
                ->where('message', 'Tasks retrieved successfully.')
                ->has('data.tasks', 10) 
                ->etc()
        );
});

test('can filter tasks by status', function () {
    $statusNew = 'New';
    $statusCompleted = 'Completed';

    Task::factory()->count(7)->create(['status' => $statusNew]); 
    Task::factory()->count(3)->create(['status' => $statusCompleted]); 

    $response = $this->getJson(route('tasks.index', ['status' => $statusNew]));

    $response->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
            $json->where('success', true)
                ->where('message', 'Tasks retrieved successfully.')
                ->has('data.tasks', 7) 
                ->etc()
        );
});

test('can filter tasks by category and status', function () {
    $category1 = Category::factory()->create();
    $category2 = Category::factory()->create();

    $statusInProgress = 'In Progress';
    $statusUnderReview = 'Under Review';

    Task::factory()->count(5)->create(['category_id' => $category1->id, 'status' => $statusInProgress]);  
    Task::factory()->count(3)->create(['category_id' => $category1->id, 'status' => $statusUnderReview]); 
    Task::factory()->count(4)->create(['category_id' => $category2->id, 'status' => $statusInProgress]);  

    $response = $this->getJson(route('tasks.index', [
        'category' => $category1->id, 
        'status' => $statusInProgress
    ]));

    $response->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
            $json->where('success', true)
                ->where('message', 'Tasks retrieved successfully.')
                ->has('data.tasks', 5) 
                ->etc()
        );
});

test('user can add new task', function() {
    $category = Category::factory()->create();

    $taskPostRequest = [
        'title' => fake()->sentence(),
        'description' => fake()->paragraph(),
        'status' => 'Completed', 
        'category' => $category->id, 
    ];

    $response = $this->postJson(route('tasks.store'), $taskPostRequest);
    $this->assertDatabaseHas('tasks', [
        'title' => $taskPostRequest['title'],
        'description' => $taskPostRequest['description'],
        'status' => $taskPostRequest['status'],
        'category_id' => $taskPostRequest['category'],
        'user_id' => $this->user->id,
        'completed_at' => now(),
    ]);

    $response->assertStatus(201)
        ->assertJsonStructure([
            'success',
            'message',
            'data' => [
                'id',
                'title',
                'description',
                'status',
                'user_id',
                'category_id',
                'completed_at',
                'created_at',
                'updated_at',
            ]
        ]);
});

test('user can see specific task', function () {
    $task = Task::factory()->create();

    $response = $this->getJson(route('tasks.show', $task->id));

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'success',
        'message',
        'data' => [
            'id',
            'title',
            'description',
            'status',
            'user_id',
            'category_id',
            'changed_at',
            'completed_at',
            'created_at',
            'updated_at',
        ]
    ]);

    $response->assertJson([
        'data' => $task->toArray()
    ]);
});

test('user can update a task', function() {
    $oldStatus = 'Under Review';
    $newStatus = 'Completed';
    $task = Task::factory()->create([
        'user_id' => $this->user->id, 
        'status' => $oldStatus
    ]);

    $taskRequest = [
        'title' => 'Updated Task Title',
        'description' => 'Updated task description.',
        'category' => $task->category_id,
        'status' => $newStatus
    ];

    $response = $this->putJson(route('tasks.update', $task->id), $taskRequest);

    $updatedTask = [
        'id' => $task->id,
        'title' => $taskRequest['title'],
        'description' => $taskRequest['description'],
        'status' => $newStatus,
        'changed_at' => now(),
        'completed_at' => now()
    ];

    $this->assertDatabaseHas('tasks', $updatedTask);

    $this->assertDatabaseHas('task_status_logs', [
        'task_id' => $task->id,
        'old_status' => $oldStatus,
        'new_status' => $newStatus,
        'changed_at' => now()
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'success',
            'message',
            'data'
        ]);
});

test('user can delete task', function() {
    $task = Task::factory()->create(['user_id' => $this->user->id]);

    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
    ]);

    $response = $this->deleteJson(route('tasks.destroy', $task->id));

    $this->assertDatabaseMissing('tasks', [
        'id' => $task->id
    ]);

    $response->assertStatus(204);
});

test('user can update task status', function () {
    $oldStatus = 'Under Review';
    $newStatus = 'Completed';
    $task = Task::factory()->create([
        'user_id' => $this->user->id,
        'status' => $oldStatus,
    ]);

    $response = $this->post(route('tasks.updateStatus', $task->id), [
        'status' => $newStatus,
    ]);

    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'status' => $newStatus,
        'changed_at' => now(),
        'completed_at' => now()
    ]);

    $this->assertDatabaseHas('task_status_logs', [
        'task_id' => $task->id,
        'old_status' => $oldStatus, 
        'new_status' => $newStatus,
        'changed_at' => now(),
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'success',
            'message',
            'data'
        ]);
});