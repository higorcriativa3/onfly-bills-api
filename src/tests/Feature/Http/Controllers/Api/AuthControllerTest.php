<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Should create and return user.
     * 
     * @test
     */
    public function should_create_and_return_user(): void
    {
      $response = $this->postJson(
        'api/auth/register',
        [
          'name' => 'Tester Doe',
          'email' => 'tester@test.com',
          'password' => 'abc1234',
        ],
      );
 
      $response->assertStatus(200);
    }

    /**
     * Should validate wrong email.
     * 
     * @test
     */
    public function should_fail_email_validation(): void
    {
      $response = $this->postJson(
        'api/auth/register',
        [
          'name' => 'Tester Doe',
          'email' => 'test.com',
          'password' => 'abc1234',
        ],
      );
 
      $response->assertStatus(422);
    }
}
