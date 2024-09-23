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