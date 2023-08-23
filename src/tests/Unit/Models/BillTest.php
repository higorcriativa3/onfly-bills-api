<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Bill;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BillTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create User bills.
     * 
     * @test
     */
    public function should_create_user_bills(): void
    {
        $user = User::factory()->create([
          'name' => 'tester doe',
          'email' => 'tester@test.com',
          'password' => '1234'
        ]);

        $bill1 = Bill::create([
          'user_id' => $user->id,
          'name' => 'test bill 1',
          'bill_date' => '2023-08-21',
          'description' => 'test description 1',
          'amount' => 88.33,
        ]);

        $bill2 = Bill::create([
          'user_id' => $user->id,
          'name' => 'test bill 2',
          'bill_date' => '2023-08-21',
          'description' => 'test description 2',
          'amount' => 85.33,
        ]);

        $this->assertNotNull($bill1->id);
        $this->assertTrue($bill1->user()->exists());
        $this->assertNotNull($bill2->id);
        $this->assertTrue($bill2->user()->exists());
    }

    /**
     * Update User bill.
     * 
     * @test
     */
    public function should_update_user_bill(): void
    {
        $user = User::factory()->create([
          'name' => 'tester doe',
          'email' => 'tester@test.com',
          'password' => '1234'
        ]);

        $bill = Bill::create([
          'user_id' => $user->id,
          'name' => 'test bill 1',
          'bill_date' => '2023-08-21',
          'description' => 'test description 1',
          'amount' => 88.33,
        ]);

        $bill->update([
          'amount' => 85.50
        ]);

        $this->assertEquals(85.50, $bill->amount);
        $this->assertNotNull($bill->updated_at);
    }

    /**
     * Delete User bill.
     * 
     * @test
     */
    public function should_delete_user_bill(): void
    {
        $user = User::factory()->create([
          'name' => 'tester doe',
          'email' => 'tester@test.com',
          'password' => '1234'
        ]);

        $bill = Bill::create([
          'user_id' => $user->id,
          'name' => 'test bill 1',
          'bill_date' => '2023-08-21',
          'description' => 'test description 1',
          'amount' => 88.33,
        ]);

        $bill->delete();

        $this->assertNotNull($bill->deleted_at);
    }
}
