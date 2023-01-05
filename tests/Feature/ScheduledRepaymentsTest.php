<?php

namespace Tests\Feature;

use App\Models\ScheduledRepaymentsLoan;
use App\Models\User;
use App\Shared\LoanConstant;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ScheduledRepaymentsTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    /**
     * Test user can pay
     *
     * @return void
     */
    public function testRepaymentLoan()
    {
        $userId = $this->faker->numerify();
        $repayment = ScheduledRepaymentsLoan::factory()->create();

        $user = Sanctum::actingAs(User::factory()->create(
            ['id' => $userId]
        ));

        $approveResponse = $this->actingAs($user, 'sanctum')->put('/api/repayment/' . $repayment->scheduled_repayments_loan_id, [
            'amount' => 11000
        ]);
        $approveResponse->assertStatus(200);

        $testData = ScheduledRepaymentsLoan::where('scheduled_repayments_loan_id', $repayment->scheduled_repayments_loan_id)->first();
        $this->assertEquals(LoanConstant::LOAN_STATE_PAID, $testData->loan_state);
    }

    /**
     * Test user can not pay the loan
     *
     * @return void
     */
    public function testRepaymentLoanNotEnough()
    {
        $userId = $this->faker->numerify();
        $repayment = ScheduledRepaymentsLoan::factory()->create();

        $user = Sanctum::actingAs(User::factory()->create(
            ['id' => $userId]
        ));

        $approveResponse = $this->actingAs($user, 'sanctum')->put('/api/repayment/' . $repayment->scheduled_repayments_loan_id, [
            'amount' => 200
        ]);
        $approveResponse->assertStatus(200);
    }
}
