<?php

namespace Tests\Feature;

use App\Enum\Currency;
use App\Enum\Destination;
use App\Http\Controllers\AddRecipientController;
use App\Models\Recipient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateRecipientControllerTest extends TestCase
{
    use RefreshDatabase;
//
//    /**
//     * @test
//     */
//    public function users_can_create_gh_bank_account()
//    {
//        Carbon::setTestNow(Carbon::parse('2021-01-01 00:00:00'));
//
//        // Arrange
//        $user = User::factory()->create();
//        $this->actingAs($user, 'api');
//
//        $recipientData = [
//            'type' => Destination::BANK->value,
//            'currency' => Currency::GHC->value,
//            'country' => 'GH',
//            'name' => 'Test Account',
//            'number' => '1234567890',
//            'provider' => 'Bank of Ghana',
//            'bank_code' => '123',
//        ];
//
//        // Act
//        $response = $this->postJson(action(AddRecipientController::class), $recipientData);
//
//        // Assert
//        $response->assertStatus(201)
//            ->assertJsonStructure([
//                'data' => [
//                    'id',
//                    'user_id',
//                    'type',
//                    'currency',
//                    'country',
//                    'name',
//                    'number',
//                    'provider',
//                    'bank_code',
//                    'metadata',
//                    'created_at',
//                    'updated_at',
//                ],
//            ])
//            ->assertJson([
//                'data' => $recipientData,
//            ]);
//
//        $account = $response->json('data');
//
//        $this->assertEquals($account, Recipient::first()->toArray());
//
//    }
//
//    /**
//     * @test
//     */
//    public function users_can_create_gh_momo_account()
//    {
//        Carbon::setTestNow(Carbon::parse('2021-01-01 00:00:00'));
//
//        // Arrange
//        $user = User::factory()->create();
//        $this->actingAs($user, 'api');
//
//        $recipientData = [
//            'type' => Destination::MOBILE_MONEY->value,
//            'currency' => Currency::GHC->value,
//            'country' => 'GH',
//            'name' => 'Test Account',
//            'number' => '1234567890',
//            'provider' => 'MTN',
//            'bank_code' => '123',
//        ];
//
//        // Act
//        $response = $this->postJson(action(AddRecipientController::class), $recipientData);
//
//        // Assert
//        $response->assertStatus(201)
//            ->assertJsonStructure([
//                'data' => [
//                    'id',
//                    'user_id',
//                    'type',
//                    'currency',
//                    'country',
//                    'name',
//                    'number',
//                    'provider',
//                    'bank_code',
//                    'metadata',
//                    'created_at',
//                    'updated_at',
//                ],
//            ])
//            ->assertJson([
//                'data' => $recipientData,
//            ]);
//
//        $account = $response->json('data');
//
//        $this->assertEquals($account, Recipient::first()->toArray());
//
//    }
//
//    /**
//     * @test
//     */
//    public function users_can_create_ng_bank_account()
//    {
//        Carbon::setTestNow(Carbon::parse('2021-01-01 00:00:00'));
//
//        // Arrange
//        $user = User::factory()->create();
//        $this->actingAs($user, 'api');
//
//        $recipientData = [
//            'type' => Destination::BANK->value,
//            'currency' => Currency::NGN->value,
//            'country' => 'NG',
//            'name' => 'Test Account',
//            'number' => '1234567890',
//            'provider' => 'Zenith Bank',
//            'bank_code' => '123',
//        ];
//
//        // Act
//        $response = $this->postJson(action(AddRecipientController::class), $recipientData);
//
//        // Assert
//        $response->assertStatus(201)
//            ->assertJsonStructure([
//                'data' => [
//                    'id',
//                    'user_id',
//                    'type',
//                    'currency',
//                    'country',
//                    'name',
//                    'number',
//                    'provider',
//                    'bank_code',
//                    'metadata',
//                    'created_at',
//                    'updated_at',
//                ],
//            ])
//            ->assertJson([
//                'data' => $recipientData,
//            ]);
//
//        $account = $response->json('data');
//
//        $this->assertEquals($account, Recipient::first()->toArray());
//
//    }

}
