<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;
    /**@test
     **/
//    public function testSendMoneyViaWalletSuccessfully()
//    {
//        $sender = User::factory()->create();
//        $account = Account::factory()->create();
//
//        Sanctum::actingAs($sender);
//
//        $response = $this->actingAs($sender)
//            ->postJson(route('transactions.send'), [
//                "payment_method" => "wallet",
//                'user_id' => $sender->id,
//                'amount' => 6000,
//                'account_name' => $account->account_name,
//                'account_number' => $account->account_number,
//                'from' => 'NGN'. 200,
//                'to' => 'GHC'. 13500,
//                'fee' => 0.00,
//                'rate' => 13.00,
//                'status' => 'pending',
//                'destination' => 'momo'
//            ]);
//
//        $response
//            ->assertStatus(200)
//            ->assertJson([
//                'status' => 'success',
//            ]);
//    }

}
