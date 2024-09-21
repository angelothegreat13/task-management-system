<?php

use App\Models\User;
use function Pest\Laravel\post;

test('a user can login with valid credentials and redirects to dashboard', function () {
    $user = User::factory()->create();

    $response = post(route('login'), [
        'email' => $user->email,
        'password' => 'password'
    ]);

    $response->assertRedirect(route('dashboard'));
    $this->assertAuthenticatedAs($user);
});

test('a user cannot login with invalid credentials', function () {
    $response = post(route('login'), [
        'email' => 'johndoe@gmail.com',
        'password' => 'password'
    ]);

    $this->assertGuest();
    $response->assertSessionHasErrors(['email']);
});

test('a user with correct inputs can register and redirects to dashboard', function() {
    $userData = [
        'name' => fake()->name(),
        'email' => fake()->unique()->safeEmail(),
        'password' => 'password',
        'password_confirmation' => 'password', 
    ];

    $response = post(route('register'), $userData);

    $response->assertRedirect(route('dashboard'));
    $this->assertAuthenticated();
});


test('a user cannot register with invalid inputs', function () {
    $response = post(route('register'), [
        'name' => '',
        'email' => 'wrongemail',
        'password' => 'password',
        'password_confirmation' => 'new_password',
    ]);

    $this->assertGuest();
    $response->assertSessionHasErrors(['name', 'email', 'password']);
});
