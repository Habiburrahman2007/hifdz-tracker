<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\RateLimiter;

uses(RefreshDatabase::class);

beforeEach(function () {
    RateLimiter::clear('login:test@example.com|127.0.0.1');
    RateLimiter::clear('register:127.0.0.1');
});

test('login is rate limited after 5 failed attempts', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password123'),
    ]);

    // Send 5 incorrect requests
    for ($i = 0; $i < 5; $i++) {
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);
        $response->assertSessionHasErrors('email');
        
        $errors = session()->get('errors')->get('email');
        $this->assertFalse(str_contains($errors[0], 'Terlalu banyak mencoba') || str_contains($errors[0], 'Terlalu banyak percobaan'));
    }

    // The 6th request should hit rate limit
    $response = $this->post('/login', [
        'email' => 'test@example.com',
        'password' => 'wrongpassword',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertTrue(str_contains(session()->get('errors')->first('email'), 'Terlalu banyak percobaan login'));

    // Even correct password should fail while rate limited
    $response = $this->post('/login', [
        'email' => 'test@example.com',
        'password' => 'password123',
    ]);
    $response->assertSessionHasErrors('email');
    $this->assertTrue(str_contains(session()->get('errors')->first('email'), 'Terlalu banyak percobaan login'));
});

test('registration is rate limited after 5 attempts', function () {
    // Send 5 attempts (even if validation fails or succeeds, it hits rate limit)
    for ($i = 0; $i < 5; $i++) {
        $response = $this->post('/register', [
            'name' => 'Wali ' . $i,
            'email' => 'wali' . $i . '@example.com',
            'password' => 'password123',
        ]);
        
        // Since we hit the dashboard after successful registration, assert redirect
        $response->assertRedirect('/dashboard');
        
        // Logout so we can register again
        $this->post('/logout');
    }

    // The 6th request should fail with rate limit error
    $response = $this->post('/register', [
        'name' => 'Wali Extra',
        'email' => 'waliextra@example.com',
        'password' => 'password123',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertTrue(str_contains(session()->get('errors')->first('email'), 'Terlalu banyak percobaan pendaftaran'));
});
