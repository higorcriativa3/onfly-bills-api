<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BillControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Should create bill.
     * 
     * @test
     */
    public function should_create_bill(): void
    {
        $user = User::factory()->create([
            'name' => 'Tester Doe',
            'email' => 'tester@test.com',
        ]);
 
        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->post(
                            '/api/bills',
                            [
                                'name' => 'Test bill',
                                'bill_date' => '2023-08-21',
                                'description' => 'Test description',
                                'amount' => 50.00
                            ]
                        );

        $response->assertStatus(201);
    }

    /**
     * Should get bill.
     * 
     * @test
     */
    public function should_get_bill(): void
    {
        $user = User::factory()->create([
            'name' => 'Tester Doe',
            'email' => 'tester@test.com',
        ]);
 
        $newBill = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->post(
                            'api/bills',
                            [
                                'name' => 'Test bill',
                                'bill_date' => '2023-08-21',
                                'description' => 'Test description',
                                'amount' => 50.00
                            ]
                        );

        $billId = $newBill->original->id;

        $url = url("/api/bills/{$billId}");

        $response = $this->actingAs($user)
                        ->withSession(['banned' => false])
                        ->get($url);

        $response->assertStatus(200);
    }

    /**
     * Should update bill.
     * 
     * @test
     */
    public function should_update_bill(): void
    {
        $user = User::factory()->create([
            'name' => 'Tester Doe',
            'email' => 'tester@test.com',
        ]);
 
        $newBill = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->post(
                            '/api/bills',
                            [
                                'name' => 'Test bill',
                                'bill_date' => '2023-08-21',
                                'description' => 'Test description',
                                'amount' => 50.00
                            ]
                        );

        $billId = $newBill->original->id;

        $url = url("/api/bills/{$billId}");

        $response = $this->actingAs($user)
                        ->withSession(['banned' => false])
                        ->put(
                            $url,
                            [
                                'name' => 'Test Updated',
                            ],
                        );

        $response->assertStatus(200);
    }

    /**
     * Should delete bill.
     * 
     * @test
     */
    public function should_delete_bill(): void
    {
        $user = User::factory()->create([
            'name' => 'Tester Doe',
            'email' => 'tester@test.com',
        ]);
 
        $newBill = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->post(
                            '/api/bills',
                            [
                                'name' => 'Test bill',
                                'bill_date' => '2023-08-21',
                                'description' => 'Test description',
                                'amount' => 50.00
                            ]
                        );

        $billId = $newBill->original->id;

        $url = url("/api/bills/{$billId}");

        $response = $this->actingAs($user)
                        ->withSession(['banned' => false])
                        ->put(
                            $url,
                            [
                                'name' => 'Test Updated',
                            ],
                        );

        $response->assertStatus(200);
    }
}
