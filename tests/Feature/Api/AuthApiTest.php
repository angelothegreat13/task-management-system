<?php

use function Pest\Laravel\post;
use App\Models\User;

function success_json_response_structure() 
{
    return [
        'success',
        'message',
        'data' => [
            'user' => [
                'id',
                'name',
                'email',
                'created_at',
                'updated_at'
            ],
            'token'
        ]
    ];
}

test('user can register with valid inputs', function() {       
    $userData = [
        'name' => 'John Doe',
        'email' => 'johndoe@gmail.com',
        'password' => 'password',
        'password_confirmation' => 'password' 
    ];

    $response = $this->postJson(route('api.register'), $userData);

    $this->assertDatabaseHas('users', [
        'name' => $userData['name'],
        'email' => $userData['email']
    ]);

    $response->assertStatus(201)
        ->assertJsonStructure(success_json_response_structure());
});

test('user cannot register with invalid inputs', function () {
    $invalidUserData = [
        'name' => '', 
        'email' => 'invalid-email', 
        'password' => 'short', 
        'password_confirmation' => 'doesnotmatch', 
    ];

    $response = $this->postJson(route('api.register'), $invalidUserData);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['name', 'email', 'password']);
});

test('user can login with valid credentials', function () {
    $user = User::factory()->create();

    $response = $this->postJson(route('api.login'), [
        'email' => $user->email,
        'password' => 'password'
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure(success_json_response_structure());
});

test('user cannot login with invalid credentials', function() {
    $response = $this->postJson(route('api.login'), [
        'email' => 'wrongemail@gmail.com',
        'password' => 'wrongpassword'
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email' => ['The provided credentials are incorrect.']]);
});