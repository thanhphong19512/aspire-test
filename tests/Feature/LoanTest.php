<?php

namespace Tests\Feature;

use App\Models\Loan;
use App\Models\User;
use App\Services\Loan\LoanService;
use App\Shared\LoanConstant;
use App\Shared\UserConstant;
use Exception;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LoanTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    /**
     * Test user can see their loans
     *
     * @return void
     */
    public function testLoggedUserCanSeeLoans()
    {
        $userId = $this->faker->numerify();
        $loan = Loan::factory()->create(
            ['user_id' => $userId]
        );

        $user = Sanctum::actingAs(User::factory()->create(
            ['id' => $userId]
        ));

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/loan');

        $response->assertStatus(200);
        $this->assertEquals([$loan->toArray()], $response['data']);
    }

    /**
     * Test user can see their loans
     *
     * @return void
     */
    public function testNotLoggedUserCanNotSeeLoans()
    {
        $response = $this->getJson('/api/loan');

        $this->createMock(LoanService::class)
            ->method('getUserLoans')
            ->willThrowException(new Exception('Error'));


        $response->assertStatus(401);
    }

    /**
     * Test user can see their loan
     *
     * @return void
     */
    public function testLoggedUserCanSeeLoan()
    {
        $userId = $this->faker->numerify();
        $loan = Loan::factory()->create(
            ['user_id' => $userId]
        );

        $user = Sanctum::actingAs(User::factory()->create(
            ['id' => $userId]
        ));

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/loan/' . $loan->loan_id);

        $response->assertStatus(200);
        $this->assertEquals($loan->toArray(), $response['data']);
    }

    /**
     * Test user can submit loan
     *
     * @return void
     */
    public function testLoggedUserCanSubmitLoan()
    {
        $userId = $this->faker->numerify();
        $user = Sanctum::actingAs(User::factory()->create(
            ['id' => $userId]
        ));

        $amount = $this->faker->numberBetween(1000, 999999999);
        $this->actingAs($user, 'sanctum')
            ->post('/api/loan/', [
                'term' => 3,
                'amount' => $amount
            ]);

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/loan');

        $response->assertStatus(200);

        $this->assertEquals(3, $response['data'][0]['term']);
        $this->assertEquals($amount, $response['data'][0]['amount']);
    }

    /**
     * Test user can see their loan
     *
     * @return void
     */
    public function testAdminCanApproveLoan()
    {
        $loan = Loan::factory()->create();
        $user = Sanctum::actingAs(User::factory()->create(
            ['role_id' => UserConstant::USER_ROLE_ADMIN]
        ));

        $approveResponse = $this->actingAs($user, 'sanctum')->put('/api/loan/approve/' . $loan->loan_id);
        $approveResponse->assertStatus(200);

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/loan/' . $loan->loan_id);

        $response->assertStatus(200);
        $this->assertEquals(LoanConstant::LOAN_STATE_APPROVED, $response['data']['loan_state']);
    }
}
