<?php

namespace Tests\Feature;

use App\Http\Controllers\SignUpController;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class SignUpControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
//    public function user_can_sign_up()
//    {
//        Carbon::setTestNow(Carbon::create(2023, 2, 26, 9, 15, 31));
//        $response = $this->post(action(SignUpController::class), [
//            'firstname'             => 'Toby',
//            'lastname'              => 'Okeke',
//            'email'                 => 'toby@example.com',
//            'country'               => 'Ghana',
//            'password'              => 'password',
//            'password_confirmation' => 'password'
//        ]);
//
//        $user = User::where('email', 'toby@example.com')->first();
//
//        $response->dump()->assertSuccessful()->assertSimilarJson(
//            [
//                'message' => 'Registration Successful',
//                'user'    => [
//                    'created_at' => '2023-02-26T09:15:31.000000Z',
//                    'email'      => 'toby@example.com',
//                    'firstname'  => 'Toby',
//                    'country'    => 'Ghana',
//                    'wallets'    => [[
//                                         "balance"    => "0.0000",
//                                         "country"    => "Ghana",
//                                         "created_at" => "2023-02-26T09:15:31.000000Z",
//                                         "currency"   => "GHC",
//                                         "id"         => 2,
//                                         "number"     => "41452940e4",
//                                         "updated_at" => "2023-02-26T09:15:31.000000Z",
//                                         "user_id"    => 1,
//                                     ], [
//                                         "balance"    => "0.0000",
//                                         "country"    => "Ghana",
//                                         "created_at" => "2023-02-26T09:15:31.000000Z",
//                                         "currency"   => "NGN",
//                                         "id"         => 1,
//                                         "number"     => "4145293bb0",
//                                         "updated_at" => "2023-02-26T09:15:31.000000Z",
//                                         "user_id"    => 1,
//                                     ],],
//                    'id'         => 1,
//                    'lastname'   => 'Okeke',
//                    'updated_at' => '2023-02-26T09:15:31.000000Z',
//                ]
//            ]);
//        $this->assertNotNull($user);
//        $this->assertEquals('Toby', $user->firstname);
//        $this->assertEquals('Okeke', $user->lastname);
//        $this->assertEquals('toby@example.com', $user->email);
//        $this->assertEquals('Ghana', $user->country);
//    }
}
