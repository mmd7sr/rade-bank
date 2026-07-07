<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RateLimitTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_routes_expose_the_rate_limit_headers(): void
    {
        $response = $this->getJson('/api/ping');

        $response->assertOk();
        $response->assertHeader('X-RateLimit-Limit', 60);
    }

    public function test_api_returns_json_429_when_the_limit_is_exceeded(): void
    {
        // 60 allowed requests, then the 61st must be throttled.
        for ($i = 0; $i < 60; $i++) {
            $this->getJson('/api/ping')->assertOk();
        }

        $response = $this->getJson('/api/ping');

        $response->assertStatus(429);
        $response->assertJson(['message' => 'Too many requests. Please try again later.']);
        $response->assertHeader('Retry-After');
    }

    public function test_auth_routes_are_throttled_after_five_attempts(): void
    {
        // 5 allowed login attempts per minute, then the 6th is throttled.
        for ($i = 0; $i < 5; $i++) {
            $this->post('/login', [
                'email' => 'nobody@example.com',
                'password' => 'wrong-password',
            ]);
        }

        $response = $this->post('/login', [
            'email' => 'nobody@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertStatus(429);
    }
}
