<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Create User.
     * 
     * @test
     */
    public function should_create_user(): void
    {
        $user = User::factory()->create([
        'name' => 'tester doe',
        'email' => 'tester@test.com',
        'password' => '1234'
        ]);

        $this->assertNotNull($user->id);
    }
}
